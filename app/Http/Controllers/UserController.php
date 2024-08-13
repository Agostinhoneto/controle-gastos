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
            'is_admin' =>  $request->input('is_admin'),
            'password' => Hash::make($request->input('password')),
        ]);
        //Enviar e-mail       
       // Mail::to($users->email)->send(new SendWelcomeEmail($users));
        DB::commit();
        return redirect()->route('users.create')->with('success', 'Usuário cadastro com sucesso!');
    }

    public function edit(User $users,$id)
    {
        $users = User::findOrFail($id);
        return view('users.edit', ['users' => $users]);
    }

    public function update(Request $request,$id)
    {
        $users = User::findOrFail($id);
        $users->update($request->all());
        return redirect()->route('users.index')->with('success', 'Usuários atualizada com sucesso!');   
    }

    public function destroy(User $users)
    {
        $users->delete();
        $mensagem = session()->get('mensagem');
        return redirect()->route('users.index')->with('success', 'Usuário excluida com sucesso!');    
    }
}
