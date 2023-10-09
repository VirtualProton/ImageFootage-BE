<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use DB;
use Carbon\Carbon;

use App\Models\Country;
use App\Models\Common;
use App\Models\User;
use App\Models\Account;
use App\Models\Admin;
use App\Models\City;
use App\Models\State;
use App\Models\Comment;
use App\Models\Usercart;
use App\Models\Orders;
use App\Models\UserPackage;
use App\Models\Invoice;
use Auth;
use Mail;
use App\Models\UserInfo;
use App\Models\Description;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('login', 'logout');
        $this->Account = new Account();
        $this->Country = new Country();
        $this->User = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userlist = $this->User->getUserData();
        return view('admin.user.index', compact('userlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Lead/User/Account";
        $countries = $this->Country->getcountrylist();
        $this->Admin = new Admin();
        $accountlist = $this->Admin->getAgentData();
        return view('admin.user.create', compact('title', 'countries', 'accountlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:imagefootage_users|max:255',
        ]);

        $title = "Add Lead/User/Account";
        $countries = $this->Country->getcountrylist();
        $this->Admin = new Admin();
        $accountlist = $this->Admin->getAgentData();
        $user = User::where('email', $request['email'])->get()->toArray();
        if (!empty($user)) {
            return view('admin.user.create', compact('title', 'countries', 'accountlist', 'user'));
        }

        $data['email'] = $request->email;
        $data['name'] = $request->first_name . ' ' . $request->last_name;
        $data['text'] = "You are added as a client.";
        $this->sendmail($data);
        if ($this->User->save_user($request)) {

            return redirect("admin/users")->with("success", "Laed/User/Contact has been created successfully !!!");
        } else {
            return redirect("admin/users/create")->with("error", "Due to some error, Laed/User/Contact is not registered yet. Please try again!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Show User";
        $this->Account = new Account();
        $account_data = $this->Account->getAccountDataForShow($id);

        return view('admin.account.show', compact('title', 'account_data'));
    }

    public function invoices($id)
    {
        $title = "Show Invoices";

        $user_id = $id;
        $user = User::find($id);
        $this->Account = new Account();
        $this->Admin = new Admin();
        if (!empty($user->account_manager_id)) {
            $account_manager = $this->Admin->getAgentData($user->account_manager_id);
            $account_manager_name = $account_manager['name'];
        } else {
            $account_manager_name = "";
        }
        $city_name = '';
        $state_name = '';
        $country_name = '';
        if (!empty($user->city)) {
            $city = City::where('id', $user->city)->first();
            $city_name = $city['name'];
        }
        if (!empty($user->state)) {
            $state = State::where('id', $user->state)->first();
            $state_name = $state['state'];
        }
        if (!empty($user->country)) {
            $country = Country::where('id', $user->country)->first();
            $country_name = $country['name'];
        }

        $user_plans = $this->User->userPlans($user_id);

        $userPlanslist = User::select('id', 'first_name', 'last_name', 'title', 'user_name', 'email', 'mobile', 'phone', 'postal_code', 'city', 'state', 'country', 'company')->with('country')
            ->with('state')
            ->with('city')
            ->where('id', $user_id)
            ->with('orders')
            ->with([
                'plans' => function ($query) {
                    $query->whereIn('payment_status', ['Completed', 'Transction Success'])
                        ->with('downloads');
                }
            ])->whereHas("plans", function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success']);
            })->get()->toArray();

        $agentlist = $this->Account->getAccountData();
        $comments = Comment::where('user_id', $user_id)->with('agent')->with('admin')->orderBy('id', 'desc')->limit(50)->get()->toArray();
        $get_quotations = Invoice::with('items')
            ->select('imagefootage_performa_invoices.*', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description', 'calcelled_user.id as calcelled_user_id', 'calcelled_user.name as calcelled_user_name')
            ->leftJoin('imagefootage_user_package', 'imagefootage_user_package.id', '=', 'imagefootage_performa_invoices.package_id')
            ->join('imagefootage_users', 'imagefootage_users.id', '=', 'imagefootage_performa_invoices.user_id')
            ->leftJoin('imagefootage_admins as calcelled_user', 'calcelled_user.id', '=', 'imagefootage_performa_invoices.cancelled_by')
            ->where('imagefootage_performa_invoices.user_id', '=', $id)
            ->where('imagefootage_performa_invoices.proforma_type', '=', '1');
        $get_quotations2 = clone $get_quotations;
        $get_quotations3 = clone $get_quotations;
        $get_quotations4 = clone $get_quotations;
        $account_quotations = $get_quotations->orderBy('imagefootage_performa_invoices.id', 'desc')->simplePaginate('10');
        $account_download_pack_quotations = $get_quotations->where('invoice_type', '=', 2)->orderBy('imagefootage_performa_invoices.id', 'desc')->simplePaginate('10', ['*'], 'dq');
        $account_subscription_quotations = $get_quotations2->where('invoice_type', '=', 1)->orderBy('imagefootage_performa_invoices.id', 'desc')->simplePaginate('10', ['*'], 'sq');
        $account_custom_quotations = $get_quotations3->where('invoice_type', '=', 3)->where('flag', 0)->orderBy('imagefootage_performa_invoices.id', 'desc')->simplePaginate('10', ['*'], 'cq');
        $account_custom_quotations2 = $get_quotations4->where('invoice_type', '=', 3)->where('flag', 2)->orderBy('imagefootage_performa_invoices.id', 'desc')->simplePaginate('10', ['*'], 'oq');

        $get_invoices = Invoice::with('items')
            ->select('imagefootage_performa_invoices.*', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description')
            ->leftJoin('imagefootage_user_package', 'imagefootage_user_package.id', '=', 'imagefootage_performa_invoices.package_id')
            ->join('imagefootage_users', 'imagefootage_users.id', '=', 'imagefootage_performa_invoices.user_id')
            ->where('imagefootage_performa_invoices.user_id', '=', $id)
            ->where('imagefootage_performa_invoices.proforma_type', '=', '2');
        $get_invoices2 = clone $get_invoices;
        $get_invoices3 = clone $get_invoices;
        $get_invoices4 = clone $get_invoices;
        $account_invoices = $get_invoices->orderBy('imagefootage_performa_invoices.id', 'desc')->simplePaginate('10');
        $account_download_pack_invoices = $get_invoices->orderBy('imagefootage_performa_invoices.id', 'desc')->where('invoice_type', '=', 2)->simplePaginate('10', ['*'], 'di');
        $account_subscriptions_invoices = $get_invoices2->orderBy('imagefootage_performa_invoices.id', 'desc')->where('invoice_type', '=', 1)->simplePaginate('10', ['*'], 'si');
        $account_custom_invoices = $get_invoices3->orderBy('imagefootage_performa_invoices.id', 'desc')->where('invoice_type', '=', 3)->where('flag', 0)->simplePaginate('10', ['*'], 'ci');
        $account_custom_invoices2 = $get_invoices4->orderBy('imagefootage_performa_invoices.id', 'desc')->where('invoice_type', '=', 3)->where('flag', 2)->simplePaginate('10', ['*'], 'oi');


        $this->Country = new Country();
        $countries = $this->Country->getcountrylist();
        $this->User = new User();
        $user_data = $this->User->getUserData($user_id);
        $states = $this->Country->getState('country_id', $user_data['country'] ?? '');
        $cities = $this->Country->getCity('state_id', $user_data['state'] ?? '');

        $this->UserInfo = new UserInfo();
        $user_info =    $this->UserInfo->getUserInfo($user_id);
        if ($user_info == null) {
            $user_info = [];
        }

        $descriptions = Description::where('user_id', $user_id)->orderBy('id', 'desc')->limit(50)->get()->toArray();
        $active_tab = "tab1";
        $active_nested_tab = "active_plans";

        $data['active_subscription_plans'] = UserPackage::leftjoin('imagefootage_packages', function ($join) {
            $join->on('imagefootage_user_package.package_id', '=', 'imagefootage_packages.package_id');
        })->select('id', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description', 'imagefootage_user_package.package_price', 'imagefootage_user_package.package_permonth_download', 'imagefootage_user_package.downloaded_product', 'imagefootage_user_package.package_type')->where('imagefootage_user_package.user_id', $user_id)->where('imagefootage_user_package.package_plan', 2)->whereIn('payment_status', ['Completed', 'Transction Success'])->where('package_expiry_date_from_purchage', '>', Now())->where('imagefootage_user_package.status', 1)->orderBy('id', 'desc')->simplePaginate('10');
        $data['active_download_plans'] = UserPackage::leftjoin('imagefootage_packages', function ($join) {
            $join->on('imagefootage_user_package.package_id', '=', 'imagefootage_packages.package_id');
        })->select('id', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description', 'imagefootage_user_package.package_price', 'imagefootage_user_package.package_permonth_download', 'imagefootage_user_package.downloaded_product', 'imagefootage_user_package.package_type')->where('imagefootage_user_package.user_id', $user_id)->whereIn('payment_status', ['Completed', 'Transction Success'])->where('package_expiry_date_from_purchage', '>', Now())->where('imagefootage_user_package.package_plan', 1)->where('imagefootage_user_package.status', 1)->orderBy('id', 'desc')->simplePaginate('10');

        return view('admin.account.invoices', compact('title', 'user_id', 'user', 'account_manager_name', 'city_name', 'state_name', 'country_name', 'user_plans', 'userPlanslist', 'agentlist', 'comments', 'user_data', 'states', 'countries', 'cities', 'user_info', 'descriptions', 'active_tab', 'active_nested_tab'))
            ->with('account_invoices', $account_invoices)->with('account_quotations', $account_quotations)
            ->with('account_download_pack_quotations', $account_download_pack_quotations)
            ->with('account_download_pack_invoices', $account_download_pack_invoices)
            ->with('account_subscription_quotations', $account_subscription_quotations)
            ->with('account_subscriptions_invoices', $account_subscriptions_invoices)
            ->with('account_custom_quotations', $account_custom_quotations)
            ->with('account_custom_invoices', $account_custom_invoices)
            ->with('account_custom_quotations2', $account_custom_quotations2)
            ->with('account_custom_invoices2', $account_custom_invoices2)
            ->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::guard('admins')->user();
        if ($user->role['role'] != 'Super Admin') {
            return back()->with('success', 'You dont have acess to edit.');
        }
        $title = "Edit Lead/User/Contact";

        $countries = $this->Country->getcountrylist();
        $this->Admin = new Admin();
        $accountlist = $this->Admin->getAgentData();
        $user_data =    $this->User->getUserData($id);
        $states = $this->Country->getState('country_id', $user_data['country']);
        $cities = $this->Country->getCity('state_id', $user_data['state']);
        return view('admin.user.edit', compact('title', 'countries', 'user_data', 'states', 'cities', 'accountlist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_data = $this->User->getUserData($id);
        $this->validate($request, [
            'email' => 'required|email|unique:imagefootage_users,email,' . $id,

        ]);
        if ($this->User->update_user($request, $id)) {
            return redirect("admin/users")->with("success", "Account has been updated successfully !!!");
        } else {
            return redirect("admin/users/$id/edit")->with("error", "Due to some error, Account is not updated yet. Please try again!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delagent = User::find($id);
        $delagent->delete();
        return redirect('admin/users')->with('success', 'Successfully deleted the admin/agent!');
    }

    /**
     * Changing the status of subadmin user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($type, $id)
    {
        $title = "Change Status User";
        if ($this->User->change_status($type, $id)) {
            return redirect("admin/users")->with("success", "User status has been changed successfully !!!");
        } else {
            return redirect("admin/users")->with("error", "Due to some error, User status is not changed yet. Please try again!");
        }
    }


    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function newRegistrants()
    {
        $userlist = $this->User->getNewRegistrants();
        return view('admin.user.newregistrants', compact('userlist'));
    }


    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function userCart()
    {
        $date = new \DateTime();
        $date->modify('-1 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');

        $userCart = Usercart::with('product')->with('user')->where('cart_added_on', '>', $formatted_date)->get()->toArray();
        return view('admin.user.usercart', compact('userlist'));
    }


    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function abandoned_cart(Request $request)
    {
        $user = Auth::guard('admins')->user();
        $userState = $user->state;

        $userlist = $this->User->getUserData();
        $date = new \DateTime();
        $formatted_date1 = $date->format('Y-m-d H:i:s');

        if ($request->hours > 0) {
            $date->modify("-{$request->hours} hours");
        }
        if ($request->minutes > 0) {
            $date->modify("-{$request->minutes} minutes");
        }
        if (!$request->hours && !$request->minutes) {
            $date->modify("-60 minutes");
        }

        $formatted_date = $date->format('Y-m-d H:i:s');

        $userCart = Usercart::with('product')->with('user')->where('cart_added_on', '>', $formatted_date)->get()->toArray();
        if ($user->department['department'] == 'Sales') {
            $userCart = Usercart::whereHas('user', function ($q) use ($userState) {
                $q->where('state', $userState);
            })
                ->where('cart_added_on', '>', $formatted_date)
                ->with('product')
                ->with('user')
                ->get()
                ->toArray();
        }

        return view('admin.user.abandonedcart', compact('userCart'));
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function changeAbandonedCartStatus(Request $request, $id)
    {
        $status = $request->status;
        DB::table('imagefootage_usercart')
            ->where('cart_id', $id)
            ->update(['status' => $status]);

        return redirect("admin/abandoned_cart")->with("success", "Abandoned Cart is updated successfully !!!");
    }

    public function newClientSales()
    {

        $user = Auth::guard('admins')->user();
        $userState = $user->state;
        $orders1 = Orders::with('user')->groupBy('user_id')->havingRaw('COUNT(*) = 1')->get()->toArray();
        $orders2 = UserPackage::with('user')->groupBy('user_id')->havingRaw('COUNT(*) = 1')->get()->toArray();

        if ($user->department['department'] == 'Sales') {
            $orders1 = Orders::whereHas('user', function ($q) use ($userState) {
                $q->where('state', $userState);
            })
                ->with('user')
                ->groupBy('user_id')->havingRaw('COUNT(*) = 1')
                ->get()
                ->toArray();

            $orders2 = UserPackage::whereHas('user', function ($q) use ($userState) {
                $q->where('state', $userState);
            })
                ->with('user')
                ->groupBy('user_id')->havingRaw('COUNT(*) = 1')
                ->get()
                ->toArray();
        }
        $userlist1 = array();
        foreach ($orders1 as $order) {
            if (date("Y-m-d", strtotime($order['created_at'])) == date('Y-m-d')) {
                $userlist1[] = $order;
            }
        }

        $userlist2 = array();
        foreach ($orders2 as $order) {
            if (date("Y-m-d", strtotime($order['created_at'])) == date('Y-m-d')) {
                $userlist2[] = $order;
            }
        }
        return view('admin.user.clientfirstsale', compact('userlist1', 'userlist2'));
    }


    public function sendmail($request)
    {

        $data["email"] = $request['email'];
        $data["text"] =  $request['text'];
        ini_set('max_execution_time', 0);
        $data["subject"]        = "Registration Email";
        $front_end_url_name     = config('app.front_end_url');
        $frontend_name          = explode('//', rtrim($front_end_url_name, '/#/'));
        $data["frontend_name"]  = $frontend_name[1] ?? '';

        try {
            Mail::send('registrationemail', $data, function ($message) use ($data) {
                $message->to($data["email"])
                    ->subject($data["subject"])
                    ->from('admin@imagefootage.com', 'Imagefootage');
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        } else {

            $this->statusdesc  =   "Email sent Succesfully";
            $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
    }

    public function updateUser(Request $request)
    {
        if (isset($_POST['updatebtn'])) {
            $this->validate($request, [
                'user_name' => 'required',
                'user_email' => 'required'
            ], [
                'user_name.required' => 'The First Name field is required.',
                'user_email.required' => 'The Email field is required.'
            ]);
            try {
                $update_array = array(
                    'first_name' => $request->user_name,
                    'last_name' => $request->user_last_name,
                    'email' => $request->user_email,
                    'company' => $request->user_company,
                    'occupation' => $request->user_occupation,
                    'address' => $request->user_address,
                    'address2' => $request->user_address2,
                    'phone' => $request->user_phone,
                    'gst' => $request->user_gst,
                    'pan' => $request->user_pan,
                    'description' => $request->user_client_des,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city
                );
                $userinfo = UserInfo::where('user_id', '=', $request->user_id)->first();
                if ($userinfo === null) {
                    $userinfo = new UserInfo;
                    $userinfo->partner = $request->user_partner;
                    $userinfo->whitelist = $request->user_whitelist;
                    $userinfo->blacklist = $request->user_blacklist;
                    $userinfo->frozen = $request->user_checkout_frozen;
                    $userinfo->allow_certi = $request->user_allow_certi;
                    $userinfo->enable_subs_multi = $request->user_enable_subs_multi;
                    $userinfo->preferred_contact_method = $request->user_preferred_contact_method;
                    $userinfo->user_id = $request->user_id;
                    $userinfo->save();
                }
                $description = Description::where('user_id', '=', $request->user_id)->where('description', $request->user_client_des)->first();
                if (!empty($request->user_client_des) && empty($description)) {
                    $description = new Description;
                    $description->user_id = $request->user_id;
                    $description->description = $request->user_client_des;
                    $description->save();
                }
                User::where('id', $request->user_id)->update($update_array);
                return redirect('admin/users')->with('success', 'User updated successfully.');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return back()->with('error', 'Some problem occured.');
            }
            return back()->with('error', 'Some problem occured.');
        } else {
            return back()->with('error', 'Some problem occured.');
        }
    }
}
