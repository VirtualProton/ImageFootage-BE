<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common;
use DB;
use Mail;
use PDF;


class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('login','logout');
        $this->Common = new Common();

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

  public function sendmail(Request $request){
      
     $data["email"]=$request->get("email");
     $data["text"]=$request->get("text");
     //print_r($data); die;
    // $data["subject"]=$request->get("subject");
    ini_set('max_execution_time', 0);
    //$data["email"]="amitpathak.bansal@gmail.com";
    //$data["client_name"]="Test email";
    $data["subject"]= "Invoice";

    $pdf = PDF::loadHTML($data["text"]);

    try{
        Mail::send('mail', $data, function($message)use($data,$pdf) {
        $message->to($data["email"])
        ->subject($data["subject"])
        ->attachData($pdf->output(), "invoice.pdf");
        });
    }catch(JWTException $exception){
        $this->serverstatuscode = "0";
        $this->serverstatusdes = $exception->getMessage();
    }
    if (Mail::failures()) {
         $this->statusdesc  =   "Error sending mail";
         $this->statuscode  =   "0";

    }else{

       $this->statusdesc  =   "Invoice sent Succesfully";
       $this->statuscode  =   "1";
    }
    return response()->json(compact('this'));
  }

  public function quotation($user_id){
        return view('admin.invoice.quotation',compact('user_id'));   
 }

  public function saveInvoice(Request $request){
      // $data = $request->input();
      $data = json_decode(request()->getContent(), true);
      return $this->Common->save_proforma($data);
      //print_r($data); die;
  }

  public function invoice($user_id,$invoice_id){
    if(!empty($invoice_id)){
        $data=$this->Common->getData($invoice_id,$user_id);
        //echo "<pre>";
        //print_r($data); die;
        return view('admin.invoice.invoice',compact('user_id'));  
    }
  }

  public function edit_quotation($quotation_id)
  {
      return view('admin.invoice.edit_quotation');
  }

      public function edit_quotation_data(Request $request){
          $data = $request->all();
          //print_r($data); die;
          if(!empty($data['quotation'])){
              return $this->Common->getQuotationData($data['quotation']);
       }

     }
     public function create_invoice(Request $request){
         $data = $request->all();
         if(!empty($data['quotation_id'])){
             return $this->Common->create_invoice($data['quotation_id'],$data['user_id']);
         }
     }

     public function change_invoice_status(Request $request){
         $data = $request->all();
         if(!empty($data['quotation_id']) && isset($data['status'])){
             return $this->Common->change_invoice_status($data['quotation_id'],$data['status']);
         }
     }

}
