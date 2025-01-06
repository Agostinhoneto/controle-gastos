<head>
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
</head>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.topo')
    @include('layouts.sidebar')
    
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-header">
                <h3 class="card-title">Relatórios</h3>
            </div>
            <div class="mb-5">
                <form method="GET" action="{{ url('/reports') }}">
                    <div class="form-group">
                        <label for="created_at">Data Inicial:</label>
                        <input type="date" name="created_at" id="created_at" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="data_pagamento">Data Final:</label>
                        <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Filtrar</button>
                </form>
            </div>
            
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
                                    <p style="color: green">Pago</p>
                                @else
                                    <p style="color: red">Não Pago</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                <strong>Total: </strong> R$ {{ number_format($total, 2, ',', '.') }}
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script><script>
    $(function() {
        // Verificar se a tabela já foi inicializada
        if (!$.fn.dataTable.isDataTable('#example1')) {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    });
</script>

