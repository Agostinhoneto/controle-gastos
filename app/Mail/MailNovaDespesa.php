<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Despesas;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class MailNovaDespesa extends Mailable
{
    use Queueable, SerializesModels;

    public $despesa;
    public $user;

    public function __construct(Despesas $despesa)
    {
        $this->despesa = $despesa;
        $this->user = $despesa->user;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Nova Despesa Registrada - ' . config('app.name'))
            ->view('emails.despesas.nova-despesa') 
            ->with([
                'despesa' => $this->despesa,
                'user' => $this->user
            ]);
    }

    
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Despesas',
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
            view: 'emails.despesas.nova-despesa',
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