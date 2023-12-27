<h1>Relatório de Despesa</h1>

@foreach ($despesas as $despesa)
    <p>{{ $despesa->descricao }}</p>
@endforeach
