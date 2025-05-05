@include('layouts.topo')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <div class="table-responsive">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Receitas</h3>
                    <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="flex-1 overflow-auto">
                    <div class="container-fluid py-4">
                        <!-- Cabeçalho -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-0">Detalhes da Receita</h2>
                            <a href="{{ route('receitas.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Voltar para lista
                            </a>
                        </div>

                        <!-- Card de detalhes -->
                        <div class="card card-details mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">{{ $receitas->nome }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Coluna 1 -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6 class="text-muted">Valor</h6>
                                            <p class="fs-5">R$ {{ number_format($receitas->valor, 2, ',', '.') }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-muted">Data</h6>
                                            <p class="fs-5">{{ \Carbon\Carbon::parse($receitas->data)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>

                                    <!-- Coluna 2 -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6 class="text-muted">Status</h6>
                                            <p class="fs-5">
                                                <span class="{{ $receitas->status == 'ativo' ? 'ativo' : 'inativo' }}">
                                                    {{ ucfirst($receitas->status) }}
                                                </span>
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-muted">Categoria</h6>
                                            <p class="fs-5">{{ $receitas->categoria->nome ?? 'Não categorizado' }}</p>
                                        </div>
                                    </div>

                                    <!-- Descrição completa -->
                                    <div class="col-12 mt-3">
                                        <div class="border-top pt-3">
                                            <h6 class="text-muted">Descrição</h6>
                                            <p class="fs-5">{{ $receitas->descricao ?? 'Nenhuma descrição fornecida' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="fas fa-edit me-2"></i>Editar
                                    </button>

                                    <form action="{{ route('receitas.destroy', $receitas->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta receita?')">
                                            <i class="fas fa-trash me-2"></i>Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scripts -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            </body>

            </html>