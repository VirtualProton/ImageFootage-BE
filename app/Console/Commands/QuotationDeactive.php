<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;

class QuotationDeactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotation:deactive';

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
        Log::channel('quotationlog')->info("====== Quotation cancelled by cron : START =====");
        $today = date('Y-m-d');
        $invoices = Invoice::whereDate('cancelled_on', '<', $today)->where('status', '=', 0)->whereNotNull('cancelled_on')->get();
        if(count($invoices) > 0) {
            foreach($invoices as $invoice) {
                Invoice::where('id', $invoice->id)->update([
                    'status' => 3,
                    'cancel_date' => date('Y-m-d H:i:s'),
                    'cancelled_by' => NULL
                ]);
                Log::channel('quotationlog')->info("====== Quotation cancelled id : " . $invoice->id ." =====");
            }
        }
        Log::channel('quotationlog')->info("====== Quotation cancelled by cron : END =====");
    }
}
