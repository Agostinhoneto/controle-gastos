@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Criar Lembretes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form" method="POST" action="{{ route('lembretes.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="despesa_id">Despesas:</label>
                        <select name="despesa_id" id="despesa_id" required class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($despesas as $c)
                            <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="despesa_id">Categorias:</label>
                        <select name="categoria_id" id="categoria_id" required class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($categorias as $c)
                            <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Usuários:</label>
                        <select name="user_id" id="user_id" required class="form-control">
                            <option value="">Selecione...</option>
                            @foreach($users as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="Digite o título">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea class="form-control" name="descricao" id="descricao" required placeholder="Digite a descrição"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor:</label>
                        <input type="text" class="form-control" name="valor" id="valor" required placeholder="Digite o Valor">
                    </div>
                   
                    <div class="form-group">
                        <label for="data_aviso">Data de Aviso:</label>
                        <input type="date" class="form-control" name="data_aviso" id="data_aviso" required placeholder="Data">
                    </div>

                    <div class="form-group">
                        <label for="data_notificacao">Data de Notificação:</label>
                        <input type="date" class="form-control" name="data_notificacao" id="data_notificacao" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-2">Salvar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script>
    $(document).ready(function() {
        $('#valor').maskMoney({
            prefix: 'R$ ',
            allowNegative: false,
            thousands: '.',
            decimal: ',',
            affixesStay: true
        });
        $('#valor').maskMoney('mask');        
        $('#valor').trigger('focus');
        $('#lembreteForm').on('submit', function(e) {
            $('#valor').val($('#valor').maskMoney('unmasked')[0]);
            return true;
        });
    });
</script>