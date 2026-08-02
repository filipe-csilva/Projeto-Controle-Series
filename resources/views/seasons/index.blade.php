<x-layout title="Temporadas de {!! $series->nome !!}">
    <div class="d-flex justify-center">
        <img src="{{ asset('storage/' . $series->cover ) }}" alt="Capa da série" class="img-fluid" style="width: 100%"/>
    </div>
    <ul class="list-group">
        @foreach ($seasons as $season)
            <a href="{{ route('episodes.index', $season->id) }}">
                <li class="list-group-item d-flex justify-content-between align-items-center">                
                    Temporada {{ $season->number }}
                    <span class="badge bg-secondary">
                        {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
                    </span>
                </li>      
            </a>          
        @endforeach
    </ul>
</x-layout>