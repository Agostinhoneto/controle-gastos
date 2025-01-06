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
                    <!-- Modal para Criar Categorias -->
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Cabeçalho do Modal -->
                                <div class="modal-header bg-primary text-white">
                                    <h4 class="modal-title">Criar Categoria</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Corpo do Modal -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('categorias.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="descricao" class="form-label">Descrição da Categoria</label>
                                            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Digite a descrição" required>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Rodapé do Modal -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabela de Categorias -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição</th>
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
                                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-pencil-alt"></i> Editar
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($categoria->descricao) }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="far fa-trash-alt"></i> Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus"></i> Adicionar Categoria
                        </button>
                    </div>

        </ul>
    </div>
</div>
</div>
@include('layouts.footer')