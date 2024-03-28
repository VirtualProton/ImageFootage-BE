<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Modules;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;


class ModuleController extends Controller
{
    public function index(){

        $this->Modules = new Modules();
        $getModuleslist=$this->Modules->getModulesData();
        return view('admin.modules.modules',compact('getModuleslist'));
    }
    public function modulesList(){
        $modulesList = new Modules;
        $modulesListing=$modulesList->all();
        $title = "Modules List";
        return view('admin.modules.index', ['moduleslist' => $modulesListing]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'module_name' => 'required'
        ], [
            'module_name.required' => 'The Module Name field is required.'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $modules = Modules::create([
                'module_name' =>$request->input('module_name'),
                'url' => $request->input('url'),
                'parent_module_id' => $request->input('parent_module'),
                'status' => $request->input('status'),
                'sort_order' => $request->input('sortorder'),
                'module_icon' => $request->input('moduleicon')
            ]);
            $modules->save();
           return back()->with('success','Modules Save Successfully.');
        }
    }

    public function changeModulesStatus($status,$id){
       $result = Modules::where('id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Modules status changed successfully.');
		}else{
		  return back()->with('warning','Some problem occured.');
		}
	}

    public function destroy($id){
		$del_result=Modules::find($id)->delete();
		if($del_result){
			return back()->with('success','Modules Deleated Successfully.');
		}else{
			 return back()->with('warning','Some Problem Occured.');
		}
    }

    public function updateModules($id)
    {
        $this->Modules = new Modules();
        $getModuleslist=$this->Modules->getModulesData();
       // dd($getModuleslist);
		$modulesDetails=Modules::find($id)->toArray();
        
        return view('admin.modules.editmodules', ['modulesDetails' => $modulesDetails,'getModuleslist'=>$getModuleslist,]);
    }
    public function editModules(Request $request){
		$this->validate($request, [
            'module_name' => 'required'
        ], [
            'module_name.required' => 'The Module Name field is required.'
        ]);
		
        $update_array = array('module_name' =>$request->input('module_name'),
                                'url' => $request->input('url'),
                                'parent_module_id' => $request->input('parent_module'),
                                'status' => $request->input('status'),
                                'sort_order' => $request->input('sortorder'),
                                'module_icon' => $request->input('moduleicon')
                            );
		 $result = Modules::where('id',$request->module_id)->update($update_array);
         if($result){
				return redirect('admin/list_module')->with('success','Modules Updated Successful');
		 }else{
               return back()->with('warning','Some Problem Occured.');
		 }
		       
    }

    
}
