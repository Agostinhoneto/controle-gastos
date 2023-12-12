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
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Despesas</h3>
                    </div>
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Cabeçalho do Modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Criar Despesas</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Corpo do Modal -->
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- left column -->
                                        <div class="col-md-12">
                                            <!-- general form elements -->
                                            <div class="card card-primary">
                                                <br>
                                                <form class="form" method="POST" action="{{ route('despesas.store') }}">
                                                    @csrf
                                                    <div class="col col-8">
                                                        <label for="descricao">Descrição:</label>
                                                        <input type="text" class="form-control" name="descricao" id="descricao" required placeholder="Descrição">
                                                    </div>
                                                    <br>
                                                    <div class="col col-4">
                                                        <label for="valor">Valor</label>
                                                        <input type="number" class="form-control" name="valor" id="valor" required placeholder="Valor $$">
                                                    </div>
                                                    <br>
                                                    <div class="col col-4">
                                                        <label for="data_pagamento">Data do Pagamento</label>
                                                        <input type="date" class="form-control" name="data_pagamento" id="data_pagamento" required placeholder="Data">
                                                    </div>
                                                    <br>
                                                    <div class="col col-2">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="status" class="form-check-input" id="exampleCheck1">
                                                            <label class="form-check-label" for="exampleCheck1">Status</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="status" name="status">
                                                        <label class="form-check-label" for="status">Ativo</label>
                                                    </div>
                                                    <br>
                                                    <div class="col col-2">
                                                        <button class="btn btn-primary mt-2">Salvar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Rodapé do Modal -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <!-- Adicione outros botões conforme necessário -->
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição da Despesa</th>
                                    <th scope="col">Data do Pagamento</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($despesas as $despesa)
                                <tr>
                                    <th scope="row">{{ $despesa->id }}</th>
                                    <td>{{ $despesa->descricao }}</td>
                                    <td>{{Carbon\Carbon::parse( $despesa->data_pagamento)->format('d/m/Y')}}</td>
                                    <td>{{ $despesa->valor}}</td>
                                    <td>
                                        <p style="color: green">{{$despesa->status ? 'Ativo' : 'Inativo' }}</p>
                                    </td>
                                    <td>
                                        <span class="d-flex">
                                            <a href="/despesa/{{ $despesa->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                    </td>
                                    <td>
                                        <form method="post" action="/despesa/{{ $despesa->id }}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($despesa->descricao) }}?')">
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
                                <i class="fa-solid fa-file-lines">
                                    Add
                                </i>
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