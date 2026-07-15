@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="content-container card p-3">
    {{-- HEADER --}}
    <div class="d-flex align-items-center gap-2 mb-4">
        <span class="section-icon pe-none me-2">
            <i class="bi bi-people"></i>
        </span>
        <div>
            <h4 class="m-0">Utenti</h4>
            <p class="description-category m-0">
                Gestisci gli utenti registrati e i relativi ruoli.
            </p>
        </div>
    </div>

    {{-- USERS --}}
    <div class="row g-3">
        @forelse ($users as $user)
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card create-card h-100 d-flex flex-row align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3 overflow-hidden">
                    <img src="{{ asset('./img/actor_image_not_found.png') }}"
                        alt="{{ $user->name }}"
                        width="48"
                        height="48"
                        class="rounded-circle flex-shrink-0">

                    <div class="overflow-hidden">
                        <div class="fw-bold">
                            {{ $user->name }}
                        </div>

                        <div class="text-secondary text-truncate">
                            {{ $user->email }}
                        </div>

                        <span class="badge mt-2 {{ $user->role === 'admin' ? 'text-bg-info' : 'text-bg-secondary' }}">
                            {{ $user->role === 'admin' ? 'Amministratore' : 'Utente' }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('users.edit', $user) }}"
                    class="btn btn-sm btn-secondary flex-shrink-0">
                    <i class="bi bi-pencil"></i>
                </a>
            </div>
        </div>
        @empty
        <p class="text-secondary mb-0">
            Nessun utente presente!
        </p>
        @endforelse
    </div>
</div>
@endsection