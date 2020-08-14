<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Common;
use App\Models\User;
use App\Models\Account;
use App\Models\Admin;

use DB;

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
        //dd($userlist);
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
        // $accountlist=$this->Account->getAccountData();
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
        $title = "Add Lead/User/Account";
        $countries = $this->Country->getcountrylist();
        // $accountlist=$this->Account->getAccountData();
                $this->Admin = new Admin();

        $accountlist=$this->Admin->getAgentData();
        $user = User::where('email', $request['email'])->get()->toArray();
        $user['id'] = $user[0]['id'];
        $user['email'] = $user[0]['email'];
        // echo "<pre>";print_r($user[0]['id']); die;
        if(!empty($user)){
           // return redirect("admin/users/create")->with("user", $user[0]['id']); 
            return view('admin.user.create', compact('title','countries','accountlist', 'user'));

        }
        // echo "<pre>"; print_r($user); die;
        $this->validate($request, [
            'email' => 'required|email|unique:imagefootage_users|max:255',

        ]);
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
        $this->Account = new Account();
        $account_invoices =    $this->Account->getAccountInvoices($id);
        $user_id = $id;
        return view('admin.account.invoices', compact('title','account_invoices','user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Lead/User/Contact";

        $countries = $this->Country->getcountrylist();
        $accountlist=$this->Account->getAccountData();
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
        $user_data =    $this->User->getUserData($id);
        // print_r($user_data['email']); die;
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
       // redirect
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


    


}
