@extends('layout')

@section('cabecalho')
Adicionar Despesas
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

<form class="form" method="POST" action="{{ route('despesas.store') }}">
    @csrf
    <div class="container" style="margin-top:40px;">
        <div class="row">
            <div class="col col-8">
                <label for="descricao">Descrição Despesas</label>
                <input type="text" class="form-control" name="descricao" id="descricao" required>
            </div>

            <div class="col col-2">
                <label for="valor">Valor</label>
                <input type="number" class="form-control" name="valor" id="valor" required>
            </div>

            <div class="col col-2">
                <label for="data_pagamento">Data do Pagamento</label>
                <input type="date" class="form-control" name="data_pagamento" id="data_pagamento" required>
            </div>
            <br>
            <button class="btn btn-primary mt-2">Adicionar</button>
        </div>
    </div>
</form>
@endsection