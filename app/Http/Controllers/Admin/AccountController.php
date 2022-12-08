<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Common;
use App\Models\Account;
use DB;

class AccountController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('login','logout');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->Account = new Account();
        $accountlist=$this->Account->getAccountData();
        return view('admin.account.index',compact('accountlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Account";
        $this->Country = new Country();
        $this->Common = new Common();
        $countries = $this->Country->getcountrylist();
        $industry_types =$this->Common->getIndustryTypes();
        $curruncies = $this->Common->getCurruncy();
        return view('admin.account.create', compact('title','countries','industry_types','curruncies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->Account = new Account();
        if($this->Account->save_account($request)){
            return redirect("admin/accounts")->with("success", "Account has been created successfully !!!");
        } else {
            return redirect("admin/accounts/create")->with("error", "Due to some error, Account is not registered yet. Please try again!");
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
        $title = "Show Accounts";
        $this->Country = new Country();
        $this->Common = new Common();
        $countries = $this->Country->getcountrylist();

        $industry_types =$this->Common->getIndustryTypes();
        $curruncies = $this->Common->getCurruncy();
        $this->Account = new Account();
        $account_data =    $this->Account->getAccountData($id);
        $states = $this->Country->getState('country_id',$account_data['bill_country']);
        $cities = $this->Country->getCity('state_id',$account_data['bill_state']);
        // return view('admin.account.view', compact('title','account_data'));
        return view('admin.account.view', compact('title','countries','industry_types','curruncies','account_data','states','cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Accounts";
        $this->Country = new Country();
        $this->Common = new Common();
        $countries = $this->Country->getcountrylist();

        $industry_types =$this->Common->getIndustryTypes();
        $curruncies = $this->Common->getCurruncy();
        $this->Account = new Account();
        $account_data =    $this->Account->getAccountData($id);
        $states = $this->Country->getState('country_id',$account_data['bill_country']);
        $cities = $this->Country->getCity('state_id',$account_data['bill_state']);
        return view('admin.account.edit', compact('title','countries','industry_types','curruncies','account_data','states','cities'));

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
         $this->Account = new Account();
        if($this->Account->update_account($request,$id)){
            return redirect("admin/accounts")->with("success", "Account has been updated successfully !!!");
        } else {
            return redirect("admin/accounts/$id/edit")->with("error", "Due to some error, Account is not updated yet. Please try again!");
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
        $delagent = Account::find($id);
        $delagent->delete();
       // redirect
       return redirect('admin/accounts')->with('success', 'Successfully deleted the admin/agent!');

    }

    /**
     * Changing the status of subadmin user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($type,$id)
    {
        $title = "Change Status Account";
        $this->Account = new Account();
        if($this->Account->change_status($type,$id)){
            return redirect("admin/accounts")->with("success", "Account status has been changed successfully !!!");
        } else {
            return redirect("admin/accounts")->with("error", "Due to some error, Account status is not changed yet. Please try again!");
        }
    }


}
