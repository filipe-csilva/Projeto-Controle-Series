<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
        <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>        
    @endauth
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('seasons.index', $serie->id) }}">{{ $serie->name }}</a>
                <span class="d-flex">
                    @auth
                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm ms-2">
                                Excluir
                            </button>
                        </form>
                    @endauth
                </span>
            </li>                
        @endforeach
    </ul>
</x-layout>