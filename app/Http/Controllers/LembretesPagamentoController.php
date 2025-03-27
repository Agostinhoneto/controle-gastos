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

    protected $lembretes;

    public function __construct(LembretePagamento $lembretes)
    {
        $this->lembretes = $lembretes;
    }


    public function index()
    {
        try {
            $despesas = Despesas::all();
            $categorias = Categorias::all();
            $users = User::all();
            $lembretes = LembretePagamento::where('user_id', Auth::id())->get();

            return view('lembretes.index', compact('lembretes', 'despesas', 'users','categorias'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar lembretes de pagamento: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar os lembretes. Tente novamente mais tarde.');
        }
    }

    public function create()
    {
        return view('lembretes.create');
    }

    public function store(Request $request)
    {
        $valorConvertido = floatval(str_replace(',', '.', str_replace('.', '', $request->valor)));
        $request->merge(['valor' => $valorConvertido]);

        try {
            $this->lembretes->create([
                'despesa_id' => $request->despesa_id,
                'categoria_id'  => $request->categoria_id,
                'user_id' => $request->user_id,
                'titulo' => $request->titulo,
                'valor'   => $valorConvertido,
                'descricao' => $request->descricao,
                'data_aviso' => $request->data_aviso,
                'data_notificacao' => $request->data_notificacao,
            ]);
            return redirect()->route('lembretes.index')->with('success', 'Receita cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao cadastrar a receita: ' . $e->getMessage());

            auth()->user()->notify(new NovoLembretePagamento($lembretes));

            return redirect()->route('lembretes.index')->with('success', 'Lembrete criado e notificado com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao criar lembrete: ' . $e->getMessage());
            return back()->withErrors('Erro ao criar o lembrete. Tente novamente mais tarde.');
        }
    }

    public function edit($id)
    {
        try {
            $lembrete = LembretePagamento::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            $despesas = Despesas::where('user_id', Auth::id())->get();

            return view('lembretes.edit', compact('lembrete', 'despesas'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar lembrete para edição: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar o lembrete. Tente novamente mais tarde.');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'despesa_id' => 'required|exists:despesas,id',
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_aviso' => 'required|date',
            'data_notificacao' => 'nullable|date|after_or_equal:data_aviso',
        ]);

        try {
            $lembrete = LembretePagamento::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            $lembrete->update($validatedData);

            return redirect()->route('lembretes.index')->with('success', 'Lembrete atualizado com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao atualizar lembrete: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar o lembrete. Tente novamente mais tarde.');
        }
    }

    public function destroy($id)
    {
        try {
            $lembrete = LembretePagamento::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            $lembrete->delete();

            return redirect()->route('lembretes.index')->with('success', 'Lembrete excluído com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao excluir lembrete: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir o lembrete. Tente novamente mais tarde.');
        }
    }
}
