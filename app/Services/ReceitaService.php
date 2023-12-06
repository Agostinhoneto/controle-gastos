<?php

namespace App\Services;

use App\Models\Despesas;
use App\Models\Receitas;
use Illuminate\Support\Facades\DB;

class ReceitaService
{
public function criarReceita(array $dados)
    {
        // Lógica para criar uma nova receita
        return Receitas::create($dados);
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