<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdminUsers;
use Redirect;
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
        $title = "Dashboard";
        return view('admin.dashboard.dashboard', compact('title'));
	}

}
