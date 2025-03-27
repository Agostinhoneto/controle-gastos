<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Cargo;
use App\Models\Endereco;
use App\Models\User;
use App\Models\Permission;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if (!Auth::check()) {
                return abort(403, 'Acesso não autorizado.');
            }
            $cargos = Cargo::all();
            $users = User::all();
            $permissions = Permission::all();
            $mensagem = $request->session()->get('mensagem');

            return view('users.index', compact('mensagem', 'users', 'permissions','cargos'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar a lista de usuários: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (!auth()->user()->can('create', User::class)) {
            throw new AuthorizationException('Você não tem permissão para criar usuários.');
        }
        
        try {
            $permissions = Permission::all();
            return view('users.create', compact('permissions'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de criação: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        try {
    
            if (!auth()->user()->can('create', User::class)) {
                throw new AuthorizationException('Você não tem permissão para criar usuários.');
            }
            
            if ($request->input('password') !== $request->input('password_confirmation')) {
                throw ValidationException::withMessages([
                    'password' => ['As senhas não coincidem.'],
                ]);
            }
           
            $user =  User::create([
                'name' => $request->input('name'),
                'cpf' => $request->input('cpf'),
                'rg' => $request->input('rg'),
                'email' => $request->input('email'),
                'is_admin' => $request->boolean('is_admin'),
                'password' => Hash::make($request->input('password')),
                'password_confirmation' => Hash::make($request->input('password_confirmation')),
                'cargo_id' => $request->input('cargo_id'),
            ]);

            dd($user);
            
            Endereco::create([
                'user_id' => $user->id, 
                'endereco' => $request->input('endereco'),
                'numero' => $request->input('numero'),
                'complemento' => $request->input('complemento'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'estado' => $request->input('estado'),
                'cep' => $request->input('cep'),
            ]);
            
            /*
            if ($request->has('permissions')) {
                $user->syncPermissions($request->permissions);
            }
            */
            return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');

        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->withErrors('Erro ao criar o usuário: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $users = User::findOrFail($id);
            $permissions = Permission::all();

            return view('users.edit', compact('users', 'permissions'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->withErrors('Usuário não encontrado.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de edição: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->update($request->only(['name', 'email', 'is_admin']));

            if ($request->has('permissions')) {
                $user->syncPermissions($request->permissions);
            }

            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->withErrors('Usuário não encontrado.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Erro ao atualizar o usuário: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->withErrors('Usuário não encontrado.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Erro ao excluir o usuário: ' . $e->getMessage());
        }
    }
}
