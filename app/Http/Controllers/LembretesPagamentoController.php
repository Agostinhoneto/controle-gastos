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

            return view('lembretes.index', compact('lembretes', 'despesas', 'users', 'categorias'));
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

        $validated = $request->validate([
            'despesa_id' => 'nullable|exists:despesas,id',
            'categoria_id' => 'required|exists:categorias,id',
            'titulo' => 'required|string|max:255',
            'valor' => 'required|string', 
            'descricao' => 'nullable|string',
            'data_aviso' => 'required|date',
            'data_notificacao' => 'nullable|date|after_or_equal:data_aviso',
        ]);

        $valorConvertido = $this->convertCurrencyToDecimal($validated['valor']);
        
        try {
           
            $lembrete = $this->lembretes->create([
                'despesa_id' => $validated['despesa_id'],
                'categoria_id' => $validated['categoria_id'],
                'user_id' => auth()->id(), 
                'titulo' => $validated['titulo'],
                'valor' => $valorConvertido,
                'descricao' => $validated['descricao'],
                'data_aviso' => $validated['data_aviso'],
                'data_notificacao' => $validated['data_notificacao'],
                'status' => $request->status ?? 1,
            ]);
            
            auth()->user()->notify(new NovoLembretePagamento($lembrete));

            return redirect()->route('lembretes.index')
                ->with('success', 'Lembrete cadastrado com sucesso!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erro ao cadastrar lembrete: ' . $e->getMessage());
        }
    }

    protected function convertCurrencyToDecimal($value)
    {
        return floatval(str_replace(',', '.', str_replace('.', '', $value)));
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


    public function ativarStatus(LembretePagamento $lembrete)
    {
        try {
            $novoStatus = !$lembrete->status; 
            $lembrete->update(['status' => $novoStatus]);

            return back()->with([
                'success' => 'Status alterado com sucesso!',
                'novo_status' => $novoStatus
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao alterar status: ' . $e->getMessage());
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
