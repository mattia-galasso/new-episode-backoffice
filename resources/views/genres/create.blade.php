@extends('layouts.app')

@section('title', 'Add Genre')

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="d-flex flex-column justify-content-center align-items-start mb-4 gap-4">

        <a href="{{ route('genres.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            Generi
        </a>

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 w-100">

            <div class="d-flex align-items-center gap-2">

                <span class="section-icon pe-none me-2">
                    <i class="bi bi-plus-circle"></i>
                </span>

                <div>
                    <h4 class="m-0">
                        Aggiungi Genere
                    </h4>

                    <p class="description-category m-0">
                        Aggiungi un nuovo genere al catalogo.
                    </p>
                </div>
            </div>

            <div class="create-actions d-flex gap-2 ms-md-auto">

                <button type="reset" form="genre-form" class="btn btn-outline-secondary">
                    Annulla
                </button>

                <button type="submit" form="genre-form" class="btn btn-info">
                    Aggiungi genere
                </button>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <form method="POST" id="genre-form" action="{{ route('genres.store') }}">

        @csrf

        <div class="card create-card">

            <h5 class="fw-bold mb-4">
                Informazioni
            </h5>

            <div class="row g-3">

                <div class="col-12 col-md-8">

                    <label for="name" class="form-label">
                        Nome
                    </label>

                    <input type="text" name="name" id="name" class="form-control" placeholder="Es. Fantascienza"
                        required>

                </div>

                <div class="col-12 col-md-4">

                    <label for="color" class="form-label">
                        Colore
                    </label>

                    <input type="color" name="color" id="color" class="form-control form-control-color w-100" required>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection