@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    <strong class="font-bold">Erro(s):</strong>
    <ul class="mt-2">
        @foreach ($errors->all() as $error)
        <li>- {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-red-600 text-white">
                <h5 class="modal-title" id="myModalLabel">Criar eventos</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Corpo do Modal -->
            <div class="modal-body">
                <form method="POST" action="{{ route('eventos.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">
                                <i class="fas fa-calendar-alt"></i> Título do Evento
                            </label>
                            <input type="text" class="form-control" id="title" name="titulo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="data_inicio" class="form-label">
                                <i class="fas fa-calendar-day"></i> Data do Evento
                            </label>
                            <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tipo" class="form-label">Tipo:</label>
                            <select name="tipo" id="tipo" required class="form-control">
                                <option value="" disabled selected>Selecione...</option>
                                <option value="0">Despesa</option>
                                <option value="1">Receita</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categoria_id" class="form-label">Categoria:</label>
                            <select name="categoria_id" id="categoria_id" required class="form-control">
                                <option value="" disabled selected>Selecione...</option>
                                @foreach($categorias as $c)
                                <option value="{{ $c->id }}">{{ $c->descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="valor" class="form-label">Valor R$:</label>
                            <input type="number" class="form-control" id="valor" name="valor" step="0.01" min="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="data_pagamento" class="form-label">Data do Pagamento:</label>
                            <input type="date" class="form-control" id="data_pagamento" name="data_pagamento" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="" disabled selected>Selecione...</option>
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>