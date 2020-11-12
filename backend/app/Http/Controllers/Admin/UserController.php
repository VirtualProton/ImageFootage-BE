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
use Auth;






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

        return back()
        ->withInput();
        // ->withErrors(['name.required', 'Name is required']);


        $title = "Add Lead/User/Account";
        $countries = $this->Country->getcountrylist();
        $this->Admin = new Admin();
        $accountlist=$this->Admin->getAgentData();
        $user = User::where('email', $request['email'])->get()->toArray();
        //$user['id'] = $user[0]['id'];
        //$user['email'] = $user[0]['email'];
        if(!empty($user)){
            return view('admin.user.create', compact('title','countries','accountlist', 'user'));
        }
        
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
        print_r($account_data); die;
        return view('admin.account.show', compact('title','account_data'));
    }

    public function invoices($id)
    {
        $title = "Show Invoices";

        $user_id = $id;
        $user = User::find($id);
        $this->Account = new Account();
        $this->Admin = new Admin();
        if(!empty($user->account_manager_id)){
            $account_manager = $this->Admin->getAgentData($user->account_manager_id);
            $account_manager_name = $account_manager['name'];
        }else{
            $account_manager_name = "";
        }
        $city = City::where('id', $user->city)->first();
        $city_name = $city['name'];
        $state = State::where('id', $user->state)->first();
        $state_name = $state['state'];
        $country = Country::where('id', $user->country)->first();
        $country_name = $country['name'];
        $user_plans = $this->User->userPlans($user_id);

        $userPlanslist = User::select('id', 'first_name', 'last_name', 'title', 'user_name', 'email', 'mobile', 'phone', 'postal_code', 'city', 'state', 'country')->with('country')
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
        $comments = Comment::where('user_id', $user_id)->with('agent')->with('admin')->get()->toArray();
        DB::enableQueryLog();
        $account_quotations = DB::table('imagefootage_performa_invoices')
                    ->select('imagefootage_performa_invoices.*', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description') 
                    ->leftJoin('imagefootage_user_package', 'imagefootage_user_package.id', '=', 'imagefootage_performa_invoices.package_id')
                    ->join('imagefootage_users','imagefootage_users.id','=','imagefootage_performa_invoices.user_id')
                    ->where('imagefootage_performa_invoices.user_id','=', $id)
                    ->where('imagefootage_performa_invoices.proforma_type', '=', '1')
                    ->orderBy('imagefootage_performa_invoices.id', 'desc')
                    ->simplePaginate('10');
        $account_invoices = DB::table('imagefootage_performa_invoices')
                    ->select('imagefootage_performa_invoices.*', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description') 
                    ->leftJoin('imagefootage_user_package', 'imagefootage_user_package.id', '=', 'imagefootage_performa_invoices.package_id')
                    ->join('imagefootage_users','imagefootage_users.id','=','imagefootage_performa_invoices.user_id')
                    ->where('imagefootage_performa_invoices.user_id','=', $id)
                    ->where('imagefootage_performa_invoices.proforma_type', '=', '2')
                    ->orderBy('imagefootage_performa_invoices.id', 'desc')
                    ->simplePaginate('10');        
        //dd(DB::getQueryLog());                      
        //print_r($account_invoices); die;                     
        return view('admin.account.invoices', compact('title','user_id', 'user', 'account_manager_name', 'city_name', 'state_name', 'country_name', 'user_plans', 'userPlanslist', 'agentlist', 'comments'))->with('account_invoices', $account_invoices)->with('account_quotations', $account_quotations);
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
        if($user->role['role'] !='Super Admin'){
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
        // echo "<pre>"; print_r($userlist); die;
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

        echo "<pre>"; print_r($userCart); die;
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
        // echo "<pre>";print_r($userlist1); 
        // echo "<pre>";print_r($userlist2); die;

        return view('admin.user.clientfirstsale',compact('userlist1', 'userlist2'));

    }
    
}
