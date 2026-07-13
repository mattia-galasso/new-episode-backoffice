@extends('layouts.app')

@section('title', 'Edit "' . $genre->name . '"')

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="d-flex flex-column justify-content-center align-items-start mb-4 gap-4">

        <a href="{{ route('genres.show', $genre) }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            {{ $genre->name }}
        </a>

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 w-100">

            <div class="d-flex align-items-center gap-2">

                <span class="section-icon pe-none me-2">
                    <i class="bi bi-pencil-square"></i>
                </span>

                <div>
                    <h4 class="m-0">
                        Modifica "{{ $genre->name }}"
                    </h4>

                    <p class="description-category m-0">
                        Aggiorna le informazioni del genere.
                    </p>
                </div>

            </div>

            <div class="create-actions d-flex gap-2 ms-md-auto">

                <button type="reset" form="genre-form" class="btn btn-outline-secondary">
                    Annulla
                </button>

                <button type="submit" form="genre-form" class="btn btn-info">
                    Salva modifiche
                </button>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <form method="POST" id="genre-form" action="{{ route('genres.update', $genre) }}">

        @csrf
        @method('PUT')

        <div class="card create-card">

            <h5 class="fw-bold mb-4">
                Informazioni
            </h5>

            <div class="row g-3">

                <div class="col-12 col-md-8">

                    <label for="name" class="form-label">
                        Nome
                    </label>

                    <input type="text" name="name" id="name" class="form-control" value="{{ $genre->name }}" required>

                </div>

                <div class="col-12 col-md-4">

                    <label for="color" class="form-label">
                        Colore
                    </label>

                    <input type="color" name="color" id="color" class="form-control form-control-color w-100"
                        value="{{ $genre->color }}" required>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection