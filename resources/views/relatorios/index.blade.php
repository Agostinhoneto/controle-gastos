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
                        <h1 class="card-title">Relatório PDF</h1>
                    </div>
                    <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">              
                        <form action="{{ route('relatorios.despesas') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="filter1">Descrição:</label>
                                <input type="text" name="filter1">
                            </div>
                            <div class="form-group">
                                <label for="filter2">Categorias :</label>
                                <input type="text" name="filter2">
                            </div>
                            <div class="form-group">
                                <label for="filter2">Data :</label>
                                <input type="date" name="filter2">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Gerar PDF</button>
                        </form>
                    </div>
                </div>
            </div>
                </div>
            </div>
        
        </ul>
    </div>
</div>

<!-- resources/views/reports/index.blade.php -->