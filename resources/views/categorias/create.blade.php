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

        <form action="{{ route('categorias.store')}}" method="post">
            @csrf
            <div class="container" style="margin-top:40px;">
                <div class="row">
                    <div class="col col-6">
                        <label for="descricao">Descrição de Categorias</label>
                        <input type="text" id="descricao" class="form-control" name="descricao" required>
                    </div>
                </div>
                <button class="btn btn-primary mt-2">Adicionar</button>
            </div>
        </form>
    </div>
</div>