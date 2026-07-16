@extends('layouts.app')

@section('title', 'Production Companies')

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">

        <div class="d-flex align-items-center gap-2">

            <span class="section-icon pe-none me-2">
                <i class="bi bi-building"></i>
            </span>

            <div>
                <h4 class="m-0">
                    Case Produttrici
                </h4>

                <p class="description-category m-0">
                    Gestisci le case produttrici presenti nel catalogo.
                </p>
            </div>

        </div>

        <a href="{{ route('production-companies.create') }}" class="btn btn-info">

            <i class="bi bi-plus-lg me-2"></i>
            Aggiungi casa produttrice

        </a>

    </div>

    {{-- PRODUCTION COMPANIES --}}
    <div class="row g-3">

        @forelse ($productionCompanies as $productionCompany)

        <div class="col-12 col-md-6 col-xl-4 d-flex">

            <div class="card create-card production-company-card d-flex flex-row justify-content-between align-items-center flex-fill gap-2"
                onclick="window.location='{{ route('production-companies.show', $productionCompany) }}'">

                <div class="d-flex align-items-start gap-3 flex-grow-1">

                    <span class="production-company-icon">
                        <i class="bi bi-building"></i>
                    </span>

                    <div class="flex-grow-1">
                        <div class="production-company-name">
                            {{ $productionCompany->name }}
                        </div>

                        <div class="text-secondary">
                            {{ $productionCompany->tvSeries->count() }}
                            {{ $productionCompany->tvSeries->count() === 1
                            ? 'Serie TV prodotta'
                            : 'Serie TV prodotte' }}
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('production-companies.edit', $productionCompany) }}"
                        onclick="event.stopPropagation()" class="btn btn-sm btn-secondary">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <button type="button" class="btn btn-sm btn-danger" onclick="event.stopPropagation()"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteProductionCompanyModal{{ $productionCompany->id }}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>

            {{-- DELETE MODAL --}}
            <div class="modal fade" id="deleteProductionCompanyModal{{ $productionCompany->id }}" tabindex="-1"
                aria-labelledby="deleteProductionCompanyModalLabel{{ $productionCompany->id }}" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="deleteProductionCompanyModalLabel{{ $productionCompany->id }}">

                                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                Elimina Casa Produttrice

                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>

                        </div>

                        <div class="modal-body">

                            <p class="mb-2">
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

                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

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

        </div>

        @empty

        <p class="text-secondary mb-0">
            Nessuna casa produttrice presente!
        </p>

        @endforelse

    </div>

</div>
@endsection