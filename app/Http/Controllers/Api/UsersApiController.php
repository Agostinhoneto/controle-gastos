<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpStatusCodes;
use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UsersService;
use Exception;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException as ExceptionsJWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsersApiController extends Controller
{
    protected $userService;

    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $limit = 10;
        try {
            $result['data'] = $this->userService->getAll($limit);
            return response()->json([Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK, $result]);
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function show($id)
    {
        try {
            if (!empty($id)) {
                $result['data'] = $this->userService->getById($id);
                return response()->json([Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK, $result]);
            }
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function store(Request $request)
    {
        $result['data'] = $this->userService->createUser(
            $request->id,
            $request->name,
            $request->email,
            $request->password,
        );
        return response()->json([Messages::SAVE_MESSAGE, HttpStatusCodes::OK, $result]);
    }

    public function update(Request $request, $id)
    {
        $result['data'] = $this->userService->updateUser(
            $request->id,
            $request->name,
            $request->email,
            $request->password,
        );
        return response()->json([Messages::UPDATE_MESSAGE, HttpStatusCodes::OK, $result]);
    }

    public function destroy($id)
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->userService->destroyUser($id);
            return response()->json([Messages::DELETE_MESSAGE, HttpStatusCodes::OK, $result]);
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }
    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível criar o token'], 500);
        }
        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        //Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (HandleExceptions $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);
        return response()->json(['user' => $user]);
    }
 
}
