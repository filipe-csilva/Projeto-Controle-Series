<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
        <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>        
    @endauth
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $serie->cover) }}" class="me-3" width="100px" />
                    <a href="{{ route('seasons.index', $serie->id) }}">{{ $serie->name }}</a>
                </div>
                @auth
                    <span class="d-flex">
                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm ms-2">
                                Excluir
                            </button>
                        </form>
                    </span>
                @endauth
            </li>                
        @endforeach
    </ul>
</x-layout>