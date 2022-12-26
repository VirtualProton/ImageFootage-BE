<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    public function index(){
        return view('admin.promotion.create');
    }
    public function promotionList(){
        $promotionList = new Promotion;
        $promotionListing=$promotionList->all()->toArray();
        $title = "Promotion List";
        return view('admin.promotion.index', ['promotionlist' => $promotionListing]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'event_banner'=> 'required',
            'event_des' => 'required'

        ], [
            'event_name.required' => 'The Event Name field is required.',
            'date_start.required' => 'The Start Date field is required.',
            'date_end.required' => 'The End Date field is required.',
            'event_banner.required' => 'The Event Banner field is required.',
            'event_des.required' => 'The Event Description field is required.'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
        $postPromotionData = $request->except(['_token']);
        $promotionDataFormat = [];
           foreach ($postPromotionData as $key => $promotionData) {
               $promotionDataFormat[$key] = $promotionData;
           }
           // create array to insert into DB
           $addPromotion = Promotion::create($promotionDataFormat); // Store lead data
           $addPromotion->save();
        }
    }

    public function changePromotionStatus($status,$id){
		$result = Promotion::where('category_id',$id)->update(array('status'=>$status));
		if($result){
          return back()->with('success','Promotion status changed successfully.');
		}else{
		  return back()->with('warning','Some problem occured.');
		}
	}

    public function destroy($id){
		$del_result=Promotion::find($id)->delete();
		if($del_result){
			return back()->with('success','Promotion deleated successfully.');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
    }

    public function updatePromotion($id)
    {
    	$user = Auth::guard('admins')->user();
        if($user->role['role'] !='Super Admin'){
          return back()->with('success','You dont have acess to edit.');
        }
		$promotionDetails=Promotion::find($id)->toArray();
        return view('admin.promotion.editproductcategory', ['promotionDetails' => $promotionDetails]);
    }
    public function editPromotion(Request $request){
		$this->validate($request, [
            'event_name' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'event_banner'=> 'required',
            'event_des' => 'required'
        ], [
            'event_name.required' => 'The Event Name field is required.',
            'date_start.required' => 'The Start Date field is required.',
            'date_end.required' => 'The End Date field is required.',
            'event_banner.required' => 'The Event Banner field is required.',
            'event_des.required' => 'The Event Description field is required.'
        ]);
		 $update_array=array('event_name'=>$request->event_name,
		 					 'date_start'=>$request->date_start,
		 					 'date_end'=>$request->date_end,
                             'event_banner'=>$request->event_banner,
							 'event_des'=>$request->event_des,
                             'status'=>$request->status,
							 );
		 $result = Promotion::where('id',$request->id)->update($update_array);
		
		 if($result){
				return redirect('admin/list_promotion')->with('success','Promotion updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
		       
    }

}
