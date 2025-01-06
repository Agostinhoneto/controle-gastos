@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Criar Lembretes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <form class="form" method="POST" action="{{ route('lembretes.store') }}">
                    @csrf

                    <!-- Despesas -->
                    <div class="form-group">
                        <label for="despesa_id">Despesas:</label>
                        <select name="despesa_id" id="despesa_id" required class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($despesas as $c)
                            <option value="{{ $c->despesa_id }}">{{ $c->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Título -->
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Digite o título">
                    </div>

                    <!-- Descrição -->
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea class="form-control" name="descricao" id="descricao" required placeholder="Digite a descrição"></textarea>
                    </div>

                    <!-- Data de Aviso -->
                    <div class="form-group">
                        <label for="data_aviso">Data de Aviso:</label>
                        <input type="date" class="form-control" name="data_aviso" id="data_aviso" required>
                    </div>

                    <!-- Data de Notificação -->
                    <div class="form-group">
                        <label for="data_notificacao">Data de Notificação:</label>
                        <input type="date" class="form-control" name="data_notificacao" id="data_notificacao" required>
                    </div>

                    <!-- Usuários -->
                    <div class="form-group">
                        <label for="user_id">Usuários:</label>
                        <select name="user_id" id="user_id" required class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($users as $c)
                            <option value="{{ $c->user_id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">Selecione...</option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>

                    <!-- Botão Salvar -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-2">Salvar</button>
                    </div>
                </form>
            </div>

            <!-- Rodapé do Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>