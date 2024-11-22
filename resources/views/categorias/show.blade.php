@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categoria: {{ $category->name }}</h1>

    @foreach($progressData as $data)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Meta: R$ {{ number_format($data['goal']->goal_amount, 2) }}</h5>
                <p>Período: {{ $data['goal']->start_date }} a {{ $data['goal']->end_date }}</p>
                <p>Gastos até agora: R$ {{ number_format($data['totalExpenses'], 2) }}</p>
                <p>Progresso: {{ number_format($data['progress'], 2) }}%</p>

                @if($data['progress'] > 100)
                    <p class="text-danger">{{ $data['status'] }}</p>
                @else
                    <p class="text-success">{{ $data['status'] }}</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
