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
                <h4 class="modal-title">Criar Lembretes</h4>
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
                            <form class="form" method="POST" action="{{ route('lembretes.store') }}">
                                @csrf
                                <div class="col col-6">
                                    <label for="categoria_id">Despesa:</label>
                                    <select name="categoria_id" id="categoria_id" required class="form-control">
                                        <option>Selecione...</option>
                                        @foreach($despesas as $despesa)
                                        <option value="{{ $despesa->despesa_id }}" required>{{ $despesa->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-8">
                                    <label for="titulo">Título:</label>
                                    <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Título">
                                </div>
                                <div class="col col-8">
                                    <label for="descricao">Descrição:</label>
                                    <input type="text" class="form-control" name="descricao" id="descricao" required placeholder="Descrição">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="data_aviso">Data de Aviso:</label>
                                    <input type="date" class="form-control" name="data_aviso" id="data_aviso" required placeholder="Data Aviso">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="data_notificacao">Data de Notificação:</label>
                                    <input type="date" class="form-control" name="data_notificacao" id="data_notificacao" required placeholder="Data Notificação">
                                </div>
                                <br>
                                <div class="col col-6">
                                    <label for="categoria_id">Usuario:</label>
                                    <select name="categoria_id" id="categoria_id" required class="form-control">
                                        <option>Selecione...</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" required>{{ $user->name }}</option>
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