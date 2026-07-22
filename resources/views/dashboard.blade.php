@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="d-flex align-items-center gap-2 mb-4">
        <span class="section-icon pe-none me-2">
            <i class="bi bi-house-door"></i>
        </span>

        <div>
            <h4 class="m-0">
                Dashboard
            </h4>
            <p class="description-category m-0">
                Panoramica generale dei contenuti presenti nel catalogo.
            </p>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="row g-4">

        {{-- TV SERIES --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card h-100"
                onclick="window.location='{{ route('tvseries.index') }}'">
                <div class="dashboard-card-icon">
                    <i class="bi bi-tv"></i>
                </div>

                <div>
                    <div class="dashboard-card-count">
                        {{ $tvseriesCount }}
                    </div>
                    <div class="dashboard-card-title">
                        Serie TV
                    </div>
                </div>
            </div>
        </div>

        {{-- ACTORS --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card h-100"
                onclick="window.location='{{ route('actors.index') }}'">
                <div class="dashboard-card-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div>
                    <div class="dashboard-card-count">
                        {{ $actorsCount }}
                    </div>
                    <div class="dashboard-card-title">
                        Attori
                    </div>
                </div>
            </div>
        </div>

        {{-- GENRES --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card h-100"
                onclick="window.location='{{ route('genres.index') }}'">
                <div class="dashboard-card-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <div>
                    <div class="dashboard-card-count">
                        {{ $genresCount }}
                    </div>
                    <div class="dashboard-card-title">
                        Generi
                    </div>
                </div>
            </div>
        </div>

        {{-- PLATFORMS --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card h-100"
                onclick="window.location='{{ route('platforms.index') }}'">
                <div class="dashboard-card-icon">
                    <i class="bi bi-display"></i>
                </div>

                <div>
                    <div class="dashboard-card-count">
                        {{ $platformsCount }}
                    </div>
                    <div class="dashboard-card-title">
                        Piattaforme
                    </div>
                </div>
            </div>
        </div>

        {{-- PRODUCTION COMPANIES --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card h-100"
                onclick="window.location='{{ route('production-companies.index') }}'">
                <div class="dashboard-card-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>
                    <div class="dashboard-card-count">
                        {{ $productionCompaniesCount }}
                    </div>
                    <div class="dashboard-card-title">
                        Case produttrici
                    </div>
                </div>
            </div>
        </div>

        {{-- USERS --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card dashboard-card h-100">
                <div class="dashboard-card-icon">
                    <i class="bi bi-person"></i>
                </div>

                <div>
                    <div class="dashboard-card-count">
                        {{ $usersCount }}
                    </div>
                    <div class="dashboard-card-title">
                        Utenti
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection