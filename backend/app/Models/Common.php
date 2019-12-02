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


class Common extends Model
{

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
            'status'=>'1',
            'invoice_type'=>'custom',
            'expiry_invoices'=>$data['expiry_date'],
            'po_detail'=>date('Y-m-d',strtotime($data['poDate'])),
            'invoice_type'=>''
);
        DB::table('imagefootage_performa_invoices')->insert($insert);   
        $id = DB::getPdo()->lastInsertId();

        if(count($data['products'])>0){
        foreach($data['products']['product'] as $eachproduct){
            
            if(isset($eachproduct['newuploadimage']) && count($eachproduct['newuploadimage'])>0){
                
                $name = "invoice_".time().'_'.$eachproduct['newuploadimage'][0]['name'];

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
            }else{
                $image = $eachproduct['image'];
            }
            $insert_product = array(
                'invoice_id'=>$id,
                'user_id'=>$data['uid'],
                'product_id'=> $eachproduct['name'],
                'product_type'=>$eachproduct['pro_type'],
                'product_size'=>$eachproduct['pro_size'],
                'product_image'=>$image,
                'subtotal'=>$eachproduct['price'],
                'status'=>"1",
                'product_web'=>'imagefootage'
       );
            DB::table('imagefootage_performa_invoice_items')->insert($insert_product);   

            } 
                $dataForEmail  = $this->getData($id,$data['uid']); 
                //print_r($dataForEmail); die;
                //$data["email"]="amitpathak.bansal@gmail.com";
                //$data["client_name"]="Test email";
                $dataForEmail = json_decode(json_encode($dataForEmail), true);
                //print_r($dataForEmail); die;
                $data["subject"] = "Quotation (".$dataForEmail[0]['invoice_name'].")";
                $data["email"] = $dataForEmail[0]['email'];
                $data["invoice"] = $dataForEmail[0]['invoice_name'];
                
                //echo view('email.quotation', ['quotation' => $dataForEmail])->render(); die;

                $pdf = PDF::loadHTML(view('email.quotation', ['quotation' => $dataForEmail]));
                $fileName = $data["invoice"]."_quotation.pdf";


                try{
                    Mail::send('mail', $data, function($message)use($data,$pdf,$fileName) {
                    $message->to($data["email"])
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
                    $source = file_put_contents($fileName, $pdf->output());
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
                        unlink($fileName);
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
        $this->statusdesc  =   "Invoice sent Succesfully";
        $this->statuscode  =   "1";
    }
    return response()->json(compact('this')); 
   }
        //return $id; 
    }

    public function getData($invoice_id,$user_id){
        if(!empty($invoice_id) && !empty($user_id) ){
           // DB::enableQueryLog();
           $all_datas = DB::table('imagefootage_performa_invoices')
            ->join('imagefootage_performa_invoice_items','imagefootage_performa_invoice_items.invoice_id','=','imagefootage_performa_invoices.id')
            ->join('imagefootage_users','imagefootage_users.id','=','imagefootage_performa_invoices.user_id')
            ->where('imagefootage_performa_invoices.id','=',$invoice_id)
            ->where('imagefootage_performa_invoices.user_id','=',$user_id)
            ->get()
            ->toArray();
            //dd(DB::getQueryLog());
            return  $all_datas;

            ;  
        }
    }

}
