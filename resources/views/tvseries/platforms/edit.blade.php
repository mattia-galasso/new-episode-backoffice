@extends('layouts.app')

@section('title', 'Edit Platforms "' . $tvseries->title . '"')

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
                    <i class="bi bi-display"></i>
                </span>

                <div>
                    <h4 class="m-0">
                        Modifica Piattaforme
                    </h4>

                    <p class="description-category m-0">
                        Aggiungi o rimuovi le piattaforme associate a
                        <strong>{{ $tvseries->title }}</strong>.
                    </p>
                </div>

            </div>

        </div>

    </div>

    <div class="alert alert-info d-flex align-items-center gap-3 mb-4">
        <i class="bi bi-info-circle-fill fs-5"></i>

        <div>
            Per modificare una piattaforma già associata, selezionala nuovamente e aggiorna le informazioni desiderate.
        </div>
    </div>

    {{-- ADD PLATFORM --}}
    <form method="POST" action="{{ route('tvseries.platforms.add', $tvseries) }}">

        @csrf
        @method('PUT')

        <div class="card create-card mb-4">

            <h5 class="fw-bold mb-4">
                Aggiungi Piattaforma
            </h5>

            <div class="row g-3">

                <div class="col-lg-4">

                    <label for="platform_id" class="form-label">
                        Piattaforma
                    </label>

                    <select name="platform_id" id="platform_id" class="form-select" required>

                        <option value="">
                            Seleziona una piattaforma
                        </option>

                        @foreach ($platforms as $platform)

                        <option value="{{ $platform->id }}">
                            {{ $platform->name }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-6">

                    <label for="url" class="form-label">
                        URL Serie TV
                    </label>

                    <input type="url" name="url" id="url" class="form-control" placeholder="https://...">

                </div>

                <div class="col-lg-2 d-flex align-items-end">

                    <button type="submit" class="btn btn-info fw-semibold w-100">
                        <i class="bi bi-plus-lg me-2"></i>
                        Aggiungi
                    </button>

                </div>

            </div>

        </div>

    </form>

    {{-- PLATFORMS --}}
    <div class="card create-card">

        <h5 class="fw-bold mb-4">
            Piattaforme della Serie
        </h5>

        <div class="d-flex flex-column gap-3">

            @forelse ($tvseries->platforms as $platform)

            <div class="platform-association-item">

                <div class="platform-association-main">

                    @if (str_starts_with($platform->logo_img, 'logo_'))
                    <img src="{{ asset('./img/platforms/' . $platform->logo_img) }}" alt="{{ $platform->name }}">
                    @elseif (!$platform->logo_img)
                    <img src="{{ asset('./img/platforms/logo_notfound.png') }}" alt="{{ $platform->name }}">
                    @else
                    <img src="{{ asset('storage/' . $platform->logo_img) }}" alt="{{ $platform->name }}">
                    @endif

                    <div class="platform-name">
                        {{ $platform->name }}
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#removePlatformModal{{ $platform->id }}">

                        <i class="bi bi-trash"></i>
                    </button>

                </div>

                <div class="platform-association-url text-secondary">
                    {{ $platform->pivot->url ?? 'URL specifico non indicato' }}
                </div>

            </div>

            {{-- MODAL --}}
            <div class="modal fade" id="removePlatformModal{{ $platform->id }}" tabindex="-1"
                aria-labelledby="removePlatformModalLabel{{ $platform->id }}" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="removePlatformModalLabel{{ $platform->id }}">

                                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                Rimuovi Piattaforma

                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>

                        </div>

                        <div class="modal-body">

                            <p class="mb-2">
                                Vuoi davvero rimuovere
                                <strong>{{ $platform->name }}</strong>
                                da <strong>{{ $tvseries->title }}</strong>?
                            </p>

                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-info-circle me-2"></i>

                                La piattaforma <strong>non verrà eliminata dal database</strong>.
                                Sarà rimossa solamente l'associazione con questa serie TV.
                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                                Annulla

                            </button>

                            <form method="POST"
                                action="{{ route('tvseries.platforms.remove', [$tvseries, $platform]) }}">

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
                Nessuna piattaforma associata!
            </p>

            @endforelse
        </div>
    </div>
</div>
@endsection