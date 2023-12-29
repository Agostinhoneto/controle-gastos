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
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Relatórios</h3>
                    </div>

                    <h1>Relatório PDF</h1>
                    <div class="container">
                        <form action="{{ route('relatorios.despesas') }}" method="post">
                            @csrf
                            <!-- Adicione seus campos de filtro aqui -->
                            <label for="filter1">Descrição:</label>
                            <input type="text" name="filter1">

                            <label for="filter2">Categorias :</label>
                            <input type="text" name="filter2">

                            <label for="filter2">Data :</label>
                            <input type="date" name="filter2">

                            <button type="submit">Gerar PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>

<!-- resources/views/reports/index.blade.php -->