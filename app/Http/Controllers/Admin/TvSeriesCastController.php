<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\TvSeries;
use Illuminate\Http\Request;

class TvSeriesCastController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TvSeries $tvseries)
    {
        return view('tvseries.cast.edit', compact('tvseries'));
    }

    /**
     * Add new actor on TV Series.
     */
    public function addActor(Request $request, TvSeries $tvseries)
    {
        if ($tvseries->actors()
            ->where('actor_id', $request->actor_id)
            ->exists()
        ) {

            $tvseries->actors()->updateExistingPivot($request->actor_id, [
                'role' => $request->role,
            ]);
        } else {

            $tvseries->actors()->attach($request->actor_id, [
                'role' => $request->role,
            ]);
        }

        return redirect()->route('tvseries.cast.edit', $tvseries);
    }

    /**
     * Remove actor on TV Series.
     */
    public function removeActor(TvSeries $tvseries, Actor $actor)
    {
        $tvseries->actors()->detach($actor->id);

        return redirect()->route('tvseries.cast.edit', $tvseries);
    }
}
