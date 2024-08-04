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
                        <h3 class="card-title">Usuários</h3>
                    </div>
                    @include('users.create')
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
                                    @foreach($users as $user)
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{Carbon\Carbon::parse( $user->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                        @if($user->status == 1)
                                        <p style="color: green">Pago</p>
                                        @else
                                        <p style="color: red">Não Pago</p>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-flex">
                                           
                                        </span>
                                    </td>
                                    <td>
                                        <form action="" method="post" onsubmit="return confirm('Tem certeza que deseja remover ?')">
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
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')