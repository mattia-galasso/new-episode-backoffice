@extends('layouts.app')

@section('title', 'Edit Production Company')

@section('content')

<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="d-flex flex-column justify-content-center align-items-start mb-4 gap-4">

        <a href="{{ route('production-companies.show', $productionCompany) }}"
            class="btn btn-primary">

            <i class="bi bi-arrow-left me-2"></i>
            {{ $productionCompany->name }}

        </a>

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 w-100">

            <div class="d-flex align-items-center gap-2">

                <span class="section-icon pe-none me-2">
                    <i class="bi bi-pencil-square"></i>
                </span>

                <div>

                    <h4 class="m-0">
                        Modifica "{{ $productionCompany->name }}"
                    </h4>

                    <p class="description-category m-0">
                        Aggiorna le informazioni della casa produttrice.
                    </p>
                </div>
            </div>

            <div class="create-actions d-flex gap-2 ms-md-auto">

                <button type="reset"
                    form="production-company-form"
                    class="btn btn-outline-secondary">
                    Annulla
                </button>

                <button type="submit"
                    form="production-company-form"
                    class="btn btn-info">
                    Salva modifiche
                </button>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <form method="POST"
        id="production-company-form"
        action="{{ route('production-companies.update', $productionCompany) }}">

        @csrf
        @method('PUT')

        <div class="card create-card">

            <h5 class="fw-bold mb-4">
                Informazioni
            </h5>

            <div>

                <label for="name" class="form-label">
                    Nome
                </label>

                <input type="text" name="name" id="name" class="form-control" value="{{ $productionCompany->name }}" placeholder="Inserisci il nome della casa produttrice" required>
            </div>
        </div>
    </form>
</div>

@endsection