@extends('layouts.app')

@section('title', $tvseries->title)

@section('content')
<div class="content-container card">
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center m-3">
        <a href="{{ route('tvseries.index') }}" class="btn btn-primary m-0">
                <i class="bi bi-arrow-left me-2"></i>Serie TV
        </a>
        <div>
            <button class="btn btn-secondary"><i class="bi bi-pencil"></i> Modifica</button>
            <button class="btn btn-danger"><i class="bi bi-trash"></i> Elimina</button>
        </div>
    </div>
    {{-- MAIN --}}
    <img src="{{ $tvseries->banner ? asset('storage/' . $tvseries->banner) : asset('./img/banner_no_image_available.png') }}"
        alt="{{ $tvseries->banner ? $tvseries->title : 'No Image Available' }}" class="image-banner">
    <div class="d-flex align-items-center gap-3 show-header">
        <img src="{{ $tvseries->poster ? asset('storage/' . $tvseries->poster) : asset('./img/no_image_available.png') }}"
            alt="{{ $tvseries->poster ? $tvseries->title : 'No Image Available' }}" class="poster-show">
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
    <div class="info-section row g-4 align-items-stretch">
        <div class="col-12 col-xl-7 d-flex">
            <div class="info-list card ms-3 mb-3 mt-4 ps-3 py-3 flex-fill">
                <h5 class="fw-bold mb-2">Descrizione</h5>
                <p class="mb-4 text-wrap description-value">{{ $tvseries->description }}</p>
                <div class="info-row">
                    <span class="info-label">Anno di inizio</span>
                    <span class="info-value">{{ $tvseries->start_year }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Anno di fine</span>
                    <span class="info-value">{{ $tvseries->end_year ? $tvseries->end_year : 'In corso' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Stato</span>
                    <span class="info-value"><span
                            class="{{$tvseries->status == 'ongoing' ? 'ongoing-dot' : 'ended-dot'}} me-1">●</span> {{
                        $tvseries->status == 'ongoing' ? 'In Produzione' : 'Terminata' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Classificazione età</span>
                    <span class="info-value">{{ $tvseries->age_rating }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lingua originale</span>
                    <span class="info-value language-text">
                        {{$tvseries->original_language ? $tvseries->original_language : 'Non indicata'}}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Paese di produzione</span>
                    <span class="info-value">
                        {{$tvseries->country ? $tvseries->country : 'Non indicato'}}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Casa produttrice</span>
                    <span class="info-value">{{ $tvseries->production_company_id ? $tvseries->productioncompany->name :
                        'Non indicata' }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-5 d-flex">
            <div class="d-flex flex-column gap-4 mb-3 mt-4 me-3 flex-fill">
                <div class="card p-3 flex-fill">
                    <div class="trailer-header">
                        <h5 class="fw-bold mb-4">Trailer</h5>
                        <a href="https://www.youtube.com/watch?v={{$tvseries->trailer_youtube_id}}" target="_blank"
                            class="youtube-btn btn mb-3">
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
    <div class="row g-4 px-3 pb-3 align-items-stretch">
        <div class="col-12 col-xl-6 d-flex">
            <div class="card flex-fill p-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Generi</h5>
                    <p class="m-0">({{$tvseries->genres->count()}})</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    @forelse ($tvseries->genres as $genre)
                    <span class="badge rounded-pill genre-pill"
                        style="border: 1px solid {{ $genre->color }}; color:{{ $genre->color }};">{{$genre->name}}
                    </span>
                    @empty
                    <p class="text-secondary mb-0">
                        Nessun genere selezionato!
                    </p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 d-flex">
            <div class="card flex-fill p-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Piattaforme</h5>
                    <p class="m-0">({{$tvseries->platforms->count()}})</p>
                </div>
                @forelse ($tvseries->platforms as $platform)
                <a href="{{$platform->website ? $platform->website : ''}}" {{$platform->website ? 'target="_blank"' : ''}}  class="platform-link">
                    <div class="platform-item">
                        @if (str_starts_with($platform->logo_img, 'logo_'))
                        <img src="{{asset('./img/platforms/' . $platform->logo_img)}}" alt="{{$platform->name}}">
                        @elseif (!$platform->logo_img)
                        <img src="{{asset('./img/platforms/logo_notfound.png')}}" alt="{{$platform->name}}">
                        @else
                        <img src="{{asset('storage/' . $platform->logo_img)}}" alt="{{$platform->name}}">
                        @endif

                        <div>
                            <div class="platform-name">{{$platform->name}}</div>
                        </div>
                        <i class="bi bi-box-arrow-up-right"></i>
                    </div>
                </a>
                @empty
                <p class="text-secondary mb-0">
                    Nessuna piattaforma associata!
                </p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="row px-3 pb-3">
        <div class="col-12">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Cast</h5>
                    <p class="m-0">({{$tvseries->actors->count()}})</p>
                </div>
                <div class="row g-3">
                    @forelse ($tvseries->actors as $actor)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="actor-card">
                            <img src="{{ $actor->photo ? asset('storage/'.$actor->photo) : asset('./img/actor_image_not_found.png') }}"
                                alt="{{ $actor->name }}">

                            <div class="p-2">
                                <div class="actor-name">
                                    {{ $actor->name }}
                                </div>
                                <div class="actor-role">
                                    {{ $actor->pivot->role }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-secondary mb-0">
                        Nessun attore selezionato!
                    </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection