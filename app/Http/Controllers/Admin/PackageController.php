<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
   public function createPackage(){
	    return view('admin.package.createpackage');
  }
  public function addPackage(Request $request){
	   $this->validate($request, [
		 	'package_name'=>'required'
            
        ]);
  }
}
