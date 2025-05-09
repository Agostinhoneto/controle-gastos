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
        <!-- Título -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Editar Receita</h2>
            <p class="text-sm text-gray-500">Atualize os dados da receita nos campos abaixo.</p>
        </div>

        <!-- Formulário -->
        <form method="post" action="{{ route('receitas.update', $receitas->id) }}" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('POST')

            <!-- Descrição -->
            <div class="mb-4">
                <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição:</label>
                <input type="text" id="descricao" name="descricao" value="{{ $receitas->descricao ?? 'Não encontrada' }}" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Valor -->
            <div class="mb-4">
                <label for="valor" class="block text-sm font-medium text-gray-700">Valor:</label>
                <input type="text" id="valor" name="valor" value="{{ $receitas->valor }}" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                <select id="status" name="status" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="1" @if (old('active', $receitas->status) == 1) selected @endif>Ativo</option>
                    <option value="0" @if (old('active', $receitas->status) == 0) selected @endif>Inativo</option>
                </select>
            </div>

            <!-- Data do Pagamento -->
            <div class="mb-4">
                <label for="data_recebimento" class="block text-sm font-medium text-gray-700">Data do Pagamento:</label>
                <input type="date" id="data_recebimento" name="data_recebimento" value="{{ $receitas->data_recebimento }}" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Categoria -->
            <div class="mb-4">
                <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoria:</label>
                <select id="categoria_id" name="categoria_id" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="" disabled selected>Selecione...</option>
                    @foreach ($categorias as $c)
                        <option value="{{ $c->id }}" @if ($c->id == $receitas->categoria_id) selected @endif>
                            {{ $c->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botões -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('receitas.index') }}" class="btn btn-secondary px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded shadow-sm">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded shadow-sm">
                    Atualizar
                </button>
            </div>
        </form>
    </div>
</div>
