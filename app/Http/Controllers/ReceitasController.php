<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceitasRequest;
use App\Models\Categorias;
use App\Models\Receitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReceitasController extends Controller
{
    protected $receitas;

    public function __construct(Receitas $receitas)
    {
        $this->receitas = $receitas;
    }

    public function index(Request $request)
    {
        try {
            if (!Auth::check()) {
                return abort(403, 'Acesso não autorizado.');
            }

            try {
                $query = Receitas::with(['categoria:id,descricao']) 
                    ->when($request->filled('descricao'), function ($query) use ($request) {
                        $query->where('descricao', 'like', '%' . $request->descricao . '%');
                    })->when($request->filled('valor'), function ($query) use ($request) {
                        $query->where('valor', $request->valor);
                    })->when($request->filled('data_recebimento'), function ($query) use ($request) {
                        $query->where('data_recebimento', $request->data_recebimento);
                    })->when($request->filled('status'), function ($query) use ($request) {
                        $query->where('status', $request->status);
                    });

                $receitas = $query->clone()->paginate(10);
                $total = $query->sum('valor');

                return view('receitas.index', [
                    'receitas' => $receitas,
                    'total' => $total,
                    'categorias' => Categorias::orderBy('descricao')->get(),
                    'mensagem' => $request->session()->get('mensagem'),
                    'filters' => $request->only(['descricao', 'valor', 'status']) 
                ]);
            } catch (\Exception $e) {
                Log::error('Erro ao carregar receitas: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Erro ao carregar receitas. Detalhes: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao acessar a página: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $categorias = Categorias::orderBy('descricao')->get();
            return view('receitas.create', compact('categorias'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de criação: ' . $e->getMessage());
        }
    }

    public function store(StoreReceitasRequest $request)
    {
        try {
            DB::beginTransaction();

            $receitas = new Receitas();
            $receitas->descricao = $request->input('descricao');
            $receitas->valor = $request->input('valor');
            $receitas->data_recebimento = $request->input('data_recebimento');
            $receitas->categoria_id = $request->input('categoria_id');
            $receitas->status = $request->input('status', 1);
          
            if (auth()->check()) {
                $receitas->usuario_cadastrante_id = auth()->id();
            } else {
                throw new \Exception('Usuário não autenticado');
            }
            
            if ($request->hasFile('comprovante')) {
                $path = $request->file('comprovante')
                    ->store('comprovantes/receitas', 'public');
                $receitas->comprovante_path = $path;
            }

            $receitas->save();
           
            DB::commit();

            return redirect()->route('receitas.index')
                ->with('sucesso', 'Receitas cadastrada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Erro ao salvar: ' . $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $receitas = Receitas::findOrFail($id);
            $mensagem = $request->session()->get('mensagem');
            $categorias = Categorias::orderBy('descricao')->get();

            return view('receitas.edit', compact('receitas', 'categorias', 'mensagem'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('receitas.index')->withErrors('Receita não encontrada.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de edição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $receitas = Receitas::findOrFail($id);
            $receitas->update($request->only(['descricao', 'valor', 'data_recebimento', 'categoria_id', 'status']));

            return redirect()->route('receitas.index')->with('success', 'Receita atualizada com sucesso!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('receitas.index')->withErrors('Receita não encontrada.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao atualizar a receita: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $receitas = Receitas::findOrFail($id);
            $receitas->delete();

            return redirect()->route('receitas.index')->with('success', 'Receita excluída com sucesso!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('receitas.index')->withErrors('Receita não encontrada.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao excluir a receita: ' . $e->getMessage());
        }
    }
}
