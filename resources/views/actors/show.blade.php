@extends('layouts.app')

@section('title', $actor->name)

@section('content')
<div class="content-container card">

    {{-- HEADER --}}
    <div class="show-topbar d-flex justify-content-between align-items-center gap-2 p-3 flex-wrap">

        <a href="{{ route('actors.index') }}" class="btn btn-primary m-0">
            <i class="bi bi-arrow-left me-2"></i>
            Attori
        </a>

        <div>

            <a href="{{ route('actors.edit', $actor) }}" class="btn btn-secondary">
                <i class="bi bi-pencil"></i>
                Modifica
            </a>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteActorModal">

                <i class="bi bi-trash"></i>
                Elimina

            </button>
        </div>
    </div>

    {{-- ACTOR --}}
    <div class="p-3">

        {{-- ACTOR INFORMATIONS --}}
        <div class="row g-3 align-items-stretch">

            {{-- PHOTO --}}
            <div class="col-12 col-md-auto">

                <div class="actor-show-photo">

                    <img src="{{ $actor->photo
                    ? asset('storage/' . $actor->photo)
                    : asset('./img/actor_image_not_found.png') }}" alt="{{ $actor->name }}">

                </div>

            </div>

            {{-- INFORMATIONS --}}
            <div class="col-12 col-md d-flex">

                <div class="card show-card flex-fill">
                    <div class="my-auto">

                        <h2 class="mb-4">
                            {{ $actor->name }}
                        </h2>

                        <div class="info-row">

                            <span class="info-label">
                                Data di nascita
                            </span>

                            <span class="info-value">
                                {{ $actor->birth_date_formatted ?? 'Non indicata' }}
                            </span>

                        </div>

                        <div class="info-row">

                            <span class="info-label">
                                Serie TV
                            </span>

                            <span class="info-value">
                                {{ $actor->tvSeries->count() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TV SERIES --}}
        <div class="card show-card mt-3">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5 class="fw-bold mb-0">
                    Serie TV
                </h5>

                <p class="m-0">
                    ({{ $actor->tvSeries->count() }})
                </p>

            </div>

            <div class="row g-3">

                @forelse ($actor->tvSeries as $series)

                <div class="col-12">

                    @include('tvseries.partials.tvseries-card', [
                    'role' => $series->pivot->role
                    ])

                </div>

                @empty

                <p class="text-secondary mb-0">
                    Nessuna serie TV associata a questo attore!
                </p>

                @endforelse
            </div>
        </div>
    </div>

    @endsection