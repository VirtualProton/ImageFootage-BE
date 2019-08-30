<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use App\Department;
use App\Admin;

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
}
