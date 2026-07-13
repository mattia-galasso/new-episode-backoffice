@extends('layouts.app')

@section('title', 'Edit Actor')

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="d-flex flex-column justify-content-center align-items-start mb-4 gap-4">

        <a href="{{ route('actors.show', $actor) }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            {{ $actor->name }}
        </a>

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 w-100">

            <div class="d-flex align-items-center gap-2">

                <span class="section-icon pe-none me-2">
                    <i class="bi bi-pencil-square"></i>
                </span>

                <div>
                    <h4 class="m-0">
                        Modifica "{{ $actor->name }}"
                    </h4>

                    <p class="description-category m-0">
                        Aggiorna le informazioni dell'attore.
                    </p>
                </div>

            </div>

            <div class="create-actions d-flex gap-2 ms-md-auto">

                <button type="reset"
                    form="actor-form"
                    class="btn btn-outline-secondary">
                    Annulla
                </button>

                <button type="submit"
                    form="actor-form"
                    class="btn btn-info">
                    Salva modifiche
                </button>

            </div>

        </div>

    </div>

    {{-- FORM --}}
    <form method="POST"
        id="actor-form"
        action="{{ route('actors.update', $actor) }}"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row g-4 align-items-stretch">

            {{-- INFORMATION --}}
            <div class="col-12 col-xl-8 d-flex">

                <div class="card create-card flex-fill">

                    <h5 class="fw-bold mb-4">
                        Informazioni
                    </h5>

                    <div class="mb-3">

                        <label for="name" class="form-label">
                            Nome e Cognome
                        </label>

                        <input type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            placeholder="Inserisci nome e cognome"
                            value="{{ $actor->name }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label for="birth_date" class="form-label">
                            Data di nascita
                        </label>

                        <input type="date"
                            name="birth_date"
                            id="birth_date"
                            class="form-control"
                            value="{{ $actor->birth_date }}">
                    </div>
                </div>
            </div>

            {{-- PHOTO --}}
            <div class="col-12 col-xl-4 d-flex">

                <div class="card create-card flex-fill">

                    <h5 class="fw-bold mb-4">
                        Foto
                    </h5>

                    <label for="photo" class="form-label">
                        Foto attore
                    </label>

                    <input type="file"
                        name="photo"
                        id="photo"
                        class="form-control"
                        accept="image/*">

                    <div class="placeholder-box poster-preview-box">

                        <div id="actor-placeholder"
                            class="{{ $actor->photo ? 'd-none' : '' }}">

                            <i class="bi bi-person-bounding-box fs-1"></i>
                            <small>Anteprima foto</small>

                        </div>

                        <img id="actor-preview"
                            class="media-preview poster-preview {{ $actor->photo ? '' : 'd-none' }}"
                            src="{{ $actor->photo ? asset('storage/' . $actor->photo) : '' }}"
                            alt="{{ $actor->name }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection