<?php

namespace App\Services;

use App\Models\Despesas;
use App\Models\Receitas;
use App\Repositories\DespesasRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class DespesaService
{
 
    private $despesasRepository;

    public function __construct(DespesasRepository $despesasRepository)
    {
        $this->despesasRepository = $despesasRepository;
    }

    public function getAll()
    {
        return $this->despesasRepository->getAllUsers();
    }

    public function getById($id)
    {
        return $this->despesasRepository
            ->getById($id);
    }


    public function getUserById($id)
    {
        return $this->despesasRepository->getById($id);
    }

    public function createUser($id, $name, $email, $password)
    {
        DB::beginTransaction();
        try {
            $data = $this->despesasRepository->salvar($id, $name, $email, $password);
            DB::commit();
            return $data;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e);
        }
    }

    public function updateUser($id, $name, $email, $password)
    {
        DB::beginTransaction();
        try {
            $data = $this->despesasRepository->update($id, $name, $email, $password);
            DB::commit();
            return $data;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e);
        }
    }

    public function destroyUser($id){
        DB::beginTransaction();
        try{
            $user = $this->despesasRepository->delete($id);
            DB::commit();
        }
        catch(Exception $e){
            DB::roolBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não pode ser deletado');
        }
        return $user;
    }
}
