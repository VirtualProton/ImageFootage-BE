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
use App\Http\AtomPay\TransactionRequest;
use App\Http\AtomPay\TransactionResponse;
use App\Models\Invoice;
use App\Models\InvoiceItem;

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
       
        if(isset($data['SGST']) && $data['SGST']==1){
            $selected_taxes['SGST']='1';
        }else{
            $selected_taxes['SGST']='0';
        } 
        
        if(isset($data['CGST']) && $data['CGST']==1){
            $selected_taxes['CGST']='1';
        }else{
            $selected_taxes['CGST']='0';
        }
        if(isset($data['IGST']) && $data['IGST']==1){
            $selected_taxes['IGST']='1';
        }else{
            $selected_taxes['IGST']='0';
        }
        if(isset($data['IGSTT']) && $data['IGSTT']==1){
            $selected_taxes['IGSTT']='1';
        }else{
            $selected_taxes['IGSTT']='0';
        }

        $insert = array(
            'user_id'=> $data['uid'],
            'email_id'=> $data['email'],
            'invoice_name'=>$this->random_numbers(),
            'created'=>date('Y-m-d'),
            'modified'=>date('Y-m-d H:i:s'),
            'job_number'=>$data['po'],
            'promo_code'=>'',
            'tax'=> $data['tax'],
            'tax_selected'=> json_encode($selected_taxes),
            'total'=>$data['total'],
            'status'=>'0',
            'invoice_type'=>'3',
            'proforma_type'=>'1',
            'expiry_invoices'=>$data['expiry_date'],
            'po_detail'=>date('Y-m-d',strtotime($data['poDate']))

    );
        //DB::beginTransaction();
        //try{

        DB::table('imagefootage_performa_invoices')->insert($insert);   
        $id = DB::getPdo()->lastInsertId();
        if(count($data['products'])>0) {
            foreach ($data['products']['product'] as $eachproduct) {

                if (isset($eachproduct['newuploadimage']) && count($eachproduct['newuploadimage']) > 0) {

                    $name = "invoice_" . time() . '_' . $eachproduct['newuploadimage'][0]['name'];

                    $type = "image/png";
//                $base64blob = base64_encode($eachproduct['newuploadimage'][0]['url']);
//                $datauri = "data:$type;base64,$base64blob";
//
//                //file_put_contents('', file_get_contents($eachproduct['newuploadimage'][0]['url']));
//				$files2bucketemp= file_get_contents($eachproduct['newuploadimage'][0]['url']);
//				$file_path='invoice/image';
//
//				$destinationPath = public_path($file_path);
//				//$image->move($destinationPath, $name);
//				$s3Client = new S3Client([
//					/*'profile' => 'default',*/
//					'region' => 'us-east-2',
//					'version' => '2006-03-01'
//				]);
//				// Use multipart upload
//				//print_r($files2bucketemp);
//				//exit();
//				$finelname=$file_path.$name;
//				$source = $files2bucketemp;
//				$uploader = new MultipartUploader($s3Client, $source, [
//					'bucket' => 'imgfootage',
//					'key' => $finelname,
//				]);

//				try {
//					$fileupresult = $uploader->upload();
//				} catch (MultipartUploadException $e) {
//					echo $e->getMessage() . "\n";
//                }
//                $image = $fileupresult['ObjectURL'];
                } else {
                    $image = $eachproduct['image'];
                }
                $insert_product = array(
                    'invoice_id' => $id,
                    'user_id' => $data['uid'],
                    'product_id' => $eachproduct['name'],
                    'product_type' => $eachproduct['pro_type'],
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
                //print_r($dataForEmail); die;
                //$data["email"]="amitpathak.bansal@gmail.com";
                //$data["client_name"]="Test email";
                $dataForEmail = json_decode(json_encode($dataForEmail), true);
                //print_r($dataForEmail); die;
                $data["subject"] = "Quotation (".$dataForEmail[0]['invoice_name'].")";
                $data["email"] = $data['email'];
                $data["invoice"] = $dataForEmail[0]['invoice_name'];

              //echo view('email.quotation', ['quotation' => $dataForEmail])->render(); die;

                $pdf = PDF::loadHTML(view('email.quotation', ['quotation' => $dataForEmail]));
                $fileName = $data["invoice"]."_quotation.pdf";
                $pdf->save(storage_path('app/public/pdf'). '/' . $fileName);
                try{
                    Mail::send('mail', $data, function($message)use($data,$pdf,$fileName) {
                    $message->to($data["email"])
                    //->from('admin@imagefootage.com')
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), $fileName);
                    });

                    $s3Client = new S3Client([
                        /*'profile' => 'default',*/
                        'region' => 'us-east-2',
                        'version' => '2006-03-01'
                    ]);
                    // Use multipart upload
                    //print_r($files2bucketemp);
                    //exit();
                    $path ='quotation/'.$fileName;
                   // $source = file_get_contents(storage_path('app/public/pdf'). '/' . $fileName);
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
                    // Mail::send('email.quotation', ['quotation' => $dataForEmail], function ($message) use($data) {
        //     $message->to($data["email"])
        //     ->subject($data["subject"]);
        // });
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
            ->select('imagefootage_performa_invoices.*','imagefootage_performa_invoices.modified as invicecreted','imagefootage_performa_invoice_items.*','usr.first_name','usr.last_name','usr.title','usr.user_name','usr.contact_owner','usr.email','usr.mobile','usr.phone','usr.postal_code','usr.description','ct.name as cityname','st.state as statename','cn.name as countryname')
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
                    //->from('admin@imagefootage.com')
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), $fileName);
            });

            $s3Client = new S3Client([
                /*'profile' => 'default',*/
                'region' => 'us-east-2',
                'version' => '2006-03-01'
            ]);
            // Use multipart upload
            //print_r($files2bucketemp);
            //exit();
            $path ='invoice/'.$fileName;
            // $source = file_get_contents(storage_path('app/public/pdf'). '/' . $fileName);
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

}
