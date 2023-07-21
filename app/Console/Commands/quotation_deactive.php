<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;

class quotation_deactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotation_deactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All quotation with due dates are cancelled by cron.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info("====== Quotation cancelled by cron : START =====");
        $today = date('Y-m-d H:i:s');
        $invoices = Invoice::whereDate('cancelled_on', '<', $today)->where('status', 3)->get();
        if(count($invoices) > 0) {
            foreach($invoices as $invoice) {
                $invoice->update([
                    'status' => 3,
                    'cancel_date' => $today,
                    'cancelled_by' => NULL
                ]);
                \Log::info("====== Quotation cancelled id : " . $invoice->id ." =====");
            }
        }
        \Log::info("====== Quotation cancelled by cron : END =====");
    }
}
