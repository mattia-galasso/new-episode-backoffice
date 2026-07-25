<?php

namespace App\Services;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\ProductionCompany;
use App\Models\TvSeries;
use App\Models\Platform;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TmdbImporter
{
    protected string $baseUrl = 'https://api.themoviedb.org/3';

    protected string $imageBaseUrl = 'https://image.tmdb.org/t/p/original';

    public function import(string $title): void
    {
        $response = Http::withoutVerifying()->get(
            "{$this->baseUrl}/search/tv",
            [
                'api_key' => config('services.tmdb.key'),
                'query' => $title,
                'language' => 'it-IT',
            ]
        );

        if (!$response->successful()) {
            throw new \Exception('Errore durante la ricerca su TMDB.');
        }

        $series = $response->json('results.0');

        if (!$series) {
            throw new \Exception("Serie '{$title}' non trovata.");
        }

        $details = Http::withoutVerifying()->get(
            "{$this->baseUrl}/tv/{$series['id']}",
            [
                'api_key' => config('services.tmdb.key'),
                'language' => 'it-IT',
                'append_to_response' => 'credits,videos,content_ratings',
            ]
        );

        if (!$details->successful()) {
            throw new \Exception('Errore nel recupero dei dettagli.');
        }

        $data = $details->json();

        if (TvSeries::where('slug', Str::slug($data['name']))->exists()) {
            throw new \Exception('Serie già presente nel database.');
        }

        $watchProviders = Http::withoutVerifying()->get(
            "{$this->baseUrl}/tv/{$series['id']}/watch/providers",
            [
                'api_key' => config('services.tmdb.key'),
            ]
        );

        $status = $data['status'] === 'Ended'
            ? 'ended'
            : 'ongoing';

        $productionCompany = null;

        if (!empty($data['production_companies'])) {

            $productionCompany = ProductionCompany::firstOrCreate([
                'name' => $data['production_companies'][0]['name']
            ]);
        }

        $tvSeries = TvSeries::create([

            'title' => $data['name'],
            'slug' => Str::slug($data['name']),
            'description' => $data['overview'],
            'original_language' => $this->getLanguageName(
                $data['original_language']
            ),
            'country' => $this->getCountryName(
                $data['origin_country'][0] ?? null
            ),
            'start_year' => !empty($data['first_air_date'])
                ? substr($data['first_air_date'], 0, 4)
                : null,
            'end_year' => !empty($data['last_air_date'])
                ? substr($data['last_air_date'], 0, 4)
                : null,
            'status' => $status,
            'age_rating' => $this->mapAgeRating(
                $data['content_ratings']['results'] ?? []
            ),
            'season_count' => $data['number_of_seasons'],
            'production_company_id' => $productionCompany?->id,

        ]);

        $this->downloadImages($tvSeries, $data);

        $this->syncGenres($tvSeries, $data);

        $this->syncCreators($tvSeries, $data);

        $this->syncActors($tvSeries, $data);

        $this->saveTrailer($tvSeries, $data);

        $this->syncPlatforms($tvSeries, $watchProviders->json());

        return;
    }

    private function mapAgeRating(array $ratings): string
    {
        $priority = ['IT', 'US', 'GB', 'FR', 'DE'];

        usort($ratings, function ($a, $b) use ($priority) {

            $aIndex = array_search($a['iso_3166_1'], $priority);
            $bIndex = array_search($b['iso_3166_1'], $priority);

            $aIndex = $aIndex === false ? 999 : $aIndex;
            $bIndex = $bIndex === false ? 999 : $bIndex;

            return $aIndex <=> $bIndex;
        });

        $map = [

            'G' => 'AL',
            'TV-G' => 'AL',
            'TV-Y' => 'AL',

            'TV-Y7' => 'VM6',
            'PG' => 'VM6',

            '12' => 'VM14',
            '12+' => 'VM14',
            '12A' => 'VM14',
            '13' => 'VM14',
            '14' => 'VM14',
            '14+' => 'VM14',
            '15' => 'VM14',
            '15+' => 'VM14',
            'TV-14' => 'VM14',
            'B-15' => 'VM14',

            '16' => 'VM18',
            '16+' => 'VM18',
            '17' => 'VM18',
            '18' => 'VM18',
            '18+' => 'VM18',
            'TV-MA' => 'VM18',
            'MA 15+' => 'VM18',
            'M18' => 'VM18',
            'A' => 'VM18',
            'C' => 'VM18',

        ];

        foreach ($ratings as $rating) {

            if (isset($map[$rating['rating']])) {

                return $map[$rating['rating']];
            }
        }

        return 'AL';
    }
    private function downloadImages(TvSeries $tvSeries, array $data): void
    {
        if (!empty($data['poster_path'])) {

            $poster = $this->downloadImage(
                $this->imageBaseUrl . $data['poster_path']
            );

            if ($poster) {

                $tvSeries->poster = Storage::putFile(
                    'tvseries',
                    new File($poster)
                );
                @unlink($poster);
            }
        }

        if (!empty($data['backdrop_path'])) {

            $banner = $this->downloadImage(
                $this->imageBaseUrl . $data['backdrop_path']
            );

            if ($banner) {

                $tvSeries->banner = Storage::putFile(
                    'tvseries',
                    new File($banner)
                );
                @unlink($banner);
            }
        }

        $tvSeries->save();
    }

    private function saveTrailer(TvSeries $tvSeries, array $data): void
    {
        if (empty($data['videos']['results'])) {
            return;
        }

        foreach ($data['videos']['results'] as $video) {

            if (
                $video['site'] === 'YouTube'
                && $video['type'] === 'Trailer'
                && !empty($video['key'])
            ) {

                $tvSeries->update([
                    'trailer_youtube_id' => $video['key']
                ]);

                return;
            }
        }
    }

    private function syncGenres(TvSeries $tvSeries, array $data): void
    {
        if (empty($data['genres'])) {
            return;
        }

        $genres = [];

        foreach ($data['genres'] as $genreData) {

            $genre = Genre::firstOrCreate(
                [
                    'name' => $genreData['name'],
                ],
                [
                    'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
                ]
            );

            $genres[] = $genre->id;
        }

        $tvSeries->genres()->sync($genres);
    }

    private function downloadImage(string $url): ?string
    {
        $response = Http::withoutVerifying()->get($url);

        if (!$response->successful()) {
            return null;
        }

        $extension = pathinfo(
            parse_url($url, PHP_URL_PATH),
            PATHINFO_EXTENSION
        ) ?: 'jpg';

        $path = storage_path(
            'app/temp_' . uniqid() . '.' . $extension
        );

        file_put_contents($path, $response->body());

        return $path;
    }

    private function syncCreators(TvSeries $tvSeries, array $data): void
    {
        if (empty($data['created_by'])) {
            return;
        }

        foreach (array_slice($data['created_by'], 0, 2) as $creatorData) {

            $actor = Actor::firstOrCreate(
                [
                    'name' => $creatorData['name'],
                ],
                [
                    'photo' => null,
                    'birth_date' => null,
                ]
            );

            if (empty($actor->birth_date)) {

                $response = Http::withoutVerifying()
                    ->get("https://api.themoviedb.org/3/person/{$creatorData['id']}", [
                        'api_key' => config('services.tmdb.key'),
                        'language' => 'it-IT',
                    ]);

                if ($response->successful()) {
                    $person = $response->json();
                    $actor->birth_date = $person['birthday'] ?? null;
                }
            }

            if (!empty($creatorData['profile_path']) && empty($actor->photo)) {

                $photo = $this->downloadImage(
                    $this->imageBaseUrl . $creatorData['profile_path']
                );

                if ($photo) {

                    $actor->photo = Storage::putFile(
                        'actors',
                        new File($photo)
                    );

                    @unlink($photo);
                }
            }

            $actor->save();

            $tvSeries->actors()->syncWithoutDetaching([
                $actor->id => [
                    'role' => 'Creatore',
                ]
            ]);
        }
    }

    private function syncActors(TvSeries $tvSeries, array $data): void
    {
        if (empty($data['credits']['cast'])) {
            return;
        }

        foreach (array_slice($data['credits']['cast'], 0, 6) as $actorData) {

            $actor = Actor::firstOrCreate(
                [
                    'name' => $actorData['name'],
                ],
                [
                    'photo' => null,
                    'birth_date' => null,
                ]
            );

            if (empty($actor->birth_date)) {

                $response = Http::withoutVerifying()
                    ->get("https://api.themoviedb.org/3/person/{$actorData['id']}", [
                        'api_key' => config('services.tmdb.key'),
                        'language' => 'it-IT',
                    ]);

                if ($response->successful()) {
                    $person = $response->json();
                    $actor->birth_date = $person['birthday'] ?? null;
                }
            }

            if (!empty($actorData['profile_path']) && empty($actor->photo)) {

                $photo = $this->downloadImage(
                    $this->imageBaseUrl . $actorData['profile_path']
                );

                if ($photo) {

                    $actor->photo = Storage::putFile(
                        'actors',
                        new File($photo)
                    );

                    @unlink($photo);
                }
            }

            $actor->save();

            $tvSeries->actors()->syncWithoutDetaching([
                $actor->id => [
                    'role' => $actorData['character'] ?? '',
                ]
            ]);
        }
    }

    private function syncPlatforms(TvSeries $tvSeries, array $providers): void
    {
        if (empty($providers['results']['IT']['flatrate'])) {
            return;
        }

        $providerNames = [
            'Netflix' => 'Netflix',
            'Amazon Prime Video' => 'Prime Video',
            'Disney Plus' => 'Disney+',
            'Apple TV Plus' => 'Apple TV+',
            'Apple TV' => 'Apple TV+',
            'Max' => 'HBO Max',
            'NOW' => 'NOW TV',
            'Sky Go' => 'Sky',
        ];

        foreach ($providers['results']['IT']['flatrate'] as $provider) {

            $platformName = $providerNames[$provider['provider_name']] ?? null;

            if (!$platformName) {
                continue;
            }

            $platform = Platform::where('name', $platformName)->first();

            if (!$platform) {
                continue;
            }

            $tvSeries->platforms()->syncWithoutDetaching([
                $platform->id => [
                    'url' => $providers['results']['IT']['link'],
                ]
            ]);
        }
    }

    private function getCountryName(?string $country): ?string
    {
        return match ($country) {
            'US' => 'Stati Uniti d\'America',
            'IT' => 'Italia',
            'GB' => 'Regno Unito',
            'FR' => 'Francia',
            'DE' => 'Germania',
            'ES' => 'Spagna',
            'JP' => 'Giappone',
            'KR' => 'Corea del Sud',
            'CA' => 'Canada',
            'AU' => 'Australia',
            default => $country,
        };
    }

    private function getLanguageName(?string $language): ?string
    {
        return match ($language) {
            'en' => 'Inglese',
            'it' => 'Italiano',
            'fr' => 'Francese',
            'es' => 'Spagnolo',
            'de' => 'Tedesco',
            'ja' => 'Giapponese',
            'ko' => 'Coreano',
            'pt' => 'Portoghese',
            'zh' => 'Cinese',
            'ru' => 'Russo',
            default => $language,
        };
    }
}
