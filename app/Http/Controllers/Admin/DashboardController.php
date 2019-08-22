<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function dashboard(){    
        return view('dashboard');
    }
	public function login(){
		return view('adminlogin');
	}
}