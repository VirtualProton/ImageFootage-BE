<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Common;
use App\Models\User;
use Auth;
use DB;

class SubscribersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('login','logout');
    }

    public function index()
    {
        $userlist = User::select('id', 'first_name', 'last_name', 'title', 'user_name', 'email', 'mobile', 'phone', 'postal_code', 'city', 'state', 'country')->with('country')
            ->with('state')
            ->with('city')
            ->with(['plans' => function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success'])
                    ->with('downloads');
            }
            ])->whereHas("plans", function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success']);
            })->get()->toArray();

            return view('admin.subscribers.index', compact('userlist'));
        //return view('admin.orders.orderlist');
    }

    public function getSubscribers()
    {
        $subscriberList = User::select('id', 'first_name', 'last_name', 'title', 'user_name', 'email', 'mobile', 'phone', 'postal_code', 'city', 'state', 'country')->with('country')
            ->with('state')
            ->with('city')
            ->with(['plans' => function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success'])
                    ->with('downloads');
            }
            ])->whereHas("plans", function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success']);
            })->get()->toArray();
        return response()->json($subscriberList);

    }

}
