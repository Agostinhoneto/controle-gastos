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
<body> 
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
        @include('layouts.sidebar')
        <ul class="list-group">
        <a href="{{ route('despesas.create') }}" class="btn btn-dark mb-2">Adicionar</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição da despesa</th>
                        <th scope="col">Data do Pagamento</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Açoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($despesas as $despesa)

                    <tr>
                        <th scope="row">{{ $despesa->id }}</th>
                        <td>{{ $despesa->descricao }}</td>
                        <td>{{ $despesa->data_pagamento }}</td>
                        <td>{{ $despesa->valor}}</td>
                        <td>
                            <span class="d-flex">
                                <a href="/despesa/{{ $despesa->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>

                                <a href="/despesa/{{ $despesa->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <form method="post" action="/despesa/{{ $despesa->id }}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($despesa->descricao) }}?')">
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
                    <tr>
                        <td>
                            <p>Total das Despesas :</p>{{$totalValor}}
                        </td>
                    </tr>

                </tbody>
            </table>
    </div>
</body>
</ul>