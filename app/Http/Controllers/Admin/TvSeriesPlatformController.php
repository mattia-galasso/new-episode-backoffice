<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\TvSeries;
use Illuminate\Http\Request;

class TvSeriesPlatformController extends Controller
{
    /**
     * Show the form for editing TV Series platforms.
     */
    public function edit(TvSeries $tvseries)
    {
        $platforms = Platform::orderBy('name')->get();

        return view('tvseries.platforms.edit', compact('tvseries', 'platforms'));
    }

    /**
     * Add platform on TV Series.
     */
    public function addPlatform(Request $request, TvSeries $tvseries)
    {
        if ($tvseries->platforms()
            ->where('platform_id', $request->platform_id)
            ->exists()
        ) {

            $tvseries->platforms()->updateExistingPivot($request->platform_id, [
                'url' => $request->url,
            ]);
        } else {

            $tvseries->platforms()->attach($request->platform_id, [
                'url' => $request->url,
            ]);
        }

        return redirect()->route('tvseries.platforms.edit', $tvseries);
    }

    /**
     * Remove platform on TV Series.
     */
    public function removePlatform(TvSeries $tvseries, Platform $platform)
    {
        $tvseries->platforms()->detach($platform->id);

        return redirect()->route('tvseries.platforms.edit', $tvseries);
    }
}
