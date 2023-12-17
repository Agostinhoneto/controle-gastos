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
    <div class="container" style="margin-top:40px;">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="container mt-5">
            <h2>Editar Receitas</h2>
            <form method="post" action="{{route('receitas.update',$receitas)}}">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $receitas->descricao }}">
                </div>
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <input type="text" class="form-control" id="valor" name="valor" value="{{ $receitas->valor }}">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ $receitas->status }}">
                </div>
                <div class="form-group">
                    <label for="data_recebimento">Data do Pagamento:</label>
                    <input type="text" class="form-control" id="data_recebimento" name="data_recebimento" value="{{$receitas->data_recebimento}}">
                </div>
                <br>
                <div class="col col-6">
                    <label for="categoria_id">Categoria:</label>
                    <select name="categoria_id" id="categoria_id" class="form-control">
                        <option>Selecione...</option>
                        @foreach($categorias as $c)
                        <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>

    </div>
</div>