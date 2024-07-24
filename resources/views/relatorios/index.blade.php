@include('layouts.topo')
@extends('layout')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-header">
                <h1>Relatório PDF</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">
                        <div class="card card-primary">
                            <form action="{{ route('relatorios.despesas')}}" method="get">
                                <br>
                                <div class="col col-4">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" aria-describedby="">
                                </div>
                                <br>
                                <div class="col col-4">
                                    <label for="categoria">Categoria</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="filter2">Data :</label>
                                    <input type="date" name="filter2">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="filter2">Data :</label>
                                    <input type="date" name="filter2">
                                </div>
                                <br>
                                <button type="submit">Gerar Relatório</button>

                            </form>
                        </div>
                    </ul>
                </div>
            </div>
            <h1 class="card-title">Todas as Despesas</h1>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Data do Pagamento</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($despesas as $despesa)
                        <tr>
                            <td>{{ $despesa->id }}</td>
                            <td>{{ $despesa->descricao }}</td>
                            <td>{{ $despesa->valor }}</td>
                            <td>{{Carbon\Carbon::parse( $despesa->data_pagamento)->format('d/m/Y')}}</td>
                            <td>
                                @if($despesa->status == 1)
                                <p style="color: green">Pago</p>
                                @else
                                <p style="color: red">Não Pago</p>
                                @endif
                            </td>
                            <td>{{ $despesa->descricao }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var tabela = $('#example1').DataTable();

            // Configurar o evento de clique para salvar
            $('#example1 tbody').on('click', 'button.btnSalvar', function() {
                var tr = $(this).closest('tr');
                var id = tr.find('td:first-child').text();
                var coluna1 = tr.find('td:nth-child(2)').text();
                var coluna2 = tr.find('td:nth-child(3)').text();
                // ... obter outras colunas ...

                // Enviar dados para o servidor (Laravel) para salvar
                $.ajax({
                    url: '/categorias/update',
                    type: 'POST',
                    data: {
                        id: id,
                        coluna1: coluna1,
                        coluna2: coluna2,
                        // ... enviar outras colunas ...
                    },
                    success: function(response) {
                        // Atualizar DataTable após salvar
                        tabela.ajax.reload();
                    },
                    error: function(error) {
                        console.error('Erro ao salvar', error);
                    }
                });
            });
        });
    </script>
    </ul>
</div>
</div>
@include('layouts.footer')