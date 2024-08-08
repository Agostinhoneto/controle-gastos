@include('layouts.topo')
@extends('layout')
@include('mensagem', ['mensagem' => $mensagem])
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
                    @include('despesas.create')
                    @include('components.flash-message')
                    <div class="card-body">
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
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
                                        <td>{{Carbon\Carbon::parse( $despesa->data_pagamento)->format('d/m/Y')}}</td>
                                        <td>{{ $despesa->valor}}</td>
                                        <td>
                                            @if($despesa->status == 1)
                                            <p style="color: green">Pago</p>
                                            @else
                                            <p style="color: red">Não Pago</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{$despesa->categoria?->descricao}}
                                        </td>

                                        <td>
                                            <a href="{{route('despesas.edit',$despesa->id)}}" class="btn btn-info btn-sm mr-1" data-toggle="modal" data-target="#editModal">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{route('despesas.destroy',$despesa->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($despesa->descricao) }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Adcionar
                                </button>
                            </table>
                            <div><b>Total de Despesas :</b>
                                <p style="color: green"> {{$total}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('despesas.edit', ['despesas' => $despesa])
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')