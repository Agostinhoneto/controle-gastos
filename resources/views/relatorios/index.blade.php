<head>
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ URL::asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Scripts DataTables -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <!-- Google Font: Source Sans Pro -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.topo')
    @include('layouts.sidebar')
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Relatórios</h3>
                    </div>

                    <form method="GET" action="{{ url('/reports') }}">
                    <div class="mb-3">
                        <label for="created_at">Data Inicial:</label>
                        <input  type="date" name="created_at" id="created_at">
                 
                        <label for="data_pagamento">Data Final:</label>
                        <input type="date" name="data_pagamento" id="data_pagamento">
                    </div>
                        <button type="submit" class="btn btn-success">Filtrar</button>
                    </form>
                    <div class="wrapper">
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
                                    <td>{{Carbon\Carbon::parse( $despesa->data_recebimento)->format('d/m/Y')}}</td>
                                    <td>{{ $despesa->valor}}</td>
                                    <td>
                                        @if($despesa->status == 1)
                                        <p style="color: green">Pago</p>
                                        @else
                                        <p style="color: red">Não Pago</p>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                        </table>
                        <td>{{$total}}</td>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </ul>
    </div>
</div>
@include('layouts.footer')

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>