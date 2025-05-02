<?php

namespace App\Http\Controllers;

use App\Mail\MailDespesas;
use App\Mail\MailNovaDespesa;
use App\Mail\NovaDespesaMail;
use App\Mail\SendWelcomeEmail;
use App\Models\Categorias;
use App\Models\Despesas;
use App\Models\User;
use App\Notifications\DespesaAlertaNotification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DespesasController extends Controller
{

    public function index(Request $request)
    {
        try {
            // Verificação de autenticação
            if (!Auth::check()) {
                return abort(403, 'Acesso não autorizado.');
            }

            $query = Despesas::with(['categoria:id,descricao'])
                ->when($request->filled('descricao'), function ($query) use ($request) {
                    $query->where('descricao', 'like', '%' . $request->descricao . '%');
                })
                ->when($request->filled('valor'), function ($query) use ($request) {
                    $query->where('valor', $request->valor);
                })
                ->when($request->filled('data_pagamento'), function ($query) use ($request) {
                    $query->whereDate('data_pagamento', $request->data_pagamento);
                })
                ->when($request->filled('status'), function ($query) use ($request) {
                    $query->where('status', $request->status);
                })
                ->orderBy('descricao');

            $despesas = $query->paginate(10);
            $total = $query->clone()->sum('valor');

            $categorias = Categorias::orderBy('descricao')->get();
            $users = User::all();
            $mensagem = $request->session()->get('mensagem');

            return view('despesas.index', [
                'despesas' => $despesas,
                'total' => $total,
                'categorias' => $categorias,
                'mensagem' => $mensagem,
                'users' => $users,
                'filters' => $request->only(['descricao', 'valor', 'data_pagamento', 'status'])
            ]);
        } catch (\Exception $e) {
            Log::error('Erro ao carregar despesas: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Erro ao carregar despesas. Por favor, tente novamente.');
        }
    }

    public function show(Despesas $despesas, $id)
    {
        try {
            $despesas = Despesas::find($id);
            return view('despesas.show', compact('despesas'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar a despesa: ' . $e->getMessage());
        }
    }
    
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();


            $despesas = new Despesas();
            $despesas->descricao = $request->input('descricao');
            $despesas->valor = $request->input('valor');
            $despesas->data_pagamento = $request->input('data_pagamento');
            $despesas->categoria_id = $request->input('categoria_id');
            $despesas->status = $request->input('status', 1);
            $despesas->user_id = $request->input('user_id');

            if (auth()->check()) {
                $despesas->usuario_cadastrante_id = auth()->id();
            } else {
                throw new \Exception('Usuário não autenticado');
            }

            if ($request->hasFile('comprovante')) {
                $path = $request->file('comprovante')
                    ->store('comprovantes/despesas', 'public');
                $despesas->comprovante_path = $path;
            }
            $despesas->load('user');

            if (!$despesas->user) {
                throw new \Exception('Nenhum usuário válido associado a esta despesa');
            }
            Mail::to('agostneto6@gmail.com')->send(new MailNovaDespesa($despesas));
            
            $despesas->save();
            DB::commit();

            return redirect()->route('despesas.index')->with('sucesso', 'Despesa cadastrada com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao cadastrar despesa', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id() ?? null
            ]);
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Erro ao salvar: ' . $e->getMessage());
        }
    }

    public function edit(Request $request, Despesas $despesas, $id)
    {
        try {
            $despesas = Despesas::find($id);
            $mensagem = $request->session()->get('mensagem');

            $categorias = Categorias::query()->orderBy('descricao')->get();
            return view('despesas.edit', compact('despesas', 'categorias', 'mensagem'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de criação: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Despesas $despesas, $id)
    {
        $despesas = Despesas::findOrFail($id);
        $despesas->update($request->all());
        return redirect()->route('despesas.index')->with('success', 'Despesas atualizada com sucesso!');
    }

    public function destroy(Despesas $despesas)
    {
        $despesas->delete();
        $mensagem = session()->get('mensagem');
        return redirect()->route('despesas.index')->with('success', 'Despesa excluida com sucesso!');
    }

    public function gerarPdf()
    {
        $despesas = Despesas::orderByDesc('created_at')->get();

        $pdf = FacadePdf::loadView('relatorios.pdf', ['despesas' => $despesas])->setPaper('a4', 'portrait');

        return $pdf->download('listar_despesas.pdf');
    }

    public function enviarAlertaDespesa($userId, $gastoAtual, $limiteGastos)
    {
        $user = User::find($userId);

        if ($user) {
            $user->notify(new DespesaAlertaNotification($gastoAtual, $limiteGastos));
            return response()->json(['message' => 'Notificação enviada com sucesso!']);
        }

        return response()->json(['message' => 'Usuário não encontrado'], 404);
    }

    public function enviarEmail()
    {
        $dados = [
            'item1' => 'Valor 1',
            'item2' => 'Valor 2',
        ];

        Mail::to('agostneto6@gmail.com')->send(new SendWelcomeEmail($dados));

        return 'E-mail enviado com sucesso!';
    }
}
