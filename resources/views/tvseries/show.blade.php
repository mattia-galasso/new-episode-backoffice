@extends('layouts.app')

@section('title', $tvseries->title)

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-primary m-0"><i class="bi bi-arrow-left me-2"></i>Serie TV</button>
        <div>
            <button class="btn btn-secondary"><i class="bi bi-pencil"></i> Modifica</button>
            <button class="btn btn-danger"><i class="bi bi-trash"></i> Elimina</button>
        </div>
    </div>
@endsection