<?php

namespace App\Repositories;

use App\Models\Despesas;

class DespesasRepository
{
    private $despesas;

    public function __construct(Despesas $despesas)
    {
        $this->despesas = $despesas;
    }

    public function getAllUsers()
    {
        return Despesas::all();
    }

    public function getById($id){
        return Despesas::findOrFail($id);
    }

    
    public function salvar($id, $name, $email,$password)
    {
        try {
            $despesas = new Despesas();
            $despesas->name = $name;
            $despesas->email = $email;
            $despesas->password  = $password;
            $despesas->save();

            return $despesas;
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function update($id,$name,$email,$password)
    {
        try {
            $despesas = Despesas::find($id);
            $despesas->id = $id;
            $despesas->name = $name;
            $despesas->email = $email;
            $despesas->password  = $password;
            $despesas->update();
            return $despesas->fresh();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function delete($id)
    {
        if($id != null ){
            $despesas = $this->despesas->findOrFail($id);
            $despesas->delete();
        } 
        return $despesas;  
    }
}