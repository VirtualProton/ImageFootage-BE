<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserPackage;
use Illuminate\Support\Carbon;

class CreateEntryForCarryForwardBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:to-credit-balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $getUserPackages = UserPackage::where(['status' => 1, 'package_plan' => 2])->where('package_expiry_date_from_purchage', '<', Carbon::today())->get();

        if ($getUserPackages->isNotEmpty()) {
            foreach ($getUserPackages as $package) {
                if ($package->downloaded_product < $package->package_products_count) {
                    $getCurrentSamePlan = UserPackage::where(['user_id' => $package->user_id, 'package_id' => $package->package_id])->where('package_expiry_date_from_purchage', '>=', Carbon::today())->exists();

                    if ($getCurrentSamePlan) {
                        $newCreditedPackage = new UserPackage();
                        $newCreditedPackage->user_id = $package->user_id;
                        $newCreditedPackage->transaction_id = "";
                        $newCreditedPackage->package_id = $package->package_id;
                        $newCreditedPackage->package_name = $package->package_name;
                        $newCreditedPackage->package_price = '';
                        $newCreditedPackage->package_description = $package->package_description;
                        $newCreditedPackage->package_products_count = $package->package_products_count - $package->downloaded_product;
                        $newCreditedPackage->package_type = $package->package_type;
                        $newCreditedPackage->package_permonth_download = $package->package_permonth_download;
                        $newCreditedPackage->package_expiry = $package->package_expiry;
                        $newCreditedPackage->package_plan = $package->package_plan;
                        $newCreditedPackage->package_pcarry_forward = $package->package_pcarry_forward;
                        $newCreditedPackage->package_expiry_yearly = $package->package_expiry_yearly;
                        $newCreditedPackage->payment_gatway_provider = "";
                        $newCreditedPackage->pacage_size = $package->pacage_size;
                        $newCreditedPackage->created_at = date('Y-m-d H:i:s');
                        $package->package_expiry_date_from_purchage = Carbon::parse($package->package_expiry)->addYear();
                        $newCreditedPackage->save();
                    } else {
                        $package->update(['status' => 0]);
                    }
                } else {
                    $package->update(['status' => 0]);
                }
            }
        }
    }
}
