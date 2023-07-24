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
        $this->middleware('admin')->except('login','logout');
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
        $userlist=$this->User->getUserData();
        return view('admin.user.index',compact('userlist'));
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
        $accountlist=$this->Admin->getAgentData();
        return view('admin.user.create', compact('title','countries','accountlist'));
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

        
        // return back()
        // ->withInput();
        // ->withErrors(['name.required', 'Name is required']);


        $title = "Add Lead/User/Account";
        $countries = $this->Country->getcountrylist();
        $this->Admin = new Admin();
        $accountlist=$this->Admin->getAgentData();
        $user = User::where('email', $request['email'])->get()->toArray();
        //$user['id'] = $user[0]['id'];
        //$user['email'] = $user[0]['email'];
        // print_r($user); die;
        if(!empty($user)){
            return view('admin.user.create', compact('title','countries','accountlist', 'user'));
        }
        
            $data['email'] = $request->email;
            $data['name'] = $request->first_name.' '.$request->last_name;
            $data['text'] ="You are added as a client.";
            $this->sendmail($data);
        if($this->User->save_user($request)){

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
        $account_data =    $this->Account->getAccountDataForShow($id);
      
        return view('admin.account.show', compact('title','account_data'));
    }

    public function invoices($id)
    {
        $title = "Show Invoices";

        $user_id = $id;
        $user = User::find($id);
       // dd($user);
        $this->Account = new Account();
        $this->Admin = new Admin();
        if(!empty($user->account_manager_id)){
            $account_manager = $this->Admin->getAgentData($user->account_manager_id);
            $account_manager_name = $account_manager['name'];
        }else{
            $account_manager_name = "";
        }
        $city_name = '';
        $state_name = '';
        $country_name = '';
        if(!empty($user->city)) {
            $city = City::where('id', $user->city)->first();
            $city_name = $city['name'];
            $state = State::where('id', $user->state)->first();
            $state_name = $state['state'];
            $country = Country::where('id', $user->country)->first();
            $country_name = $country['name'];
        }
        
        $user_plans = $this->User->userPlans($user_id);
      
        $userPlanslist = User::select('id', 'first_name', 'last_name', 'title', 'user_name', 'email', 'mobile', 'phone', 'postal_code', 'city', 'state', 'country', 'company')->with('country')
            ->with('state')
            ->with('city')
            ->where('id', $user_id)
            ->with('orders')//i added this to include orders
            ->with(['plans' => function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success'])
                    ->with('downloads');
            }
            ])->whereHas("plans", function ($query) {
                $query->whereIn('payment_status', ['Completed', 'Transction Success']);
            })->get()->toArray();

          // echo "<pre>"; print_r($userPlanslist); die;

        $agentlist=$this->Account->getAccountData();
        $comments = Comment::where('user_id', $user_id)->with('agent')->with('admin')->orderBy('id', 'desc')->limit(50)->get()->toArray();
        
        $account_quotations = Invoice::with('items')
                    ->select('imagefootage_performa_invoices.*', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description', 'calcelled_user.id as calcelled_user_id', 'calcelled_user.first_name as calcelled_user_first_name', 'calcelled_user.last_name as calcelled_user_last_name') 
                    ->leftJoin('imagefootage_user_package', 'imagefootage_user_package.id', '=', 'imagefootage_performa_invoices.package_id')
                    ->join('imagefootage_users','imagefootage_users.id','=','imagefootage_performa_invoices.user_id')
                    ->leftJoin('imagefootage_users as calcelled_user','calcelled_user.id','=','imagefootage_performa_invoices.cancelled_by')
                    ->where('imagefootage_performa_invoices.user_id','=', $id)
                    ->where('imagefootage_performa_invoices.proforma_type', '=', '1')
                    ->orderBy('imagefootage_performa_invoices.id', 'desc')
                    ->simplePaginate('10');
        $account_invoices = Invoice::with('items')
                    ->select('imagefootage_performa_invoices.*', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description') 
                    ->leftJoin('imagefootage_user_package', 'imagefootage_user_package.id', '=', 'imagefootage_performa_invoices.package_id')
                    ->join('imagefootage_users','imagefootage_users.id','=','imagefootage_performa_invoices.user_id')
                    ->where('imagefootage_performa_invoices.user_id','=', $id)
                    ->where('imagefootage_performa_invoices.proforma_type', '=', '2')
                    ->orderBy('imagefootage_performa_invoices.id', 'desc')
                    ->simplePaginate('10');
           
        $this->Country = new Country();
        $countries = $this->Country->getcountrylist();
        $this->User = new User();
        $user_data =    $this->User->getUserData($user_id);
        $states = $this->Country->getState('country_id',$user_data['country'] ?? '');
        $cities = $this->Country->getCity('state_id',$user_data['state'] ?? '');
        
        $this->UserInfo = new UserInfo();
        $user_info =    $this->UserInfo->getUserInfo($user_id);
        if($user_info == null){
            $user_info = [];
        }

        $descriptions = Description::where('user_id', $user_id)->orderBy('id', 'desc')->limit(50)->get()->toArray();
           // dd($description);
           $active_tab = "tab1";
        return view('admin.account.invoices', compact('title','user_id', 'user', 'account_manager_name', 'city_name', 'state_name', 'country_name', 'user_plans', 'userPlanslist', 'agentlist', 'comments','user_data','states','countries','cities','user_info','descriptions','active_tab'))->with('account_invoices', $account_invoices)->with('account_quotations', $account_quotations);
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
        if($user->role['role'] != 'Super Admin'){
          return back()->with('success','You dont have acess to edit.');
        }
        $title = "Edit Lead/User/Contact";

        $countries = $this->Country->getcountrylist();
        // $accountlist=$this->Account->getAccountData();
        $this->Admin = new Admin();
        $accountlist=$this->Admin->getAgentData();
        $user_data =    $this->User->getUserData($id);
        $states = $this->Country->getState('country_id',$user_data['country']);
        $cities = $this->Country->getCity('state_id',$user_data['state']);
        return view('admin.user.edit', compact('title','countries','user_data','states','cities','accountlist'));

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
            'email' => 'required|email|unique:imagefootage_users,email,'.$id,

        ]);
        if($this->User->update_user($request,$id)){
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
    public function status($type,$id)
    {
        $title = "Change Status User";
        if($this->User->change_status($type,$id)){
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
        $userlist=$this->User->getNewRegistrants();
        return view('admin.user.newregistrants',compact('userlist'));
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

        $userCart = Usercart::with('product')->with('user')->where('cart_added_on', '>',$formatted_date)->get()->toArray();
        //Usercart::where('cart_added_on', '2020-10-05 16:20:23.000000')->with('product')->get()->toArray();

       
        // echo "<pre>"; print_r($userlist); die;
        return view('admin.user.usercart',compact('userlist'));
    }


    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function abandoned_cart()
    {
        $user = Auth::guard('admins')->user();
        $userState = $user->state;
        // print_r($user->state); echo "<br>";

        // echo "hi"; die;
        date_default_timezone_set('Asia/Kolkata');
        $userlist=$this->User->getUserData();
        $date = new \DateTime();
        $date->modify('-60 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        //echo $formatted_date; die;

        // $userCart = Usercart::with('product')->with('user')->where('cart_added_on', '>',$formatted_date)->get()->groupBy('cart_added_by')->toArray();
        $userCart = Usercart::with('product')->with('user')->where('cart_added_on', '>',$formatted_date)->get()->toArray();
        //Usercart::where('cart_added_on', '2020-10-05 16:20:23.000000')->with('product')->get()->toArray();
        if($user->department['department'] == 'Sales'){

            // Usercart::where('cart_added_on', '>',$formatted_date)
            //   ->with('user', function ($query) {
            //       $query->where('state','=','3');
            //   })
            //   ->with('product')
            //   ->get(); 

              $userCart = Usercart::whereHas('user', function($q) use($userState){
              $q->where('state', $userState);
              })
              ->where('cart_added_on', '>',$formatted_date)
              ->with('product')
              ->with('user')
              ->get()
              ->toArray();
          
        }

        // echo "<pre>"; print_r($userCart); die;
        return view('admin.user.abandonedcart',compact('userCart'));
        // echo "<pre>"; print_r($userlist); die;
        //return view('admin.user.usercart',compact('userlist'));
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function changeAbandonedCartStatus(Request $request, $id)
    {
        // print_r($request->status); die;

        $status = $request->status;
        DB::table('imagefootage_usercart')
            ->where('cart_id', $id)
            ->update(['status' => $status]);

            return redirect("admin/abandoned_cart")->with("success", "Abandoned Cart is updated successfully !!!");
        // $cart_data = Usercart::where('cart_id', $id)->get()->toArray();
        // $cart_data['status'] = $status;
        // $cart_data->update();

       // echo "<pre>"; print_r($cart_data); die;


    }
    
    public function newClientSales(){

        $user = Auth::guard('admins')->user();
        $userState = $user->state;
      // $orders = Orders::all()->unique('user_id')->toArray();

        // $orders = DB::table('imagefootage_orders')
        //          ->select('*', DB::raw('count(*) as total'))
        //          // ->select('*')
        //          ->groupBy('user_id')
        //          ->where(DB::raw('count(*) as total'),1)
        //          ->get();

        $orders1 = Orders::with('user')->groupBy('user_id')->havingRaw('COUNT(*) = 1')->get()->toArray();

        $orders2 = UserPackage::with('user')->groupBy('user_id')->havingRaw('COUNT(*) = 1')->get()->toArray();

        if($user->department['department'] == 'Sales'){ 

              $orders1 = Orders::whereHas('user', function($q) use($userState){
              $q->where('state', $userState);
              })
              ->with('user')
              ->groupBy('user_id')->havingRaw('COUNT(*) = 1')
              ->get()
              ->toArray();

              $orders2 = UserPackage::whereHas('user', function($q) use($userState){
              $q->where('state', $userState);
              })
              ->with('user')
              ->groupBy('user_id')->havingRaw('COUNT(*) = 1')
              ->get()
              ->toArray();
          
        }
        // echo "<pre>"; print_r($orders1); die;

        // $orders = array_merge($orders1,$orders2);

        $userlist1 = array();
        foreach($orders1 as $order){
                if(date("Y-m-d", strtotime($order['created_at'])) == date('Y-m-d')){
                    $userlist1[] = $order;
                }

        }

        $userlist2 = array();
        foreach($orders2 as $order){
                if(date("Y-m-d", strtotime($order['created_at'])) == date('Y-m-d')){
                    $userlist2[] = $order;
                }

        }
        return view('admin.user.clientfirstsale',compact('userlist1', 'userlist2'));

    }


    public function sendmail($request)
    {

        $data["email"] = $request['email'];
        $data["text"] =  $request['text'];
        //print_r($data); die;
        // $data["subject"]=$request->get("subject");
        ini_set('max_execution_time', 0);
        //$data["email"]="amitpathak.bansal@gmail.com";
        //$data["client_name"]="Test email";
        $data["subject"] = "Registration Email";

        // $pdf = PDF::loadHTML($data["text"]);

        try {
            Mail::send('registrationemail', $data, function ($message) use ($data) {
              // echo "<pre>";print_r($data); die;
                $message->to($data["email"])
                    ->subject($data["subject"])
                    ->from('admin@imagefootage.com', 'Imagefootage');
                    // ->attachData($pdf->output(), "invoice.pdf");
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

    public function updateUser(Request $request){
        if (isset($_POST['updatebtn'])) { 
       
     //  dd( $request);
       $this->validate($request, [
        'user_name' => 'required',
        'user_last_name' => 'required',
        'user_email' => 'required'
    ], [
        'user_name.required' => 'The First Name field is required.',
        'user_last_name.required' => 'The Last Name field is required.',
        'user_email.required' => 'The Email field is required.'
    ]);
    try {
            $update_array=array('first_name'=>$request->user_name,
                                'last_name'=>$request->user_last_name,
                                'email'=>$request->user_email,
                                'company' => $request->user_company,
                                'occupation' => $request->user_occupation,
                                'address'=>$request->user_address,
                                'phone'=>$request->user_phone,
                                'gst'=>$request->user_gst,
                                'pan'=>$request->user_pan,
                                'description'=>$request->user_client_des
                            );
                $userinfo = UserInfo::where('user_id', '=', $request->user_id)->first();
                if ($userinfo === null) {
                        $userinfo=new UserInfo;
                        $userinfo->partner =$request->user_partner;
                        $userinfo->whitelist=$request->user_whitelist;
                        $userinfo->blacklist=$request->user_blacklist;
                        $userinfo->frozen=$request->user_checkout_frozen;
                        $userinfo->allow_certi=$request->user_allow_certi;
                        $userinfo->enable_subs_multi=$request->user_enable_subs_multi;
                        $userinfo->preferred_contact_method=$request->user_preferred_contact_method;
                        $userinfo->user_id=$request->user_id;
                        $userinfo->save();
            }
            $description = Description::where('user_id', '=', $request->user_id)->where('description',$request->user_client_des)->first();
            if ($description === null) {
                $description=new Description;
                    $description->user_id=$request->user_id;
                    $description->description=$request->user_client_des;
                    $description->save();
            }   
            User::where('id',$request->user_id)->update($update_array);
                return redirect('admin/users')->with('success','Users updated successful');
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
            return back()->with('warning','Some problem occured.');
            
        }
        else{
            echo "error1"; die();
        }
    }
}