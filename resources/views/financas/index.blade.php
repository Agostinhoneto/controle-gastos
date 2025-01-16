@include('layouts.topo')
@extends('layout')

<style>
    .card-header {
        font-weight: bold;
    }

    .saldo-positivo {
        background-color: #28a745 !important;
    }

    .saldo-negativo {
        background-color: #dc3545 !important;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')

    <div class="container my-4">
        <h1>Minhas Finanças</h1>
        <p class="text-muted">Aqui você acompanha suas despesas, receitas e saldo atualizado.</p>
        <hr>

        <h2>{{ ucfirst($mesAtual) }}</h2>

        <div class="row mt-4">
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
                <div class="card text-white {{ $saldoFinal >= 0 ? 'saldo-positivo' : 'saldo-negativo' }} mb-3">
                    <div class="card-header">Saldo Final</div>
                    <div class="card-body">
                        <h5 class="card-title">
                            @if ($saldoFinal >= 0)
                                <i class="fas fa-arrow-up"></i>
                            @else
                                <i class="fas fa-arrow-down"></i>
                            @endif
                            R$ {{ number_format($saldoFinal, 2, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimas Despesas -->
        <div class="row">
            <h2>Últimas Despesas</h2>
            <p class="text-muted">Confira as despesas recentes lançadas.</p>
            <div class="table-responsive">
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
                            <td>{{ \Carbon\Carbon::parse($despesa->data)->format('d/m/Y') }}</td>
                            <td>{{ $despesa->descricao }}</td>
                            <td>{{ $despesa->categoria->nome ?? 'Não categorizado' }}</td>
                            <td>R$ {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('despesas.index') }}" class="btn btn-primary">Ver todas</a>
        </div>

        <!-- Últimas Receitas -->
        <div class="row mt-4">
            <h2>Últimas Receitas</h2>
            <p class="text-muted">Confira as receitas recentes lançadas.</p>
            <div class="table-responsive">
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
                            <td>{{ \Carbon\Carbon::parse($receita->data)->format('d/m/Y') }}</td>
                            <td>{{ $receita->descricao }}</td>
                            <td>{{ $receita->categoria->nome ?? 'Não categorizado' }}</td>
                            <td>R$ {{ number_format($receita->valor, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('receitas.index') }}" class="btn btn-primary">Ver todas</a>
        </div>
    </div>

    @include('layouts.footer')
</div>
