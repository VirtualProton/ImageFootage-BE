<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
{


   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $guard = Auth::guard('admins');
        $user = $guard->user();
        if ($user && $user->admin_status === 'A') {
            return $next($request);
        }
        if ($user) {
            $guard->logout();
        }
        return redirect('/admin/login');
   }
}
