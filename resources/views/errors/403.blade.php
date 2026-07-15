@extends('layouts.auth')

@section('title', '403 - Accesso negato')

@section('content')
<div class="text-center">

    <h1 class="display-1 fw-bold">403</h1>

    <h2 class="mb-3">
        Accesso negato
    </h2>

    <p class="text-secondary mb-4">
        Non hai i permessi necessari per accedere a questa pagina.
    </p>

    <a href="{{ route('dashboard') }}" class="btn btn-primary">
        <i class="bi bi-house me-2"></i>
        Torna alla Dashboard
    </a>
</div>
@endsection