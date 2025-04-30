<div class="card">
    <div class="card-header">
        <h3 class="card-title">Histórico Financeiro</h3>
        <div class="card-tools">
            <span class="badge bg-success">Receitas: R$ {{ number_format($totalReceitas, 2, ',', '.') }}</span>
            <span class="badge bg-danger ml-2">Despesas: R$ {{ number_format($totalDespesas, 2, ',', '.') }}</span>
            <span class="badge bg-primary ml-2">Saldo: R$ {{ number_format($saldo, 2, ',', '.') }}</span>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th>Comprovante</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historico as $item)
                <tr>
                    <td>{{ $item->data->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $item->tipo == 'receita' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($item->tipo) }}
                        </span>
                    </td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->categoria->nome }}</td>
                    <td class="{{ $item->tipo == 'receita' ? 'text-success' : 'text-danger' }}">
                        R$ {{ number_format($item->valor, 2, ',', '.') }}
                    </td>
                    <td>
                        @if($item->comprovante_path)
                        <a href="{{ $item->comprovante_url }}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $historico->links() }}
    </div>
</div>