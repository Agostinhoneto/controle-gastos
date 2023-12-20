<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <title>Admin</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
@extends('layout')
@include('mensagem', ['mensagem' => $mensagem])
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
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    @include('receitas.create')
                    <div class="card-body">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Descrição da Receita</th>
                                        <th scope="col">Data do Recebimento</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($receitas as $receita)
                                    <tr>
                                        <th scope="row">{{ $receita->id }}</th>
                                        <td>{{ $receita->descricao }}</td>
                                        <td>{{Carbon\Carbon::parse( $receita->data_recebimento)->format('d/m/Y')}}</td>
                                        <td>{{ $receita->valor}}</td>
                                        <td>
                                            @if($receita->status == 1)
                                            <p style="color: green">Pago</p>
                                            @else
                                            <p style="color: red">Não Pago</p>
                                            @endif
                                        </td>
                                        <td>
                                             {{$receita->categoria->descricao}}
                                        </td>
                                        <td>
                                            <span class="d-flex">
                                                <a href="{{route('receitas.edit',$receita->id)}}" class="btn btn-info btn-sm mr-1">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{route('receitas.destroy',$receita->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($receita->descricao) }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">

                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Adcionar
                                </button>

                            </table>

        </ul>
    </div>
</div>
</div>

<!-- footer-->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
<!-- jQuery -->
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
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
