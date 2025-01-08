<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NovoEventoFinanceiro extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $evento;

    public function __construct($evento)
    {
        $this->evento = $evento;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable)
    {
        if ($this->evento) {
            // Certifique-se de que os dados estão presentes antes de usá-los
            $titulo = $this->evento->titulo;

            // Converta data_inicio para Carbon, se necessário
            $data_inicio = Carbon::parse($this->evento->data_inicio);
        } else {
            // Caso o evento seja null
            $titulo = "Evento não encontrado";
            $data_inicio = "Data não disponível";
        }

        return (new MailMessage)
            ->subject('Novo Evento Financeiro Adicionado')
            ->greeting('Olá, ' . $notifiable->name . '!')
            ->line('Um novo evento financeiro foi cadastrado:')
            ->line('Título: ' . $this->evento->titulo)
            ->line('Data Início: ' . $data_inicio->format('d/m/Y'))  
            ->line('Tipo: ' . $this->evento->tipo)
            ->line('Valor: R$' . number_format($this->evento->valor, 2, ',', '.'))
            ->action('Visualizar no Sistema', url('/eventos'))
            ->line('Obrigado por usar nosso sistema!');
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    /**
     * Dados que serão salvos no banco.
     */
    public function toDatabase($notifiable)
    {
        return [
            'titulo' => $this->evento->titulo,
            'data_inicio' => $this->evento->data_inicio,
            'tipo' => $this->evento->tipo,
            'valor' => $this->evento->valor,
        ];
    }
}
