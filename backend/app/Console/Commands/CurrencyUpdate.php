<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Currency;


class CurrencyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Currency Update';

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
        $api_url_usd = 'https://api.exchangeratesapi.io/latest?base=USD';
        // $api_url = 'https://api.exchangeratesapi.io/latest?base=USD';

        // Read JSON file
        $json_data = file_get_contents($api_url_usd);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);

        $usd = $response_data->rates->INR;

        $usd = round($usd,4);

        $api_url_eur = 'https://api.exchangeratesapi.io/latest?base=EUR';
        // $api_url = 'https://api.exchangeratesapi.io/latest?base=USD';

        // Read JSON file
        $json_data = file_get_contents($api_url_eur);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);

        $eur = $response_data->rates->INR;
        $eur = round($eur,4);

        $currency = Currency::where('name','USD')->first();
        $currency->cur_value=$usd;
        $currency->save();

        $currency = Currency::where('name','EURO')->first();
        $currency->cur_value=$eur;
        $currency->save();


        $this->info('Currency Update has been done successfully');
    }
}
