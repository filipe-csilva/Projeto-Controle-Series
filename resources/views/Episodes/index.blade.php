<x-layout title="Episódios" :mensagem-sucesso="$mensagemSucesso">
    <form method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">                
                    Episódio {{ $episode->number }}
                    @auth
                        <input type="checkbox" name="episodes[]" value="{{ $episode->id }}" @if($episode->watched) checked @endif />
                    @endauth
                </li>    
            @endforeach
        </ul>
        <button type="submit" class="btn btn-primary mt-2 mb-2">Salvar</button>        
    </form>
</x-layout>