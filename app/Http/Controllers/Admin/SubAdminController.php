<?php

namespace App\Http\Controllers\Admin;

use App\Models\Modules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\Department;
use App\Models\Admin;
use App\Models\RolesModulesMapping;
use Illuminate\Support\Facades\Response;

use App\Models\Country;
use Auth;



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
        
        $this->Country = new Country();
        $countries = $this->Country->getcountrylist();

        return view('admin.subadmin.create', compact('title','countries','deparments','roles'));
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
            'bill_country' =>'required',
            'bill_state' =>'required',
            // 'email'=>'required|email',
            'email' => 'required|email|unique:imagefootage_admins|max:255',
            'password'=>'required|min:6',
        ]);

        // print_r($request->all()); die;
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
        $user = Auth::guard('admins')->user();
        if($user->role['role'] !='Super Admin'){
          return back()->with('success','You dont have acess to edit.');
        }
        $title = "Add Admin/Agent";
        $roles= Roles::where('status','=','A')->get();
        $deparments= Department::where('status','=','A')->get();
        $this->Admin = new Admin();
        $agent_data=$this->Admin->getAgentData($id);
        // echo "<pre>"; print_r($agent_data); die;
        $this->Country = new Country();
        $states = $this->Country->getState('country_id',$agent_data['country']);
        // echo "<pre>"; print_r($states); die;

        $this->Country = new Country();
        $countries = $this->Country->getcountrylist();

        return view('admin.subadmin.edit', compact('title','countries','states','deparments','roles','agent_data'));

    }

    public function view($id)
    {
        $title = "Add Admin/Agent";
        $roles= Roles::where('status','=','A')->get();
        $deparments= Department::where('status','=','A')->get();
        $this->Admin = new Admin();
        $agent_data=$this->Admin->getAgentData($id);


        // echo "<pre>"; print_r($agent_data); die;

        $department_id = $agent_data['department_id'];
        $role_id = $agent_data['role_id'];

        $agent_data_modules = RolesModulesMapping::where('department_id', $department_id)->where('role_id', $role_id)->get();
        // echo "<pre>"; print_r($agent_data_modules); die;


        $modules = Modules::all()->toArray();
        // echo "<pre>"; print_r($modules); die;

        $modules_array = array();
        foreach($modules as $module){
            $modules_array[$module['id']] = $module['module_name'];

        }
        // echo "<pre>"; print_r($modules_array); die;
        

        foreach($agent_data_modules as $k => $agent_data_module){
            $agent_data_module['module_name'] = $modules_array[$agent_data_module['module_id']];
 
        }

        // echo "<pre>"; print_r($agent_data_modules); die;


        return view('admin.subadmin.view', compact('title','deparments','roles','agent_data', 'agent_data_modules'));

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
            'bill_country' =>'required',
            'bill_state' =>'required',
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
        $title = "Access Management";
        $roles= Roles::where('status','=','A')->where('id','<>','1')->get();
        $deparments= Department::where('status','=','A')->get();
        $modules = Modules::where('parent_module_id','=','0')->where('id','<>','1')->select('module_name','id')->get();
        return view('admin.subadmin.access_management', compact('title','deparments','roles','modules'));

    }
    public function save_access(Request $request){
         $data = $request->all();
         if(count($data)>0){
             foreach($data['access_management'] as $k=>$eachData){
                 $is_view='0';
                 $is_edit='0';
                 $is_delete='0';
                 $is_add='0';
                 if(isset($eachData["'view'"]) && $eachData["'view'"]=='on'){
                     $is_view ='1';
                 }
                 if(isset($eachData["'add'"]) && $eachData["'add'"]=='on'){
                     $is_add='1';
                 }
                 if(isset($eachData["'edit'"]) && $eachData["'edit'"]=='on'){
                     $is_edit='1';
                 }
                 if(isset($eachData["'delete'"]) && $eachData["'delete'"]=='on'){
                     $is_delete='1';
                 }
                 $count= RolesModulesMapping::where('department_id',$data['department'])
                                      ->where('role_id',$data['role'])
                                      ->where('module_id',$k)->count();
                 if($count==0){
                     RolesModulesMapping::insert(['department_id'=>$data['department'],'role_id'=>$data['role'],'module_id'=>$k,
                         'can_add'=>$is_add,'can_edit'=>$is_edit,'can_view'=>$is_view,'can_delete'=>$is_delete]);
                 }else{
                    $updated = RolesModulesMapping::where('department_id',$data['department'])
                         ->where('role_id',$data['role'])
                         ->where('module_id',$k)
                         ->update(['can_add'=>$is_add,'can_edit'=>$is_edit,'can_view'=>$is_view,'can_delete'=>$is_delete]);

                 }

             }
             return redirect("admin/subadmin/access_management")->with("success", "Access has been added/Modified successfully !!!");
         }

    }

    public function mapping_data(Request $request){
        $data = $request->all();
        $modules = Modules::where('parent_module_id', '=', '0')->where('id', '<>', '1')->select('module_name', 'id')->get();
        $access= RolesModulesMapping::select('module_id','can_add','can_edit','can_view','can_delete')->where('department_id',$data['department'])
            ->where('role_id',$data['role'])
            ->get()
            ->groupBy('module_id')
            ->toArray();
        //print_r($access);die;
        if(count($access)>0) {
            $viewRendered = view('admin.subadmin.access_management_edit', compact('modules','access'))->render();
            return Response::json(['html'=>$viewRendered]);
        }else{
            $access = [];
            $viewRendered = view('admin.subadmin.access_management_edit', compact('modules','access'))->render();
            return Response::json(['html'=>$viewRendered]);
        }

    }


    public function editProfile($id){
        $user = Auth::guard('admins')->user();
        $title = "Add Admin/Agent";
        $roles= Roles::where('status','=','A')->get();
        $deparments= Department::where('status','=','A')->get();
        $this->Admin = new Admin();
        $agent_data=$this->Admin->getAgentData($id);
        $this->Country = new Country();
        $states = $this->Country->getState('country_id',$agent_data['country']);
        $this->Country = new Country();
        $countries = $this->Country->getcountrylist();
        return view('admin.subadmin.editprofile', compact('title','countries','states','deparments','roles','agent_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'department'   => 'required',
            'role' => 'required',
            'name' =>'required',
            //'email'=>'required|email',
            'bill_country' =>'required',
            'bill_state' =>'required',
            'password'=>'sometimes|nullable|min:6',
        ]);

        $this->Admin = new Admin();
        if($this->Admin->update_admin($request,$id)){
            return redirect("admin/edit_profile/$id")->with("success", "Profile has been updated successfully !!!");
        } else {
            return redirect("admin/edit_profile/$id")->with("error", "Due to some error, Admin/Agent is not updated yet. Please try again!");
        }
    }

}
