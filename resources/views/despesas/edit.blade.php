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
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="container mt-5">
        <h2>Editar Despesa</h2>
        <form method="post" action="{{route('despesas.update',$despesas)}}">
            @csrf
            @method('POST')
            <div class="col col-6">
                <label for="descricao">Descrição:</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $despesas->descricao }}">
            </div>
            <div class="col col-4">
                <label for="valor">Valor:</label>
                <input type="text" class="form-control" id="valor" name="valor" value="{{ $despesas->valor }}">
            </div>
            <div class="col col-4{{ $errors->has('active') ? ' has-error' : '' }}">
                <label for="status">Status:</label>
                <select class="form-control" name="status" id="status">
                    <option value="1" @if (old('active')==1) selected @endif>Ativo</option>
                    <option value="0" @if (old('active')==0) selected @endif>Inativo</option>
                </select>
            </div>
            <br>
            <div class="col col-4">
                <label for="data_pagamento">Data do Pagamento:</label>
                <input type="date" class="form-control" id="data_pagamento" name="data_pagamento" value="{{$despesas->data_pagamento}}">
            </div>
            <br> 
            <div class="col col-4">
                <label for="categoria_id">Categoria:</label>
                <select name="categoria_id" id="categoria_id" required class="form-control" required>
                    <option>Selecione...</option>
                    @foreach($categorias as $c)
                    <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <a href="{{ route('despesas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>