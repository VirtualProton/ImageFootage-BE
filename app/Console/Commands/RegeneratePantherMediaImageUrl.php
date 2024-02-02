<?php

namespace App\Console\Commands;

use App\Http\PantherMedia\ImageApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Carbon\Carbon;

class RegeneratePantherMediaImageUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regenerate:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate image url for panthermedia';

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
        Log::channel('regenrateUrlLog')->info("====== Panthermedia Image cancelled by cron : START =====");
        $today = date('Y-m-d');
        $tomorrow = Carbon::now()->addDay();
        $tomorrowDate = $tomorrow->toDateString();
        $expirData = Product::whereDate('expired_date', $tomorrowDate)->get();
        if(!$expirData->isEmpty()){
            foreach($expirData as $key=>$expire){
                $imageApi = new ImageApi();
                $getData = $imageApi->get_media_infoNew($expire->api_product_id);
                if(isset($getData['stat'])){
                    if($getData['stat'] == 'ok'){
                        $parsedUrl = parse_url($expire['preview_high_no_wm']);
                        if (isset($parsedUrl['query'])) {
                            parse_str($parsedUrl['query'], $queryParams);

                            if (isset($queryParams['expires'])) {
                                $expiresValue = $queryParams['expires'];
                                $expiryDate =  date('Y-m-d H:i:s', $expiresValue);

                            } else {

                                $currentDateTime = Carbon::now();  // Current date and time
                                $expiryDate = $currentDateTime->addDays(28)->format('Y-m-d H:i:s');
                            }
                        } else {

                            $currentDateTime = Carbon::now();  // Current date and time
                            $expiryDate = $currentDateTime->addDays(28)->format('Y-m-d H:i:s');
                        }
                        Product::where('api_product_id',$expire->api_product_id)->update([
                            'product_thumbnail' => $getData['media']['preview_url_no_wm'],
                            'expired_date' => $expiryDate
                        ]);
                        Log::channel('regenrateUrlLog')->info("====== Panthermedia Image cancelled id : " . $expire->api_product_id ." =====");
                    }else{
                        Log::channel('regenrateUrlLog')->info("====== Getting error in info API response" );
                    }

                }else{
                    Log::channel('regenrateUrlLog')->info("====== Getting error in info API response" );
                }
            }
        }
    }
}
