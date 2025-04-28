<div class="card">
    <div class="card-header">
        <h3 class="card-title">Metas Financeiras</h3>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('metas.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="title" class="form-label">
                            <i class="fas fa-calendar-alt"></i> Título da Metas 
                        </label>
                        <input type="text" class="form-control" id="title" name="titulo" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="title" class="form-label">
                            <i class="fas fa-calendar-alt"></i> Descrição
                        </label>
                        <input type="text" class="form-control" id="title" name="descricao" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="data_inicio" class="form-label">
                            <i class="fas fa-calendar-day"></i> Data de Inicio
                        </label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="data_inicio" class="form-label">
                            <i class="fas fa-calendar-day"></i> Data Fim
                        </label>
                        <input type="date" class="form-control" id="data_fim" name="data_fim" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="data_inicio" class="form-label">
                            <i class="fas fa-calendar-day"></i> Valor 
                        </label>
                        <input type="valor" class="form-control" id="valor" name="valor" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="data_inicio" class="form-label">
                            <i class="fas fa-calendar-day"></i> Valor Atual
                        </label>
                        <input type="valor" class="form-control" id="valor" name="valor_corrente" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">
                    <i class="fas fa-plus-circle"></i> Adicionar Metas
                </button>
            </form>
        </div>
    </div>
    <div id="calendar" class="bg-white shadow p-3 rounded"></div>
</div>