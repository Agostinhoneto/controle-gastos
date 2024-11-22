<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReminder extends Notification
{
    use Queueable;

    public $valor;

    public function __construct($valor)
    {
        $this->valor = $valor;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $datas = $this->valor->datas ? $this->valor->datas->format('d/m/Y') : 'Data não informada';

        return (new MailMessage)
            ->subject('Lembrete de Pagamento')
            ->line("Olá, lembrete de pagamento para: {$this->valor->nome}.")
            ->line("Valor: R$ {$this->valor->valor}")
            ->line("Data de vencimento: {$datas}")
            ->action('Visualizar Pagamento', url('/valor/' . $this->valor->id))
            ->line('Evite atrasos no pagamento.');
           // dd($this->valor);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
