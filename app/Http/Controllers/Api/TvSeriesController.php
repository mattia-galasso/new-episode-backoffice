<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TvSeries;
use Illuminate\Http\Request;

class TvSeriesController extends Controller
{
    public function homepage(Request $request)
    {
        $section = $request->section;
        $year = now()->format('Y');

        if ($section === 'hero') {
            $tvseries = TvSeries::with('genres')
                ->inRandomOrder()
                ->first();
        }

        if ($section === 'new_releases') {
            $tvseries = TvSeries::with('genres')
                ->where('start_year', '>=', $year - 1)
                ->inRandomOrder()
                ->take(6)
                ->get();
        }

        if ($section === 'ongoing') {
            $tvseries = TvSeries::with('genres')
                ->where('status', 'ongoing')
                ->inRandomOrder()
                ->take(6)
                ->get();
        }

        if ($section === 'ended') {
            $tvseries = TvSeries::where('status', 'ended')
                ->inRandomOrder()
                ->take(6)
                ->get();
        }

        return response()->json([
            'success' => true,
            'results' => $tvseries
        ]);
    }

    public function index(Request $request)
    {

        $query = TvSeries::query();

        //ORDINAMENTO
        if ($request->order === 'az') {
            $query->orderBy("title");
        }

        if ($request->order === 'za') {
            $query->orderBy("title", 'desc');
        }

        if ($request->order === 'recent') {
            $query->orderBy("start_year", "desc");
        }

        if ($request->order === 'old') {
            $query->orderBy("start_year");
        }

        // STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // NEW RELEASES
        if ($request->newReleases === 'true') {
            $currentYear = now()->year;

            $query->where('start_year', '>=', $currentYear);
        }

        //PLATFORMS
        if ($request->filled('platforms')) {
            $query->wherehas('platforms', function ($query) use ($request) {
                $query->whereIn('platforms.id', $request->platforms);
            });
        }

        //GENRES
        if ($request->filled('genres')) {
            $query->wherehas('genres', function ($query) use ($request) {
                $query->whereIn('genres.id', $request->genres);
            });
        }

        $tvseries = $query->paginate(18);

        return response()->json([
            'success' => true,
            'results' => $tvseries
        ]);
    }

    public function show(string $slug)
    {
        $tvSeries = TvSeries::with([
            'genres',
            'platforms',
            'actors',
            'productionCompany'
        ])->where('slug', $slug)->firstOrFail();

        return response()->json([
            'success' => true,
            'results' => $tvSeries
        ]);
    }
}
