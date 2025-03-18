@include('layouts.topo')
@extends('layout')
<style>
    #status {
        padding: 5px;
        border-radius: 5px;
        text-align: center;
    }

    .ativo {
        background-color: green;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .inativo {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .card-title {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .total-despesas {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card shadow">
                    <a href="{{ route('metas.create') }}" class="btn btn-primary mb-3">Criar Nova Meta</a>

                    @if ($metas->isEmpty())
                    <div class="alert alert-info">
                        Você ainda não tem metas financeiras cadastradas.
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Valor Alvo</th>
                                    <th>Valor Atual</th>
                                    <th>Progresso</th>
                                    <th>Data Limite</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($metas as $meta)
                                <tr>
                                    <td>{{ $meta->titulo }}</td>
                                    <td>R$ {{ number_format($meta->valor_alvo, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($meta->valor_atual, 2, ',', '.') }}</td>
                                    <td>
                                        <div class="progress">
                                            @php
                                            $progresso = ($meta->valor_atual / $meta->valor_alvo) * 100;
                                            @endphp
                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $progresso }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ number_format($progresso, 2) }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $meta->data_limite->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('metas.show', $meta) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('metas.edit', $meta) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('metas.destroy', $meta) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta meta?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </ul>
    </div>
</div>

@include('layouts.footer')