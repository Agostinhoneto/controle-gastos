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
</style>
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="display-5 fw-bold">Histórico Financeiro</h1>
                <p class="text-muted">Controle completo de suas finanças pessoais</p>
            </div>
        </div>

        <!-- Cards Resumo -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card summary-card summary-receita h-100">
                    <div class="card-body">
                        <h5 class="card-title">Receitas</h5>
                        <h2 class="saldo-positivo">R$ 8.450,00</h2>
                        <p class="text-muted mb-0">Últimos 30 dias</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card summary-card summary-despesa h-100">
                    <div class="card-body">
                        <h5 class="card-title">Despesas</h5>
                        <h2 class="saldo-negativo">R$ 5.230,00</h2>
                        <p class="text-muted mb-0">Últimos 30 dias</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card summary-card summary-saldo h-100">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Atual</h5>
                        <h2 class="saldo-positivo">R$ 3.220,00</h2>
                        <p class="text-muted mb-0">Disponível</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="filter-card">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Período</label>
                            <select class="form-select">
                                <option>Últimos 7 dias</option>
                                <option selected>Últimos 30 dias</option>
                                <option>Este mês</option>
                                <option>Mês passado</option>
                                <option>Personalizado</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tipo</label>
                            <select class="form-select">
                                <option selected>Todos</option>
                                <option>Receitas</option>
                                <option>Despesas</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Categoria</label>
                            <select class="form-select">
                                <option selected>Todas</option>
                                <option>Salário</option>
                                <option>Alimentação</option>
                                <option>Moradia</option>
                                <option>Transporte</option>
                                <option>Lazer</option>
                            </select>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary w-100">
                                <i class="fas fa-filter me-2"></i>Filtrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Receitas vs Despesas</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <!-- Espaço para gráfico de barras -->
                            <img src="https://via.placeholder.com/600x300?text=Gráfico+Receitas+vs+Despesas" alt="Gráfico" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Distribuição por Categoria</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <!-- Espaço para gráfico de pizza -->
                            <img src="https://via.placeholder.com/600x300?text=Gráfico+Por+Categorias" alt="Gráfico" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Histórico -->
        <div class="row">
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
                            <table class="table table-hover">
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
                                    <!-- Exemplo de linha de receita -->
                                    <tr>
                                        <td>15/05/2023</td>
                                        <td><span class="badge receita-badge">Receita</span></td>
                                        <td>Salário Mensal</td>
                                        <td>Salário</td>
                                        <td class="saldo-positivo">R$ 4.500,00</td>
                                        <td>
                                            <button class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Exemplo de linha de despesa -->
                                    <tr>
                                        <td>10/05/2023</td>
                                        <td><span class="badge despesa-badge">Despesa</span></td>
                                        <td>Supermercado</td>
                                        <td>Alimentação</td>
                                        <td class="saldo-negativo">R$ 850,00</td>
                                        <td>
                                            <button class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Mais linhas de exemplo -->
                                    <tr>
                                        <td>05/05/2023</td>
                                        <td><span class="badge receita-badge">Receita</span></td>
                                        <td>Freelance</td>
                                        <td>Trabalho Extra</td>
                                        <td class="saldo-positivo">R$ 1.200,00</td>
                                        <td>
                                            <button class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>01/05/2023</td>
                                        <td><span class="badge despesa-badge">Despesa</span></td>
                                        <td>Aluguel</td>
                                        <td>Moradia</td>
                                        <td class="saldo-negativo">R$ 1.800,00</td>
                                        <td>
                                            <button class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginação -->
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Próxima</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>