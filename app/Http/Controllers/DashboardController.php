<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\ProductionCompany;
use App\Models\TvSeries;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tvseriesCount = TvSeries::count();
        $actorsCount = Actor::count();
        $genresCount = Genre::count();
        $platformsCount = Platform::count();
        $productionCompaniesCount = ProductionCompany::count();
        $usersCount = User::count();

        return view('dashboard', compact(
            'tvseriesCount',
            'actorsCount',
            'genresCount',
            'platformsCount',
            'productionCompaniesCount',
            'usersCount',
        ));
    }
}
