@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
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
                                <div class="col col-6">
                                    <label for="valor">Valor:</label>
                                    <input type="number" class="form-control" name="valor" id="valor" required placeholder="Valor $$">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="data_pagamento">Data do Pagamento:</label>
                                    <input type="date" class="form-control" name="data_pagamento" id="data_pagamento" required placeholder="Data">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="categoria_id">Categoria:</label>
                                    <select name="categoria_id" id="categoria_id" required class="form-control">
                                        <option>Selecione...</option>
                                        @foreach($categorias as $c)
                                        <option value="{{ $c->id }}" required>{{ $c->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="status">Status:</label>
                                    <select id="status" name="status" class="form-control">
                                        <option>Selecione...</option>
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
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
            </div>

        </div>
    </div>
</div>
<!-- /.card-header -->