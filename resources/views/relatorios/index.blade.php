@include('layouts.topo')
@extends('layout')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-header">
                <h1 class="card-title">Relatório PDF</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">
                        <div class="card card-primary">
                            <form action="{{ route('relatorios.despesas')}}" method="post">
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
                            </form>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Coluna 1</th>
                            <th>Coluna 2</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btnSalvar" data-id="">Salvar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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