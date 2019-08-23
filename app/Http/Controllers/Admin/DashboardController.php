<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdminUsers;
use Redirect;
class DashboardController extends Controller
{
    public function dashboard(Request $request){
		if($request->session()->has('admin_id')){
			return view('dashboard');	
		}else{
			return redirect('admin');
		}
    }
	public function login(){
		return view('adminlogin');
	}
	public function admin_login_process(Request $request){
		$admin =new AdminUsers;
		$admin_data=$admin->where('admin_email',$request->ademail)->where('admin_password', md5($request->adpassword))->get()->toArray();
		//echo '<pre>';
		//print_r($admin_data);
		if(isset($admin_data[0]) && !empty($admin_data[0])){
			$request->session()->put('admin_id', $admin_data[0]['admin_id']);
			$request->session()->put('admin_name', $admin_data[0]['admin_name']);
			$request->session()->put('admin_email', $admin_data[0]['admin_email']);
			$request->session()->put('admin_mobile', $admin_data[0]['admin_mobile']);
			$request->session()->put('admin_address', $admin_data[0]['admin_address']);
			$request->session()->put('admin_type', $admin_data[0]['admin_type']);
			$request->session()->put('created_at', $admin_data[0]['created_at']);
			$request->session()->put('updated_at', $admin_data[0]['updated_at']);
			return redirect('admin/dashboard');
		}else{
			return redirect('admin');	
		}
		exit();		
	}
	public function logout(Request $request){
		$request->session()->flush();
		if($request->session()->has('admin_id')){
			return redirect('admin/dashboard');
		}else{
			return redirect('admin');
		}
	}
}