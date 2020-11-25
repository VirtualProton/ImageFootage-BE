<?php

namespace App\Models;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Illuminate\Database\Eloquent\Model;
use DB;
use Mail;
use PDF;
use App;
use Helper;
use App\Http\AtomPay\TransactionRequest;
use App\Http\AtomPay\TransactionResponse;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Package;

class Common extends Model
{

    public function __construct()
    {

        date_default_timezone_set('Asia/Kolkata');
        $environment = App::environment();
        if (App::environment('local')) {
            // The environment is local
            $this->baseurl = 'http://localhost:4200';
            $this->atomRequestKey = 'KEY123657234';
            $this->atomResponseKey = 'KEYRESP123657234';
            $this->login = '197';
            $this->mode = 'Test';
            $this->password = 'Test@123';
            $this->clientcode = '007';
            $this->atomprodId = 'NSE';
        } else {
            $this->baseurl = 'https://imagefootage.com';
            $this->keyRazorId = 'rzp_test_TcSjfuF7EzPHev';
            $this->keyRazorSecret = 'ZzP8Z9Z1dYUYykBPkgYlpGS6';
            $this->atomRequestKey = '3a1575abc728e8ccf9';
            $this->atomResponseKey = '43af4ba2fbd68d327e';
            $this->login = '106640';
            $this->mode = 'live';
            $this->password = '33719eef';
            $this->clientcode = '007';
            $this->atomprodId = 'CONCEPTUAL';
        }
    }
 public function getCurruncy($col=NULL,$value=NULL){
        if(!empty($id) && !empty($type)){
            $currencies = DB::table('currency_convertes')->where($col,'=',$value)->get()->toArray();
        }else{
            $currencies = DB::table('currency_convertes')->get()->toArray();
        }
        return $currencies;
    }

    public function getIndustryTypes($col=NULL,$value=NULL){
        if(!empty($id) && !empty($type)){
            $industrytypes = DB::table('industry_types')->where($col,'=',$value)->get()->toArray();
        }else{
            $industrytypes = DB::table('industry_types')->get()->toArray();
        }
        return $industrytypes;
    }

    public function changeCurruncy($type=NULL,$value=NULL){
        if(!empty($type) && !empty($value)){
           
            $price_inr = DB::table('currency_convertes')
                     ->select(DB::raw('12*cur_value as price'))
                     ->where('name', '=', $type)
                     ->get();    

        }
        return $price_inr;
    }

    public function checkCategory($category_name=NULL){
        if(!empty($category_name)){
            $category = DB::table('imagefootage_productcategory')
                        ->select('category_id')
                        ->where('category_name' ,'=', $category_name)
                        ->get();
            if(count($category)==0) {
                $insert = array(
                    'category_name'=>$category_name,
                    'category_order'=> '',
                    'category_added_by'=>'1',
                    'category_status'=>'Active'
                    
                );
                DB::table('imagefootage_productcategory')->insert($insert);   
                $id = DB::getPdo()->lastInsertId();
                return $id; 
            }else{
               return $category[0]->category_id;
            }           
            
        }
       
    }
    
    public function random_numbers(){
        $digits = 7;
        return rand(pow(10, $digits-1), pow(10, $digits)-1);
    }
    

    public function save_proforma($data){
        ini_set('max_execution_time', 0);
        $selected_taxes = array();
        
        if(isset($data['GSTS']) && $data['GSTS']==1){
            $selected_taxes['GST']='1';
        }else{
            $selected_taxes['GST']='0';
        }

        $insert = array(
            'user_id'=> $data['uid'],
            'email_id'=> $data['email'],
            'invoice_name'=> $this->random_numbers(),
            'created'=>date('Y-m-d'),
            'modified'=>date('Y-m-d H:i:s'),
            //'job_number'=>$data['po'],
            'promo_code'=>'',
            'tax'=> $data['tax'] ?? '',
            'tax_selected'=> json_encode($selected_taxes),
            'total'=>$data['total'],
            'status'=>'0',
            'invoice_type'=>'3',
            'proforma_type'=>'1',
            'expiry_invoices'=>$data['expiry_date'],
            //'po_detail'=>date('Y-m-d',strtotime($data['poDate']))

        );
        //DB::beginTransaction();
        //try{
        DB::table('imagefootage_performa_invoices')->insert($insert);   
        $id = DB::getPdo()->lastInsertId();
        if(count($data['products'])>0) {
            //echo "<pre>"; print_r($data['products']); die; 
            foreach ($data['products']['product'] as $eachproduct) {  
                if (filter_var($eachproduct['image'], FILTER_VALIDATE_URL)) { 
                       $image = $eachproduct['image'];
                } else{
                       $image = $this->imagesaver($eachproduct['image']);    
                }
                $insert_product = array(
                    'invoice_id' => $id,
                    'user_id' => $data['uid'],
                    'product_id' => $eachproduct['name'],
                    'product_type' => $eachproduct['pro_type'],
                    'type' => $eachproduct['type'],
                    'product_size' => $eachproduct['pro_size'],
                    'product_image' => $image,
                    'subtotal' => $eachproduct['price'],
                    'status' => "1",
                    'product_web' => 'imagefootage'
                );
                DB::table('imagefootage_performa_invoice_items')->insert($insert_product);
            }
            if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
                Invoice::where('id', '=', $data['old_quotation'])->update(['status' => 3]);
            }

            $dataForEmail  = $this->getData($id,$data['uid']); 
            $dataForEmail = json_decode(json_encode($dataForEmail), true);

            $transactionRequest = new TransactionRequest();
            //Setting all values here
            $transactionRequest->setMode($this->mode);
            $transactionRequest->setLogin($this->login);
            $transactionRequest->setPassword($this->password);
            $transactionRequest->setProductId($this->atomprodId);
            $transactionRequest->setAmount($dataForEmail[0]['total']);
            $transactionRequest->setTransactionCurrency("INR");
            $transactionRequest->setTransactionAmount($dataForEmail[0]['total']);

            $transactionRequest->setReturnUrl(url('/api/atomPayInvoiceResponse'));
            $transactionRequest->setClientCode($this->clientcode);
            $transactionRequest->setTransactionId($dataForEmail[0]['invoice_name']);
            $datenow = date("d/m/Y h:m:s",strtotime($dataForEmail[0]['invicecreted']));
            $transactionDate = str_replace(" ", "%20", $datenow);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($dataForEmail[0]['first_name']);
            $transactionRequest->setCustomerEmailId($dataForEmail[0]['email']);
            $transactionRequest->setCustomerMobile($dataForEmail[0]['mobile']);
            $transactionRequest->setCustomerBillingAddress("India");
            $transactionRequest->setCustomerAccount($data['uid']);
            $transactionRequest->setReqHashKey($this->atomRequestKey);
            $url = $transactionRequest->getPGUrl();
            $dataForEmail[0]['payment_url'] = $url;
            
            $data["subject"] = "Quotation (".$dataForEmail[0]['invoice_name'].")";
            $data["email"] = $data['email'];
            $data["invoice"] = $dataForEmail[0]['invoice_name'];
            $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);
            
            //PDF genration and email
            $pdf = PDF::loadHTML(view('email.quotation', ['quotation' => $dataForEmail, 'amount_in_words' => $amount_in_words]));
            $fileName = $data["invoice"]."_quotation.pdf";
            $pdf->save(storage_path('app/public/pdf'). '/' . $fileName);
            try{
                    Mail::send('mail', $data, function($message)use($data,$pdf,$fileName) {
                    $message->to($data["email"])
                    ->from('admin@imagefootage.com', 'Imagefootage')
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), $fileName);
                    });

                    $s3Client = new S3Client([
                        /*'profile' => 'default',*/
                        'region' => 'us-east-2',
                        'version' => '2006-03-01'
                    ]);
                    $path ='quotation/'.$fileName;
                    $source = fopen(storage_path('app/public/pdf'). '/' . $fileName, 'rb');
                    $uploader = new MultipartUploader($s3Client, $source, [
                        'bucket' => 'imgfootage',
                        'key' => $path,
                    ]);
                try {
                        $fileupresult = $uploader->upload();
                    } catch (MultipartUploadException $e) {
                        echo $e->getMessage() . "\n";
                    }
                $pdf_path = $fileupresult['ObjectURL']; 
                if(!empty($pdf_path)){
                    DB::table('imagefootage_performa_invoices')
                        ->where('id','=',$id)
                        ->update(['quotation_url'=>$pdf_path]);
                    unlink(storage_path('app/public/pdf'). '/' . $fileName);
                }
            }catch(JWTException $exception){
                $this->serverstatuscode = "0";
                $this->serverstatusdes = $exception->getMessage();
            }
            if (Mail::failures()) {
                $this->statusdesc  =   "Error sending mail";
                $this->statuscode  =   "0";
            }else{
                $this->statusdesc  =   "Quotation sent Succesfully";
                $this->statuscode  =   "1";
            }
            return response()->json(compact('this')); 
}
                    //}catch (\Exception $e){
                    // DB::rollback();
                    //}
                    //return $id; 
    }

   
    public function getData($invoice_id,$user_id){
        if(!empty($invoice_id) && !empty($user_id) ){
           // DB::enableQueryLog();
           $all_datas = DB::table('imagefootage_performa_invoices')
            ->select('imagefootage_performa_invoices.*','imagefootage_performa_invoices.modified as invicecreted','imagefootage_performa_invoice_items.*','usr.first_name','usr.last_name','usr.title','usr.user_name','usr.contact_owner','usr.email','usr.mobile','usr.phone','usr.postal_code','usr.description','usr.gst','usr.pan','ct.name as cityname','st.state as statename','cn.name as countryname')
            ->join('imagefootage_performa_invoice_items','imagefootage_performa_invoice_items.invoice_id','=','imagefootage_performa_invoices.id')
            ->join('imagefootage_users as usr','usr.id','=','imagefootage_performa_invoices.user_id')
            ->where('imagefootage_performa_invoices.id','=',$invoice_id)
            ->where('imagefootage_performa_invoices.user_id','=',$user_id)
            ->join('countries as cn','cn.id','=','usr.country')
            ->join('states as st','st.id','=','usr.state')
            ->join('cities as ct','ct.id','=','usr.city')
            ->get()
            ->toArray();
            //dd(DB::getQueryLog());
            return  $all_datas;
      }
    }
    public function getSubData($invoice_id,$user_id){
        if(!empty($invoice_id) && !empty($user_id) ){
           // DB::enableQueryLog();
           $all_datas = DB::table('imagefootage_performa_invoices')
            ->select('imagefootage_performa_invoices.*','imagefootage_performa_invoices.modified as invicecreted','usr.first_name','usr.last_name','usr.title','usr.user_name','usr.contact_owner','usr.email','usr.mobile','usr.phone','usr.postal_code','usr.address','usr.description','usr.gst', 'usr.pan','ct.name as cityname','st.state as statename','cn.name as countryname', 'imagefootage_user_package.id as package_id','imagefootage_user_package.package_name', 'imagefootage_user_package.package_description', 'imagefootage_user_package.package_plan', 'imagefootage_user_package.package_expiry_yearly', 'imagefootage_user_package.package_type', 'imagefootage_user_package.pacage_size', 'imagefootage_user_package.package_products_count', 'imagefootage_user_package.package_price')
            ->join('imagefootage_user_package','imagefootage_user_package.id','=','imagefootage_performa_invoices.package_id')
            ->join('imagefootage_users as usr','usr.id','=','imagefootage_performa_invoices.user_id')
            ->where('imagefootage_performa_invoices.id','=',$invoice_id)
            ->where('imagefootage_performa_invoices.user_id','=',$user_id)
            ->join('countries as cn','cn.id','=','usr.country')
            ->join('states as st','st.id','=','usr.state')
            ->join('cities as ct','ct.id','=','usr.city')
            ->get()
            ->toArray();
            //dd(DB::getQueryLog());
            return  $all_datas;
      }
    }

    public function getQuotationData($quotation_id){
        if(!empty($quotation_id)){
            // DB::enableQueryLog();
            $all_datas = Invoice::select('imagefootage_performa_invoices.*')
                ->with('items')
                ->where('imagefootage_performa_invoices.id','=',$quotation_id)
                ->first()
                ->toArray();
            //dd(DB::getQueryLog());
            return  response()->json($all_datas);

        }
    }

    public function create_invoice($quotation_id,$user_id){
        $dataForEmail = $this->getData($quotation_id,$user_id);

        $dataForEmail = json_decode(json_encode($dataForEmail), true);
        $transactionRequest = new TransactionRequest();
        //Setting all values here
        $transactionRequest->setMode($this->mode);
        $transactionRequest->setLogin($this->login);
        $transactionRequest->setPassword($this->password);
        $transactionRequest->setProductId($this->atomprodId);
        $transactionRequest->setAmount($dataForEmail[0]['total']+$dataForEmail[0]['tax']);
        $transactionRequest->setTransactionCurrency("INR");
        $transactionRequest->setTransactionAmount($dataForEmail[0]['total']+$dataForEmail[0]['tax']);

        $transactionRequest->setReturnUrl(url('/api/atomPayInvoiceResponse'));
        $transactionRequest->setClientCode($this->clientcode);
        $transactionRequest->setTransactionId($dataForEmail[0]['invoice_name']);
        $datenow = date("d/m/Y h:m:s",strtotime($dataForEmail[0]['invicecreted']));
        $transactionDate = str_replace(" ", "%20", $datenow);
        $transactionRequest->setTransactionDate($transactionDate);
        $transactionRequest->setCustomerName($dataForEmail[0]['first_name']);
        $transactionRequest->setCustomerEmailId($dataForEmail[0]['email']);
        $transactionRequest->setCustomerMobile($dataForEmail[0]['mobile']);
        $transactionRequest->setCustomerBillingAddress("India");
        $transactionRequest->setCustomerAccount($user_id);
        $transactionRequest->setReqHashKey($this->atomRequestKey);
        $url = $transactionRequest->getPGUrl();
        $dataForEmail[0]['payment_url'] = $url;
        $pdf = PDF::loadHTML(view('email.backend_invoice', ['quotation' => $dataForEmail]));
        $fileName = $dataForEmail[0]['invoice_name']."_invoice.pdf";
        $pdf->save(storage_path('app/public/pdf'). '/' . $fileName);
        $data["subject"] = "Invoice (".$dataForEmail[0]['invoice_name'].")";
        $data["email"] = $dataForEmail[0]['email_id'];
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
            Mail::send('mail', $data, function($message)use($data,$pdf,$fileName) {
                $message->to($data["email"])
                            ->from('admin@imagefootage.com', 'Imagefootage')
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), $fileName);
            });

            $s3Client = new S3Client([
                /*'profile' => 'default',*/
                'region' => 'us-east-2',
                'version' => '2006-03-01'
            ]);
            $path ='invoice/'.$fileName;
            $source = fopen(storage_path('app/public/pdf'). '/' . $fileName, 'rb');
            $uploader = new MultipartUploader($s3Client, $source, [
                'bucket' => 'imgfootage',
                'key' => $path,
            ]);
            try {
                $fileupresult = $uploader->upload();
            } catch (MultipartUploadException $e) {
                echo $e->getMessage() . "\n";
            }
            $pdf_path = $fileupresult['ObjectURL'];
            if(!empty($pdf_path)){
                DB::table('imagefootage_performa_invoices')
                    ->where('id','=',$quotation_id)
                    ->update(['invoice_url'=>$pdf_path,'proforma_type'=>'2','invoice_created'=>date('Y-m-d H:i:s')]);
                unlink(storage_path('app/public/pdf'). '/' . $fileName);
            }
            $resp =array();
        if (Mail::failures()) {
            $resp['statusdesc']  =   "Error sending mail";
            $resp['statuscode']   =   "0";
        }else{
            $resp['statusdesc']  =   "Invoice sent Succesfully";
            $resp['statuscode']  =   "1";
        }
        return response()->json(compact('resp'));

    }

    public function create_invoice_subscription($quotation_id,$user_id, $po, $po_date, $payment_method){
        $dataForEmail = $this->getSubData($quotation_id,$user_id);
        $dataForEmail = json_decode(json_encode($dataForEmail), true);
        $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);
       
         if ($payment_method == 'online') {
            $transactionRequest = new TransactionRequest();
            //Setting all values here
            $transactionRequest->setMode($this->mode);
            $transactionRequest->setLogin($this->login);
            $transactionRequest->setPassword($this->password);
            $transactionRequest->setProductId($this->atomprodId);
            $transactionRequest->setAmount($dataForEmail[0]['total']);
            $transactionRequest->setTransactionCurrency("INR");
            $transactionRequest->setTransactionAmount($dataForEmail[0]['total']);
    
            $transactionRequest->setReturnUrl(url('/api/atomSubPayInvoiceResponse'));
            $transactionRequest->setClientCode($this->clientcode);
            $transactionRequest->setTransactionId($dataForEmail[0]['invoice_name']);
            $datenow = date("d/m/Y h:m:s",strtotime($dataForEmail[0]['invicecreted']));
            $transactionDate = str_replace(" ", "%20", $datenow);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($dataForEmail[0]['first_name']);
            $transactionRequest->setCustomerEmailId($dataForEmail[0]['email']);
            $transactionRequest->setCustomerMobile($dataForEmail[0]['mobile']);
            $transactionRequest->setCustomerBillingAddress("India");
            $transactionRequest->setCustomerAccount($user_id);
            $transactionRequest->setReqHashKey($this->atomRequestKey);
            $url = $transactionRequest->getPGUrl();
            $dataForEmail[0]['payment_url'] = $url;
         }
            $pdf = PDF::loadHTML(view('email.plan_invoice_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words' => strtoupper($amount_in_words), 'payment_method' => $payment_method]));
        
        $fileName = $dataForEmail[0]['invoice_name']."_invoice.pdf";
        $pdf->save(storage_path('app/public/pdf'). '/' . $fileName);
        $data["subject"] = "Invoice (".$dataForEmail[0]['invoice_name'].")";
        $data["email"] = $dataForEmail[0]['email_id'];
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
            Mail::send('mail', $data, function($message)use($data,$pdf,$fileName) {
                $message->to($data["email"])
                            ->from('admin@imagefootage.com', 'Imagefootage')
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), $fileName);
            });

            $s3Client = new S3Client([
                /*'profile' => 'default',*/
                'region' => 'us-east-2',
                'version' => '2006-03-01'
            ]);
            $path ='invoice/'.$fileName;
            $source = fopen(storage_path('app/public/pdf'). '/' . $fileName, 'rb');
            $uploader = new MultipartUploader($s3Client, $source, [
                'bucket' => 'imgfootage',
                'key' => $path,
            ]);
            try {
                $fileupresult = $uploader->upload();
            } catch (MultipartUploadException $e) {
                echo $e->getMessage() . "\n";
            }
            $pdf_path = $fileupresult['ObjectURL'];
            if(!empty($pdf_path)){
                DB::table('imagefootage_performa_invoices')
                    ->where('id','=',$quotation_id)
                    ->update(['invoice_url'=>$pdf_path,'proforma_type'=>'2','invoice_created'=>date('Y-m-d H:i:s'), 'job_number'=> $po, 'po_detail'=>$po_date, 'payment_method' => $payment_method]);
                DB::table('imagefootage_user_package')
                    ->where('id','=', $dataForEmail[0]['package_id'])
                    ->update(['status'=> 0,'order_type'=>'2']);       
                unlink(storage_path('app/public/pdf'). '/' . $fileName);
            }
            $resp =array();
        if (Mail::failures()) {
            $resp['statusdesc']  =   "Error sending mail";
            $resp['statuscode']   =   "0";
        }else{
            $resp['statusdesc']  =   "Invoice sent Succesfully";
            $resp['statuscode']  =   "1";
        }
        return response()->json(compact('resp'));
    }

    public function change_invoice_status($quotation_id,$status){
        $update = Invoice::where('id','=',$quotation_id)
                ->update(['status'=>$status]);
        $resp =array();
        if($update) {
            $resp['statusdesc'] = "Your Quotation/Invoice status changed Successfully!!";
            $resp['statuscode'] = "1";
        }else{
            $resp['statusdesc']  =   "Error in change status";
            $resp['statuscode']   =   "0";
        }
        return response()->json(compact('resp'));
    }

    public function save_subscription_proforma($data){

        ini_set('max_execution_time', 0);
        
        $selected_taxes = array();
    
        if(isset($data['GSTS']) && $data['GSTS']==1){
            $selected_taxes['GST']='1';
        }else{
            $selected_taxes['GST']='0';
        } 

               
        $allFields = Package::find($data['plan_id']['package_id']);
        $packge = new UserPackage();
        $packge->user_id = $data['uid'];               
        $packge->package_id = $allFields['package_id'];
        $packge->package_name = $allFields['package_name'];
        $packge->package_price = $allFields['package_price'];
        $packge->package_description = $allFields['package_description'];
        $packge->package_products_count = $allFields['package_products_count'];
        $packge->package_type = $allFields['package_type'];
        $packge->package_permonth_download = $allFields['package_permonth_download'];
        $packge->package_expiry = $allFields['package_expiry'];
        $packge->package_plan = $allFields['package_plan'];
        $packge->package_pcarry_forward = $allFields['package_pcarry_forward'];
        $packge->package_expiry_yearly = $allFields['package_expiry_yearly'];
        $packge->pacage_size = $allFields['pacage_size'];
        $packge->status = 0; 
        $packge->order_type = 2;           
        $packge->created_at = date('Y-m-d H:i:s');
        if($allFields['package_expiry'] !=0 && $allFields['package_expiry_yearly']==0){
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s',strtotime("+".$allFields['package_expiry']." months"));
        }else{
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s',strtotime("+".$allFields['package_expiry_yearly']." years"));
        }
        $packge->save();
                
        $insert = array(
            'user_id'=> $data['uid'],
            'email_id'=> $data['email'],
            'invoice_name'=> $this->random_numbers(),
            'invoice_type'=> '1',
            'created'=>date('Y-m-d H:i:s'),
            'modified'=>date('Y-m-d H:i:s'),
            //'job_number'=>$data['po'],
            'promo_code'=>'',
            'tax'=> $data['tax'] ?? '',
            'tax_selected'=> "GST",
            'total'=>$data['total'],
            'status'=>'0', 
            'proforma_type' => '1',
            'package_id' => $packge->id,
            'expiry_invoices'=>$data['expiry_date'],
            //'po_detail'=>date('Y-m-d',strtotime($data['poDate']))

        );

        DB::table('imagefootage_performa_invoices')->insert($insert);   
        $id = DB::getPdo()->lastInsertId();
                   
        if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
            Invoice::where('id', '=', $data['old_quotation'])->update(['status' => 3]);
        }

        $dataForEmail  = $this->getSubData($id,$data['uid']);

        
        $dataForEmail = json_decode(json_encode($dataForEmail), true); 
        
            $transactionRequest = new TransactionRequest();
            //Setting all values here
            $transactionRequest->setMode($this->mode);
            $transactionRequest->setLogin($this->login);
            $transactionRequest->setPassword($this->password);
            $transactionRequest->setProductId($this->atomprodId);
            $transactionRequest->setAmount($dataForEmail[0]['total']);
            $transactionRequest->setTransactionCurrency("INR");
            $transactionRequest->setTransactionAmount($dataForEmail[0]['total']);
    
            $transactionRequest->setReturnUrl(url('/api/atomSubPayInvoiceResponse'));
            $transactionRequest->setClientCode($this->clientcode);
            $transactionRequest->setTransactionId($dataForEmail[0]['invoice_name']);
            $datenow = date("d/m/Y h:m:s",strtotime($dataForEmail[0]['invicecreted']));
            $transactionDate = str_replace(" ", "%20", $datenow);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($dataForEmail[0]['first_name']);
            $transactionRequest->setCustomerEmailId($dataForEmail[0]['email']);
            $transactionRequest->setCustomerMobile($dataForEmail[0]['mobile']);
            $transactionRequest->setCustomerBillingAddress("India");
            $transactionRequest->setCustomerAccount($data['uid']);
            $transactionRequest->setReqHashKey($this->atomRequestKey);
            $url = $transactionRequest->getPGUrl();
            $dataForEmail[0]['payment_url'] = $url;

        // print_r($transactionRequest); die;
                       
        $data["subject"] = "Subscription Quotation (".$dataForEmail[0]['invoice_name'].")";
        $data["email"] =   $data['email'];
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
        $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);
        $package_price_in_words   =  $this->convert_number_to_words($dataForEmail[0]['package_price']);

        $pdf = PDF::loadHTML(view('email.plan_quotation_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words' => $amount_in_words, 'package_price_in_words' => $package_price_in_words]));
        $fileName = $data["invoice"]."subscription_quotation.pdf";
        $pdf->save(storage_path('app/public/pdf'). '/' . $fileName);
        try{
            Mail::send('mail', $data, function($message)use($data,$pdf,$fileName) {
                $message->to($data["email"])
                ->from('admin@imagefootage.com', 'Imagefootage')
                ->subject($data["subject"])
                ->attachData($pdf->output(), $fileName);
            });

            $s3Client = new S3Client([
                /*'profile' => 'default',*/
                'region' => 'us-east-2',
                'version' => '2006-03-01'
            ]);
            
            $path ='quotation/'.$fileName;
            $source = fopen(storage_path('app/public/pdf'). '/' . $fileName, 'rb');
            $uploader = new MultipartUploader($s3Client, $source, [
                'bucket' => 'imgfootage',
                'key' => $path,
            ]);
        try {
                $fileupresult = $uploader->upload();
            } catch (MultipartUploadException $e) {
                echo $e->getMessage() . "\n";
            }
            $pdf_path = $fileupresult['ObjectURL'];
            if(!empty($pdf_path)){
                DB::table('imagefootage_performa_invoices')
                    ->where('id','=',$id)
                    ->update(['quotation_url'=>$pdf_path]);
                unlink(storage_path('app/public/pdf'). '/' . $fileName);
            }
        
    }catch(JWTException $exception){
        $this->serverstatuscode = "0";
        $this->serverstatusdes = $exception->getMessage();
    }
    if (Mail::failures()) {
        $this->statusdesc  =   "Error sending mail";
        $this->statuscode  =   "0";
    }else{
        $this->statusdesc  =   "Subscription Quotation sent Succesfully";
        $this->statuscode  =   "1";
    }
    return response()->json(compact('this'));               
    }


public function save_download_proforma($data){

            ini_set('max_execution_time', 0);
            //echo "<pre>"; print_r($data); die;
            $selected_taxes = array();

            if(isset($data['GSTS']) && $data['GSTS']==1){
                $selected_taxes['GST']='1';
            }else{
                $selected_taxes['GST']='0';
            } 

            $allFields = Package::find($data['plan_id']['package_id']);
            $packge = new UserPackage();
            $packge->user_id = $data['uid'];               
            $packge->package_id = $allFields['package_id'];
            $packge->package_name = $allFields['package_name'];
            $packge->package_price = $allFields['package_price'];
            $packge->package_description = $allFields['package_description'];
            $packge->package_products_count = $allFields['package_products_count'];
            $packge->package_type = $allFields['package_type'];
            $packge->package_permonth_download = $allFields['package_permonth_download'];
            $packge->package_expiry = $allFields['package_expiry'];
            $packge->package_plan = $allFields['package_plan'];
            $packge->package_pcarry_forward = $allFields['package_pcarry_forward'];
            $packge->package_expiry_yearly = $allFields['package_expiry_yearly'];
            $packge->pacage_size = $allFields['pacage_size'];
            $packge->status = 0; 
            $packge->order_type = 2;       
            $packge->created_at = date('Y-m-d H:i:s');
            if($allFields['package_expiry'] !=0 && $allFields['package_expiry_yearly']==0){
                $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s',strtotime("+".$allFields['package_expiry']." months"));
            }else{
                $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s',strtotime("+".$allFields['package_expiry_yearly']." years"));
            }
            $packge->save();
            $insert = array(
                'user_id'=> $data['uid'],
                'email_id'=> $data['email'],
                'invoice_name'=> $this->random_numbers(),
                'invoice_type'=> '2',
                'created'=>date('Y-m-d H:i:s'),
                'modified'=>date('Y-m-d H:i:s'),
                //'job_number'=>$data['po'],
                'promo_code'=>'',
                'tax'=> $data['tax'] ?? '',
                'tax_selected'=> "GST",
                'total'=>$data['total'],
                'status'=>'0', 
                'proforma_type' => '1',
                'package_id' => $packge->id,
                'expiry_invoices'=>$data['expiry_date'],
                //'po_detail'=>date('Y-m-d',strtotime($data['poDate']))

            );

            DB::table('imagefootage_performa_invoices')->insert($insert);   
            $id = DB::getPdo()->lastInsertId();
           
               
                if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
                    Invoice::where('id', '=', $data['old_quotation'])->update(['status' => 3]);
                }

                    $dataForEmail  = $this->getSubData($id,$data['uid']); 
                   
                    $dataForEmail = json_decode(json_encode($dataForEmail), true);
                    $transactionRequest = new TransactionRequest();
                    //Setting all values here
                    $transactionRequest->setMode($this->mode);
                    $transactionRequest->setLogin($this->login);
                    $transactionRequest->setPassword($this->password);
                    $transactionRequest->setProductId($this->atomprodId);
                    $transactionRequest->setAmount($dataForEmail[0]['total']);
                    $transactionRequest->setTransactionCurrency("INR");
                    $transactionRequest->setTransactionAmount($dataForEmail[0]['total']);
            
                    $transactionRequest->setReturnUrl(url('/api/atomSubPayInvoiceResponse'));
                    $transactionRequest->setClientCode($this->clientcode);
                    $transactionRequest->setTransactionId($dataForEmail[0]['invoice_name']);
                    $datenow = date("d/m/Y h:m:s",strtotime($dataForEmail[0]['invicecreted']));
                    $transactionDate = str_replace(" ", "%20", $datenow);
                    $transactionRequest->setTransactionDate($transactionDate);
                    $transactionRequest->setCustomerName($dataForEmail[0]['first_name']);
                    $transactionRequest->setCustomerEmailId($dataForEmail[0]['email']);
                    $transactionRequest->setCustomerMobile($dataForEmail[0]['mobile']);
                    $transactionRequest->setCustomerBillingAddress("India");
                    $transactionRequest->setCustomerAccount($data['uid']);
                    $transactionRequest->setReqHashKey($this->atomRequestKey);
                    $url = $transactionRequest->getPGUrl();
                    $dataForEmail[0]['payment_url'] = $url;  

                    $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);
                    $package_price_in_words   =  $this->convert_number_to_words($dataForEmail[0]['package_price']);
                         
                    $data["subject"] = "Download Quotation (".$dataForEmail[0]['invoice_name'].")";
                    $data["email"] =   $data['email'];
                    $data["invoice"] = $dataForEmail[0]['invoice_name'];
                    

                    $pdf = PDF::loadHTML(view('email.plan_quotation_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words'=> $amount_in_words, 'package_price_in_words' => $package_price_in_words]));
                    $fileName = $data["invoice"]."download_quotation.pdf";
                    $pdf->save(storage_path('app/public/pdf'). '/' . $fileName);
                    try{
                        Mail::send('mail', $data, function($message)use($data,$pdf,$fileName) {
                        $message->to($data["email"])
                        ->from('admin@imagefootage.com', 'Imagefootage')
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), $fileName);
                        });

                        $s3Client = new S3Client([
                            /*'profile' => 'default',*/
                            'region' => 'us-east-2',
                            'version' => '2006-03-01'
                        ]);
                       
                        $path ='quotation/'.$fileName;
                        $source = fopen(storage_path('app/public/pdf'). '/' . $fileName, 'rb');
                        $uploader = new MultipartUploader($s3Client, $source, [
                            'bucket' => 'imgfootage',
                            'key' => $path,
                        ]);
                    try {
                            $fileupresult = $uploader->upload();
                        } catch (MultipartUploadException $e) {
                            echo $e->getMessage() . "\n";
                        }
                        $pdf_path = $fileupresult['ObjectURL'];
                        if(!empty($pdf_path)){
                            DB::table('imagefootage_performa_invoices')
                                ->where('id','=',$id)
                                ->update(['quotation_url'=>$pdf_path]);
                            unlink(storage_path('app/public/pdf'). '/' . $fileName);
                        }
                  
                }catch(JWTException $exception){
                    $this->serverstatuscode = "0";
                    $this->serverstatusdes = $exception->getMessage();
                }
                if (Mail::failures()) {
                    $this->statusdesc  =   "Error sending mail";
                    $this->statuscode  =   "0";
                }else{
                    $this->statusdesc  =   "Download Quotation sent Succesfully";
                    $this->statuscode  =   "1";
                }
            return response()->json(compact('this'));             
  
    }


    public function convert_number_to_words($number) {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

    public static function imagesaver($image_data){ 
        list($type, $data) = explode(';', $image_data); // exploding data for later checking and validating 

        if (preg_match('/^data:image\/(\w+);base64,/', $image_data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif
        
            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                throw new \Exception('invalid image type');
            }
        
            $data = base64_decode($data);
        
            if ($data === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }
        
        $fullname = rand().time().'.'.$type;
        
        if(file_put_contents(public_path('image/').$fullname, $data)){
            $s3Client = new S3Client([
                /*'profile' => 'default',*/
                'region' => 'us-east-2',
                'version' => '2006-03-01'
            ]);
            $path ='image/'.$fullname;
            $source = fopen(public_path('image/') . $fullname, 'rb');
            $uploader = new MultipartUploader($s3Client, $source, [
                'bucket' => 'imgfootage',
                'key' => $path,
            ]);
            try {
                $fileupresult = $uploader->upload();
            } catch (MultipartUploadException $e) {
                echo $e->getMessage() . "\n";
            }
            $result = $fileupresult['ObjectURL'];
            unlink(public_path('image/').$fullname);
        }else{
            $result =  "error";
        }
        /* it will return image name if image is saved successfully 
        or it will return error on failing to save image. */
        return $result; 
    }

}
