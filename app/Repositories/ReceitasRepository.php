<?php

namespace App\Repositories;

use App\Models\Receitas;

class ReceitasRepository
{
    private $receitas;

    public function __construct(Receitas $receitas)
    {
        $this->receitas = $receitas;
    }

    public function getAllUsers()
    {
        return Receitas::all();
    }

    public function getById($id){
        return Receitas::findOrFail($id);
    }

    
    public function salvar($id, $name, $email,$password)
    {
        try {
            $receitas = new Receitas();
            $receitas->name = $name;
            $receitas->email = $email;
            $receitas->password  = $password;
            $receitas->save();

            return $receitas;
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function update($id,$name,$email,$password)
    {
        try {
            $receitas = Receitas::find($id);
            $receitas->id = $id;
            $receitas->name = $name;
            $receitas->email = $email;
            $receitas->password  = $password;
            $receitas->update();
            return $receitas->fresh();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function delete($id)
    {
        if($id != null ){
            $receitas = $this->receitas->findOrFail($id);
            $receitas->delete();
        } 
        return $receitas;  
    }
}