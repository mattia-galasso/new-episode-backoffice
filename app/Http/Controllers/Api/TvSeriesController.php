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

    public function index()
    {
        $tvseries = TvSeries::paginate(18);

        return response()->json([
            'success' => true,
            'results' => $tvseries
        ]);
    }
}
