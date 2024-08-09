<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function index(){
        return view('contatos.index');
    }

    public function create()
    {
        return view('contact.create');
    }

    // Processa o envio do formulário
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Enviar o e-mail (substitua 'admin@example.com' pelo seu e-mail de destino)
        Mail::send('emails.contact', [
            'name' => $request->name,
            'email' => $request->email,
            'user_message' => $request->message,
        ], function ($mail) use ($request) {
            $mail->from($request->email, $request->name);
            $mail->to('admin@example.com')->subject('Nova mensagem de contato');
        });

        // Redireciona com mensagem de sucesso
        return redirect()->route('contact.create')->with('success', 'Mensagem enviada com sucesso!');
    }
}
