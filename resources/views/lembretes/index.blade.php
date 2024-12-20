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
                        <h3 class="card-title">Adicionar Lembrete</h3>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Data do Lembrete</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reminders as $reminder)
                            <tr>
                                <td>{{ $reminder->id }}</td>
                                <td>{{ $reminder->title }}</td>
                                <td>{{ $reminder->reminder_date->format('d/m/Y H:i') }}</td>
                                <td>{{ $reminder->description }}</td>
                                <td>
                                    <a href="{{ route('reminders.edit', $reminder->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir este lembrete?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum lembrete encontrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>