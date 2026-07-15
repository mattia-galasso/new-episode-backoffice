@extends('layouts.app')

@section('title', 'Create Platform')

@section('content')
<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="d-flex flex-column justify-content-center align-items-start mb-4 gap-4">

        <a href="{{ route('platforms.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            Piattaforme
        </a>

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 w-100">

            <div class="d-flex align-items-center gap-2">

                <span class="section-icon pe-none me-2">
                    <i class="bi bi-display"></i>
                </span>

                <div>
                    <h4 class="m-0">
                        Nuova Piattaforma
                    </h4>

                    <p class="description-category m-0">
                        Compila i campi per aggiungere una nuova piattaforma.
                    </p>
                </div>

            </div>

            <div class="create-actions d-flex gap-2 ms-md-auto">

                <button type="reset"
                    form="platform-form"
                    class="btn btn-outline-secondary">

                    Annulla

                </button>

                <button type="submit"
                    form="platform-form"
                    class="btn btn-info">

                    Pubblica

                </button>

            </div>

        </div>

    </div>

    {{-- FORM --}}
    <form method="POST"
        id="platform-form"
        action="{{ route('platforms.store') }}"
        enctype="multipart/form-data">

        @csrf

        <div class="row g-4 align-items-stretch">

            {{-- INFORMATION --}}
            <div class="col-12 col-xl-8 d-flex">

                <div class="card create-card flex-fill">

                    <h5 class="fw-bold mb-4">
                        Informazioni
                    </h5>

                    <div class="mb-3">

                        <label for="name" class="form-label">
                            Nome
                        </label>

                        <input type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            placeholder="Inserisci nome piattaforma"
                            required>

                    </div>

                    <div class="mb-3">

                        <label for="website" class="form-label">
                            Sito web
                        </label>

                        <input type="url"
                            name="website"
                            id="website"
                            class="form-control"
                            placeholder="https://...">

                    </div>

                </div>

            </div>

            {{-- LOGO --}}
            <div class="col-12 col-xl-4 d-flex">

                <div class="card create-card flex-fill">

                    <h5 class="fw-bold mb-4">
                        Logo
                    </h5>

                    <label for="logo_img" class="form-label">
                        Logo piattaforma
                    </label>

                    <input type="file"
                        name="logo_img"
                        id="logo_img"
                        class="form-control"
                        accept="image/*">

                    <div class="placeholder-box platform-preview-box">

                        <div id="platform-placeholder">

                            <i class="bi bi-image fs-1"></i>

                            <small>
                                Anteprima logo
                            </small>

                        </div>

                        <img id="platform-preview"
                            class="media-preview platform-preview d-none"
                            alt="Anteprima logo">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection