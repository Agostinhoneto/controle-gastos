@include('layouts.topo')
@extends('layout')
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
                        <h3 class="card-title">Eventos Financeiros</h3>
                    </div>

                    <!-- Formulário para Criar Evento -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('calendario.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="title" class="form-label">Título do Evento</label>
                                        <input type="text" class="form-control" id="title" name="titulo" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="start_date" class="form-label">Data</label>
                                        <input type="date" class="form-control" id="data_inicio" name="start_date" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="type" class="form-label">Tipo</label>
                                        <select class="form-select" id="type" name="tipo" required>
                                            <option value="receita">Receita</option>
                                            <option value="despesa">Despesa</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Adicionar Evento</button>
                            </form>
                        </div>
                    </div>

                    <!-- Calendário -->
                    <div id="calendar" class="bg-white shadow p-3 rounded"></div>
                </div>
                @include('layouts.footer')