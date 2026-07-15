@extends('layouts.app')

@section('title', $productionCompany->name)

@section('content')

<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="show-topbar d-flex justify-content-between align-items-center gap-2 mb-4 flex-wrap">

        <a href="{{ route('production-companies.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            Case Produttrici
        </a>

        <div>

            <a href="{{ route('production-companies.edit', $productionCompany) }}"
                class="btn btn-secondary">

                <i class="bi bi-pencil me-2"></i>
                Modifica

            </a>

            <button type="button"
                class="btn btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#deleteProductionCompanyModal">

                <i class="bi bi-trash me-2"></i>
                Elimina

            </button>
        </div>
    </div>

    {{-- INFORMATION --}}
    <div class="card show-card mb-4">

        <div class="d-flex align-items-center gap-3">

            <span class="production-company-icon">
                <i class="bi bi-building"></i>
            </span>

            <div>

                <h2 class="mb-1">
                    {{ $productionCompany->name }}
                </h2>

                <p class="text-secondary mb-0">
                    {{ $productionCompany->tvSeries->count() }}
                    {{ $productionCompany->tvSeries->count() === 1
                        ? 'Serie TV prodotta'
                        : 'Serie TV prodotte' }}
                </p>
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
                ({{ $productionCompany->tvSeries->count() }})
            </p>

        </div>

        <div class="d-flex flex-column gap-3">

            @forelse ($productionCompany->tvSeries as $series)

                @include('tvseries.partials.tvseries-card', [
                    'series' => $series
                ])

            @empty

                <p class="text-secondary mb-0">
                    Nessuna serie TV associata!
                </p>

            @endforelse
        </div>
    </div>
</div>


{{-- DELETE MODAL --}}
<div class="modal fade"
    id="deleteProductionCompanyModal"
    tabindex="-1"
    aria-labelledby="deleteProductionCompanyModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="deleteProductionCompanyModalLabel">

                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                    Elimina Casa Produttrice

                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <p>
                    Vuoi davvero eliminare
                    <strong>{{ $productionCompany->name }}</strong>?
                </p>

                <div class="alert alert-warning mb-0">

                    <i class="bi bi-info-circle me-2"></i>

                    La casa produttrice verrà
                    <strong>eliminata definitivamente dal database</strong>.

                    Le serie TV associate non verranno eliminate e rimarranno senza una casa produttrice.

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">

                    Annulla

                </button>

                <form method="POST"
                    action="{{ route('production-companies.destroy', $productionCompany) }}">

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