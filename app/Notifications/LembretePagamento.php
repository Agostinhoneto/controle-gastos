<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LembretePagamento extends Notification
{
    use Queueable;

    public $despesa;
    public $dataVencimento;

    public function __construct($despesa, $dataVencimento)
    {
        $this->despesa = $despesa;
        $this->dataVencimento = $dataVencimento;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Lembrete de Pagamento")
                    ->line("A despesa '{$this->despesa}' tem vencimento próximo.")
                    ->line("Data de Vencimento: {$this->dataVencimento}")
                    ->action('Ver suas despesas', url('/despesas'))
                    ->line('Realize o pagamento para evitar juros.');
    }

    public function toArray($notifiable)
    {
        return [
            'despesa' => $this->despesa,
            'dataVencimento' => $this->dataVencimento,
            'mensagem' => "A despesa '{$this->despesa}' tem vencimento próximo."
        ];
    }
}
