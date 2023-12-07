@extends('layout')

@section('cabecalho')
Receitas
@endsection

@section('conteudo')
@include('mensagem', ['mensagem' => $mensagem])

<a href="{{ route('receitas.create') }}" class="btn btn-dark mb-2">Adicionar</a>

<ul class="list-group">
    @foreach($receitas as $receita)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="nome-serie-{{ $receita->id }}">{{ $receita->descricao }}</span>

        <div class="input-group w-50" hidden id="input-nome-serie-{{ $receita->id }}">
            <input type="text" class="form-control" value="{{ $receita->descricao }}">
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
            <a href="/receita/{{ $receita->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <form method="post" action="/receita/{{ $receita->id }}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($receita->descricao) }}?')">
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

@endsection