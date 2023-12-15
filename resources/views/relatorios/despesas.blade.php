<!-- resources/views/relatorio.blade.php -->
<h1>Relatório</h1>

{{-- Exiba seus dados no relatório --}}
@foreach ($data as $item)
    <p>{{ $item->campo1 }} - {{ $item->campo2 }}</p>
@endforeach
