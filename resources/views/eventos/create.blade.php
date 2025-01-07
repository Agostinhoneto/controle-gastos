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
                        <label for="start_date" class="form-label">
                            <i class="fas fa-calendar-day"></i> Data
                        </label>
                        <input type="date" class="form-control" id="data_inicio" name="start_date" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="categoria_id">Tipo:</label>
                        <select name="categoria_id" id="categoria_id" required class="form-control">
                            <option>Selecione...</option>
                        </select>
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