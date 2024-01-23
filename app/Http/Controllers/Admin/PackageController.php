<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Auth;
use App\Models\LicenceType;

class PackageController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin')->except('login', 'logout');
	}
	public function createPackage()
	{
        $getDetails = LicenceType::get();
		return view('admin.package.createpackage',['licence'=>$getDetails]);
	}
	public function addPackage(Request $request)
	{
		$this->validate($request, [
			'package_name' => 'required',
			'package_price' => 'required',
			'package_description' => 'required',
			'package_products_count' => 'required',
			'package_type' => 'required',
			'display_for' => 'required',
            'package_expiry' => 'required_without_all:package_expiry_year',
            'package_expiry_year' => 'required_without_all:package_expiry',

		]);
        $tier = '';
        if(isset($request->footage_tier) && !empty($request->footage_tier)){
            $tier = $request->footage_tier;
        } elseif(isset($request->music_tier) && !empty($request->music_tier)){
            $tier  = $request->music_tier;
			$request->pacage_size = null;
        }else{
            $tier = $request->image_tier;
        }

		$package = new Package;
		$package->package_plan = $request->package_plan;
		$package->package_name = $request->package_name;
		$package->package_price = $request->package_price;
		$package->package_description = $request->package_description;
		$package->package_products_count = $request->package_products_count;
		$package->package_type = $request->package_type;
		$package->package_added_on = date('Y-m-d H:i:s');
		$package->package_expiry = $request->package_expiry;
		$package->package_expiry_yearly = $request->package_expiry_year;
		$package->package_permonth_download = $request->package_month_count;
		$package->package_pcarry_forward = $request->products_carry_forward;
		$package->pacage_size = $request->pacage_size;
		$package->package_addedby = Auth::guard('admins')->user()->id;
		$package->footage_tier = $tier;
		$package->display_for = $request->display_for;
		$package->package_status = $request->package_status;
		$result = $package->save();
		if ($result) {
			return back()->with('success', 'Package created successful');
		} else {
			return back()->with('warning', 'Some problem occured.');
		}
	}
	public function packageList()
	{
		$package = new Package;
		$all_package_list = $package->get()->toArray();
		return view('admin.package.packagelist', ['package' => $all_package_list]);
	}
	public function changePackageStatus($status, $id)
	{
		$result = Package::where('package_id', $id)->update(array('package_status' => $status));
		if ($result) {
			return back()->with('success', 'Package status changed successful');
		} else {
			return back()->with('warning', 'Some problem occured.');
		}
	}

	public function changePackageHomeView($view, $id)
	{
		//echo $view; die;
		$result = Package::where('package_id', $id)->update(array('home_view' => $view));
		if ($result) {
			return back()->with('success', 'Package Home View changed successful');
		} else {
			return back()->with('warning', 'Some problem occured.');
		}
	}
	public function updatePackage($id)
	{

		$user = Auth::guard('admins')->user();
		if ($user->role['role'] != 'Super Admin') {
			return back()->with('success', 'You dont have acess to edit.');
		}

		$package = new Package;
		$package_data = $package->where('package_id', $id)->get()->toArray();
		return view('admin.package.editpackage', ['package' => $package_data]);
	}
	public function editPackage(Request $request)
	{
		if(isset($request->package_type) && $request->package_type == 'Music'){
			$request->pacage_size = null;
        }
		$this->validate($request, [
			'package_name' => 'required',
			'package_price' => 'required',
			'package_description' => 'required',
			'package_products_count' => 'required',
			'package_type' => 'required',
            'package_expiry' => 'required_without_all:package_expiry_year',
            'package_expiry_year' => 'required_without_all:package_expiry',
		]);
		$update_array = array(
			'package_plan' => $request->package_plan, 'package_name' => $request->package_name,
			'package_price' => $request->package_price,
			'package_description' => $request->package_description,
			'package_products_count' => $request->package_products_count,
			'package_type' => $request->package_type,
			'package_expiry' => $request->package_expiry,
			'package_permonth_download' => $request->package_month_count,
			'package_pcarry_forward' => $request->products_carry_forward,
			'package_expiry_yearly' => $request->package_expiry_year,
			'pacage_size' => $request->pacage_size,
			'updated_at' => date('Y-m-d H:i:s'),
			'footage_tier' => $request->footage_tier,
			'display_for' => $request->display_for,
			'package_status' => $request->package_status
		);
		$result = Package::where('package_id', $request->package_id)->update($update_array);
		if ($result) {
			return back()->with('success', 'Package updated successfully');
		} else {
			return back()->with('warning', 'Some problem occured.');
		}
	}
	public function deletePackage($id)
	{
		$del_result = Package::find($id)->delete();
		if ($del_result) {
			return back()->with('success', 'Package deleated successfully');
		} else {
			return back()->with('warning', 'Some problem occured.');
		}
	}

	public function plans(Request $request)
	{
		$data = $request->all();
		$month = 1; // use as default monthly value
		if ($data['product_dur'] == 'quarterly') {
			$month = 3;
		}
		if ($data['product_dur'] == 'half_yearly') {
			$month = 6;
		}
		if (count($data) > 0) {
			if ($data['quotation_type'] == 'download') {
				$package = Package::where('package_plan', '1');
				if ($data['prod_type'] == 'foot') {
					$package->where('package_type', '=', 'Footage');
				} else {
					$package->where('package_type', '=', 'Image');
				}
			} else {
				$package = Package::where('package_plan', '2');
				$package->where('package_type', '=', 'Image');
				if ($data['product_dur'] == 'annual') {
					$package->where('package_expiry_yearly', '=', '1');
				} else if ($month > 1) {
					// if quarterly or half_yearly than match months records
					$package->where('package_expiry', '=', $month);
				} else {
					// else any number of months records
					$package->where('package_expiry', '>', 0)->whereNotIn('package_expiry', [3, 6]);
				}
			}
		}
		$all_package_list = $package->select('package_id', 'package_name', 'package_description', 'package_price', 'package_expiry', 'footage_tier')
			->where(function ($query) {
				$query->where('display_for', 2)
					->orWhere('display_for', 3);
			})
			->where('package_status', '=', 'Active')
			->get()
			->toArray();
		if (count($all_package_list) > 0) {
			echo json_encode(["status" => "success", 'data' => $all_package_list]);
		} else {
			echo json_encode(["status" => "fail", 'data' => '']);
		}
	}
}
