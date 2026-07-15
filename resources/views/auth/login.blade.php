@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="card auth-card">
    <div class="auth-card-header">
        <h1>
            Bentornato
        </h1>

        <p>
            Accedi al tuo account NextEpisode.
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="auth-form">

        @csrf

        {{-- EMAIL --}}
        <div>
            <label for="email" class="form-label">
                Email
            </label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Inserisci la tua email">

            @error('email')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

            @enderror

        </div>

        {{-- PASSWORD --}}
        <div>

            <div class="d-flex justify-content-between align-items-center">

                <label for="password" class="form-label">
                    Password
                </label>

                @if (Route::has('password.request'))

                <a href="{{ route('password.request') }}" class="auth-link">

                    Password dimenticata?

                </a>

                @endif

            </div>

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password" placeholder="Inserisci la tua password">

            @error('password')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

            @enderror

        </div>

        {{-- REMEMBER --}}
        <div class="form-check">

            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked'
                : '' }}>

            <label class="form-check-label" for="remember">

                Ricordami

            </label>

        </div>

        {{-- SUBMIT --}}
        <button type="submit" class="btn btn-info auth-submit">

            Accedi

        </button>
    </form>

    @if (Route::has('register'))
    <div class="auth-footer">

        <span>
            Non hai ancora un account?
        </span>

        <a href="{{ route('register') }}" class="auth-link">

            Registrati

        </a>
    </div>
    @endif
</div>

@endsection