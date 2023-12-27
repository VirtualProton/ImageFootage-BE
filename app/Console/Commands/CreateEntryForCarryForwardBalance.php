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
    protected $description = 'This command is used to create a new entry in user_package table with order_type flag is 3(means consider it as a credited package) if the user have unused balance from previous plan.';

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
                    $getCurrentSamePlan = UserPackage::where(['status' => 1, 'user_id' => $package->user_id, 'package_id' => $package->package_id])->where('created_at','>', $getUserPackages->package_expiry_date_from_purchage)->where('package_expiry_date_from_purchage', '>=', Carbon::today())->exists();

                    if ($getCurrentSamePlan) {
                        $newCreditedPackage = new UserPackage();
                        $newCreditedPackage->user_id = $package->user_id;

                        $newCreditedPackage->transaction_id = $package->package_id;
                        $newCreditedPackage->package_id = $package->package_id;
                        $newCreditedPackage->package_name = $package->package_name;

                        $newCreditedPackage->package_price = $package->package_price;
                        $newCreditedPackage->package_description = $package->package_description;
                        $newCreditedPackage->package_products_count = $package->package_products_count - $package->downloaded_product;
                        $newCreditedPackage->payment_status = "Completed";
                        $newCreditedPackage->package_type = $package->package_type;
                        $newCreditedPackage->package_permonth_download = $package->package_permonth_download;
                        $newCreditedPackage->package_expiry = $package->package_expiry;
                        $newCreditedPackage->package_plan = $package->package_plan;
                        $newCreditedPackage->package_pcarry_forward = "yes";
                        $newCreditedPackage->package_expiry_yearly = $package->package_expiry_yearly;

                        $newCreditedPackage->payment_gatway_provider = $package->payment_gatway_provider;
                        $newCreditedPackage->pacage_size = $package->pacage_size;
                        $newCreditedPackage->created_at = Carbon::today();
                        $newCreditedPackage->package_expiry_date_from_purchage = Carbon::parse($package->package_expiry_date_from_purchage)->addYear();
                        $newCreditedPackage->order_type = 3;
                        $newCreditedPackage->save();
                    }
                }
                $package->update(['status' => 0]);
            }
        }
    }
}
