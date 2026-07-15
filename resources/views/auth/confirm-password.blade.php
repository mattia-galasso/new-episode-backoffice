@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')

<div class="card auth-card">

    <div class="auth-card-header">

        <h1>
            Conferma la password
        </h1>

        <p>
            Per continuare, conferma la password del tuo account.
        </p>

    </div>

    <form method="POST"
        action="{{ route('password.confirm') }}"
        class="auth-form">

        @csrf

        <div>

            <label for="password" class="form-label">
                Password
            </label>

            <input id="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                required
                autocomplete="current-password"
                autofocus
                placeholder="Inserisci la tua password">

            @error('password')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

            @enderror

        </div>

        <button type="submit"
            class="btn btn-info auth-submit">

            Conferma password

        </button>

    </form>

    @if (Route::has('password.request'))

    <div class="auth-footer">

        <a href="{{ route('password.request') }}"
            class="auth-link">

            Password dimenticata?

        </a>

    </div>
    @endif
</div>
@endsection