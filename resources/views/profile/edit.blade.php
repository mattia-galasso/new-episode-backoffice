@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="content-container card p-3">

    {{-- HEADER --}}
    <div class="d-flex align-items-center gap-2 mb-4">

        <span class="section-icon pe-none me-2">
            <i class="bi bi-person"></i>
        </span>

        <div>

            <h4 class="m-0">
                Profilo
            </h4>

            <p class="description-category m-0">
                Gestisci le informazioni e la sicurezza del tuo account.
            </p>

        </div>
    </div>

    {{-- PROFILE INFORMATION --}}
    <div class="card create-card mb-4">
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- UPDATE PASSWORD --}}
    <div class="card create-card mb-4">
        @include('profile.partials.update-password-form')
    </div>

    {{-- DELETE ACCOUNT --}}
    <div class="card create-card">
        @include('profile.partials.delete-user-form')
    </div>
</div>

@endsection