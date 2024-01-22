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
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Relatório PDF</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="card card-primary">
                                <form action="{{ route('relatorios.despesas') }}" method="post">
                                    @csrf
                                    <br>
                                    <div class="col col-6">
                                        <label for="filter1">Descrição:</label>
                                        <input type="text" name="filter1">
                                    </div>
                                    <br>            
                                    <div class="col col-2">
                                        <label for="categoria_id">Categoria:</label>
                                        <select name="categoria_id" id="categoria_id" class="form-control">
                                            <option>Selecione...</option>
                                            @foreach($categorias as $c)
                                            <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>            
                                    <div class="col col-6">
                                        <label for="filter2">Data :</label>
                                        <input type="date" name="filter2">
                                    </div>
                                    
                                    <br>
                                    <button type="submit" class="btn btn-primary">Gerar PDF</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                        </td>
                        <td>

                        </td>
                        <td>
                            <span class="d-flex">
                                <a href="" class="btn btn-info btn-sm mr-1">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </span>
                        </td>
                        <td>
                            <form action="" method="post" onsubmit="return confirm('Tem certeza que deseja remover')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('layouts.footer')