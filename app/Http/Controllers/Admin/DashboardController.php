<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AdminUsers;
use Redirect;
use DB;
use Auth;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('login','logout');
    }

   public function dashboard(){
        $user = Auth::guard('admins')->user();

        $title = "Dashboard";
        $orders = DB::table('imagefootage_orders')->count();
        $users = DB::table('imagefootage_users')->count();
        $products = DB::table('imagefootage_products')->count();
        $subs = DB::table('imagefootage_user_package') ->groupBy('user_id')->count();
        $subspercentage = ($subs*100)/$users;

        $data['orders'] = $orders;
        $data['products'] = $products;
        $data['users'] = $users;
        $data['subspercentage'] = $subspercentage;
        return view('admin.dashboard.dashboard', compact('title'), ['data' => $data]);
	}

}
