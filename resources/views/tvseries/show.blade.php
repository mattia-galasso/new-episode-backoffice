@extends('layouts.app')

@section('title', $tvseries->title)

@section('content')
<div class="content_container card">
    <div class="d-flex justify-content-between align-items-center m-3">
        <a href="{{ route('tvseries.index') }}">
            <button class="btn btn-primary m-0">
                <i class="bi bi-arrow-left me-2"></i>Serie TV
            </button>
        </a>
        <div>
            <button class="btn btn-secondary"><i class="bi bi-pencil"></i> Modifica</button>
            <button class="btn btn-danger"><i class="bi bi-trash"></i> Elimina</button>
        </div>
    </div>
    <img src="{{ $tvseries->banner == null ? asset('./img/banner_no_image_available.png') : asset('storage/' . $tvseries->banner) }}"
        alt="{{ $tvseries->banner == null ? 'No Image Available' : $tvseries->title }}" class="image-banner">
    <div class="d-flex align-items-center gap-3 show-header">
        <img src="{{ $tvseries->poster == null ? asset('./img/no_image_available.png') : asset('storage/' . $tvseries->poster) }}"
            alt="{{ $tvseries->poster == null ? 'No Image Available' : $tvseries->title }}" class="poster-show">
        <div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="m-0">{{$tvseries->title}}</h2>
                <div class="status-badge {{$tvseries->status == 'ongoing' ? 'ongoing' : 'ended'}}">
                    <p class="mb-0 me-2">●</p> {{$tvseries->status == 'ongoing' ? 'In Produzione' : 'Terminata'}}
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 my-3">
                <p class="m-0">{{$tvseries->start_year}} - {{$tvseries->end_year == null ? 'In corso' :
                    $tvseries->end_year}}
                </p>
                <div class="vertical-division bg-secondary"></div>
                <p class="m-0">{{$tvseries->season_count}} Stagioni
                </p>
            </div>
            <div class="d-flex align-items-center gap-3">
                @foreach ($tvseries->genres as $genre)
                <span class="badge rounded-pill"
                    style="border: 1px solid {{ $genre->color }}; color:{{ $genre->color }};">{{$genre->name}}
                </span>
                @endforeach
            </div>
        </div>
    </div>
    <div class="info-section row g-4">
        <div class="col-12 col-xl-7">
            <div class="info-list card ms-3 mb-3 mt-4 ps-3 py-3">
                <h5 class="mb-2 fw-bold">Descrizione</h5>
                <p class="mb-4 text-wrap description-value">{{ $tvseries->description }}</p>
                <div class="info-row">
                    <span class="info-label">Anno di inizio</span>
                    <span class="info-value">{{ $tvseries->start_year }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Anno di fine</span>
                    <span class="info-value">{{ $tvseries->end_year == null ? 'In corso' :
                        $tvseries->end_year }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Stato</span>
                    <span class="info-value">{{ $tvseries->status == 'ongoing' ? 'In Produzione' : 'Terminata' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Classificazione età</span>
                    <span class="info-value">{{ $tvseries->age_rating }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Paese di produzione</span>
                    <span class="info-value">
                        @if (!$tvseries->productioncompany->country || !$tvseries->production_company_id)
                        Non indicata
                        @else
                        {{$tvseries->productioncompany->country}}
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Casa produttrice</span>
                    <span class="info-value">{{ $tvseries->production_company_id == null ? 'Non indicata' :
                        $tvseries->productioncompany->name }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-5">
            <div class="d-flex flex-column gap-4 mb-3 mt-4 me-3">
                <div class="card p-3 trailer-card">
                    <div class="trailer-header">
                        <h5 class="fw-bold mb-4">Trailer</h5>
                        <a href="https://www.youtube.com/watch?v={{$tvseries->trailer_youtube_id}}" target="_blank" class="youtube-btn btn mb-3">
                            <i class=" bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>

                    @if ($tvseries->trailer_youtube_id)
                    <div class="ratio ratio-16x9">
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/{{$tvseries->trailer_youtube_id}}?controls=0"
                            title="Trailer {{$tvseries->title}}" allowfullscreen>
                        </iframe>
                    </div>

                    @else
                    
                    <div class="placeholder-trailer">
                        <i class="bi bi-film"></i>
                        <p class="mb-0">
                            Nessun trailer disponibile
                        </p>
                    </div>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection