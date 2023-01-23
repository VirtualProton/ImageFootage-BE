<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StaticPages;
use Auth;

class StaticPagesController extends Controller
{
	public function __construct()
	{
        $this->middleware('admin')->except('login','logout');
	}
	public function createStaticPage(){
		 return view('admin.staticpages.createstaticpage');
	}
	public function addStaticPage(Request $request){
		$this->validate($request, [
		 	'page_title'=>'required',
			'page_url'=>'required',
			'page_meta_desc'=>'required',
			'page_meta_keywords'=>'required',
			'page_slug'=>'required',
			'page_content'=>'required'
        ]);
		$staticpages=new StaticPages;
		$staticpages->page_title =$request->page_title;
	    $staticpages->page_url=$request->page_url;
		$staticpages->page_meta_desc=$request->page_meta_desc;
		$staticpages->page_meta_keywords=$request->page_meta_keywords;
		$staticpages->page_slug=$request->page_slug;
		$staticpages->page_content=$request->page_content;
		$staticpages->page_added_on=date('Y-m-d H:i:s');
		$staticpages->page_added_by=Auth::guard('admins')->user()->id;	
		$result=$staticpages->save();
		if($result){
		  	 return back()->with('success','Static page created successful');
		}else{
			 return back()->with('warning','Some problem occured.');
		}	
	}
	public function statiePagesList(){
	   $staticpages = new StaticPages;
	   $pages_list=$staticpages->get()->toArray();
	   return view('admin.staticpages.staticpageslist', ['pages' => $pages_list]);
   }
   public function changePackageStatus($status,$id){
	  	$result = StaticPages::where('page_id',$id)->update(array('image_status'=>$status));
		if($result){
          return back()->with('success','Static page status changed successful');
		}else{
		  return back()->with('warning','Some problem occured.');
  		}
  }
  public function updateStaticPage($id){
	  $staticpages = new StaticPages;
	  $staticpage_data=$staticpages->where('page_id',$id)->get()->toArray();
	  return view('admin.staticpages.editstaticpage', ['page' => $staticpage_data]);
  }
  public function editStaticPage(Request $request){
	  $this->validate($request, [
		 	'page_title'=>'required',
			'page_url'=>'required',
			'page_meta_desc'=>'required',
			'page_meta_keywords'=>'required',
			'page_slug'=>'required',
			'page_content'=>'required'
        ]);
	 $update_array=array('page_title'=>$request->page_title,
							 'page_url'=>$request->page_url,
		 					 'page_meta_desc'=>$request->page_meta_desc,
							 'page_meta_keywords'=>$request->page_meta_keywords,
							 'page_slug'=>$request->page_slug,
							 'page_content'=>$request->page_content
							 );
		$result = StaticPages::where('page_id',$request->page_id)->update($update_array);
		if($result){
				return back()->with('success','Static page updated successful');
		 }else{
			    return back()->with('warning','Some problem occured.');
		 }
  }
    public function deleteStaticPage($id){
	  $del_result=StaticPages::find($id)->delete();
	  if($del_result){
			return back()->with('success','Static page deleated successfully');
		}else{
			 return back()->with('warning','Some problem occured.');
		}
  }
}
