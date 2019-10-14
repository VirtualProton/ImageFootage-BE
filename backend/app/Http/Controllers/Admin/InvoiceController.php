<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('login','logout');

    }

    public function send_invoice(){
        $templates = DB::table('email_templates')
                    ->where('type','=','2')
                    ->get();

        return view('admin.invoice.index',compact('templates'));             
   }

   public function get_email_template(Request $request){
        $id = $request->input('templ_id');
        if($id>0){
            $templateData = DB::table('email_templates')
            ->where('id','=',$id)
            ->first();
            $replace = array('##first_name##', '##orderId##','##productname##','##logo##');
            $with = array('Amit', '123456','pond5images','imagefotage');
            $new_template = str_replace($replace, $with, $templateData->content);
            echo $new_template;
        }
  }



}
