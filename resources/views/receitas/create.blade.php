@extends('layout')

@section('cabecalho')
    Adicionar Receitas
@endsection

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action ="{{ route('receitas.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col col-6">
            <label for="descricao">Descrição da Receita</label>
            <input type="text" class="form-control" name="descricao" id="descricao">
        </div>

        <div class="col col-2">
            <label for="valor">Valor</label>
            <input type="number" class="form-control" name="valor" id="valor">
        </div>

        <div class="col col-2">
            <label for="data">Data</label>
            <input type="date" class="form-control" name="data_recebimento" id="data_recebimento">
        </div>

    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection