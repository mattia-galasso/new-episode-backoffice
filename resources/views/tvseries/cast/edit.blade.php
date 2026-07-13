@extends('layouts.app')

@section('title', 'Edit Cast "' . $tvseries->title . '"')

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="d-flex flex-column justify-content-center align-items-start mb-4 gap-4">

        <a href="{{ route('tvseries.edit', $tvseries) }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            Torna alle informazioni
        </a>

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 w-100">

            <div class="d-flex align-items-center gap-2">

                <span class="section-icon pe-none me-2">
                    <i class="bi bi-people"></i>
                </span>

                <div>
                    <h4 class="m-0">
                        Modifica Cast
                    </h4>
                    <p class="description-category m-0">
                        Aggiungi o rimuovi gli attori associati a
                        <strong>{{ $tvseries->title }}</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info d-flex align-items-center gap-3 mb-4">
        <i class="bi bi-info-circle-fill fs-5"></i>
        <div>
            Per modificare un attore già associato, selezionalo nuovamente e aggiorna le informazioni desiderate.
        </div>
    </div>

    <form id="cast-form" method="POST" action="{{ route('tvseries.cast.add', $tvseries) }}">

        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-12">
                <div class="card create-card">

                    <h5 class="fw-bold mb-4">
                        Aggiungi Attore
                    </h5>

                    <div class="row g-3">

                        <div class="col-lg-7">

                            <label for="actor_id" class="form-label">
                                Attore
                            </label>

                            <select name="actor_id" id="actor_id">
                            </select>

                        </div>
                        <div class="col-lg-3">

                            <label for="role" class="form-label">
                                Ruolo / Personaggio
                            </label>

                            <input type="text" name="role" id="role" class="form-control"
                                placeholder="Es. Regista o Harry Potter" required>

                        </div>

                        <div class="col-lg-2 d-flex align-items-end">

                            <button type="submit" class="btn fw-semibold btn-info w-100">
                                <i class="bi bi-plus-lg me-2"></i>
                                Aggiungi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <div class="col-12">
        <div class="card create-card">

            <h5 class="fw-bold mb-4">
                Cast della Serie
            </h5>

            <div class="row g-3">
                @forelse ($tvseries->actors as $actor)
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="actor-card position-relative">
                        <button type="button" class="btn btn-sm btn-danger actor-remove" data-bs-toggle="modal"
                            data-bs-target="#removeActorModal{{ $actor->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
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
                <div class="modal fade" id="removeActorModal{{ $actor->id }}" tabindex="-1"
                    aria-labelledby="removeActorModalLabel{{ $actor->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="removeActorModalLabel{{ $actor->id }}">
                                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                    Rimuovi Attore
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-2">
                                    Vuoi davvero rimuovere
                                    <strong>{{ $actor->name }}</strong> dal cast di <strong>{{ $tvseries->title
                                        }}</strong>?
                                </p>
                                <div class="alert alert-warning mb-0">
                                    <i class="bi bi-info-circle me-2"></i>

                                    L'attore <strong>non verrà eliminato dal database</strong>.
                                    Sarà rimossa solamente l'associazione con questa serie TV.
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Annulla
                                </button>

                                <form method="POST" action="{{ route('tvseries.cast.remove', [$tvseries, $actor]) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash me-2"></i>
                                        Rimuovi
                                    </button>
                                </form>
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


@endsection