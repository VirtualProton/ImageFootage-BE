<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function index(){
        return view('admin.promotion.promotion');
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
            'date_start'      => 'required',
            'date_end'        => 'required|date|after:date_start',
            'product_name'=> 'required',
            'event_des' => 'required',
            'media_type' => 'required',
        ], [
            'event_name.required' => 'The Event Name field is required.',
            'date_start.required' => 'The Start Date field is required.',
            'date_end.required' => 'The End Date field is required.',
            'product_name.required' => 'The Event Banner field is required.',
            'event_des.required' => 'The Event Description field is required.',
            'media_type.required' => 'The Media Type field is required.',
            'product_name.required' => 'The Product Name field is required.'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $url = "";
            if($request->input('image_url') !=""){
                $url = $request->input('image_url');
            }else {
                $url = "https://p5resellerp.s3-accelerate.amazonaws.com/".$request->input('footage_url');
            }
            $promotion = Promotion::create([
                'event_name' => strip_tags($request->input('event_name')),
                'date_start' => $request->input('date_start'),
                'date_end' => $request->input('date_end'),
                'media_type' => $request->input('media_type'),
                'product_name' => $request->input('product_name'),
                'media_url' =>  $url,
                'event_des' => $request->input('event_des'),
                'status' => $request->input('status')
                
            ]);
            $promotion->save();
           return back()->with('success','Promotion Save Successfully.');
        }
    }

    public function changePromotionStatus($status,$id){
       $result = Promotion::where('id',$id)->update(array('status'=>$status));
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
    	$promotionDetails=Promotion::find($id)->toArray();
        return view('admin.promotion.editpromotion', ['promotionDetails' => $promotionDetails]);
    }
    public function editPromotion(Request $request){
      // dd( $request);
        $url = "";
            if($request->input('image_url') !=""){
                $url = $request->input('image_url');
            }else {
                $url = "https://p5resellerp.s3-accelerate.amazonaws.com/".$request->input('footage_url');
            }
       $this->validate($request, [
            'event_name' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'product_name'=> 'required',
            'event_des' => 'required',
            'media_type' => 'required'
        ], [
            'event_name.required' => 'The Event Name field is required.',
            'date_start.required' => 'The Start Date field is required.',
            'date_end.required' => 'The End Date field is required.',
            'product_name.required' => 'The Event Banner field is required.',
            'event_des.required' => 'The Event Description field is required.',
            'media_type.required' => 'The Media Type field is required.',
            'product_name.required' => 'The Product Name field is required.'
        ]);
		 $update_array=array('event_name'=>$request->event_name,
		 					 'date_start'=>$request->date_start,
		 					 'date_end'=>$request->date_end,
                              'media_type' => $request->input('media_type'),
                             'product_name' => $request->input('product_name'),
                             'media_url' =>  $url,
							 'event_des'=>$request->event_des,
                             'status'=>$request->status,
							 );
                            // dd( $update_array);               
		 $result = Promotion::where('id',$request->promotion_id)->update($update_array);
		 if($result){
				return redirect('admin/list_promotion')->with('success','Promotion updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
		       
    }

    public function getPromotion(Request $request)
    {
       $current_event = Promotion::select( 'id','event_name','media_type', 'media_url','date_start', 'date_end' )
            ->where('status', '=', '1')
            ->where('date_start', '<=', Carbon::now())
            ->where('date_end', '>=', Carbon::now())->get();
        return response()->json(["status"=> true, "data"=> $current_event]);
    }
}
