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
        <button class="series-btn delete-btn" onclick="event.stopPropagation()">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>