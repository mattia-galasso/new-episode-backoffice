@extends('layouts.auth')

@section('title', 'Register')

@section('content')

<div class="card auth-card">

    <div class="auth-card-header">

        <h1>
            Crea il tuo account
        </h1>

        <p>
            Registrati per entrare in NextEpisode.
        </p>

    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">

        @csrf

        {{-- NAME --}}
        <div>

            <label for="name" class="form-label">
                Nome
            </label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Inserisci il tuo nome">

            @error('name')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

            @enderror

        </div>

        {{-- EMAIL --}}
        <div>

            <label for="email" class="form-label">
                Email
            </label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" placeholder="Inserisci la tua email">

            @error('email')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

            @enderror

        </div>

        {{-- PASSWORD --}}
        <div>

            <label for="password" class="form-label">
                Password
            </label>

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password" placeholder="Crea una password">

            @error('password')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

            @enderror

        </div>

        {{-- CONFIRM PASSWORD --}}
        <div>
            <label for="password-confirm" class="form-label">
                Conferma password
            </label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password" placeholder="Ripeti la password">
        </div>

        {{-- SUBMIT --}}
        <button type="submit" class="btn btn-info auth-submit">
            Registrati
        </button>

    </form>

    <div class="auth-footer">

        <span>
            Hai già un account?
        </span>

        <a href="{{ route('login') }}" class="auth-link">
            Accedi
        </a>
    </div>
</div>

@endsection