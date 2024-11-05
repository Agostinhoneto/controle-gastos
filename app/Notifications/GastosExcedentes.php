<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GastosExcedentes extends Notification
{
    use Queueable;

    protected $categoria;
    protected $limite;

    public function __construct($categoria, $limite)
    {
        $this->categoria = $categoria;
        $this->limite = $limite;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Alerta de Gastos Excedentes')
                    ->line("Você atingiu o limite de gastos para a categoria: {$this->categoria}.")
                    ->line("Limite: R$ {$this->limite}")
                    ->action('Verificar Despesas', url('/despesas'))
                    ->line('Por favor, revise suas despesas.');
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'categoria' => $this->categoria,
            'limite' => $this->limite,
            'message' => "Você atingiu o limite de gastos para a categoria: {$this->categoria}."
        ]);
    }
}
