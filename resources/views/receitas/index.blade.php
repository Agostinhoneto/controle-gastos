@extends('layout')

@section('cabecalho')
    Receitas
@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])

    <form action="" method="post">
        @csrf
        <ul class="list-group">
             <li class="list-group-item d-flex justify-content-between">
                Despesas 
                <input type="checkbox" >
            </li>
        </ul>

        <button class="btn btn-primary mt-2">Salvar</button>
    </form>
@endsection