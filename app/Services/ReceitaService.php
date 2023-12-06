<?php

namespace App\Services;

use App\Models\Despesas;
use App\Models\Receitas;
use Illuminate\Support\Facades\DB;

class ReceitaService
{
    public function criarReceita($numero, $nome, $pais)
    {
            DB::beginTransaction();
            try {
                $data = $this->surfistaRepository->salvar($numero, $nome, $pais);
                DB::commit();
                return $data;
            } catch (\Exception $e) {
                DB::rollback();
                throw new \Exception($e);
            }
     
    }

    public function atualizarReceita(Receitas $receita, array $dados)
    {
        // Lógica para atualizar uma receita existente
        $receita->update($dados);

        return $receita;
    }

    public function excluirReceita(Receitas $receita)
    {
        // Lógica para excluir uma receita
        $receita->delete();
    }
}
