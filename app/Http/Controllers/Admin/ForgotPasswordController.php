<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
        
          $request->validate([
              'email' => 'required|email',
          ]);
          
          $user = Admin::where('email', $request->email)->first();
          if (!$user) {
              return back()->with('failed', 'Failed! email is not registered.');
          }
         
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
            Mail::send('email.forgotpassword', ["data" => ['token' => $token]], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password')
                ->from('admin@imagefootage.com', 'Imagefootage');
            });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('auth.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
          $user = Admin::where('email', $request->email)->first();
          if (!$user) {
              return back()->with('failed', 'Failed! email is not registered.');
          }
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = Admin::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
          
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/admin/login')->with('message', 'Your password has been changed!');
      }
}
