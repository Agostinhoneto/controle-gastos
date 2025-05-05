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
    <div class="container mx-auto p-6">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="card shadow">
                        <div class="flex-1 overflow-auto">
                            <div class="container-fluid py-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h2 class="mb-0">Detalhes da Despesas</h2>
                                    <a href="{{ route('despesas.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Voltar para lista
                                    </a>
                                </div>
                                <div class="card card-details mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">{{ $despesas->descricao }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="text-muted">Valor</h6>
                                                    <p class="fs-5">R$ {{ number_format($despesas->valor, 2, ',', '.') }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="text-muted">Data</h6>
                                                    <p class="fs-5">{{ \Carbon\Carbon::parse($despesas->data_pagamento)->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="text-muted">Status</h6>
                                                    <p class="fs-5">
                                                        <span class="{{ $despesas->status == 'pago' ? 'ativo' : 'inativo' }}">
                                                            {{ ucfirst($despesas->status) }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="text-muted">Categoria</h6>
                                                    <p class="fs-5">{{$despesas->categoria->nome ?? 'Não categorizado' }}</p>
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