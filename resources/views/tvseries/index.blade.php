@extends('layouts.app')

@section('title', 'Tv Series')

@section('content')
<div class="content_container card p-3">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <span class="section-icon pe-none me-2"><i class="bi bi-film"></i></span>
            <div>
                <h4 class="m-0">Serie Tv</h4>
                <p class="description-category m-0">Gestisci tutte le serie TV presenti in catalogo.</p>
            </div>
        </div>
        <button class="btn btn-info fw-semibold">
            <i class="bi bi-plus-lg me-1"></i>
            Aggiungi nuova serie
        </button>
    </div>
    <div class="table-container mt-4 mb-0">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Locandina</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Stagioni</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Classificazione Età</th>
                    <th scope="col">Generi</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tvseries as $series)
                <tr>
                    <td scope="row" class="text-center">{{ $series->id }}</td>
                    <td class="poster-index text-center">
                        <img src="{{ $series->poster == null ? asset('./img/no_image_available.png') : asset('storage/' . $series->poster) }}"
                            alt="{{ $series->poster == null ? 'No Image Available' : $series->title }}">
                    </td>
                    <th>{{ $series->title }}</th>
                    <td>{{ $series->season_count }}</td>
                    <td>
                        {{ $series->status == 'ongoing' ? 'In Produzione' : 'Terminata'}}
                    </td>
                    <td>{{ $series->age_rating }}</td>
                    <td>
                        @foreach ($series->genres as $genre)
                        <span class="badge rounded-pill"
                            style="border: 1px solid {{ $genre->color }}; color:{{ $genre->color }};">{{$genre->name}}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('tvseries.show', $series)}}">
                            <button class="btn btn-primary me-2"><i class="bi bi-eye"></i></button></a>
                        <button class="btn btn-secondary me-2"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <th class="text-center" colspan="5">Nessuna Serie TV in lista!</th>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection