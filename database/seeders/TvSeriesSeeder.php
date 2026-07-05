<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\ProductionCompany;
use App\Models\TvSeries;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TvSeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $roles = [
            "Regista",
            "Produttore",
            "Attore protagonista",
            "Attrice protagonista",
            "Attore comprimario",
            "Attore non protagonista",
        ];

        $languages = ['Inglese', 'Italiano', 'Spagnolo', 'Francese', 'Tedesco', 'Giapponese', 'Koreano'];


        $productionCompanies = ProductionCompany::all();
        $genres = Genre::all();
        $platforms = Platform::all();
        $actors = Actor::all();

        for ($i = 0; $i < 10; $i++) {
            $newTvSeries = new TvSeries();

            $newTvSeries->title = $faker->sentence(2);
            $newTvSeries->description = $faker->paragraph(2);
            $newTvSeries->original_language = $faker->randomElement($languages);
            $newTvSeries->country = $faker->country();

            $start = $faker->dateTimeBetween('-10 years', '-2 years');
            $end = $faker->dateTimeBetween($start, '+1 years');
            $newTvSeries->start_year = $start->format('Y');
            $newTvSeries->end_year = $faker->boolean(30) ? $end->format('Y') : null;

            $newTvSeries->status = $newTvSeries->end_year == null ? 'ongoing' : 'ended';
            $newTvSeries->age_rating = $faker->randomElement(['AL', 'VM6', 'VM14', 'VM18']);
            $newTvSeries->season_count = rand(1, 10);

            $productionCompany = $faker->randomElement($productionCompanies);
            $newTvSeries->production_company_id = $productionCompany->id;

            $newTvSeries->save();

            $newTvSeries->genres()->sync($faker->randomElements($genres, 2));
            $newTvSeries->platforms()->sync($faker->randomElements($platforms, 2));

            $randomActors = $actors->random(5);
            $actorRole = [];

            foreach ($randomActors as $actor) {
                $actorRole[$actor->id] = ['role' => $faker->randomElement($roles)];
            }

            $newTvSeries->actors()->sync($actorRole);
        }
    }
}
