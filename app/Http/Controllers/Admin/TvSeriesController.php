<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\ProductionCompany;
use App\Models\TvSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TvSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tvseries = TvSeries::all();
        return view('tvseries.index', compact('tvseries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productionCompanies = ProductionCompany::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        return view('tvseries.create', compact('genres', 'productionCompanies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newTvSeries = new TvSeries();

        $title = $data['title'];
        $newTvSeries->title = $title;
        $newTvSeries->slug = Str::slug($title);
        $newTvSeries->description = $data['description'];
        $newTvSeries->original_language = $data['original_language'];
        $newTvSeries->country = $data['country'];
        $newTvSeries->start_year = $data['start_year'];
        $newTvSeries->end_year = $data['end_year'];
        $newTvSeries->status = $data['status'];
        $newTvSeries->age_rating = $data['age_rating'];
        $newTvSeries->season_count = $data['season_count'];
        $newTvSeries->poster = $data['poster'];
        $newTvSeries->banner = $data['banner'];
        $newTvSeries->trailer_youtube_id = $data['trailer_youtube_id'];
        $newTvSeries->production_company_id = $data['production_company_id'];

        /* POSTER */
        if ($request->hasFile('poster')) {
            $newTvSeries->poster = Storage::putFile('tvseries', $data['poster']);
        }

        /* BANNER */
        if ($request->hasFile('banner')) {
            $newTvSeries->banner = Storage::putFile('tvseries', $data['banner']);
        }

        $newTvSeries->save();

        /* GENRES */
        $newTvSeries->genres()->attach($data['genres']);

        return redirect()->route('tvseries.show', $newTvSeries);
    }

    /**
     * Display the specified resource.
     */
    public function show(TvSeries $tvseries)
    {
        return view('tvseries.show', compact('tvseries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TvSeries $tvseries)
    {
        $productionCompanies = ProductionCompany::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();

        return view('tvseries.edit', compact('tvseries', 'productionCompanies', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TvSeries $tvseries)
    {
        $data = $request->except(['poster', 'banner']);
        $tvseries->update($data);

        /* POSTER */
        if ($request->hasFile('poster')) {

            if ($tvseries->poster) {
                Storage::delete($tvseries->poster);
            }

            $tvseries->poster = Storage::putFile('tvseries', $request->file('poster'));
        }

        /* BANNER */
        if ($request->hasFile('banner')) {

            if ($tvseries->banner) {
                Storage::delete($tvseries->banner);
            }

            $tvseries->banner = Storage::putFile('tvseries', $request->file('banner'));
        }

        $tvseries->save();

        /* GENRES */
        if ($request->has('genres')) {
            $tvseries->genres()->sync($data['genres']);
        } else {
            $tvseries->genres()->detach();
        }

        return redirect()->route('tvseries.show', $tvseries);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TvSeries $tvseries)
    {
        /* POSTER */
        if ($tvseries->poster) {
            Storage::delete($tvseries->poster);
        }

        /* BANNER */
        if ($tvseries->banner) {
            Storage::delete($tvseries->banner);
        }

        $tvseries->genres()->detach();
        $tvseries->platforms()->detach();
        $tvseries->actors()->detach();

        $tvseries->delete();

        return redirect()->route('tvseries.index');
    }
}
