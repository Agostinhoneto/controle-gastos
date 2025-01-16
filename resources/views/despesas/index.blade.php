@include('layouts.topo')
@extends('layout')
@include('mensagem', ['mensagem' => $mensagem])

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
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Despesas</h3>
                        <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                        </button>
                    </div>

                    @include('despesas.create')
                    @include('components.flash-message')

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição da Despesa</th>
                                    <th scope="col">Data do Pagamento</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($despesas as $despesa)
                                <tr>
                                    <th scope="row">{{ $despesa->id }}</th>
                                    <td>{{ $despesa->descricao }}</td>
                                    <td>{{ Carbon\Carbon::parse($despesa->data_pagamento)->format('d/m/Y') }}</td>
                                    <td>R$ {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                                    <td>
                                        <span class="{{ $despesa->status == 1 ? 'ativo' : 'inativo' }}">
                                            {{ $despesa->status == 1 ? 'Pago' : 'Não Pago' }}
                                        </span>
                                    </td>
                                    <td>{{ $despesa->categoria?->descricao }}</td>
                                    <td>
                                        <a href="{{ route('despesas.edit', $despesa->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('despesas.destroy', $despesa->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($despesa->descricao) }}?')">
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
                        <div class="mt-3 total-despesas">
                            <span>Total de Despesas:</span>
                            <span class="text-success">R$ {{ number_format($total, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>

@include('layouts.footer')
