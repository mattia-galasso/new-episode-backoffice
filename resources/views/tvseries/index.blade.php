@extends('layouts.app')

@section('title', 'Tv Series')

@section('content')
<div class="content-container card p-3">
    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-lg-center gap-3">
        <div class="d-flex align-items-center gap-2">
            <span class="section-icon pe-none me-2">
                <i class="bi bi-film"></i>
            </span>
            <div>
                <h4 class="m-0">Serie TV</h4>
                <p class="description-category m-0">
                    Gestisci tutte le serie TV presenti in catalogo.
                </p>
            </div>
        </div>
        <a href="{{ route('tvseries.create') }}"
            class="btn btn-info fw-semibold d-flex align-items-center">

            <i class="bi bi-plus-lg me-1"></i>
            Aggiungi nuova serie

        </a>
    </div>
    {{-- SERIES LIST --}}
    <div class="tvseries-list mt-4">

        @forelse($tvseries as $series)

            @include('tvseries.partials.tvseries-card')

        @empty

            <div class="text-center py-5">
                Nessuna serie TV presente.
            </div>

        @endforelse

    </div>

</div>
@endsection