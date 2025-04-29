@include('layouts.topo')
@include('mensagem', ['mensagem' => $mensagem])
<style>
    #status {
        padding: 5px;
        border-radius: 5px;
        text-align: center;
    }

    .ativo {
        background-color: green;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .inativo {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .card-title {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .total-receitas {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <div class="table-responsive">
            <div class="card shadow">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Despesas</h3>
                    <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                    </button>
                </div>
                @include('despesas.create')
                @include('components.flash-message')
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filtros de Busca</h3>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('despesas.index') }}" class="row g-3">
                                <div class="col-md-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da despesa">
                                </div>
                                <div class="col-md-3">
                                    <label for="data_pagamento" class="form-label">Data Pagamento</label>
                                    <input type="date" class="form-control" id="data_pagamento" name="data_pagamento">
                                </div>
                                <div class="col-md-3">
                                    <label for="valor" class="form-label">Valor</label>
                                    <input type="number" step="0.01" class="form-control" id="valor" name="valor" placeholder="Valor da despesa">
                                </div>
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">Selecione</option>
                                        <option value="1">Pago</option>
                                        <option value="0">Não Pago</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body">
                            <table id="despesas" class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Descrição da Despesa</th>
                                        <th scope="col">Data do Pagamento</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Data de Cadastro</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($despesas as $despesa)
                                    <tr>
                                        <th scope="row">{{ $despesa->id }}</th>
                                        <td>{{ $despesa->descricao }}</td>
                                        <td>{{ Carbon\Carbon::parse($despesa->data_pagamento)->format('d/m/Y') }}</td>
                                        <td>R$ {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                                        <td>
                                            <span class="{{ $despesa->status == 1 ? 'ativo' : 'inativo' }}">
                                                {{ $despesa->status == 1 ? 'Pago' : 'Não Pago' }}
                                            </span>
                                        </td>
                                        <td>{{ $despesa->categoria?->descricao }}</td>
                                        <td>{{ Carbon\Carbon::parse($despesa->created_at)->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('despesas.edit', $despesa->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('despesas.destroy', $despesa->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($despesa->descricao) }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3 total-despesas">
                                <span>Total de Despesas:</span>
                                <span class="text-success">R$ {{ number_format($total, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                </ul>
            </div>
        </div>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JS (apenas o básico) -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <!-- Script de Inicialização Simplificado -->
        <script>
            $(document).ready(function() {
                $('#despesas').DataTable({
                    responsive: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                    },
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    pageLength: 10
                });
            });
        </script>
        @include('layouts.footer')