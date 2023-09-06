<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\UserPackage;
use Auth;
class PackageApiController extends Controller
{
    public function packageList()
    {
        $all_package_list = Package::get()->where('package_added_on', '<=', '2020-02-29')->whereNotIn('footage_tier', ['2', '3', '4'])->toArray();
        //print_r($all_package_list); die;
        $packagelist = [];
        if (count($all_package_list) > 0) {
            foreach ($all_package_list as $eachpacage) {
                if ($eachpacage['package_plan'] == 1) {
                    $plan = 'download_pack';
                } else if ($eachpacage['package_plan'] == 2) {
                    if ($eachpacage['package_expiry_yearly'] == 0) {
                        $plan = 'monthly_pack';
                    } else {
                        $plan = 'yearly_pack';
                    }
                }
                if ($eachpacage['package_type'] == 'Image') {
                    $packagelist[$eachpacage['package_type']][$plan][] = $eachpacage;
                } else {
                    if ($eachpacage['pacage_size'] == '1') {
                        $packagelist[$eachpacage['package_type']][$plan]['HD'][] = $eachpacage;
                    } else {
                        $packagelist[$eachpacage['package_type']][$plan]['4K'][] = $eachpacage;
                    }
                }
            }
        }
        echo json_encode(["status" => "success", 'data' => $packagelist]);
    }

    public function packageListv2()
    {
        $all_package_list = Package::where(function ($query) {
                $query->where('display_for', 1)
                    ->orWhere('display_for', 3);
            })
            ->where('package_status', '=', 'Active')
            ->where('package_added_on', '<=', config('constants.GET_PACKAGE_LIST_DATE'))
            ->get()
            ->toArray();
        $packagelist = [];
        if (count($all_package_list) > 0) {
            foreach ($all_package_list as $eachpacage) {
                if ($eachpacage['package_plan'] == 1) {
                    $plan = 'download_pack';
                } else if ($eachpacage['package_plan'] == 2) {
                    $plan = 'subscription';
                }
                if ($eachpacage['package_type'] == 'Image') {
                    $packagelist[$eachpacage['package_type']][$plan][] = $eachpacage;
                } else if ($eachpacage['package_type'] == 'Music') {
                    $packagelist[$eachpacage['package_type']][$plan][] = $eachpacage;
                } else {
                    if ($eachpacage['pacage_size'] == '1') {
                        $packagelist[$eachpacage['package_type']][$plan]['HD'][] = $eachpacage;
                    } else {
                        $packagelist[$eachpacage['package_type']][$plan]['4K'][] = $eachpacage;
                    }
                }
            }
        }
        echo json_encode(["status" => "success", 'data' => $packagelist]);
    }
}
