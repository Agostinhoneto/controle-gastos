<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (!Auth::check()) {
            echo "Não autenticado";
            exit();
        }
        $users = User::all();
        $mensagem = $request->session()->get('mensagem');
        return view('users.index', compact('mensagem', 'users'));
    }
    public function create(Request $request)
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $users = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        //Enviar e-mail       
        Mail::to($users->email)->send(new SendWelcomeEmail($users));
        DB::commit();
        return redirect()->route('users.create')->with('success', 'Usuário cadastro com sucesso!');
    }

    public function edit(Request $request)
    {
        dd('oi');
    }

    public function update(Request $request)
    {
        dd('oi');
    }

    public function destroy(Request $request)
    {
        dd('oi');
    }
}
