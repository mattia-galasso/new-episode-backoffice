@extends('layouts.app')

@section('title', 'Genres')

@section('content')

<div class="content-container card p-3">

    {{-- HEADER --}}
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">

        <div class="d-flex align-items-center gap-2">

            <span class="section-icon pe-none me-2">
                <i class="bi bi-tags"></i>
            </span>

            <div>
                <h4 class="m-0">
                    Generi
                </h4>

                <p class="description-category m-0">
                    Gestisci i generi disponibili nel catalogo.
                </p>
            </div>

        </div>

        <a href="{{ route('genres.create') }}" class="btn btn-info">
            <i class="bi bi-plus-lg me-2"></i>
            Aggiungi genere
        </a>

    </div>

    {{-- GENRES --}}
    <div class="row g-3">

        @forelse ($genres as $genre)

        <div class="col-12 col-md-6 col-lg-4">

            <div class="card create-card genre-card d-flex flex-row justify-content-between align-items-center"
                onclick="window.location='{{ route('genres.show', $genre) }}'">

                <span class="badge rounded-pill"
                    style="border: 1px solid {{ $genre->color }}; color: {{ $genre->color }}">

                    {{ $genre->name }}

                </span>

                <div class="d-flex gap-2">

                    <a href="{{ route('genres.edit', $genre) }}" onclick="event.stopPropagation()"
                        class="btn btn-sm btn-secondary">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <button type="button" class="btn btn-sm btn-danger" onclick="event.stopPropagation()"
                        data-bs-toggle="modal" data-bs-target="#deleteGenreModal{{ $genre->id }}">
                        <i class="bi bi-trash"></i>
                    </button>

                </div>
            </div>
        </div>

        {{-- MODAL --}}
        <div class="modal fade" id="deleteGenreModal{{ $genre->id }}" tabindex="-1"
            aria-labelledby="deleteGenreModalLabel{{ $genre->id }}" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="deleteGenreModalLabel{{ $genre->id }}">

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

        @empty

        <p class="text-secondary mb-0">
            Nessun genere presente!
        </p>

        @endforelse

    </div>
</div>

@endsection