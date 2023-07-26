<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Illuminate\Support\Facades\Session;

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
            'page_type' => 'required',
            'desktop_banner_image' => 'required|mimes:jpeg,png,jpg|dimensions:width=1280,height=797',
            'mobile_banner_image' => 'required|mimes:jpeg,png,jpg|dimensions:width=236,height=354',
        ], [
            'event_name.required' => 'The Event Name field is required.',
            'date_start.required' => 'The Start Date field is required.',
            'date_end.required' => 'The End Date field is required.',
            'product_name.required' => 'The Event Banner field is required.',
            'event_des.required' => 'The Event Description field is required.',
            'media_type.required' => 'The Media Type field is required.',
            'product_name.required' => 'The Product Name field is required.',
            'page_type.required' => 'The Page Type field is required.',
            'desktop_banner_image' => 'Please upload valid desktop banner image.',
            'mobile_banner_image' => 'Please upload valid mobile banner image.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            if($request->status == 1 && Promotion::where('page_type', $request->page_type)->where('status', '1')->count() > 0){
                Session::flash('error', 'Active record found. You can not add another active record.');
                return redirect()->back()->withInput();
            }
            $url = "";
            if($request->input('image_url') !=""){
                $url = $request->input('image_url');
            }else {
                $url = "https://p5resellerp.s3-accelerate.amazonaws.com/".$request->input('footage_url');
            }
            $file_path = strstr($request->product_type, '_page').'/photo/';
            if($request->hasFile('desktop_banner_image')) {
				$image = $request->file('desktop_banner_image');
				$name = time().'.'.$image->getClientOriginalExtension();
				$files2bucketemp= $image->getPathName();
				$s3Client = new S3Client([
					'region' => 'us-east-2',
					'version' => '2006-03-01'
				]);
				$finelname=$file_path.$name;
				$source = $files2bucketemp;
				$uploader = new MultipartUploader($s3Client, $source, [
					'bucket' => 'imgfootage',
					'key' => $finelname,
				]);
				try {
					$result = $uploader->upload();
                    $fileupresult = $result['ObjectURL'];
				} catch (MultipartUploadException $e) {
					echo $e->getMessage() . "\n";
				}
    		}
            if($request->hasFile('mobile_banner_image')) {
				$image = $request->file('mobile_banner_image');
				$name = time().'.'.$image->getClientOriginalExtension();
				$files2bucketemp= $image->getPathName();
				$s3Client = new S3Client([
					'region' => 'us-east-2',
					'version' => '2006-03-01'
				]);
				$finelname=$file_path.$name;
				$source = $files2bucketemp;
				$uploader = new MultipartUploader($s3Client, $source, [
					'bucket' => 'imgfootage',
					'key' => $finelname,
				]);
				try {
					$result1 = $uploader->upload();
                    $fileupresult1 = $result1['ObjectURL'];
				} catch (MultipartUploadException $e) {
					echo $e->getMessage() . "\n";
				}
    		}
            $promotion = Promotion::create([
                'event_name' => strip_tags($request->input('event_name')),
                'date_start' => $request->input('date_start'),
                'date_end' => $request->input('date_end'),
                'media_type' => $request->input('media_type'),
                'product_name' => $request->input('product_name'),
                'media_url' =>  $url,
                'event_des' => $request->input('event_des'),
                'status' => $request->input('status'),
                'page_type' => $request->input('page_type'),
                'desktop_banner_image' => $fileupresult ?? '',
                'mobile_banner_image' => $fileupresult1 ?? ''
                
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
            'media_type' => 'required',
            'page_type' => 'required',
            'desktop_banner_image' => 'nullable|mimes:jpeg,png,jpg|dimensions:width=1280,height=797',
            'mobile_banner_image' => 'nullable|mimes:jpeg,png,jpg|dimensions:width=236,height=354',
        ], [
            'event_name.required' => 'The Event Name field is required.',
            'date_start.required' => 'The Start Date field is required.',
            'date_end.required' => 'The End Date field is required.',
            'product_name.required' => 'The Event Banner field is required.',
            'event_des.required' => 'The Event Description field is required.',
            'media_type.required' => 'The Media Type field is required.',
            'product_name.required' => 'The Product Name field is required.',
            'page_type.required' => 'The Page Type field is required.',
            'desktop_banner_image' => 'Please upload valid desktop banner image.',
            'mobile_banner_image' => 'Please upload valid mobile banner image.',
        ]);
        if($request->status == 1 && Promotion::where('id','!=',$request->promotion_id)->where('page_type', $request->page_type)->where('status', '1')->count() > 0){
            Session::flash('error', 'Active record found. You can not add another active record.');
            return redirect()->back()->withInput();
        }
        $file_path = strstr($request->product_type, '_page').'/photo/';
            if($request->hasFile('desktop_banner_image')) {
				$image = $request->file('desktop_banner_image');
				$name = time().'.'.$image->getClientOriginalExtension();
				$files2bucketemp= $image->getPathName();
				$s3Client = new S3Client([
					'region' => 'us-east-2',
					'version' => '2006-03-01'
				]);
				$finelname=$file_path.$name;
				$source = $files2bucketemp;
				$uploader = new MultipartUploader($s3Client, $source, [
					'bucket' => 'imgfootage',
					'key' => $finelname,
				]);
				try {
					$result = $uploader->upload();
                    $fileupresult = $result['ObjectURL'];
				} catch (MultipartUploadException $e) {
					echo $e->getMessage() . "\n";
				}
    		}
            if($request->hasFile('mobile_banner_image')) {
				$image = $request->file('mobile_banner_image');
				$name = time().'.'.$image->getClientOriginalExtension();
				$files2bucketemp= $image->getPathName();
				$s3Client = new S3Client([
					'region' => 'us-east-2',
					'version' => '2006-03-01'
				]);
				$finelname=$file_path.$name;
				$source = $files2bucketemp;
				$uploader = new MultipartUploader($s3Client, $source, [
					'bucket' => 'imgfootage',
					'key' => $finelname,
				]);
				try {
					$result1 = $uploader->upload();
                    $fileupresult1 = $result1['ObjectURL'];
				} catch (MultipartUploadException $e) {
					echo $e->getMessage() . "\n";
				}
    		}
		 $update_array=array('event_name'=>$request->event_name,
		 					 'date_start'=>$request->date_start,
		 					 'date_end'=>$request->date_end,
                              'media_type' => $request->input('media_type'),
                             'product_name' => $request->input('product_name'),
                             'media_url' =>  $url,
							 'event_des'=>$request->event_des,
                             'status'=>$request->status,
                             'page_type' => $request->page_type
							 );
         if(!empty($fileupresult)) {
            $update_array['desktop_banner_image'] = $fileupresult;
         }
         if(!empty($fileupresult1)) {
            $update_array['mobile_banner_image'] = $fileupresult1;
         }
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
