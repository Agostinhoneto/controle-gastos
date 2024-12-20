<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\LembretePagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LembretesPagamentoController extends Controller
{
    public function index()
    {
        $reminders = LembretePagamento::where('user_id', Auth::id())->get();
        return view('lembretes.index', compact('reminders'));
    }

    // Exibe o formulário para criar um novo lembrete
    public function create()
    {
        $expenses = Despesas::where('user_id', Auth::id())->get();
        return view('reminders.create', compact('expenses'));
    }

    // Salva o lembrete no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'reminder_date' => 'required|date|after_or_equal:now',
            'description' => 'nullable|string',
            'expense_id' => 'nullable|exists:expenses,id',
        ]);

        LembretePagamento::create([
            'user_id' => Auth::id(),
            'expense_id' => $request->expense_id,
            'title' => $request->title,
            'description' => $request->description,
            'reminder_date' => $request->reminder_date,
            'is_notified' => false,
        ]);

        return redirect()->route('reminders.index')->with('success', 'Lembrete criado com sucesso!');
    }

    // Exibe o formulário para editar um lembrete
    public function edit($id)
    {
        $reminder = LembretePagamento::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $expenses = Despesas::where('user_id', Auth::id())->get();

        return view('reminders.edit', compact('reminder', 'expenses'));
    }

    // Atualiza o lembrete no banco de dados
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'reminder_date' => 'required|date|after_or_equal:now',
            'description' => 'nullable|string',
            'expense_id' => 'nullable|exists:expenses,id',
        ]);

        $reminder = LembretePagamento::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reminder->update($request->only('title', 'description', 'reminder_date', 'expense_id'));

        return redirect()->route('reminders.index')->with('success', 'Lembrete atualizado com sucesso!');
    }

    // Exclui um lembrete
    public function destroy($id)
    {
        $reminder = LembretePagamento::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reminder->delete();

        return redirect()->route('reminders.index')->with('success', 'Lembrete excluído com sucesso!');
    }
}
