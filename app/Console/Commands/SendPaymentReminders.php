<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Notifications\PaymentReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendPaymentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'reminders:send';
    protected $description = 'Enviar lembretes de pagamentos próximos do vencimento';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payments = Payment::where('is_paid', false)
            ->whereDate('datas', '<=', Carbon::now()->addDays(3))
            ->get();

        foreach ($payments as $payment) {
            $payment->user->notify(new PaymentReminder($payment));
        }

        $this->info('Lembretes de pagamento enviados com sucesso!');
    }
}
