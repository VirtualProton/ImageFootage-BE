<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Image;
use File;
use App\Models\Contributor;
class ContributorController extends Controller
{
	public function index(){
		return view('admin.contributor.addcontributor');
	}
	public function addcontributor(Request $request){
		$this->validate($request, [
		 	'contributor_name'=>'required',
            'contributor_email'   => 'required',
            'contributor_password' => 'required',
			'contributor_confirm_password' => 'required|same:contributor_password',
			'contributor_idproof'=>'required|file',
			'contributor_type'=>'required'
        ]);
		 $contributor = new Contributor;
		 $file = $request->file('contributor_idproof');
		 //Get the first three characters using substr.
		 $firstThreeCharacters = substr($request->contributor_name, 0, 3);
		 $firstThreeCharactersType = substr($request->contributor_type, 0, 3);
		 $contributorid=$firstThreeCharacters.$firstThreeCharactersType;
         $contributor->contributor_memberid =$contributorid;
		 $contributor->contributor_name=$request->contributor_name;
		 $contributor->contributor_email=$request->contributor_email;
		 $contributor->contributor_password=$request->contributor_password;
		 $contributor->contributor_type=$request->contributor_type;
		 $contributor->contributor_added_on=date('Y-m-d H:i:s');
		 $contributor->contributor_addedby=Auth::guard('admins')->user()->id;
		 $result=$contributor->save();
		 $last_id=$contributor->contributor_id;
		 if($result){
			 if($last_id < 10){
				 $last_id='00'.$last_id;
			 }else if($last_id < 100){
				 $last_id='0'.$last_id;
			 }
			 if($request->hasFile('contributor_idproof')) {
				$image = $request->file('contributor_idproof');
				$name = time().'.'.$image->getClientOriginalExtension();
				$file_path='/uploads/idproof/';
				$destinationPath = public_path($file_path);
				$image->move($destinationPath, $name);
				
    		 }
			 $contributorid=strtolower($firstThreeCharacters.$firstThreeCharactersType.$last_id);
			 $contributor_update = Contributor::find($last_id);
			 $contributor_update->contributor_memberid=$contributorid;
			 $contributor_update->contributor_idproof=$name;
			 $contributor_update->save();
			 return back()->with('success','Contributor added successful');
		 }else{
			 return back()->with('warning','Some problem occured.');
		 }
	}
	public function contributorList(){
		$contributor = new Contributor;
	   $all_produst_list=$contributor->all()->toArray();
	  // echo '<pre>';
	   //print_r($all_produst_list);
	   //$title = "Product List";
       //return view('admin.product.productlist', ['products' => $all_produst_list]);
	}
}
