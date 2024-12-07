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
    <div class="container">
        <h1>Minhas Finanças</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total de Despesas</div>
                    <div class="card-body">
                        <h5 class="card-title">R$ {{ number_format($totalDespesas, 2, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total de Receitas</div>
                    <div class="card-body">
                        <h5 class="card-title">R$ {{ number_format($totalReceitas, 2, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Saldo Final</div>
                    <div class="card-body">
                        <h5 class="card-title">R$ {{ number_format($saldoFinal, 2, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <h2>Últimas Despesas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($despesasRecentes as $despesa)
                <tr>
                    <td>{{ $despesa->data }}</td>
                    <td>{{ $despesa->descricao }}</td>
                    <td>{{ $despesa->categoria->nome }}</td>
                    <td>R$ {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Últimas Receitas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receitasRecentes as $receita)
                <tr>
                    <td>{{ $receita->data }}</td>
                    <td>{{ $receita->descricao }}</td>
                    <td>{{ $receita->categoria->nome }}</td>
                    <td>R$ {{ number_format($receita->valor, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('layouts.footer')