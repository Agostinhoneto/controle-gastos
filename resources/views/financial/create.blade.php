@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Meta Financeira</h1>
    <form method="POST" action="{{ route('financial_goals.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome da Meta</label>
            <input type="text" class="form-control" id="name" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="target_amount" class="form-label">Valor Alvo</label>
            <input type="number" class="form-control" id="target_amount" name="valor" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Data de Início</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Data de Término</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
