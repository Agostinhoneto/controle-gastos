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

    <div class="container">
        <div class="card-body">
            <ul class="list-group">
                <div class="table-responsive">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Categorias</h3>
                        </div>
                        <h1>Categoria: {{ $category->name }}</h1>

                        @foreach($progressData as $data)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Meta: R$ {{ number_format($data['goal']->valor_meta, 2) }}</h5>
                                <p>Período: {{ $data['goal']->start_date }} a {{ $data['goal']->end_date }}</p>
                                <p>Gastos até agora: R$ {{ number_format($data['totalExpenses'], 2) }}</p>
                                <p>Progresso: {{ number_format($data['progress'], 2) }}%</p>

                                @if($data['progress'] > 100)
                                <p class="text-danger">{{ $data['status'] }}</p>
                                @else
                                <p class="text-success">{{ $data['status'] }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>
@include('layouts.footer')