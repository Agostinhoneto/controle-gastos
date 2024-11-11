<?php

namespace App\Http\Controllers;

use App\Mail\Despesas as MailDespesas;
use App\Mail\SendWelcomeEmail;
use App\Models\Categorias;
use App\Models\Despesas;
use App\Models\User;
use App\Notifications\DespesaAlertaNotification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Mail;

class DespesasController extends Controller
{

    public function index(Request $request)
    {
        $categorias = Categorias::query()->orderBy('descricao')->get();
        $total = Despesas::sum('valor');
        $despesas = Despesas::query()->with('categoria')->orderBy('descricao')->paginate(10);
        $mensagem = $request->session()->get('mensagem');
        return view('despesas.index', compact('despesas', 'mensagem', 'total', 'categorias'));
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function store(Request $request)
    {
        $despesas = new Despesas();
        $despesas->descricao = $request->input('descricao');
        $despesas->valor = $request->input('valor');
        $despesas->data_pagamento = $request->input('data_pagamento');
        $despesas->categoria_id = $request->input('categoria_id');
        $despesas->status = $request->input('status', 1);
        $despesas->save();

        // Enviar e-mail
        Mail::to('destinatario@provedor.com')->send(new DespesaCadastradaMail($despesa));
        
        return redirect()->route('despesas.index')->with('sucesso', 'Despesa cadastrada com sucesso');
    }

    public function edit(Request $request, Despesas $despesas, $id)
    {
        $despesas = Despesas::find($id);
        $mensagem = $request->session()->get('mensagem');

        $categorias = Categorias::query()->orderBy('descricao')->get();
        return view('despesas.edit', compact('despesas', 'categorias', 'mensagem'));
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
