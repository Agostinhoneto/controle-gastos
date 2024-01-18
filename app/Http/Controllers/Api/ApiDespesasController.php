<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpStatusCodes;
use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Services\DespesaService;
use Exception;
use Illuminate\Support\Facades\Request;

class ApiDespesasController extends Controller
{ 
    
    protected $despesasService;

    public function __construct(DespesaService $despesasService)
    {
        $this->despesasService = $despesasService;
    }

   
    public function index()
    {
        $limit = 10;
        try {
            $result['data'] = $this->despesasService->getAll($limit);
            return response()->json([Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK, $result]);
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function show($id)
    {
        try {
            if (!empty($id)) {
                $result['data'] = $this->despesasService->getById($id);
                return response()->json([Messages::SUCCESS_MESSAGE, HttpStatusCodes::OK, $result]);
            }
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }

    public function store(Request $request)
    {
        $result['data'] = $this->despesasService->createUser(
            $request->id,
            $request->name,
            $request->email,
            $request->password,
        );
        return response()->json([Messages::SAVE_MESSAGE, HttpStatusCodes::OK, $result]);
    }

    public function update(Request $request, $id)
    {
        $result['data'] = $this->despesasService->updateUser(
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
            $result['data'] = $this->despesasService->destroyUser($id);
            return response()->json([Messages::DELETE_MESSAGE, HttpStatusCodes::OK, $result]);
        } catch (Exception $e) {
            return response()->json([Messages::ERROR_MESSAGE, HttpStatusCodes::INTERNAL_SERVER_ERROR]);
        }
    }
}
