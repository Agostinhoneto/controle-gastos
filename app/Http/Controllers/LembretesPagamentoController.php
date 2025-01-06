<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\LembretePagamento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LembretesPagamentoController extends Controller
{
    public function index()
    {
        $despesas = Despesas::all();
        $users = User::all();
        $lembretes = LembretePagamento::where('user_id', Auth::id())->get();
        
        return view('lembretes.index', compact('lembretes','despesas','users'));
    }

    public function create()
    {
        return view('lembretes.create');
    }

    public function store(Request $request)
    {
        LembretePagamento::create([
            'user_id' => Auth::id(),
            'expense_id' => $request->expense_id,
            'title' => $request->title,
            'description' => $request->description,
            'reminder_date' => $request->reminder_date,
            'is_notified' => false,
        ]);

        return redirect()->route('lembretes.index')->with('success', 'Lembrete criado com sucesso!');
    }

    public function edit($id)
    {
        $reminder = LembretePagamento::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $expenses = Despesas::where('user_id', Auth::id())->get();

        return view('lembretes.edit', compact('reminder', 'expenses'));
    }

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

        return redirect()->route('lembretes.index')->with('success', 'Lembrete atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $reminder = LembretePagamento::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reminder->delete();
        return redirect()->route('lembretes.index')->with('success', 'Lembrete excluído com sucesso!');
    }
}
