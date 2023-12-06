<?php

namespace App\Services;

use App\Models\Despesas;
use App\Models\Receitas;
use Illuminate\Support\Facades\DB;

class DespesaService
{
    public function criarReceita(array $dados)
    {
        return Despesas::create($dados);
    }

    public function atualizarReceita(Despesas $receita, array $dados)
    {
        $receita->update($dados);

        return $receita;
    }

    public function excluirReceita(Despesas $receita)
    {
        $receita->delete();
    }
}
