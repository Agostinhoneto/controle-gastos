@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Metas Financeiras</h1>
    <a href="{{ route('financial_goals.create') }}" class="btn btn-primary">Nova Meta</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Progresso</th>
                <th>Prazo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($goals as $goal)
                <tr>
                    <td>{{ $goal->name }}</td>
                    <td>{{ $goal->saved_amount }} / {{ $goal->target_amount }}</td>
                    <td>{{ $goal->start_date }} - {{ $goal->end_date }}</td>
                    <td>
                        <a href="{{ route('financial_goals.show', $goal) }}" class="btn btn-info btn-sm">Ver</a>
                        <form action="{{ route('financial_goals.destroy', $goal) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
