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
<div class="container-fluid">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
        @include('layouts.sidebar')
        <div class="container" style="margin-top:40px;">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Main content -->
            <section class="content">
                <div class="container" style="margin-top:0px;">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Criar uma Receita</h3>
                                </div>
                                <br>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form class="form" method="POST" action="{{ route('despesas.store') }}">
                                    @csrf
                                    <div class="col col-8">
                                        <label for="descricao">Descrição:</label>
                                        <input type="text" class="form-control" name="descricao" id="descricao" required placeholder="Descrição">
                                    </div>
                                    <br>
                                    <div class="col col-2">
                                        <label for="valor">Valor</label>
                                        <input type="number" class="form-control" name="valor" id="valor" required placeholder="Valor $$">
                                    </div>
                                    <br>
                                    <div class="col col-2">
                                        <label for="data_pagamento">Data do Pagamento</label>
                                        <input type="date" class="form-control" name="data_pagamento" id="data_pagamento" required placeholder="Data">
                                    </div>
                                    <br>
                                    <div class="col col-2">
                                        <div class="form-check">
                                            <input type="checkbox" name="status" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Status</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col col-2">
                                        <button class="btn btn-primary mt-2">Adicionar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>