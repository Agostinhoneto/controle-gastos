<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NovoLembretePagamento extends Notification
{
    use Queueable;

    public $lembretes;
    
    public function __construct($lembretes)
    {
      
        $this->lembretes = $lembretes;

    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
     {
         return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject("Lembrete de Pagamento")
            ->line('Um novo Lembrete de Pagamento foi registrado.')
             ->line('Usuario: ' . $this->lembretes->user_id)
             ->line('Despesa: ' . $this->lembretes->despesa_id)
             ->line('Titulo: ' . $this->lembretes->titulo)
             ->line('Descrição: ' . $this->lembretes->descricao)
             ->line('Valor: R$ ' . number_format($this->lembretes->valor, 2, ',', '.'))
             ->line('Data: ' . \Carbon\Carbon::parse($this->lembretes->data_aviso)->format('d/m/Y'))
             ->line('Data: ' . \Carbon\Carbon::parse($this->lembretes->data_notificao)->format('d/m/Y'))
             ->action('Visualizar', url('/lembretes'))
             ->line('Obrigado por usar nosso sistema!');
     }

    public function toArray($notifiable)
    {
        return [
          //  'despesa' => $this->data_notificao,
            //'dataVencimento' => $this->data_aviso,
         //   'mensagem' => "A despesa '{$this->despesa}' tem vencimento próximo."
        ];
    }
}
