<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function login(){
     return view('adminlogin');
    }

    public function authenticate(Request $request)
    {
      $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admins')->attempt($credentials)) {
            // Authentication passed...
           $user = Auth::guard('admins')->user();
           if($user->admin_status=="I"){
            Auth::logout();
            return \Redirect::back()->withWarning( 'You are Not authorised to login access.Please contact with admin !!' );
           }else{
           return redirect()->intended('admin/dashboard');
           }
        }else{
           return \Redirect::back()->withWarning( 'Please enter Correct Username or Password' );
        }

    }

    public function logout(){
        Auth::guard('admins')->logout();
        return redirect()->intended('admin/login');
    }
}
