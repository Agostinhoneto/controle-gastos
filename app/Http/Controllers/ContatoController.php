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
        return view('contatos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Mail::send('emails.contato', [
            'name' => $request->name,
            'email' => $request->email,
            'user_message' => $request->message,
        ], function ($mail) use ($request) {
            $mail->from($request->email, $request->name);
            $mail->to('admin@example.com')->subject('Nova mensagem de contato');
        });

        return redirect()->route('contact.create')->with('success', 'Mensagem enviada com sucesso!');
    }
}
