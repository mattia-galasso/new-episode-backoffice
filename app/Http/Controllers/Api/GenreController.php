<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy("name")->get();

        return response()->json([
            "success" => true,
            "results" => $genres
        ]);
    }
}
