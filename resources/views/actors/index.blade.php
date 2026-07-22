@extends('layouts.app')

@section('title', 'Actors')

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">

        <div class="d-flex align-items-center gap-2">

            <span class="section-icon pe-none me-2">
                <i class="bi bi-people"></i>
            </span>

            <div>
                <h4 class="m-0">Attori</h4>

                <p class="description-category m-0">
                    Gestisci gli attori presenti nel catalogo.
                </p>
            </div>

        </div>

        <a href="{{ route('actors.create') }}" class="btn btn-info">
            <i class="bi bi-plus-lg me-2"></i>
            Aggiungi attore
        </a>

    </div>

    {{-- ACTORS --}}
    <div class="row g-3">

        @forelse ($actors as $actor)

        <div class="col-6 col-md-4 col-lg-3 col-xl-2">

            <div class="actor-card actor-index-card position-relative"
                onclick="window.location='{{ route('actors.show', $actor) }}'">

                <div class="actor-actions">

                    <a href="{{ route('actors.edit', $actor) }}" onclick="event.stopPropagation()"
                        class="series-btn edit-btn">

                        <i class="bi bi-pencil"></i>

                    </a>

                    <button type="button" class="series-btn delete-btn" onclick="event.stopPropagation()"
                        data-bs-toggle="modal" data-bs-target="#deleteActorModal{{ $actor->id }}">
                        <i class="bi bi-trash"></i>
                    </button>

                </div>

                <img src="{{ $actor->photo
                    ? asset('storage/' . $actor->photo)
                    : asset('./img/actor_image_not_found.png') }}" alt="{{ $actor->name }}">

                <div class="p-3">

                    <div class="actor-name">
                        {{ $actor->name }}
                    </div>

                    <div class="actor-role">
                        {{ $actor->birth_date_formatted ?? 'Data di nascita non indicata' }}
                    </div>

                </div>

            </div>
            {{-- DELETE MODAL --}}
            <div class="modal fade" id="deleteActorModal{{ $actor->id }}" tabindex="-1"
                aria-labelledby="deleteActorModalLabel{{ $actor->id }}" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="deleteActorModalLabel{{ $actor->id }}">

                                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                Elimina Attore

                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>

                        </div>

                        <div class="modal-body">

                            <p class="mb-2">
                                Vuoi davvero eliminare
                                <strong>{{ $actor->name }}</strong>?
                            </p>

                            <div class="alert alert-danger mb-0">

                                <i class="bi bi-exclamation-circle me-2"></i>

                                L'attore verrà <strong>eliminato definitivamente dal database</strong>
                                e rimosso da tutte le serie TV associate.

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                                Annulla

                            </button>

                            <form method="POST" action="{{ route('actors.destroy', $actor) }}">

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

        </div>

        @empty

        <p class="text-secondary mb-0">
            Nessun attore presente!
        </p>

        @endforelse

    </div>

</div>
@endsection