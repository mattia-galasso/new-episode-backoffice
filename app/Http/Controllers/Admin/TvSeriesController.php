<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\TvSeries;
use Illuminate\Http\Request;

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
        $genres = Genre::all();
        $platforms = Platform::all();
        return view('tvseries.create', compact('genres', 'platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
