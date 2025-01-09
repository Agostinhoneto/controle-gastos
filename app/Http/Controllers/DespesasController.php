<?php

namespace App\Http\Controllers;

use App\Mail\MailDespesas as MailMailDespesas;
use App\Mail\SendWelcomeEmail;
use App\Models\Categorias;
use App\Models\Despesas;
use App\Models\User;
use App\Notifications\DespesaAlertaNotification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DespesasController extends Controller
{

    public function index(Request $request)
    {
        try {
            if (!Auth::check()) {
                return abort(403, 'Acesso não autorizado.');
            }

            $categorias = Categorias::query()->orderBy('descricao')->get();
            $total = Despesas::sum('valor');
            $despesas = Despesas::query()->with('categoria')->orderBy('descricao')->paginate(10);
            $mensagem = $request->session()->get('mensagem');
            return view('despesas.index', compact('despesas', 'mensagem', 'total', 'categorias'));
        } catch (\Exception $e) {

            return redirect()->back()->withErrors('Erro ao carregar as despesas: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function store(Request $request)
    {
        try {
            $despesas = new Despesas();
            $despesas->descricao = $request->input('descricao');
            $despesas->valor = $request->input('valor');
            $despesas->data_pagamento = $request->input('data_pagamento');
            $despesas->categoria_id = $request->input('categoria_id');
            $despesas->status = $request->input('status', 1);
            $despesas->user_id = auth()->id();
            $despesas->save();
    
            Mail::to('agostneto6@gmail.com')->send(new MailMailDespesas($despesas));
    
            return redirect()->route('despesas.index')->with('sucesso', 'Despesa cadastrada com sucesso');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao salvar a despesa: ' . $e->getMessage());
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
        // Encontrar o usuário pelo ID
        $user = User::find($userId);

        // Verificar se o usuário existe
        if ($user) {
            // Enviar a notificação
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
