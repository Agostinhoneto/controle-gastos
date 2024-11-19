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
        @section('content')
        <div class="container">
            <h1>Metas Financeiras</h1>
            <a href="{{ route('financial.create') }}" class="btn btn-primary">Nova Meta</a>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Progresso</th>
                        <th>Prazo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($goals as $goal)
                    <tr>
                        <td>{{ $goal->nome }}</td>
                        <td>{{ $goal->valor }} / {{ $goal->valor }}</td>
                        <td>{{ $goal->start_date }} - {{ $goal->end_date }}</td>
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
            </table>
        </div>
        @endsection
        @include('layouts.footer')