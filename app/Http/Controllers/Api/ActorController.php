<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function show(string $slug)
    {
        $actor = Actor::where('slug', $slug)
            ->with([
                'tvSeries.genres',
                'tvSeries.platforms'
            ])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'results' => $actor
        ]);
    }
}
