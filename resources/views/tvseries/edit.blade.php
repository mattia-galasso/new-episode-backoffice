@extends('layouts.app')

@section('title', 'Edit TV Series')

@section('content')
<div class="content-container card p-3">
    {{-- HEADER --}}
    <div class="d-flex flex-column justify-content-center align-items-start mb-4 gap-4">
        <a href="{{route('tvseries.index')}}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>Serie TV
        </a>
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 w-100">

            <div class="d-flex align-items-center gap-2">

                <span class="section-icon pe-none me-2">
                    <i class="bi bi-pencil-square"></i>
                </span>

                <div>
                    <h4 class="m-0">Modifica "{{ $tvseries->title }}"</h4>

                    <p class="description-category m-0">
                        Aggiorna le informazioni della serie presente nel catalogo.
                    </p>
                </div>
            </div>

            <div class="create-actions d-flex gap-2 ms-md-auto">
                <button type="reset" form="tvseries-form" class="btn btn-outline-secondary">
                    Annulla
                </button>
                <button type="submit" form="tvseries-form" class="btn btn-info">
                    Salva modifiche
                </button>
            </div>
        </div>
    </div>
    {{-- FORM --}}
    <form method="POST" id="tvseries-form" action="{{route('tvseries.update', $tvseries)}}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4 align-items-stretch">
            <div class="col-12 col-xl-8 d-flex">

                {{-- Information --}}
                <div class="card create-card flex-fill">
                    <h5 class="fw-bold mb-4">Informazioni</h5>

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci titolo"
                            value="{{ $tvseries->title }}" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="start_year" class="form-label">Anno di inizio (YYYY)</label>
                            <input type="number" min="1900" max="2100" class="form-control" name="start_year"
                                id="start_year" placeholder="Inserisci anno es. 2026"
                                value="{{ $tvseries->start_year }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_year" class="form-label">Anno di fine (YYYY)</label>
                            <input type="number" min="1900" max="2100" class="form-control" name="end_year"
                                id="end_year" placeholder="Inserisci anno es. 2026" value="{{ $tvseries->end_year }}"
                                aria-describedby="end-year-text">
                            <div class="form-text" id="end-year-text">In caso di Serie TV ancora in produzione lasciare
                                vuoto!</div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label">Stato</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="" disabled>Seleziona stato</option>
                                <option value="ongoing" {{ $tvseries->status === 'ongoing' ? 'selected' : '' }}>In
                                    produzione</option>
                                <option value="ended" {{ $tvseries->status === 'ended' ? 'selected' : '' }}>Terminata
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="age_rating" class="form-label">Classificazione età</label>
                            <select name="age_rating" id="age_rating" class="form-select" required>
                                <option value="" disabled>Seleziona età</option>
                                <option value="AL" {{ $tvseries->age_rating === 'AL' ? 'selected' : '' }}>AL</option>
                                <option value="VM6" {{ $tvseries->age_rating === 'VM6' ? 'selected' : '' }}>VM6</option>
                                <option value="VM14" {{ $tvseries->age_rating === 'VM14' ? 'selected' : '' }}>VM14
                                </option>
                                <option value="VM18" {{ $tvseries->age_rating === 'VM18' ? 'selected' : '' }}>VM18
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label for="season_count" class="form-label">Stagioni</label>
                            <input type="number" min="1" class="form-control" name="season_count" id="season_count"
                                placeholder="Es. 10" value="{{ $tvseries->season_count }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="original_language" class="form-label">Lingua originale</label>
                            <input type="text" class="form-control" name="original_language" id="original_language"
                                placeholder="Es: Inglese" value="{{ $tvseries->original_language }}">
                        </div>
                        <div class="col-md-4">
                            <label for="country" class="form-label">Paese di produzione</label>
                            <input type="text" class="form-control" name="country" id="country"
                                placeholder="Inserisci paese di produzione" value="{{ $tvseries->country }}">
                        </div>
                    </div>
                    {{-- PRODUCTION COMPANY --}}
                    <div class="mb-3">
                        <label for="production_company_id" class="form-label">
                            Casa di produzione
                        </label>

                        <select name="production_company_id" id="production_company_id">

                            <option value="">Seleziona una casa di produzione</option>

                            @foreach ($productionCompanies as $productionCompany)
                            <option value="{{ $productionCompany->id }}" {{ $productionCompany->id ===
                                $tvseries->production_company_id ? 'selected' : ''}}>
                                {{ $productionCompany->name }}
                            </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="trailer_youtube_id" class="form-label">ID Trailer Youtube</label>
                        <input type="text" name="trailer_youtube_id" class="form-control" id="trailer_youtube_id"
                            aria-describedby="trailer-youtube" placeholder="Es. A7OOx5-0iq8" value="{{ $tvseries->trailer_youtube_id }}">
                        <div class="form-text" id="trailer-youtube">Inserire solo l'ID del trailer
                            https://www.youtube.com/watch?v=[ID Trailer]</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea name="description" id="description" rows="5" class="form-control" required
                            placeholder="Scrivi la descrizione della serie...">{{ $tvseries->description }}</textarea>
                    </div>
                </div>
            </div>
            {{-- Poster And Banner --}}
            <div class="col-12 col-xl-4 d-flex flex-column gap-4">
                <div class="card create-card flex-fill">
                    <h5 class="fw-bold mb-4">Media</h5>
                    {{-- POSTER --}}
                    <div class="mb-4">
                        <label for="poster" class="form-label">Poster</label>
                        <input type="file" name="poster" id="poster" class="form-control" accept="image/*">

                        {{-- PREVIEW TEXT --}}
                        <div class="placeholder-box poster-preview-box">
                            <div id="poster-placeholder" class="{{ $tvseries->poster ? 'd-none' : '' }}">
                                <i class="bi bi-image fs-1"></i>
                                <small>Anteprima poster</small>
                            </div>
                            {{-- IMG PREVIEW --}}
                            <img id="poster-preview" class="media-preview poster-preview {{ $tvseries->poster ? '' : 'd-none' }}" src="{{ $tvseries->poster ? asset('storage/'.$tvseries->poster) : '' }}" alt="Poster">
                        </div>
                    </div>
                    {{-- BANNER --}}
                    <div>
                        <label for="banner" class="form-label">Banner</label>
                        <input type="file" name="banner" id="banner" class="form-control" accept="image/*">
                        {{-- PREVIEW TEXT --}}
                        <div class="placeholder-box banner-preview-box">
                            <div id="banner-placeholder" class="{{ $tvseries->banner ? 'd-none' : '' }}">
                                <i class="bi bi-image fs-1"></i>
                                <small>Anteprima banner</small>
                            </div>
                            {{-- IMG PREVIEW --}}
                            <img id="banner-preview" class="media-preview banner-preview {{ $tvseries->banner ? '' : 'd-none' }}" src="{{ $tvseries->banner ? asset('storage/'.$tvseries->banner) : '' }}" alt="Banner">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 align-items-stretch mt-1">
            <div class="col-12 col-xl-6 d-flex">
                <div class="card create-card flex-fill">
                    <h5 class="fw-bold mb-3">Generi</h5>
                    <div class="genre-grid">
                        @foreach ($genres as $genre)
                        <label class="genre-checkbox">

                            <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="genre-{{$genre->id}}"
                                class="genre-input" {{ $tvseries->genres->contains($genre->id) ? 'checked' : '' }}>

                            <span class="genre-pill" style="--genre-color: {{ $genre->color }};">
                                <i class="bi bi-circle genre-icon"></i>
                                <i class="bi bi-check-circle-fill genre-icon-selected"></i>

                                {{ $genre->name }}
                            </span>

                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 d-flex">
                <div class="card create-card flex-fill">
                    <h5 class="fw-bold mb-3">Piattaforme</h5>
                    <div class="platform-grid">
                        @foreach ($platforms as $platform)
                        <label class="platform-checkbox">
                            <input type="checkbox" name="platforms[]" value="{{$platform->id}}"
                                id="platform-{{$platform->id}}" class="platform-input" {{ $tvseries->platforms->contains($platform->id) ? 'checked' : '' }}>
                            <div class="platform-card">

                                <i class="bi bi-circle platform-icon"></i>
                                <i class="bi bi-check-circle-fill platform-icon-selected"></i>

                                @if (str_starts_with($platform->logo_img, 'logo_'))
                                <img class="platform-logo" src="{{asset('./img/platforms/' . $platform->logo_img)}}"
                                    alt="{{$platform->name}}">
                                @elseif (!$platform->logo_img)
                                <img class="platform-logo" src="{{asset('./img/platforms/logo_notfound.png')}}"
                                    alt="{{$platform->name}}">
                                @else
                                <img class="platform-logo" src="{{asset('storage/' . $platform->logo_img)}}"
                                    alt="{{$platform->name}}">
                                @endif

                                <span class="platform-name">
                                    {{$platform->name}}
                                </span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection