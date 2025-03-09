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
        <!-- Alertas de erro -->
        @if ($errors->any())
        <div class="alert alert-danger shadow-sm mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Título -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Editar Usuário</h2>
            <p class="text-sm text-gray-500">Atualize as informações do usuário nos campos abaixo.</p>
        </div>
        <form method="post" action="{{ route('users.update', $users->id) }}" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nome:</label>
                <input type="text" id="name" name="name" value="{{ $users->name }}" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="{{ $users->email }}" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
                <input type="password" id="password" name="password" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Repetir Senha:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-2">
                <label for="exampleSelectBorder">Tipo</label>
                <select class="custom-select form-control-border" id="is_admin" name="is_admin">
                    <option>Selecione</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuário</option>
                </select>
            </div>
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('users.index') }}" class="btn btn-secondary px-4 py-2 text-gray-600 bg-gray-200 hover:bg-gray-300 rounded shadow-sm">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded shadow-sm">
                    Atualizar
                </button>
            </div>
        </form>
    </div>
</div>