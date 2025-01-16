<head>
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
</head>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.topo')
    @include('layouts.sidebar')

    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title">Relatórios</h3>
                <button class="btn btn-sm btn-light" onclick="window.print()">
                    <i class="fas fa-print"></i> Imprimir
                </button>
            </div>
            <div class="card-body">
                <!-- Filtros -->
                <form method="GET" action="{{ url('/reports') }}" class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="created_at" class="form-label">Data Inicial:</label>
                        <input type="date" name="created_at" id="created_at" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="data_pagamento" class="form-label">Data Final:</label>
                        <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" required>
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                    </div>
                </form>

                <!-- Tabela -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Descrição</th>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($despesas as $despesa)
                        <tr>
                            <td>{{ $despesa->id }}</td>
                            <td>{{ $despesa->descricao }}</td>
                            <td>{{ \Carbon\Carbon::parse($despesa->data_recebimento)->format('d/m/Y') }}</td>
                            <td>R$ {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                            <td>
                                @if($despesa->status == 1)
                                <span class="badge bg-success">Pago</span>
                                @else
                                <span class="badge bg-danger">Não Pago</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Total -->
                <div class="mt-3 text-end">
                    <h5><strong>Total:</strong> R$ {{ number_format($total, 2, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script>
    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#example1')) {
            $('#example1').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    });
</script>