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
        // echo "<pre>"; print_r($user); die;
        
        $title = "Dashboard";
        $orders = DB::table('imagefootage_orders')
                    // ->where('order_status','=','2')
                    ->get();

        $users = DB::table('imagefootage_users')
                    // ->where('','=','')
                    ->get();

        $products = DB::table('imagefootage_products')
                    // ->where('','=','')
                    ->get();
        $subs = DB::table('imagefootage_user_package')
                    // ->where('','=','')
                    ->groupBy('user_id')
                    ->get();
        $subspercentage = (count($subs)*100)/count($users);

        // $comments = Comment::Where('agent_id', )

        // print_r(count($subs)); die;

        $data['orders'] = $orders;
        $data['products'] = $products;
        $data['users'] = $users;
        $data['subspercentage'] = $subspercentage;
        return view('admin.dashboard.dashboard', compact('title'), ['data' => $data]);
	}

}
