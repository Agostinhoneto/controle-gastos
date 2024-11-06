<?php

namespace App\Services;

use App\Models\User;
use App\Models\Despesas;
use App\Notifications\GastosExcedentes;

class AlertService
{
    /**
     * Verifica se o usuário atingiu o limite de gastos em suas categorias
     * e envia notificações se necessário.
     */
    public function verificarLimites(User $user)
    {
        foreach ($user->categorias as $categoria) {
            // Calcula o total de despesas na categoria do usuário
            $totalGastos = Despesas::where('categoria_id', $categoria->id)
                ->where('user_id', $user->id)
                ->sum('valor');

            // Verifica se o total excede o limite estabelecido
            if ($totalGastos >= $categoria->limite) {
                // Envia a notificação de gastos excedentes
                $this->enviarAlerta($user, $categoria, $totalGastos);
            }
        }
    }

    /**
     * Envia uma notificação ao usuário quando o limite de gastos é excedido.
     *
     * @param User $user
     * @param $categoria
     * @param $totalGastos
     */
    protected function enviarAlerta(User $user, $categoria, $totalGastos)
    {
        // Cria e envia a notificação
        $user->notify(new GastosExcedentes($categoria->nome, $categoria->limite, $totalGastos));
    }
}
