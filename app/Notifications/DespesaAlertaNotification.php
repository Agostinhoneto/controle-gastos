<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DespesaAlertaNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $gastoAtual;
    protected $limiteGastos;

    public function __construct($gastoAtual, $limiteGastos)
    {
        $this->gastoAtual = $gastoAtual;
        $this->limiteGastos = $limiteGastos;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Alerta: Você está próximo do limite de gastos!')
                    ->greeting("Olá, {$notifiable->name}!")
                    ->line("Seu gasto atual é de R$ {$this->gastoAtual}.")
                    ->line("O limite de gastos que você definiu é de R$ {$this->limiteGastos}.")
                    ->line("Considere revisar seus gastos para evitar despesas acima do seu limite.")
                    ->action('Verificar despesas', url('/despesas'))
                    ->line('Obrigado por utilizar nosso sistema de controle de custos!');
    }
}
