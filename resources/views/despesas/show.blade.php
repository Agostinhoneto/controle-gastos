@include('layouts.topo')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <title>Admin</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>@extends('layout')

@section('cabecalho', 'Detalhes da Despesa')

@section('conteudo')
<div class="container mx-auto p-6">
    <div class="card-body">
        <div class="table-responsive">
            <div class="card shadow">
                <div class="flex-1 overflow-auto">
                    <div class="container mx-auto p-6">
                        <div class="card shadow-lg rounded-lg">
                            <div class="card-body p-6">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                                    <h2 class="text-2xl font-bold text-gray-800">Detalhes da Despesa</h2>
                                    <a href="{{ route('despesas.index') }}" class="btn btn-outline-secondary mt-4 md:mt-0">
                                        <i class="fas fa-arrow-left mr-2"></i>Voltar para lista
                                    </a>
                                </div>

                                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                                    <div class="bg-blue-600 px-6 py-4 text-white">
                                        <h3 class="text-xl font-semibold">{{ $despesas->descricao }}</h3>
                                    </div>

                                    <div class="p-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <div class="mb-4">
                                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Valor</h4>
                                                    <p class="mt-1 text-lg font-semibold text-gray-900">
                                                        R$ {{ number_format($despesas->valor, 2, ',', '.') }}
                                                    </p>
                                                </div>

                                                <div class="mb-4">
                                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Data</h4>
                                                    <p class="mt-1 text-lg font-semibold text-gray-900">
                                                        {{ \Carbon\Carbon::parse($despesas->data_pagamento)->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="mb-4">
                                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Status</h4>
                                                    <p class="mt-1">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                        {{ $despesas->status == 'pago' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ ucfirst($despesas->status) }}
                                                        </span>
                                                    </p>
                                                </div>

                                                <div class="mb-4">
                                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Categoria</h4>
                                                    <p class="mt-1 text-lg font-semibold text-gray-900">
                                                        {{ $despesas->categoria->nome ?? 'Não categorizado' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</div>
