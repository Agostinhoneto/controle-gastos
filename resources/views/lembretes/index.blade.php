@include('layouts.topo')
@extends('layout')

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
        font-size: 1.25rem;
    }
</style>

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Lembretes</h3>
                        <button type="button" class="btn btn-light btn-sm float-right" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                        </button>
                    </div>
                    @include('lembretes.create')
                    @include('components.flash-message')
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                            <div class="card-body">
                                <table id="lembretes" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Descrição do Lembrete</th>
                                            <th scope="col">Data do Pagamento</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Categoria</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col">Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lembretes as $lembrete)
                                        <tr>
                                            <td>{{ $lembrete->id }}</td>
                                            <td>{{ $lembrete->descricao }}</td>
                                            <td>{{ Carbon\Carbon::parse($lembrete->data_recebimento)->format('d/m/Y') }}</td>
                                            <td>R$ {{ number_format($lembrete->valor, 2, ',', '.') }}</td>

                                            <td>
                                                <form action="{{ route('lembretes.ativar-status', $lembrete->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $lembrete->status ? 'btn-danger' : 'btn-success' }}">
                                                        {{ $lembrete->status ? 'Não Pago' : 'Pago' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $lembrete->categoria?->descricao }}</td>
                                            <td>
                                                <a href="{{ route('receitas.edit', $lembrete->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('receitas.destroy', $lembrete->id) }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($lembrete->descricao) }}?')">
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
        </ul>
    </div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS (apenas o básico) -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#lembretes').DataTable({
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

    $(document).ready(function() {
        setTimeout(function() {
            $('#valor').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: true
            }).maskMoney('mask');
        }, 100);
    });
</script>