<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">

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
<link href="{{ URL::asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Scripts DataTables -->
<script src="{{ URL::asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('assets/datatables/datatables-demo.js') }}"></script>
<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
        @include('layouts.sidebar')
        <div class="card shadow mb-4">
            <div class="card-body">
                <ul class="list-group">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição da Receita</th>
                                    <th scope="col">Data do Recebimento</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Açoes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($receitas as $receita)
                                <tr>
                                    <th scope="row">{{ $receita->id }}</th>
                                    <td>{{ $receita->descricao }}</td>
                                    <td>{{ $receita->data_recebimento }}</td>
                                    <td>{{ $receita->valor}}</td>
                                    <td>
                                        <span class="d-flex">
                                            <a href="/receita/{{ $receita->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <form method="post" action="/receita/{{ $receita->id }}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($receita->descricao) }}?')">
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
                        </table>
                        <a href="{{ route('receitas.create') }}" class="btn btn-dark mb-2">Adicionar</a>
                </ul>
            </div>
        </div>


</body>