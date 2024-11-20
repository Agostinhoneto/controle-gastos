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
                <h4 class="modal-title">Nova Meta Financeira</h4>
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
                            <form class="form" method="POST" action="{{ route('financial.store') }}">
                                @csrf
                                <div class="col col-8">
                                    <label for="descricao">Descrição:</label>
                                    <input type="text" class="form-control" name="nome" id="nome required placeholder="Descrição">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="valor">Valor R$:</label>
                                    <input type="number" class="form-control" name="valor" id="valor" step="0.01" min="0.01"  required>
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="data_pagamento">Data Inicio:</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" required placeholder="Data">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="data_pagamento">Data Fim:</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" required placeholder="Data">
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