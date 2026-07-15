@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="content-container card p-3">

    {{-- BACK BUTTON --}}
    <div class="mb-4">
        <a href="{{ route('users.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>
            Utenti
        </a>
    </div>

    {{-- FORM --}}
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- HEADER --}}
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div class="d-flex align-items-center gap-2">
                <span class="section-icon pe-none me-2">
                    <i class="bi bi-person-gear"></i>
                </span>

                <div>
                    <h4 class="m-0">
                        Modifica "{{ $user->name }}"
                    </h4>

                    <p class="description-category m-0">
                        Modifica le informazioni e il ruolo dell'utente.
                    </p>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    Annulla
                </a>

                <button type="submit" class="btn btn-info">
                    Salva modifiche
                </button>
            </div>
        </div>

        {{-- INFORMATIONS --}}
        <div class="card create-card p-4">
            <h5 class="mb-4">
                Informazioni
            </h5>

            <div class="mb-3">
                <label for="name" class="form-label">
                    Nome
                </label>

                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ $user->name }}" required>

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">
                    Email
                </label>

                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>

            <div>
                <label for="role" class="form-label">
                    Ruolo
                </label>

                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required {{ Auth::id() === $user->id ? 'disabled' : '' }}>

                    <option value="user" {{ $user->role === "user" ? 'selected' : '' }}>
                        Utente
                    </option>

                    <option value="admin" {{ $user->role === "admin" ? 'selected' : '' }}>
                        Amministratore
                    </option>
                </select>

                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </form>
</div>
@endsection