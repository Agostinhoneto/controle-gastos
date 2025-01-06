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

    #calendar {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 8px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        padding: 10px;
    }

    .fc-event {
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .fc-event:hover {
        background-color: #007bff !important;
        color: white !important;
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
                                    <!-- Título do Evento -->
                                    <div class="col-md-4 mb-3">
                                        <label for="title" class="form-label">
                                            <i class="fas fa-calendar-alt"></i> Título do Evento
                                        </label>
                                        <input type="text" class="form-control" id="title" name="titulo" required>
                                    </div>
                                    <!-- Data de Início -->
                                    <div class="col-md-4 mb-3">
                                        <label for="start_date" class="form-label">
                                            <i class="fas fa-calendar-day"></i> Data
                                        </label>
                                        <input type="date" class="form-control" id="data_inicio" name="start_date" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="categoria_id">Tipo:</label>
                                        <select name="categoria_id" id="categoria_id" required class="form-control">
                                            <option>Selecione...</option>

                                        </select>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-3">
                                    <i class="fas fa-plus-circle"></i> Adicionar Evento
                                </button>
                            </form>
                        </div>
                    </div>


                    <!-- Calendário -->
                    <div id="calendar" class="bg-white shadow p-3 rounded"></div>
                </div>
                @include('layouts.footer')