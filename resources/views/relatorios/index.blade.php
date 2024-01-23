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
                                <div class="col col-6">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="col col-6">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Relatório PDF</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="card card-primary">
                    <form action="{{ route('relatorios.despesas') }}" method="post">
                        @csrf
                        <br>
                        <div class="col col-6">
                            <label for="filter1">Descrição:</label>
                            <input type="text" name="filter1">
                        </div>
                        <br>
                        <div class="col col-2">
                            <label for="categoria_id">Categoria:</label>
                            <select name="categoria_id" id="categoria_id" class="form-control">
                                <option>Selecione...</option>
                                @foreach($categorias as $c)
                                <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="col col-6">
                            <label for="filter2">Data :</label>
                            <input type="date" name="filter2">
                        </div>
                        <div>Entre</div>
                        <div class="col col-6">
                            <label for="filter2">Data :</label>
                            <input type="date" name="filter2">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Gerar PDF</button>
                    </form>
                </div>
            </div>
        </div>
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