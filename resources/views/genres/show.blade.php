@extends('layouts.app')

@section('title', $genre->name)

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
                    <i class="bi bi-tags"></i>
                </span>

                <div>
                    <h4 class="m-0">
                        {{ $genre->name }}
                    </h4>

                    <p class="description-category m-0">
                        Informazioni e serie TV associate al genere.
                    </p>
                </div>
            </div>

            <div class="d-flex gap-2 ms-md-auto">
                <a href="{{ route('genres.edit', $genre) }}" class="btn btn-secondary">
                    <i class="bi bi-pencil me-2"></i>
                    Modifica
                </a>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteGenreModal">
                    <i class="bi bi-trash me-2"></i>
                    Elimina
                </button>
            </div>
        </div>
    </div>

    {{-- INFO --}}
    <div class="card create-card mb-4">

        <h5 class="fw-bold mb-4">
            Informazioni
        </h5>

        <div class="info-row">
            <span class="info-label">
                Nome
            </span>

            <span class="info-value">
                {{ $genre->name }}
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">
                Colore
            </span>

            <span class="info-value">
                <span class="badge rounded-pill"
                    style="border: 1px solid {{ $genre->color }}; color: {{ $genre->color }}">

                    {{ $genre->name }}

                </span>
            </span>
        </div>
    </div>

    {{-- TV SERIES --}}
    <div class="card create-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h5 class="fw-bold mb-0">
                Serie TV
            </h5>

            <p class="m-0">
                ({{ $genre->tvseries->count() }})
            </p>

        </div>
        <div class="row g-3">

            @forelse ($genre->tvseries as $series)

            <div class="col-12">
                @include('tvseries.partials.tvseries-card')
            </div>

            @empty

            <p class="text-secondary mb-0">
                Nessuna serie TV associata a questo genere!
            </p>

            @endforelse
        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="deleteGenreModal" tabindex="-1" aria-labelledby="deleteGenreModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="deleteGenreModalLabel">

                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                    Elimina Genere

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <p>
                    Vuoi davvero eliminare
                    <strong>{{ $genre->name }}</strong>?
                </p>

                <div class="alert alert-danger mb-0">
                    <i class="bi bi-exclamation-circle me-2"></i>

                    Il genere verrà eliminato definitivamente e rimosso dalle serie TV associate.
                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                    Annulla

                </button>

                <form method="POST" action="{{ route('genres.destroy', $genre) }}">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>
                        Elimina
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection