@extends('layouts.app')

@section('title', 'Create TV Series')

@section('content')
<div class="content-container card p-3">
    {{-- HEADER --}}
    <div class="d-flex flex-column justify-content-center align-items-start mb-4 gap-4">
        <a href="{{route('tvseries.index')}}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>Serie TV
        </a>
        <div class="d-flex justify-content-between align-items-center w-100">
            <div>
                <h3 class="m-0">Aggiungi nuova serie</h3>
                <p class="m-0">Compila i campi per aggiungere una nuova serie al catalogo</p>
            </div>
            <div>
                <button type="reset" form="tvseries-form"
                    class="btn btn-outline-secondary text-light me-2">Annulla</button>
                <button type="submit" form="tvseries-form" class="btn btn-info">Pubblica</button>
            </div>
        </div>
    </div>
    {{-- FORM --}}
    <form method="POST" id="tvseries-form" action="{{route('tvseries.store')}}">
        @csrf

        <div class="row g-4 align-items-stretch">
            <div class="col-12 col-xl-8 flex-fill">

                {{-- Information --}}
                <div class="card p-3 mb-4">
                    <h5 class="fw-bold mb-4">Informazioni</h5>

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci titolo"
                            required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="start_year" class="form-label">Anno di inizio (YYYY)</label>
                            <input type="number" min="1900" max="2100" class="form-control" name="start_year"
                                id="start_year" placeholder="Inserisci anno es. 2026" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_year" class="form-label">Anno di fine (YYYY)</label>
                            <input type="number" min="1900" max="2100" class="form-control" name="end_year"
                                id="end_year" placeholder="Inserisci anno es. 2026" aria-describedby="end-year-text">
                            <div class="form-text" id="end-year-text">In caso di Serie TV ancora in produzione lasciare
                                vuoto!</div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label">Stato</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="" selected disabled>Seleziona stato</option>
                                <option value="ongoing">In produzione</option>
                                <option value="ended">Terminata</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="age_rating" class="form-label">Classificazione età</label>
                            <select name="age_rating" id="age_rating" class="form-select" required>
                                <option value="" selected disabled>Seleziona età</option>
                                <option value="AL">AL</option>
                                <option value="VM6">VM6</option>
                                <option value="VM14">VM14</option>
                                <option value="VM18">VM18</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label for="season_count" class="form-label">Stagioni</label>
                            <input type="number" min="1" class="form-control" name="season_count" id="season_count"
                                placeholder="Es. 10" required>
                        </div>
                        <div class="col-md-4">
                            <label for="season_count" class="form-label">Lingua originale</label>
                            <input type="text" class="form-control" name="season_count" id="season_count"
                                placeholder="Es: Inglese">
                        </div>
                        <div class="col-md-4">
                            <label for="season_count" class="form-label">Paese di produzione</label>
                            <input type="text" class="form-control" name="season_count" id="season_count"
                                placeholder="Inserisci paese di produzione">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="trailer_youtube_id" class="form-label">ID Trailer Youtube</label>
                        <input type="text" name="trailer_youtube_id" class="form-control" id="trailer_youtube_id"
                            aria-describedby="trailer-youtube" placeholder="Es. A7OOx5-0iq8">
                        <div class="form-text" id="end-year-text">Inserire solo l'ID del trailer
                            https://www.youtube.com/watch?v=[ID Trailer]</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea name="description" id="description" rows="5" class="form-control" required
                            placeholder="Scrivi la descrizione della serie..."></textarea>
                    </div>
                </div>
            </div>
            {{-- Poster And Banner --}}
            <div class="col-12 col-xl-4 d-flex flex-column gap-4">
                <div class="card p-3 mb-4 flex-fill">
                    <h5 class="fw-bold mb-5">Media</h5>
                    <div class="row g-4">
                        <div class="col-12 mb-5">
                            <label for="poster" class="form-label">Poster</label>
                            <input type="file" name="poster" id="poster" class="form-control">
                            <div class="mt-2 placeholder-box">Anteprima...</div>
                        </div>

                        <div class="col-12">
                            <label for="banner" class="form-label">Banner</label>
                            <input type="file" name="banner" id="banner" class="form-control">
                            <div class="mt-2 placeholder-box">Anteprima...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 align-items-stretch">
            <div class="col-12 col-xl-6">
                <div class="card p-3 flex-fill">
                    <h5 class="fw-bold mb-3">Generi</h5>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($genres as $genre)
                        <label class="genre-checkbox d-flex align-items-center gap-1">
                            <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="genre-{{$genre->id}}"
                                class="form-check-input me-1">
                            <span for="genre-{{$genre->id}}" class="badge rounded-pill"
                                style="border:1px solid {{ $genre->color }}; color: {{ $genre->color }}">{{$genre->name}}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card p-3 flex-fill">
                    <h5 class="fw-bold mb-3">Piattaforme</h5>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($platforms as $platform)
                        <label class="platform-checkbox d-flex align-items-center">
                            <input type="checkbox" name="platforms[]" value="{{$platform->id}}" id="platform-{{$platform->id}}" class="form-check-input me-1">

                            @if (str_starts_with($platform->logo_img, 'logo_'))
                            <img class="platform_logo" src="{{asset('./img/platforms/' . $platform->logo_img)}}"
                                alt="{{$platform->name}}">
                            @elseif (!$platform->logo_img)
                            <img class="platform_logo" src="{{asset('./img/platforms/logo_notfound.png')}}"
                                alt="{{$platform->name}}">
                            @else
                            <img class="platform_logo" src="{{asset('storage/' . $platform->logo_img)}}"
                                alt="{{$platform->name}}">
                            @endif

                            <span>{{ $platform->name }}</span>
                        </label>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection