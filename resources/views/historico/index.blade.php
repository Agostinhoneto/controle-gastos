@include('layouts.topo')
@extends('layout')
<style>
    .card-header {
        font-weight: bold;
        background-color: #f8f9fa;
    }

    .saldo-positivo {
        color: #28a745;
        font-weight: bold;
    }

    .saldo-negativo {
        color: #dc3545;
        font-weight: bold;
    }

    .receita-badge {
        background-color: #28a745;
    }

    .despesa-badge {
        background-color: #dc3545;
    }

    .filter-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .summary-card {
        border-left: 4px solid;
        border-radius: 8px;
    }

    .summary-receita {
        border-left-color: #28a745;
    }

    .summary-despesa {
        border-left-color: #dc3545;
    }

    .summary-saldo {
        border-left-color: #007bff;
    }

    .chart-container {
        height: 300px;
        margin-bottom: 30px;
    }

    .saldo-positivo {
        color: #28a745;
        /* Verde */
        font-weight: bold;
    }

    .saldo-negativo {
        color: #dc3545;
        /* Vermelho */
        font-weight: bold;
    }
</style>
<div class="d-flex flex-column flex-md-row flex-fill">
    @include('layouts.sidebar')

    <div class="container-fluid py-4">
        <!-- Cabeçalho -->
        <header class="row mb-4">
            <div class="col-md-12">
                <h1 class="display-5 fw-bold">Histórico Financeiro</h1>
                <p class="text-muted">Controle completo de suas finanças pessoais</p>
            </div>
        </header>

        <!-- Resumo Financeiro -->
        <section class="row mb-4">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card summary-card summary-receita h-100">
                    <div class="card-body">
                        <h5 class="card-title">Receitas</h5>
                        <h2 class="saldo-positivo">R$ {{ number_format($totalReceitas, 2, ',', '.') }}</h2>
                        <p class="text-muted mb-0">Últimos 30 dias</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card summary-card summary-despesa h-100">
                    <div class="card-body">
                        <h5 class="card-title">Despesas</h5>
                        <h2 class="saldo-negativo">
                            R$ {{ number_format($totalDespesas, 2, ',', '.') }}
                        </h2>
                        <p class="text-muted mb-0">Últimos 30 dias</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card summary-card summary-saldo h-100">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Atual</h5>
                        <h2 class="{{ $total >= 0 ? 'saldo-positivo' : 'saldo-negativo' }}">
                            R$ {{ number_format($total, 2, ',', '.') }}
                        </h2>
                        <p class="text-muted mb-0">Disponível</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filtros -->
        <section class="row mb-4">
            <div class="col-md-12">
                <div class="card filter-card">
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-3">
                                <label for="periodo" class="form-label">Período</label>
                                <select id="periodo" class="form-select">
                                    <option>Últimos 7 dias</option>
                                    <option selected>Últimos 30 dias</option>
                                    <option>Este mês</option>
                                    <option>Mês passado</option>
                                    <option>Personalizado</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select id="tipo" class="form-select">
                                    <option selected>Todos</option>
                                    <option>Receitas</option>
                                    <option>Despesas</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select id="categoria" class="form-select">
                                    <option selected>Todas</option>
                                    <option>Salário</option>
                                    <option>Alimentação</option>
                                    <option>Moradia</option>
                                    <option>Transporte</option>
                                    <option>Lazer</option>
                                </select>
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Filtrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Adicione no cabeçalho -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Substitua a seção de gráficos por: -->
        <section class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Receitas vs Despesas</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="receitasDespesasChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Distribuição por Categoria</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="categoriasChart"></canvas>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gráfico Receitas vs Despesas
                const ctx1 = document.getElementById('receitasDespesasChart').getContext('2d');
                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                        datasets: [{
                                label: 'Receitas',
                                data: [12000, 19000, 15000, 18000, 14000, 16000],
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Despesas',
                                data: [8000, 11000, 9000, 10000, 12000, 9500],
                                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Gráfico de Categorias
                const ctx2 = document.getElementById('categoriasChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels: ['Alimentação', 'Moradia', 'Transporte', 'Lazer', 'Saúde', 'Outros'],
                        datasets: [{
                            data: [35, 25, 15, 10, 10, 5],
                            backgroundColor: [
                                '#FF6384',
                                '#36A2EB',
                                '#FFCE56',
                                '#4BC0C0',
                                '#9966FF',
                                '#FF9F40'
                            ]
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            });
        </script>

        <!-- Tabela de Histórico -->
        <section class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Histórico de Transações</h5>
                        <button class="btn btn-sm btn-success">
                            <i class="fas fa-plus me-2"></i>Nova Transação
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>Data</th>
                                        <th>Tipo</th>
                                        <th>Descrição</th>
                                        <th>Categoria</th>
                                        <th>Valor</th>
                                        <th>Comprovante</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($receitas as $receita)
                                    <tr>
                                        <td>{{ date('d/m/Y', strtotime($receita->data_recebimento)) }}</td>
                                        <td><span class="badge receita-badge">Receita</span></td>
                                        <td>{{ $receita->descricao }}</td>
                                        <td>{{ $receita->categoria->descricao ?? 'Sem categoria' }}</td>
                                        <td class="saldo-positivo">R$ {{ number_format($receita->valor, 2, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" title="Visualizar comprovante">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-primary me-2" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Nenhuma receita registrada</td>
                                    </tr>
                                    @endforelse

                                    @forelse($despesas as $despesa)
                                    <tr>
                                        <td>{{ date('d/m/Y', strtotime($despesa->data_pagamento)) }}</td>
                                        <td><span class="badge despesa-badge">Despesa</span></td>
                                        <td>{{ $despesa->descricao }}</td>
                                        <td>{{ $despesa->categoria->descricao ?? 'Sem categoria' }}</td>
                                        <td class="saldo-negativo">R$ {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" title="Visualizar comprovante">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-primary me-2" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" title="Excluir">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Nenhuma despesa registrada</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <nav aria-label="Navegação de páginas" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Próxima">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>