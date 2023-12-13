<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <title>Admin</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
@extends('layout')

<div class="container mt-5">
    <h2>Editar Despesa</h2>
    <form method="post" action="{{route('despesas.update',$despesas)}}" >
        @csrf
        @method('POST') 

        <!-- Adicione campos para editar as informações do produto -->
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $despesas->descricao }}">
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" class="form-control" id="valor" name="valor" value="{{ $despesas->valor }}">
        </div>
        
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ $despesas->status }}">
        </div>
        
        <div class="form-group">
            <label for="data_pagamento">Data do Pagamento:</label>
            <input type="text" class="form-control" id="data_pagamento" name="data_pagamento" value="{{$despesas->data_pagamento}}">
        </div>

        <!-- Adicione mais campos conforme necessário -->

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<!-- Adicione os scripts do Bootstrap (opcional) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
