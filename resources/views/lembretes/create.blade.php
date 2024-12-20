@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Adicionar Lembrete</h1>

    <form action="{{ route('reminders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="reminder_date" class="form-label">Data do Lembrete</label>
            <input type="datetime-local" name="reminder_date" id="reminder_date" class="form-control @error('reminder_date') is-invalid @enderror" value="{{ old('reminder_date') }}">
            @error('reminder_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="expense_id" class="form-label">Despesa Relacionada</label>
            <select name="expense_id" id="expense_id" class="form-select">
                <option value="">Nenhuma</option>
                @foreach($expenses as $expense)
                <option value="{{ $expense->id }}" {{ old('expense_id') == $expense->id ? 'selected' : '' }}>
                    {{ $expense->name }} - {{ $expense->amount }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
