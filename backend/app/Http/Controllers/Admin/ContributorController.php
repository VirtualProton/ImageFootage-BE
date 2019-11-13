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
			$chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
			srand((double)microtime()*1000000); 
			$i = 0; 
			$pass = '' ; 
			while ($i <= 7) { 
				$num = rand() % 33; 
				$tmp = substr($chars, $num, 1); 
				$pass = $pass . $tmp; 
				$i++; 
			} 
		 $contributor = new Contributor;
		 $file = $request->file('contributor_idproof');
		 //Get the first three characters using substr.
		 $firstThreeCharacters = substr($request->contributor_name, 0, 3);
		 $firstThreeCharactersType = substr($request->contributor_type, 0, 3);
		 $contributorid=$firstThreeCharacters.$firstThreeCharactersType;
         $contributor->contributor_memberid =$contributorid;
		 $contributor->contributor_name=$request->contributor_name;
		 $contributor->contributor_email=$request->contributor_email;
		 //$contributor->contributor_password=md5($request->contributor_password);
		 $contributor->contributor_password=md5($pass);
		 $contributor->contributor_type=$request->contributor_type;
		 $contributor->contributor_added_on=date('Y-m-d H:i:s');
		 $contributor->contributor_addedby=Auth::guard('admins')->user()->id;
		 $contributor->contributor_accountholder=$request->bank_holder_name;
		 $contributor->contributor_banknumber=$request->bank_account_number;
		 $contributor->contributor_ifsc=$request->ifsc_number;
		 $contributor->contributor_bank=$request->bank_name;
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
			 
			 $body="Dear ".$request->contributor_name."";
			 $body.="Please click the below link for activing jyour account";
			 return back()->with('success','Contributor added successful');
		 }else{
			 return back()->with('warning','Some problem occured.');
		 }
	}
	public function contributorList(){
		$contributor = new Contributor;
	   $all_contributor_list=$contributor->all()->toArray();
       return view('admin.contributor.contributorlist', ['contributor' => $all_contributor_list]);
	}
	 public function changeContributorStatus($status,$id){
		$result = Contributor::where('contributor_id',$id)->update(array('contributor_status'=>$status));
		if($result){
          return back()->with('success','Contributor status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
		}
    }
	 public function updateContributor($id)
    {   $contributor=new Contributor;
		$contributor_data=Contributor::find($id)->toArray();
        return view('admin.contributor.editcontributor', ['contributor'=>$contributor_data]);
    }
	public function editcontributor(Request $request){
		$name='';
		 $this->validate($request, [
		 	'contributor_name'=>'required',
            'contributor_email'   => 'required',
			'contributor_type'=>'required'
        ]);
		if(isset($request->contributor_password) && !empty($request->contributor_password)){
			 $this->validate($request, [
			  			'contributor_password' => 'required',
		 				'contributor_confirm_password' => 'required|same:contributor_password'
			
        	]);
		}
		if($request->hasFile('contributor_idproof')) {
		$this->validate($request, [
			  			'contributor_idproof'=>'required|file'
			
        	]);
		}
		 $contributor = new Contributor;
		 $contributor_data=Contributor::find($request->contributor_id)->toArray();
		 $update_array=array('contributor_name'=>$request->contributor_name,
		 					 'contributor_email'=>$request->contributor_email,
							 'contributor_type'=>$request->contributor_type,
							 'contributor_accountholder'=>$request->bank_holder_name,
							 'contributor_banknumber'=>$request->bank_account_number,
		 					 'contributor_ifsc'=>$request->ifsc_number,
		 					 'contributor_bank'=>$request->bank_name,
							 'updated_at'=>date('Y-m-d H:i:s')
							 );
		 if(isset($request->contributor_password) && !empty($request->contributor_password)){
			 $update_array['contributor_password']=md5($request->contributor_password);
		 }
		 if($request->hasFile('contributor_idproof')){
				$image = $request->file('contributor_idproof');
				$name = time().'.'.$image->getClientOriginalExtension();
				$update_array['contributor_idproof']=$name;
    	 }
		 $result = Contributor::where('contributor_id',$request->contributor_id)->update($update_array);
		 if($result){
				 if($request->hasFile('contributor_idproof')) {
					$image = $request->file('contributor_idproof');
					$file_path='/uploads/idproof/';
					$destinationPath = public_path($file_path);
				 	File::delete($destinationPath.$contributor_data['contributor_idproof']);
					$image->move($destinationPath, $name);
					$update_array['contributor_idproof']=$name;
				}
				return back()->with('success','Contributor updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
		       
	}
	public function destroy($id){
		 $contributor_data=Contributor::find($id)->toArray();
		
		$del_result=Contributor::find($id)->delete();
		if($del_result){
			if(isset($contributor_data['contributor_idproof']) && !empty($contributor_data['contributor_idproof'])){
				$file_path='/uploads/idproof/';
				$destinationPath = public_path($file_path);
				File::delete($destinationPath.$contributor_data['contributor_idproof']);
			}
			return back()->with('success','Contributor deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
    }
}