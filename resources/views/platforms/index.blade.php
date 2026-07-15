@extends('layouts.app')

@section('title', 'Platforms')

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">

        <div class="d-flex align-items-center gap-2">

            <span class="section-icon pe-none me-2">
                <i class="bi bi-display"></i>
            </span>

            <div>
                <h4 class="m-0">Piattaforme</h4>

                <p class="description-category m-0">
                    Gestisci le piattaforme presenti nel catalogo.
                </p>
            </div>

        </div>

        <a href="{{ route('platforms.create') }}" class="btn btn-info">
            <i class="bi bi-plus-lg me-2"></i>
            Aggiungi piattaforma
        </a>

    </div>

    {{-- PLATFORMS --}}
    <div class="row g-3">

        @forelse ($platforms as $platform)

        <div class="col-12 col-md-6 col-lg-4 col-xl-3">

            <div class="card platform-index-card position-relative h-100" onclick="window.location='{{ route('platforms.show', $platform) }}'">

                <div class="platform-actions">

                    <a href="{{ route('platforms.edit', $platform) }}" class="series-btn edit-btn" onclick="event.stopPropagation()">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <button type="button" class="series-btn delete-btn" data-bs-toggle="modal" data-bs-target="#deletePlatformModal{{ $platform->id }}" onclick="event.stopPropagation()">
                        <i class="bi bi-trash"></i>
                    </button>

                </div>

                <div class="p-4 d-flex flex-column align-items-center text-center gap-3">

                    @if (str_starts_with($platform->logo_img, 'logo_'))

                    <img class="platform-index-logo" src="{{ asset('./img/platforms/' . $platform->logo_img) }}"
                        alt="{{ $platform->name }}">

                    @elseif (!$platform->logo_img)

                    <img class="platform-index-logo" src="{{ asset('./img/platforms/logo_notfound.png') }}"
                        alt="{{ $platform->name }}">

                    @else

                    <img class="platform-index-logo" src="{{ asset('storage/' . $platform->logo_img) }}"
                        alt="{{ $platform->name }}">

                    @endif

                    <div>

                        <div class="platform-name">
                            {{ $platform->name }}
                        </div>

                        <div class="text-secondary">
                            {{ $platform->website ?? 'Sito web non indicato' }}
                        </div>

                    </div>

                </div>

            </div>

            {{-- DELETE MODAL --}}
            <div class="modal fade" id="deletePlatformModal{{ $platform->id }}" tabindex="-1"
                aria-labelledby="deletePlatformModalLabel{{ $platform->id }}" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="deletePlatformModalLabel{{ $platform->id }}">

                                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                Elimina Piattaforma

                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>

                        </div>

                        <div class="modal-body">

                            <p class="mb-2">
                                Vuoi davvero eliminare
                                <strong>{{ $platform->name }}</strong>?
                            </p>

                            <div class="alert alert-danger mb-0">
                                <i class="bi bi-exclamation-circle me-2"></i>

                                La piattaforma verrà
                                <strong>eliminata definitivamente dal database</strong>
                                e rimossa da tutte le serie TV associate.
                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                                Annulla

                            </button>

                            <form method="POST" action="{{ route('platforms.destroy', $platform) }}">

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
            Nessuna piattaforma presente!
        </p>

        @endforelse

    </div>

</div>
@endsection