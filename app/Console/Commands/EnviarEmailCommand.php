<?php

namespace App\Console\Commands;

use App\Mail\Despesas;
use App\Mail\SendWelcomeEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarEmailCommand extends Command
{
    // Nome do comando que será usado no terminal
    protected $signature = 'email:enviar {email}';
    
    // Descrição do comando
    protected $description = 'Envia um e-mail para o endereço especificado';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->argument('email');
        $dados = [
            'item1' => 'Valor 1',
            'item2' => 'Valor 2',
        ];
    
        // Exibe os dados para verificar
        $this->info("Dados: " . print_r($dados, true));
    
        Mail::to($email)->send(new SendWelcomeEmail($dados));
    
        $this->info("E-mail enviado para {$email} com sucesso!");
    }
    
}

