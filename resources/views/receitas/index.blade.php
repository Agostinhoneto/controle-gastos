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
                        <h3 class="card-title">Receitas</h3>
                    </div>
                    @include('receitas.create')
                    @include('components.flash-message')
                    <div class="card-body">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Descrição da Receita</th>
                                        <th scope="col">Data do Recebimento</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Excluir</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($receitas as $receita)
                                    <td>{{ $receita->id }}</td>
                                    <td>{{ $receita->descricao }}</td>
                                    <td>{{Carbon\Carbon::parse( $receita->data_recebimento)->format('d/m/Y')}}</td>
                                    <td>{{ $receita->valor}}</td>
                                    <td>
                                        @if($receita->status == 1)
                                        <p style="color: green">Pago</p>
                                        @else
                                        <p style="color: red">Não Pago</p>
                                        @endif
                                    </td>
                                    <td>
                                        {{$receita->categoria?->descricao}}
                                    </td>
                                    <td>
                                        <span class="d-flex">
                                            <a href="{{route('receitas.edit',$receita->id)}}" class="btn btn-info btn-sm mr-1">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{route('receitas.destroy',$receita->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($receita->descricao) }}?')">
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

                            <div>
                                <b>Total de Receitas :</b>
                                <p style="color: green"> {{$total}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</div>
