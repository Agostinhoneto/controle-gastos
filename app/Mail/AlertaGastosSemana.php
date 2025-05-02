<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlertaGastosSemana extends Mailable
{
    use Queueable, SerializesModels;

    public $total;

    public function __construct($total)
    {
        $this->total = $total;
    }
    
    public function build()
    {
        return $this->subject('Alerta de Gastos Semanais')
            ->view('emails.alertas.gastos-semanais')
            ->with(['total' => $this->total]);
    }
    
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Alerta Gastos Semana',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.alertas.gastos-semanais',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
