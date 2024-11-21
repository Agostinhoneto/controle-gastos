@include('layouts.topo')
@extends('layout')
<style>
    #status {
        padding: 5px;
    }

    .ativo {
        background-color: green;
        color: white;
    }

    .inativo {
        background-color: red;
        color: white;
    }
</style>
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Despesas</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <h1>Metas Financeiras</h1>
                            @include('financial.create')
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Progresso</th>
                                        <th>Data Inicio</th>
                                        <th>Data Fim</th>

                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($goals as $goal)
                                    <tr>
                                        <td>{{ $goal->nome }}</td>
                                        <td>{{ $goal->valor }} / {{ $goal->target_amount }}</td>
                                        <td>{{ $goal->start_date }}</td>
                                        <td>{{ $goal->end_date }}</td>

                                        <td>
                                            <a href="{{ route('financial.show', $goal) }}" class="btn btn-info btn-sm">Ver</a>
                                            <form action="{{ route('financial.destroy', $goal) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Adcionar
                                </button>
                            </table>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')