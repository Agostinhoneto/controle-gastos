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

                    @include('eventos.create')
                    @include('components.flash-message')

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição do Evento</th>
                                    <th scope="col">Data do inicio</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventos as $evento)
                                <tr>
                                    <th scope="row">{{ $evento->id }}</th>
                                    <td>{{ $evento->titulo }}</td>
                                    <td>{{ Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y') }}</td>
                                    <td>R$ {{ number_format($evento->valor, 2, ',', '.') }}</td>
                                  
                                    <td>
                                        <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('eventos.destroy', $evento->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($evento->descricao) }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>

@include('layouts.footer')