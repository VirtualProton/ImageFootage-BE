<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usercart;
use Mail;

class HourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an hourly update email';

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

        $date = new \DateTime();
        $date->modify('-1 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');

        $userCart = Usercart::with('product')->with('user')->where('cart_added_on', '>',$formatted_date)->get()->toArray();

        if(!empty($userCart)){
            $a = 'vasiuddin@conceptualpictures.com';
            Mail::raw("This is automatically generated Hourly Update", function($message) use ($a)
            {
                $message->from('admin@imagefootage.com');
                $message->to($a)->subject('Hourly Update');
            });
            $this->info('Hourly Update has been send successfully');
        }

        
       }
}
