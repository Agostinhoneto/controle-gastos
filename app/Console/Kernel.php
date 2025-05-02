<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\EnviarEmailCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('reminders:send')->daily();
        $schedule->command('recorrencias:processar')->daily();
        $schedule->command('receitas:limpar-antigas')->monthly(); //monthly() para rodar 1x por mês
        $schedule->command('despesas:limpar-antigas')->monthly(); //monthly() para rodar 1x por mês
        $schedule->command('alertas:gastos-semanais')->weeklyOn(1, '08:00'); // Toda segunda-feira às 8h
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
