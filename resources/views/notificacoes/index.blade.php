@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Minhas Notificações</h1>
    <ul class="list-group">
        @foreach ($notificacoes as $notificacao)
            <li class="list-group-item {{ $notificacao->read_at ? '' : 'bg-light' }}">
                <h5>{{ $notificacao->data['titulo'] }}</h5>
                <p>Valor: R$ {{ number_format($notificacao->data['valor'], 2, ',', '.') }}</p>
                <p>Data de vencimento: {{ \Carbon\Carbon::parse($notificacao->data['data_vencimento'])->format('d/m/Y') }}</p>
                <small>Recebida em: {{ $notificacao->created_at->format('d/m/Y H:i') }}</small>
                @if (is_null($notificacao->read_at))
                    <form method="POST" action="{{ route('notificacoes.marcarLida', $notificacao->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">Marcar como lida</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
