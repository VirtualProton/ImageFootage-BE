<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Common;
use App\Models\User;
use App\Models\UserPackage;
use Auth;
use DB;
use Carbon\Carbon;
use PDF;
use Mail;
use App\Mail\InvoiceExtendDate;
use Illuminate\Support\Facades\Storage;

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

        $this->validate($request, [
            'extended_date'=>'required|numeric',
        ]);

        $UserPackage = UserPackage::findOrFail($request->user_transaction_id);

        if($UserPackage->extended_date) {
            $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($UserPackage->extended_date)));
            $new_date = $date->addDays($request->extended_date);
        } else {
            $date = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($UserPackage->package_expiry_date_from_purchage)));
            $new_date = $date->addDays($request->extended_date);
        }

        UserPackage::where('id', $UserPackage->id)->update(['extended_date' => $new_date]);

        // send email and invoice
        $orders = UserPackage::with(['user'=>function($query1){
            $query1->select('id','user_name','first_name','last_name','email','phone','mobile','city','address','postal_code','state','country')
                ->with('country')
                ->with('state')
                ->with('city');
        }])->where('transaction_id',$UserPackage->transaction_id)->first()->toArray();

        if(!Storage::exists('invoice')) {
            Storage::makeDirectory('pdf', 0775, true);
        }

        $fileName = $UserPackage->transaction_id."_web_plan_invoice.pdf";
        $filePath = storage_path("/app/pdf/". $fileName);

        $pdf = PDF::loadHTML(view('email.plan_invoice_old',['orders' => $orders]));

        $pdf->save(storage_path('app/pdf'). '/' . $fileName);

        Mail::to($orders['user']['email'])->send(new InvoiceExtendDate($filePath, $UserPackage->transaction_id, $orders));

        return redirect('admin/subscribers/details/'.$UserPackage->user_id)->with('success','Package Expired Date Successfully Updated');
    }

}
