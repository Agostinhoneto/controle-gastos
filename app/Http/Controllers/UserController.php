<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (!Auth::check()) {
            echo "Não autenticado";
            exit();
        }
        $users = User::all();
        $permissions = Permission::all();

        $mensagem = $request->session()->get('mensagem');
        return view('users.index', compact('mensagem', 'users','permissions'));
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(StoreUserRequest $request)
    {
        $users = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'is_admin' =>  $request->input('is_admin'),
            'password' => Hash::make($request->input('password')),
        ]);
        
        if ($request->has('permissions')) {
            $users->syncPermissions($request->permissions);
        }

        return redirect()->route('users.index')->with('success', 'Usuário cadastro com sucesso!');
    }

    public function edit(User $users, $id)
    {
        $users = User::findOrFail($id);
        return view('users.edit', ['users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
        if ($id == null) {
            dd('erro');
        }
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
