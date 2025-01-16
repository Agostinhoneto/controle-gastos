<div class="card">
    <div class="card-header">
        <h3 class="card-title">Eventos Financeiros</h3>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('eventos.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="title" class="form-label">
                            <i class="fas fa-calendar-alt"></i> Título do Evento
                        </label>
                        <input type="text" class="form-control" id="title" name="titulo" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="data_inicio" class="form-label">
                            <i class="fas fa-calendar-day"></i> Data
                        </label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" id="tipo" required class="form-control">
                            <option value="" disabled selected>Selecione...</option>
                            <option value="0">Despesa</option>
                            <option value="1">Receita</option>
                        </select>
                    </div>
                    <div class="col col-6">
                        <label for="categoria_id">Categoria:</label>
                        <select name="categoria_id" id="categoria_id" required class="form-control">
                            <option>Selecione...</option>
                            @foreach($categorias as $c)
                            <option value="{{ $c->id }}" required>{{ $c->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="data_inicio" class="form-label">
                            <i class="fas fa-calendar-day"></i> Valor
                        </label>
                        <input type="valor" class="form-control" id="valor" name="valor" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">
                    <i class="fas fa-plus-circle"></i> Adicionar Evento
                </button>
            </form>
        </div>
    </div>
    <div id="calendar" class="bg-white shadow p-3 rounded"></div>
</div>