@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')

<div class="card auth-card">

    <div class="auth-card-header">

        <h1>
            Password dimenticata?
        </h1>

        <p>
            Inserisci la tua email e ti invieremo un link per reimpostare la password.
        </p>

    </div>

    @if (session('status'))

    <div class="alert alert-success">
        {{ session('status') }}
    </div>

    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">

        @csrf

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

        <button type="submit" class="btn btn-info auth-submit">

            Invia link di reimpostazione

        </button>
    </form>

    <div class="auth-footer">

        <span>
            Ricordi la password?
        </span>

        <a href="{{ route('login') }}" class="auth-link">

            Torna al login

        </a>
    </div>
</div>

@endsection