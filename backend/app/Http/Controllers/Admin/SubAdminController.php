<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\Department;
use App\Models\Admin;

class SubAdminController extends Controller
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
        $this->Admin = new Admin();
        $agentlist=$this->Admin->getAgentData();
        return view('admin.subadmin.index',compact('agentlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Admin/Agent";
        $roles= Roles::where('status','=','A')->get();
        $deparments= Department::where('status','=','A')->get();
        return view('admin.subadmin.create', compact('title','deparments','roles'));
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
            'department'   => 'required',
            'role' => 'required',
            'name' =>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        $this->Admin = new Admin();
        if($this->Admin->save_admin($request)){
            return redirect("admin/subadmin")->with("success", "Admin/Agent has been created successfully !!!");
        } else {
            return redirect("admin/subadmin/create")->with("error", "Due to some error, Admin/Agent is not registered yet. Please try again!");
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Add Admin/Agent";
        $roles= Roles::where('status','=','A')->get();
        $deparments= Department::where('status','=','A')->get();
        $this->Admin = new Admin();
        $agent_data=$this->Admin->getAgentData($id);
        return view('admin.subadmin.edit', compact('title','deparments','roles','agent_data'));

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

        $this->validate($request, [
            'department'   => 'required',
            'role' => 'required',
            'name' =>'required',
            'email'=>'required|email',
            'password'=>'sometimes|nullable|min:6',
        ]);

        $this->Admin = new Admin();
        if($this->Admin->update_admin($request,$id)){
            return redirect("admin/subadmin")->with("success", "Admin/Agent has been updated successfully !!!");
        } else {
            return redirect("admin/subadmin/$id/edit")->with("error", "Due to some error, Admin/Agent is not updated yet. Please try again!");
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
        $delagent = Admin::find($id);
        $delagent->delete();
       // redirect
       return redirect('admin/subadmin')->with('success', 'Successfully deleted the admin/agent!');

    }

    /**
     * Changing the status of subadmin user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($type,$id)
    {
        $title = "Change Status Admin/Agent";
        $this->Admin = new Admin();
        if($this->Admin->change_status($type,$id)){
            return redirect("admin/subadmin")->with("success", "Admin/Agent status has been changed successfully !!!");
        } else {
            return redirect("admin/subadmin")->with("error", "Due to some error, Admin/Agent status is not changed yet. Please try again!");
        }
    }
    /**
     * Give access managemnt to roles as per department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function access_management(){


    }


}
