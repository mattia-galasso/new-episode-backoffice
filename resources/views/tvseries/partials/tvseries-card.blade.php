<div class="tvseries-card" onclick="window.location='{{ route('tvseries.show',$series) }}'">

    {{-- POSTER --}}
    <div class="series-poster">
        <img src="{{ $series->poster === null ? asset('img/no_image_available.png') : asset('storage/'.$series->poster) }}"
            alt="{{ $series->title }}">
    </div>

    {{-- INFORMATIONS --}}
    <div class="series-content">
        <h5 class="series-title">
            {{ $series->title }}
        </h5>

        @if(isset($role))
        <div class="series-role">
            <span class="text-secondary">Ruolo:</span>
            <strong>{{ $role }}</strong>
        </div>
        @endif

        <div class="series-meta">
            <span>
                <i class="bi bi-collection-play"></i>
                {{ $series->season_count }} stagioni
            </span>
            <span>
                <i class="bi bi-shield-check"></i>
                {{ $series->age_rating }}
            </span>

            @if($series->status === 'ongoing')
            <span class="badge index-ongoing">
                In Produzione
            </span>
            @else
            <span class="badge index-ended">
                Terminata
            </span>
            @endif

        </div>
        <div class="series-genres">

            @foreach($series->genres as $genre)
            <span class="badge rounded-pill" style="border:1px solid {{ $genre->color }}; color:{{ $genre->color }}">
                {{ $genre->name }}
            </span>
            @endforeach

        </div>

    </div>

    {{-- ACTIONS --}}
    <div class="series-actions">
        <a href="{{ route('tvseries.edit', $series) }}" onclick="event.stopPropagation()" class="series-btn edit-btn">
            <i class="bi bi-pencil"></i>
        </a>
        <button type="button" class="series-btn delete-btn" onclick="event.stopPropagation()" data-bs-toggle="modal"
            data-bs-target="#deleteTvSeriesModal{{ $series->id }}">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="deleteTvSeriesModal{{ $series->id }}" tabindex="-1"
    aria-labelledby="deleteTvSeriesModalLabel{{ $series->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTvSeriesModalLabel{{ $series->id }}">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                    Elimina Serie TV
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <p>
                    Vuoi davvero eliminare
                    <strong>{{ $series->title }}</strong>?
                </p>

                <div class="alert alert-danger mb-0">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    La serie TV verrà eliminata definitivamente.
                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                    Annulla

                </button>

                <form method="POST" action="{{ route('tvseries.destroy', $series) }}">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>
                        Elimina
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>