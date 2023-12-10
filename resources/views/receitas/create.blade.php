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

<form action="{{ route('receitas.store')}}" method="post">
    @csrf
    <div class="container" style="margin-top:40px;">
        <div class="row">
            <div class="col col-6">
                <label for="descricao">Descrição da Receita</label>
                <input type="text" id="descricao" class="form-control" name="descricao" required>
            </div>

            <div class="col col-2">
                <label for="valor">Valor</label>
                <input type="number" id="valor" class="form-control" name="valor" required>
            </div>

            <div class="col col-2">
                <label for="data">Data</label>
                <input type="date" id="data_recebimento" class="form-control" name="data_recebimento" required>
            </div>
        </div>
        <button class="btn btn-primary mt-2">Adicionar</button>
    </div>
</form>
@endsection