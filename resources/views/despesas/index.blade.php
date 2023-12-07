@extends('layout')

@section('cabecalho')
Despesas
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<a href="{{ route('despesas.create') }}" class="btn btn-dark mb-2">Adicionar</a>
<ul class="list-group">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição da despesa</th>
                <th scope="col">Data do Pagamento</th>
                <th scope="col">Valor</th>
                <th scope="col">Açoes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($despesas as $despesa)

            <tr>
                <th scope="row">{{ $despesa->id }}</th>
                <td>{{ $despesa->descricao }}</td>
                <td>{{ $despesa->data_pagamento }}</td>
                <td>{{ $despesa->valor}}</td>

                <td>
                    <span class="d-flex">
                        <a href="/despesa/{{ $despesa->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                            <i class="fas fa-external-link-alt"></i>
                        </a>

                        <a href="/despesa/{{ $despesa->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <form method="post" action="/despesa/{{ $despesa->id }}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($despesa->descricao) }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </span>
                </td>
            </tr>
            @endforeach
            <tr>
                <td>
                    <p>Total das Despesas :</p>{{$totalValor}}
                </td>
            </tr>

        </tbody>
    </table>
</ul>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
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