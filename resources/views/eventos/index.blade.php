@include('layouts.topo')
@include('mensagem', ['mensagem' => $mensagem])
<style>
    #status {
        padding: 5px;
        border-radius: 5px;
        text-align: center;
    }

    .ativo {
        background-color: green;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .inativo {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .card-title {
        font-weight: bold;
        font-size: 1.5rem;
    }
    /* Adicionado para melhor espaçamento */
    .main-content {
        padding: 20px;
        width: 100%;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="main-content">
        <div class="card shadow">
            <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title">Despesas</h3>
                <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                </button>
            </div>
            @include('despesas.create')
            @include('components.flash-message')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="eventos" class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descrição do Evento</th>
                                <th scope="col">Data do inicio</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Status</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($eventos as $evento)
                            <tr>
                                <th scope="row">{{ $evento->id }}</th>
                                <td>{{ $evento->titulo }}</td>
                                <td>{{ Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y') }}</td>
                                <td>R$ {{ number_format($evento->valor, 2, ',', '.') }}</td>
                                <td>
                                    <span class="{{ $evento->status == 1 ? 'ativo' : 'inativo' }}">
                                        {{ $evento->status == 1 ? 'Pago' : 'Não Pago' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('eventos.destroy', $evento->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($evento->descricao) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#eventos').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            },
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pageLength: 10
        });
    });
</script>

