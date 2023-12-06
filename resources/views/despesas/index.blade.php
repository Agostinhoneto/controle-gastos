@extends('layout')

@section('cabecalho')
    Despesas
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<a href="{{ route('criar_despesas') }}" class="btn btn-dark mb-2">Adicionar</a>

<ul class="list-group">
    @foreach($despesas as $despesa)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="nome-serie-{{ $despesa->id }}">{{ $despesa->descricao }}</span>

        <div class="input-group w-50" hidden id="input-nome-serie-{{ $despesa->id }}">
            <input type="text" class="form-control" value="{{ $despesa->descricao }}">
            <div class="input-group-append">
                <button class="btn btn-primary">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>

        <span class="d-flex">
            <button class="btn btn-info btn-sm mr-1">
                <i class="fas fa-edit"></i>
            </button>
            <a href="/despesa/{{ $despesa->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <form method="post" action="/despesa/{{ $despesa->id }}"
                  onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($despesa->descricao) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
        </span>
    </li>
    @endforeach
</ul>

<script>
    /*
    function toggleInput(serieId) {
        const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
        const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
        if (nomeSerieEl.hasAttribute('hidden')) {
            nomeSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
            inputSerieEl.removeAttribute('hidden');
            nomeSerieEl.hidden = true;
        }
    }

    function editarSerie(serieId) {
        let formData = new FormData();
        const nome = document
            .querySelector(`#input-nome-serie-${serieId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('descricao', descricao);
        formData.append('_token', token);
        const url = `/series/${serieId}/editaNome`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = nome;
        });
    }
    */
</script>
@endsection