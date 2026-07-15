@extends('layouts.app')

@section('title', $platform->name)

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">

        <a href="{{ route('platforms.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            Piattaforme
        </a>

        <div class="d-flex gap-2">

            <a href="{{ route('platforms.edit', $platform) }}" class="btn btn-secondary">
                <i class="bi bi-pencil me-2"></i>
                Modifica
            </a>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePlatformModal">

                <i class="bi bi-trash me-2"></i>
                Elimina

            </button>

        </div>

    </div>

    {{-- PLATFORM INFO --}}
    <div class="card show-card mb-4">

        <div class="d-flex align-items-center gap-4">

            @if (str_starts_with($platform->logo_img, 'logo_'))

            <img src="{{ asset('./img/platforms/' . $platform->logo_img) }}" alt="{{ $platform->name }}"
                class="platform-show-logo">

            @elseif (!$platform->logo_img)

            <img src="{{ asset('./img/platforms/logo_notfound.png') }}" alt="{{ $platform->name }}"
                class="platform-show-logo">

            @else

            <img src="{{ asset('storage/' . $platform->logo_img) }}" alt="{{ $platform->name }}"
                class="platform-show-logo">

            @endif

            <div>

                <h2 class="fw-bold mb-2">
                    {{ $platform->name }}
                </h2>

                @if ($platform->website)

                <a href="{{ $platform->website }}" target="_blank" class="text-decoration-none">

                    {{ $platform->website }}

                    <i class="bi bi-box-arrow-up-right ms-1"></i>

                </a>

                @else

                <p class="text-secondary mb-0">
                    Sito web non indicato
                </p>

                @endif

            </div>

        </div>

    </div>

    {{-- TV SERIES --}}
    <div class="card show-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h5 class="fw-bold mb-0">
                Serie TV
            </h5>

            <p class="m-0">
                ({{ $platform->tvSeries->count() }})
            </p>

        </div>

        <div class="row g-3">
            @forelse ($platform->tvSeries as $series)

            @include('tvseries.partials.tvseries-card', [
            'series' => $series,
            'url' => $series->pivot->url,
            ])

            @empty

            <p class="text-secondary mb-0">
                Nessuna serie TV associata a questa piattaforma!
            </p>

            @endforelse
        </div>
    </div>
</div>


{{-- DELETE MODAL --}}
<div class="modal fade" id="deletePlatformModal" tabindex="-1" aria-labelledby="deletePlatformModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="deletePlatformModalLabel">

                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                    Elimina Piattaforma

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <p>
                    Vuoi davvero eliminare
                    <strong>{{ $platform->name }}</strong>?
                </p>

                <div class="alert alert-danger mb-0">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    La piattaforma verrà eliminata definitivamente.

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
@endsection