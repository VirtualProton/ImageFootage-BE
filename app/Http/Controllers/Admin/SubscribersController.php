<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserPackage;
use Auth;
use Carbon\Carbon;

class SubscribersController extends Controller
{
    private function resolveExpiryExtensionDays(Request $request)
    {
        if ($request->filled('extended_date')) {
            return (int) $request->extended_date;
        }

        $option = trim((string) $request->input('extend_expiry_option', ''));
        if (in_array($option, ['15', '30', '45', '60'], true)) {
            return (int) $option;
        }

        if ($option === 'custom' && $request->filled('custom_days')) {
            return (int) $request->custom_days;
        }

        return 0;
    }

    private function resolveCurrentExpiryDate(UserPackage $userPackage)
    {
        $currentExpiryDate = $userPackage->resolveEffectiveExpiryDate();

        return $currentExpiryDate ? $currentExpiryDate->startOfDay() : null;
    }

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

    public function subscribers_details($id){
        $userlist = User::select('id', 'first_name', 'last_name', 'title', 'user_name', 'email', 'mobile', 'phone', 'postal_code', 'city', 'state', 'country')->with('country')
            ->with('state')
            ->where('id',$id)
            ->with('city')
            ->with(['plans' => function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success'])
                    ->with('downloads');
            }
            ])->whereHas("plans", function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success']);
            })->first()->toArray();
            return view('admin.subscribers.subscribers_details', compact('userlist'));
    }

    public function editExpireDate(Request $request, $id) {

        $UserPackage = UserPackage::findOrFail($id);

        $user = Auth::guard('admins')->user();
        if($user->role['role'] !='Super Admin'){
          return back()->with('success','You dont have acess to edit.');
        }

        return view('admin.subscribers.update_expired_date', compact('UserPackage'));
    }

    public function updateExpiredDate(Request $request) {
        $user = Auth::guard('admins')->user();
        if (!$user || !in_array((int) $user->role_id, config('constants.SUPER_ADMIN_ROLE_ID', []), true)) {
            return back()->with('error', 'You do not have access to update expiry.');
        }

        if ((string) $request->input('reset_extended_expiry') === '1') {
            $UserPackage = UserPackage::findOrFail($request->user_transaction_id);

            if (empty($UserPackage->package_extended_expiry_data)) {
                return back()->with('warning', 'No extended expiry date found to reset.');
            }

            $UserPackage->update([
                'package_extended_expiry_data' => null,
            ]);

            return back()->with('success', 'Extended expiry date reset successfully.');
        }

        $daysToExtend = $this->resolveExpiryExtensionDays($request);
        if ($daysToExtend <= 0) {
            return back()->withErrors([
                'extend_expiry_option' => 'Please select valid expiry extension days.',
            ])->withInput();
        }

        $UserPackage = UserPackage::findOrFail($request->user_transaction_id);
        $currentExpiryDate = $this->resolveCurrentExpiryDate($UserPackage);

        if ($currentExpiryDate === null) {
            return back()->withErrors([
                'extend_expiry_option' => 'Current expiry date is not available for this package.',
            ])->withInput();
        }

        $newExpiryDate = $currentExpiryDate->copy()->addDays($daysToExtend);

        $UserPackage->update([
            'package_extended_expiry_data' => $newExpiryDate->format('Y-m-d'),
        ]);

        return back()->with('success','Package expiry date updated successfully.');
    }

}
