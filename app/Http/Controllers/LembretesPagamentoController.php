<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Despesas;
use App\Models\LembretePagamento;
use App\Models\User;
use App\Notifications\NovoLembretePagamento;
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
        $lembretes = new LembretePagamento();
        $lembretes->despesa_id = $request->input('despesa_id');
        $lembretes->user_id = $request->input('user_id');
        $lembretes->titulo = $request->input('titulo');
        $lembretes->descricao = $request->input('descricao');
        $lembretes->data_aviso = $request->input('data_aviso');       
        $lembretes->data_notificacao = $request->input('data_notificacao');
        $lembretes->save();
  
        auth()->user()->notify(new NovoLembretePagamento($lembretes));
        
        return redirect()->route('lembretes.index')->with('success', 'Evento financeiro criado e notificado com sucesso!');
    }

    public function edit($id)
    {
        $reminder = LembretePagamento::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $expenses = Despesas::where('user_id', Auth::id())->get();

        return view('lembretes.edit', compact('reminder', 'expenses'));
    }

    public function update(Request $request, $id)
    {
        $lembretes = LembretePagamento::findOrFail($id);
        $lembretes->update($request->all());
        return redirect()->route('lembretes.index')->with('success', 'lembretes atualizada com sucesso!');     
    }

    public function destroy($id)
    {
        $reminder = LembretePagamento::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reminder->delete();
        return redirect()->route('lembretes.index')->with('success', 'Lembrete excluído com sucesso!');
    }
}
