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
@include('mensagem', ['mensagem' => $mensagem])
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categorias</h3>
                    </div>
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Cabeçalho do Modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Criar Categorias</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Corpo do Modal -->
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- left column -->
                                        <div class="col-md-12">
                                            <!-- general form elements -->
                                            <div class="card card-primary">
                                                <br>
                                                <form class="form" method="POST" action="{{route('categorias.store')}}">
                                                    @csrf
                                                    <div class="col col-8">
                                                        <label for="descricao">Descrição:</label>
                                                        <input type="text" class="form-control" name="descricao" id="descricao" required placeholder="Descrição">
                                                    </div>
                                                    <div class="col col-2">
                                                        <button class="btn btn-primary mt-2">Salvar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Rodapé do Modal -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição da categoria</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categorias as $categoria)
                                <tr>
                                    <th scope="row">{{ $categoria->id }}</th>
                                    <td>{{ $categoria->descricao }}</td>
                                    <td>
                                        <span class="d-flex">
                                            <form action="{{ route('categorias.destroy',$categoria->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($categoria->descricao) }}?')">
                                                <a href="{{route('categorias.edit',$categoria->id)}}" class="btn btn-info btn-sm mr-1">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                    </td>
                                    <td>
                                        <form action="route('categorias.destroy',$categoria->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($categoria->descricao) }}?')">
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
        </ul>
    </div>
</div>
</div>
@include('layouts.footer')