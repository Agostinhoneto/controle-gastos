<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <title>Editar Categorias - Admin</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

@extends('layout')

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')

    <div class="flex-1 p-6">
        <div class="bg-white rounded-lg shadow-md p-6 max-w-3xl mx-auto">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Editar Categorias</h2>

            <!-- Displaying errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Erro(s):</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('categorias.update', $categorias) }}" class="space-y-4">
                @csrf
                @method('POST')

                <!-- Description Field -->
                <div>
                    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        value="{{ $categorias->descricao }}" required>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('receitas.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
