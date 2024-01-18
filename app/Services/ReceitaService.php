<?php

namespace App\Services;
use App\Repositories\ReceitasRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class ReceitaService
{

    private $receitasRepository;

    public function __construct(ReceitasRepository $receitasRepository)
    {
        $this->receitasRepository = $receitasRepository;
    }
    public function getAll()
    {
        return $this->receitasRepository->getAllUsers();
    }

    public function getById($id)
    {
        return $this->receitasRepository
            ->getById($id);
    }


    public function getUserById($id)
    {
        return $this->receitasRepository->getById($id);
    }

    public function createUser($id, $name, $email, $password)
    {
        DB::beginTransaction();
        try {
            $data = $this->receitasRepository->salvar($id, $name, $email, $password);
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
            $data = $this->receitasRepository->update($id, $name, $email, $password);
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
            $user = $this->receitasRepository->delete($id);
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
