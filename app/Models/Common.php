<?php

namespace App\Models;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Mail;
use PDF;
use App;
use Helper;
use App\Http\AtomPay\TransactionRequest;
use App\Http\AtomPay\TransactionResponse;
use App\Models\Invoice;
use App\Models\PromoCode;
use App\Models\InvoiceItem;
use App\Models\Package;
use Carbon\Carbon;

class Common extends Model
{
    public $baseurl;
    public $keyRazorId;
    public $keyRazorSecret;
    public $atomRequestKey;
    public $atomResponseKey;
    public $login;
    public $mode;
    public $password;
    public $clientcode;
    public $atomprodId;

    public function __construct()
    {

        date_default_timezone_set('Asia/Kolkata');
        $environment = App::environment();
        $hostname = env('FRONT_END_URL');
        // if (App::environment('local')) {
        //     // The environment is local
        //     $this->baseurl = 'http://localhost:4200';
        //     $this->atomRequestKey = 'KEY123657234';
        //     $this->atomResponseKey = 'KEYRESP123657234';
        //     $this->login = '197';
        //     $this->mode = 'Test';
        //     $this->password = 'Test@123';
        //     $this->clientcode = '007';
        //     $this->atomprodId = 'NSE';
        // } else {
        //$this->baseurl = 'https://imagefootage.com';
        $this->baseurl = $hostname;
        $this->keyRazorId = config('payments.keyRazorId');
        $this->keyRazorSecret = config('payments.keyRazorSecret');
        $this->atomRequestKey = config('payments.atomRequestKey');
        $this->atomResponseKey = config('payments.atomResponseKey');
        $this->login = config('payments.login');
        $this->mode = config('payments.mode');
        $this->password = config('payments.password');
        $this->clientcode = config('payments.clientcode');
        $this->atomprodId = config('payments.atomprodId');
        //}
    }
    public function getCurruncy($col = NULL, $value = NULL)
    {
        if (!empty($id) && !empty($type)) {
            $currencies = DB::table('currency_convertes')->where($col, '=', $value)->get()->toArray();
        } else {
            $currencies = DB::table('currency_convertes')->get()->toArray();
        }
        return $currencies;
    }

    public function getIndustryTypes($col = NULL, $value = NULL)
    {
        if (!empty($id) && !empty($type)) {
            $industrytypes = DB::table('industry_types')->where($col, '=', $value)->get()->toArray();
        } else {
            $industrytypes = DB::table('industry_types')->get()->toArray();
        }
        return $industrytypes;
    }

    public function changeCurruncy($type = NULL, $value = NULL)
    {
        if (!empty($type) && !empty($value)) {

            $price_inr = DB::table('currency_convertes')
                ->select(DB::raw('12*cur_value as price'))
                ->where('name', '=', $type)
                ->get();
        }
        return $price_inr;
    }

    public function checkCategory($category_name = NULL)
    {
        if (!empty($category_name)) {
            $category = DB::table('imagefootage_productcategory')
                ->select('category_id')
                ->where('category_name', '=', $category_name)
                ->get();
            if (count($category) == 0) {
                $insert = array(
                    'category_name' => $category_name,
                    'category_order' => '',
                    'category_added_by' => '1',
                    'category_status' => 'Active'

                );
                DB::table('imagefootage_productcategory')->insert($insert);
                $id = DB::getPdo()->lastInsertId();
                return $id;
            } else {
                return $category[0]->category_id;
            }
        }
    }

    public function random_numbers()
    {
        $digits = 7;
        return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
    }


    public function save_proforma($data)
    {
        $res = $this->verifyUserDetailsExist($data['uid']);
        if(!$res) {
            $this->statusdesc  =   "Please complete the user details.";
            $this->statuscode  =   "0";
            return response()->json(compact('this'));
        }
        ini_set('max_execution_time', 0);
        $selected_taxes = array();

        if (isset($data['GSTS']) && $data['GSTS'] == 1) {
            $selected_taxes['GST'] = '1';
        } else {
            $selected_taxes['GST'] = '0';
        }
        $today = Carbon::now();
        $cancelled_on = $today->addDays($data['expiry_date'])->format('Y-m-d H:i:s');

        $insert = array(
            'user_id' => $data['uid'],
            'end_client' => $data['end_client'] ?? '',
            'email_id' => $data['email'],
            'flag' => $data['flag'],
            'invoice_name' => $this->random_numbers(),
            'created' => date('Y-m-d'),
            'modified' => date('Y-m-d H:i:s'),
            //'job_number'=>$data['po'],
            'promo_code' => '',
            'tax' => $data['tax'] ?? '',
            'tax_selected' => json_encode($selected_taxes),
            'total' => $data['total'],
            'status' => '0',
            'invoice_type' => '3',
            'proforma_type' => '1',
            'expiry_invoices' => $data['expiry_date'],
            'created_by' => Auth::guard('admins')->user()->id,
            'promo_code_id' => isset($data['promo_code_id']) ? $data['promo_code_id'] : 0,
            //'po_detail'=>date('Y-m-d',strtotime($data['poDate']))
            'cancelled_on' => $cancelled_on,
        );
        //DB::beginTransaction();
        //try{
        DB::table('imagefootage_performa_invoices')->insert($insert);
        $id = DB::getPdo()->lastInsertId();

        // Update Total applied code in promo code
        if (!empty($data['promo_code_id'])) {
            $promoCode   = PromoCode::find($data['promo_code_id']);
            $currentUsed = $promoCode->total_applied_code;
            $promoCode->total_applied_code = $currentUsed + 1;
            $promoCode->save();
        }
        // End Update Total applied code in promo code

        if (count($data['products']) > 0) {
            //echo "<pre>"; print_r($data['products']); die; 
            foreach ($data['products']['product'] as $eachproduct) {
                if (filter_var($eachproduct['image'], FILTER_VALIDATE_URL)) {
                    $image = $eachproduct['image'];
                } else {
                    $image = !empty($eachproduct['image']) ? $this->imagesaver($eachproduct['image']) : '';
                    $eachproduct['name'] = '';
                }
                $licence_type = $eachproduct['pro_type'] == 'right_managed' ? $eachproduct['licence_type'] : '';
                $insert_product = array(
                    'invoice_id' => $id,
                    'user_id' => $data['uid'],
                    'product_id' => $eachproduct['name'],
                    'product_type' => $eachproduct['pro_type'],
                    'type' => $eachproduct['type'],
                    'product_size' => $eachproduct['pro_size'],
                    'licence_type' => $licence_type,
                    'product_image' => $image,
                    'subtotal' => $eachproduct['price'],
                    'status' => "1",
                    'product_web' => 'imagefootage',
                    'licence_type' => $eachproduct['licence_type']
                );
                DB::table('imagefootage_performa_invoice_items')->insert($insert_product);
            }
            if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
                $update = [
                    'status' => 3,
                    'expiry_invoices' => $data['expiry_date'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'cancelled_on' => $cancelled_on,
                    'cancelled_by' => Auth::guard('admins')->user()->id
                ];
                Invoice::where('id', '=', $data['old_quotation'])->update($update);
            }
            // dd($id,$data['uid']);
            $dataForEmail  = $this->getData($id, $data['uid']);
            $dataForEmail = json_decode(json_encode($dataForEmail), true);
            // dd($dataForEmail);
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
            $datenow = date("d/m/Y h:m:s", strtotime($dataForEmail[0]['invicecreted']));
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
            // dd($dataForEmail);
            $data["subject"] = "Quotation (" . $dataForEmail[0]['invoice_name'] . ")";
            $data["email"] = $data['email'];
            $data["invoice"] = $dataForEmail[0]['invoice_name'];
            $data["name"] = $dataForEmail[0]['first_name'];
            $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);
            if ($data['flag'] == 0) {
                // For other quotations use image footage logo
                $dataForEmail[0]['company_logo'] = 'images/new-design-logo.png';
            } else {
                // For form2 quotation use other logo
                $dataForEmail[0]['company_logo'] = 'images/conceptual_logo.png';
            }
            $dataForEmail[0]['signature'] = 'images/signature.png';
            $front_end_url_name = config('app.front_end_url');
            $frontend_name = explode('//', rtrim($front_end_url_name, '/#/'));
            $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
            $dataForEmail[0]["frontend_url"] = $front_end_url_name;
            //echo view('email.quotation', ['quotation' => $dataForEmail, 'amount_in_words' => $amount_in_words]); die;
            //PDF genration and email
            $pdf = PDF::loadHTML(view('email.quotation', ['quotation' => $dataForEmail, 'amount_in_words' => $amount_in_words]));
            $fileName = $data["invoice"] . "_quotation.pdf";

            $pdf->save(storage_path('app/public/pdf') . '/' . $fileName);

            try {
                Mail::send('mail', $data, function ($message) use ($data, $pdf, $fileName) {
                    $message->to($data["email"])
                        ->from('admin@imagefootage.com', 'Imagefootage')
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), $fileName);
                });

                $s3Client = new S3Client([
                    // 'profile' => 'default',
                    'region' => 'us-east-2',
                    'version' => '2006-03-01'
                ]);
                $path = 'quotation/' . $fileName;
                $source = fopen(storage_path('app/public/pdf') . '/' . $fileName, 'rb');
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
                if (!empty($pdf_path)) {
                    DB::table('imagefootage_performa_invoices')
                        ->where('id', '=', $id)
                        ->update(['quotation_url' => $pdf_path]);
                    unlink(storage_path('app/public/pdf') . '/' . $fileName);
                }
            } catch (JWTException $exception) {
                $this->serverstatuscode = "0";
                $this->serverstatusdes = $exception->getMessage();
            }
            if (Mail::failures()) {
                $this->statusdesc  =   "Error sending mail";
                $this->statuscode  =   "0";
            } else {
                $this->statusdesc  =   "Quotation sent succesfully";
                $this->statuscode  =   "1";
            }
            return response()->json(compact('this'));
        }
        //}catch (\Exception $e){
        // DB::rollback();
        //}
        //return $id; 
    }


    public function getData($invoice_id, $user_id)
    {
        if (!empty($invoice_id) && !empty($user_id)) {
            // DB::enableQueryLog();
            $all_datas = DB::table('imagefootage_performa_invoices')
                ->select('imagefootage_performa_invoices.*', 'imagefootage_performa_invoices.modified as invicecreted', 'imagefootage_performa_invoice_items.*', 'usr.first_name', 'usr.last_name', 'usr.title', 'usr.user_name', 'usr.contact_owner', 'usr.email', 'usr.mobile', 'usr.phone', 'usr.postal_code', 'usr.description', 'usr.gst', 'usr.pan', 'usr.company', 'ct.name as cityname', 'st.state as statename', 'cn.name as countryname')
                ->join('imagefootage_performa_invoice_items', 'imagefootage_performa_invoice_items.invoice_id', '=', 'imagefootage_performa_invoices.id')
                ->join('imagefootage_users as usr', 'usr.id', '=', 'imagefootage_performa_invoices.user_id')
                ->where('imagefootage_performa_invoices.id', '=', $invoice_id)
                ->where('imagefootage_performa_invoices.user_id', '=', $user_id)
                ->join('countries as cn', 'cn.id', '=', 'usr.country', 'left')
                ->join('states as st', 'st.id', '=', 'usr.state', 'left')
                ->join('cities as ct', 'ct.id', '=', 'usr.city', 'left')
                ->get()
                ->toArray();
            //dd(DB::getQueryLog());
            return  $all_datas;
        }
    }
    public function getSubData($invoice_id, $user_id)
    {
        if (!empty($invoice_id) && !empty($user_id)) {
            // DB::enableQueryLog();
            $all_datas = DB::table('imagefootage_performa_invoices')
                ->select('imagefootage_performa_invoices.*', 'imagefootage_performa_invoices.modified as invicecreted', 'usr.first_name', 'usr.last_name', 'usr.title', 'usr.user_name', 'usr.contact_owner', 'usr.email', 'usr.mobile', 'usr.phone', 'usr.postal_code', 'usr.address', 'usr.address2', 'usr.description', 'usr.gst', 'usr.pan', 'usr.company', 'ct.name as cityname', 'st.state as statename', 'cn.name as countryname', 'imagefootage_user_package.id as package_id', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description', 'imagefootage_user_package.package_plan', 'imagefootage_user_package.package_expiry_yearly', 'imagefootage_user_package.package_type', 'imagefootage_user_package.pacage_size', 'imagefootage_user_package.package_products_count', 'imagefootage_user_package.package_price')
                ->join('imagefootage_user_package', 'imagefootage_user_package.id', '=', 'imagefootage_performa_invoices.package_id')
                ->join('imagefootage_users as usr', 'usr.id', '=', 'imagefootage_performa_invoices.user_id')
                ->where('imagefootage_performa_invoices.id', '=', $invoice_id)
                ->where('imagefootage_performa_invoices.user_id', '=', $user_id)
                ->join('countries as cn', 'cn.id', '=', 'usr.country')
                ->join('states as st', 'st.id', '=', 'usr.state')
                ->join('cities as ct', 'ct.id', '=', 'usr.city')
                ->get()
                ->toArray();
            //dd(DB::getQueryLog());
            return  $all_datas;
        }
    }

    public function getQuotationData($quotation_id)
    {
        if (!empty($quotation_id)) {
            // DB::enableQueryLog();
            $all_datas = Invoice::select('imagefootage_performa_invoices.*')
                ->with('items')
                ->with('user_package:id,package_type,package_expiry,package_expiry_yearly,package_id')
                ->where('imagefootage_performa_invoices.id', '=', $quotation_id)
                ->first()
                ->toArray();
            //dd(DB::getQueryLog());
            return  response()->json($all_datas);
        }
    }

    public function create_invoice($quotation_id, $user_id, $po, $po_date, $payment_method, $request_data)
    {
        //ini_set('max_execution_time', 0);
        User::where('id', $user_id)->update(['gst' => $request_data['gst'], 'pan' => $request_data['pan'], 'mobile' => $request_data['phone'], 'phone' => $request_data['phone']]);
        $dataForEmail = $this->getData($quotation_id, $user_id);

        $dataForEmail = json_decode(json_encode($dataForEmail), true);
        $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);
        $transactionRequest = new TransactionRequest();
        //Setting all values here
        $transactionRequest->setMode($this->mode);
        $transactionRequest->setLogin($this->login);
        $transactionRequest->setPassword($this->password);
        $transactionRequest->setProductId($this->atomprodId);
        $transactionRequest->setAmount($dataForEmail[0]['total'] + $dataForEmail[0]['tax']);
        $transactionRequest->setTransactionCurrency("INR");
        $transactionRequest->setTransactionAmount($dataForEmail[0]['total'] + $dataForEmail[0]['tax']);

        $transactionRequest->setReturnUrl(url('/api/atomPayInvoiceResponse'));
        $transactionRequest->setClientCode($this->clientcode);
        $transactionRequest->setTransactionId($dataForEmail[0]['invoice_name']);
        $datenow = date("d/m/Y h:m:s", strtotime($dataForEmail[0]['invicecreted']));
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

        $dataForEmail[0]['company_logo'] = 'images/new-design-logo.png';
        if ($dataForEmail[0]['flag'] == 0) {
            // For other quotations use image footage logo
            $dataForEmail[0]['company_logo'] = 'images/new-design-logo.png';
        } else {
            // For form2 quotation use other logo
            $dataForEmail[0]['company_logo'] = 'images/conceptual_logo.png';
        }
        $dataForEmail[0]['signature'] = 'images/signature.png';
        $front_end_url_name = config('app.front_end_url');
        $frontend_name = explode('//', rtrim($front_end_url_name, '/#/'));
        $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
        $dataForEmail[0]["frontend_url"] = $front_end_url_name;

        $pdf = PDF::loadHTML(view('email.backend_invoice', ['quotation' => $dataForEmail, 'amount_in_words' => strtoupper($amount_in_words), 'payment_method' => $payment_method, 'po' => $po, 'po_date' => $po_date]));
        $fileName = $dataForEmail[0]['invoice_name'] . "_invoice.pdf";
        $pdf->save(storage_path('app/public/pdf') . '/' . $fileName);
        $data["subject"] = "Invoice (" . $dataForEmail[0]['invoice_name'] . ")";
        $data["email"] = $dataForEmail[0]['email_id'];
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
        $data["name"] = $dataForEmail[0]['first_name'];
        
        Mail::send('invoice', $data, function ($message) use ($data, $pdf, $fileName) {
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
        $path = 'invoice/' . $fileName;
        $source = fopen(storage_path('app/public/pdf') . '/' . $fileName, 'rb');
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
        if (!empty($pdf_path)) {
            $update_data = ['invoice_url' => $pdf_path, 'proforma_type' => '2', 'job_number' => $po, 'po_detail' => $po_date, 'invoice_created' => date('Y-m-d H:i:s'), 'payment_method' => $request_data['payment_method']];
            if (!empty($request_data['payment_method'] == 'chq') && !empty($request_data['expiry_due_date'])) {
                $update_data['expiry_due_date'] = $request_data['expiry_due_date'];
            }
            DB::table('imagefootage_performa_invoices')
                ->where('id', '=', $quotation_id)
                ->update($update_data);
            unlink(storage_path('app/public/pdf') . '/' . $fileName);
        }
        $resp = array();
        if (Mail::failures()) {
            $resp['statusdesc']  =   "Error sending mail";
            $resp['statuscode']   =   "0";
        } else {
            $resp['statusdesc']  =   "Invoice sent succesfully";
            $resp['statuscode']  =   "1";
        }
        return response()->json(compact('resp'));
    }

    public function create_invoice_subscription($quotation_id, $user_id, $po, $po_date, $payment_method, $request_data)
    {
        $dataForEmail = $this->getSubData($quotation_id, $user_id);
        $dataForEmail = json_decode(json_encode($dataForEmail), true);
        $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);

        //if ($payment_method == 'online') {
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
        $datenow = date("d/m/Y h:m:s", strtotime($dataForEmail[0]['invicecreted']));
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
        //}
        $dataForEmail[0]['company_logo'] = 'images/new-design-logo.png';
        $dataForEmail[0]['signature'] = 'images/signature.png';
        $front_end_url_name = config('app.front_end_url');
        $frontend_name = explode('//', rtrim($front_end_url_name, '/#/'));
        $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
        $dataForEmail[0]["frontend_url"] = $front_end_url_name;
        $dataForEmail[0]["INVOICE_PREFIX"] = config('constants.INVOICE_PREFIX') ?? '';
        $dataForEmail[0]["GSTIN_VALUE"] = config('constants.GSTIN_VALUE') ?? '';
        $dataForEmail[0]["PAN_VALUE"] = config('constants.PAN_VALUE') ?? '';
        $dataForEmail[0]['package_products_count_in_words'] =  $this->convert_number_to_words($dataForEmail[0]['package_products_count']) ?? '';
        $pdf = PDF::loadHTML(view('email.plan_invoice_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words' => strtoupper($amount_in_words), 'payment_method' => $payment_method]));

        $fileName = $dataForEmail[0]['invoice_name'] . "_invoice.pdf";
        $pdf->save(storage_path('app/public/pdf') . '/' . $fileName);
        $data["subject"] = "Invoice (" . $dataForEmail[0]['invoice_name'] . ")";
        $data["email"] = $dataForEmail[0]['email_id'];
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
        $data['name'] = $dataForEmail[0]['first_name'];
        Mail::send('invoice', $data, function ($message) use ($data, $pdf, $fileName) {
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
        $path = 'invoice/' . $fileName;
        $source = fopen(storage_path('app/public/pdf') . '/' . $fileName, 'rb');
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
        if (!empty($pdf_path)) {
            $update_data = ['invoice_url' => $pdf_path, 'proforma_type' => '2', 'invoice_created' => date('Y-m-d H:i:s'), 'job_number' => $po, 'po_detail' => $po_date, 'payment_method' => $payment_method];
            if (!empty($payment_method == 'chq') && !empty($request_data['expiry_due_date'])) {
                $update_data['expiry_due_date'] = $request_data['expiry_due_date'];
            }
            DB::table('imagefootage_performa_invoices')
                ->where('id', '=', $quotation_id)
                ->update($update_data);
            DB::table('imagefootage_user_package')
                ->where('id', '=', $dataForEmail[0]['package_id'])
                ->update(['status' => 0, 'order_type' => '2']);
            unlink(storage_path('app/public/pdf') . '/' . $fileName);
        }
        $resp = array();
        if (Mail::failures()) {
            $resp['statusdesc']  =   "Error sending mail";
            $resp['statuscode']   =   "0";
        } else {
            $resp['statusdesc']  =   "Invoice sent succesfully";
            $resp['statuscode']  =   "1";
        }
        return response()->json(compact('resp'));
    }

    public function change_invoice_status($quotation_id, $status)
    {
        $update = Invoice::where('id', '=', $quotation_id)
            ->update(['status' => $status]);
        $resp = array();
        if ($update) {
            $resp['statusdesc'] = "Your Quotation/Invoice status changed successfully!!";
            $resp['statuscode'] = "1";
        } else {
            $resp['statusdesc']  =   "Error in change status";
            $resp['statuscode']   =   "0";
        }
        return response()->json(compact('resp'));
    }

    public function save_subscription_proforma($data)
    {
        $res = $this->verifyUserDetailsExist($data['uid']);
        if(!$res) {
            $this->statusdesc  =   "Please complete the user details.";
            $this->statuscode  =   "0";
            return response()->json(compact('this'));
        }
        ini_set('max_execution_time', 0);

        $selected_taxes = array();

        if (isset($data['GSTS']) && $data['GSTS'] == 1) {
            $selected_taxes['GST'] = '1';
        } else {
            $selected_taxes['GST'] = '0';
        }

        $today = Carbon::now();
        $cancelled_on = $today->addDays($data['expiry_date'])->format('Y-m-d H:i:s');
        $package_id = !empty($data['plan_id']['package_id']) ? $data['plan_id']['package_id'] : $data['plan_id'];
        $allFields = Package::find($package_id);
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
        if ($allFields['package_expiry'] != 0 && $allFields['package_expiry_yearly'] == 0) {
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s', strtotime("+" . $allFields['package_expiry'] . " months"));
        } else {
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s', strtotime("+" . $allFields['package_expiry_yearly'] . " years"));
        }
        $packge->save();
        $package_name = '';
        if ($packge->package_expiry == 3) {
            $package_name = 'Quarterly';
        } else if ($packge->package_expiry == 6) {
            $package_name = 'Half Year';
        } else if ($packge->package_expiry > 0) {
            $package_name = 'Monthly';
        } else if ($packge->package_expiry_yearly == 1) {
            $package_name = 'Annual';
        }

        $insert = array(
            'user_id' => $data['uid'],
            'email_id' => $data['email'],
            'invoice_name' => $this->random_numbers(),
            'invoice_type' => '1',
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s'),
            //'job_number'=>$data['po'],
            'promo_code' => '',
            'tax' => $data['tax'] ?? '',
            'tax_selected' => "GST",
            'total' => $data['total'],
            'status' => '0',
            'proforma_type' => '1',
            'package_id' => $packge->id,
            'expiry_invoices' => $data['expiry_date'],
            //'po_detail'=>date('Y-m-d',strtotime($data['poDate']))
            'promo_code_id' => isset($data['promo_code_id']) ? $data['promo_code_id'] : 0,
            'created_by' => Auth::guard('admins')->user()->id,
            'flag' => $data['flag'] ?? '',
            'cancelled_on' => $cancelled_on,
        );

        DB::table('imagefootage_performa_invoices')->insert($insert);
        $id = DB::getPdo()->lastInsertId();

        // Update Total applied code in promo code
        if (!empty($data['promo_code_id'])) {
            $promoCode   = PromoCode::find($data['promo_code_id']);
            $currentUsed = $promoCode->total_applied_code;
            $promoCode->total_applied_code = $currentUsed + 1;
            $promoCode->save();
        }
        // End Update Total applied code in promo code

        if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
            $update = [
                'status' => 3,
                'expiry_invoices' => $data['expiry_date'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'cancelled_on' => $cancelled_on,
                'cancelled_by' => Auth::guard('admins')->user()->id
            ];
            Invoice::where('id', '=', $data['old_quotation'])->update($update);
        }

        $dataForEmail  = $this->getSubData($id, $data['uid']);


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
        $datenow = date("d/m/Y h:m:s", strtotime($dataForEmail[0]['invicecreted']));
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

        $data["subject"] = "Subscription Quotation (" . $dataForEmail[0]['invoice_name'] . ")";
        $data["email"] =   $data['email'];
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
        $data["name"] = $dataForEmail[0]['first_name'];
        $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);
        $package_price_in_words   =  $this->convert_number_to_words($dataForEmail[0]['package_price']);
        $dataForEmail[0]['company_logo'] = 'images/new-design-logo.png';
        $dataForEmail[0]['signature'] = 'images/signature.png';
        $dataForEmail[0]['description'] = 'Subscription Plan – Images – ' . $package_name . ' Pack';
        $front_end_url_name = config('app.front_end_url');
        $frontend_name = explode('//', rtrim($front_end_url_name, '/#/'));
        $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
        $dataForEmail[0]["frontend_url"] = $front_end_url_name;

        $pdf = PDF::loadHTML(view('email.plan_quotation_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words' => $amount_in_words, 'package_price_in_words' => $package_price_in_words]));
        $fileName = $data["invoice"] . "subscription_quotation.pdf";
        $pdf->save(storage_path('app/public/pdf') . '/' . $fileName);
        try {
            Mail::send('mail', $data, function ($message) use ($data, $pdf, $fileName) {
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

            $path = 'quotation/' . $fileName;
            $source = fopen(storage_path('app/public/pdf') . '/' . $fileName, 'rb');
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
            if (!empty($pdf_path)) {
                DB::table('imagefootage_performa_invoices')
                    ->where('id', '=', $id)
                    ->update(['quotation_url' => $pdf_path]);
                unlink(storage_path('app/public/pdf') . '/' . $fileName);
            }
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        } else {
            $this->statusdesc  =   "Subscription quotation sent succesfully";
            $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
    }


    public function save_download_proforma($data)
    {
        $res = $this->verifyUserDetailsExist($data['uid']);
        if(!$res) {
            $this->statusdesc  =   "Please complete the user details.";
            $this->statuscode  =   "0";
            return response()->json(compact('this'));
        }
        ini_set('max_execution_time', 0);
        //echo "<pre>"; print_r($data); die;
        $selected_taxes = array();

        if (isset($data['GSTS']) && $data['GSTS'] == 1) {
            $selected_taxes['GST'] = '1';
        } else {
            $selected_taxes['GST'] = '0';
        }

        $today = Carbon::now();
        $cancelled_on = $today->addDays($data['expiry_date'])->format('Y-m-d H:i:s');
        $package_id = !empty($data['plan_id']['package_id']) ? $data['plan_id']['package_id'] : $data['plan_id'];
        $allFields = Package::find($package_id);
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
        if ($allFields['package_expiry'] != 0 && $allFields['package_expiry_yearly'] == 0) {
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s', strtotime("+" . $allFields['package_expiry'] . " months"));
        } else {
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s', strtotime("+" . $allFields['package_expiry_yearly'] . " years"));
        }
        $packge->save();
        $insert = array(
            'user_id' => $data['uid'],
            'email_id' => $data['email'],
            'invoice_name' => $this->random_numbers(),
            'invoice_type' => '2',
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s'),
            //'job_number'=>$data['po'],
            'promo_code' => '',
            'tax' => $data['tax'] ?? '',
            'tax_selected' => "GST",
            'total' => $data['total'],
            'status' => '0',
            'proforma_type' => '1',
            'package_id' => $packge->id,
            'expiry_invoices' => $data['expiry_date'],
            //'po_detail'=>date('Y-m-d',strtotime($data['poDate']))
            'promo_code_id' => isset($data['promo_code_id']) ? $data['promo_code_id'] : 0,
            'created_by' => Auth::guard('admins')->user()->id,
            'flag' => $data['flag'] ?? '',
            'cancelled_on' => $cancelled_on,
        );

        DB::table('imagefootage_performa_invoices')->insert($insert);
        $id = DB::getPdo()->lastInsertId();

        // Update Total applied code in promo code
        if (!empty($data['promo_code_id'])) {
            $promoCode   = PromoCode::find($data['promo_code_id']);
            $currentUsed = $promoCode->total_applied_code;
            $promoCode->total_applied_code = $currentUsed + 1;
            $promoCode->save();
        }
        // End Update Total applied code in promo code

        if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
            $update = [
                'status' => 3,
                'expiry_invoices' => $data['expiry_date'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'cancelled_on' => $cancelled_on,
                'cancelled_by' => Auth::guard('admins')->user()->id
            ];
            Invoice::where('id', '=', $data['old_quotation'])->update($update);
        }

        $dataForEmail  = $this->getSubData($id, $data['uid']);

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
        $datenow = date("d/m/Y h:m:s", strtotime($dataForEmail[0]['invicecreted']));
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

        $data["subject"] = "Download Quotation (" . $dataForEmail[0]['invoice_name'] . ")";
        $data["email"] =   $data['email'];
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
        $data["name"] = $dataForEmail[0]['first_name'];
        $dataForEmail[0]['company_logo'] = 'images/new-design-logo.png';
        $dataForEmail[0]['signature'] = 'images/signature.png';
        $dataForEmail[0]['description'] = 'Download Plan – ' . $dataForEmail[0]['package_type'] . ' - ' . $dataForEmail[0]['package_name'] . ' Pack';
        $front_end_url_name = config('app.front_end_url');
        $frontend_name = explode('//', rtrim($front_end_url_name, '/#/'));
        $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
        $dataForEmail[0]["frontend_url"] = $front_end_url_name;

        $pdf = PDF::loadHTML(view('email.plan_quotation_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words' => $amount_in_words, 'package_price_in_words' => $package_price_in_words]));
        $fileName = $data["invoice"] . "download_quotation.pdf";
        $pdf->save(storage_path('app/public/pdf') . '/' . $fileName);
        try {
            Mail::send('mail', $data, function ($message) use ($data, $pdf, $fileName) {
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

            $path = 'quotation/' . $fileName;
            $source = fopen(storage_path('app/public/pdf') . '/' . $fileName, 'rb');
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
            if (!empty($pdf_path)) {
                DB::table('imagefootage_performa_invoices')
                    ->where('id', '=', $id)
                    ->update(['quotation_url' => $pdf_path]);
                unlink(storage_path('app/public/pdf') . '/' . $fileName);
            }
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        } else {
            $this->statusdesc  =   "Download quotation sent succesfully";
            $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
    }


    public function convert_number_to_words($number)
    {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'Zero',
            1                   => 'One',
            2                   => 'Two',
            3                   => 'Three',
            4                   => 'Four',
            5                   => 'Five',
            6                   => 'Six',
            7                   => 'Seven',
            8                   => 'Eight',
            9                   => 'Nine',
            10                  => 'Ten',
            11                  => 'Eleven',
            12                  => 'Twelve',
            13                  => 'Thirteen',
            14                  => 'Fourteen',
            15                  => 'Fifteen',
            16                  => 'Sixteen',
            17                  => 'Seventeen',
            18                  => 'Eighteen',
            19                  => 'Nineteen',
            20                  => 'Twenty',
            30                  => 'Thirty',
            40                  => 'Fourty',
            50                  => 'Fifty',
            60                  => 'Sixty',
            70                  => 'Seventy',
            80                  => 'Eighty',
            90                  => 'Nnety',
            100                 => 'Hundred',
            1000                => 'Thousand',
            1000000             => 'Million',
            1000000000          => 'Billion',
            1000000000000       => 'Trillion',
            1000000000000000    => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
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

    public static function imagesaver($image_data)
    {
        list($type, $data) = explode(';', $image_data); // exploding data for later checking and validating 

        if (preg_match('/^data:image\/(\w+);base64,/', $image_data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }

            $data = base64_decode($data);

            if ($data === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $fullname = rand() . time() . '.' . $type;

        if (file_put_contents(public_path('image/') . $fullname, $data)) {
            $s3Client = new S3Client([
                /*'profile' => 'default',*/
                'region' => 'us-east-2',
                'version' => '2006-03-01'
            ]);
            $path = 'image/' . $fullname;
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
            unlink(public_path('image/') . $fullname);
        } else {
            $result =  "error";
        }
        /* it will return image name if image is saved successfully 
        or it will return error on failing to save image. */
        return $result;
    }

    public function update_po($invoice_id, $po_no)
    {
        $update = Invoice::where('id', '=', $invoice_id)
            ->update(['job_number' => $po_no]);
        $resp = array();
        if ($update) {
            $resp['statusdesc'] = "PO no. updated successfully.";
            $resp['statuscode'] = "1";
        } else {
            $resp['statusdesc'] = "Error in update PO no.";
            $resp['statuscode'] = "0";
        }
        return response()->json(compact('resp'));
    }

    public function verifyUserDetailsExist($user_id)
    {
        if (!empty($user_id)) {
            $count = DB::table('imagefootage_users')
                ->where('imagefootage_users.id', '=', $user_id)
                ->join('countries as cn', 'cn.id', '=', 'imagefootage_users.country')
                ->join('states as st', 'st.id', '=', 'imagefootage_users.state')
                ->join('cities as ct', 'ct.id', '=', 'imagefootage_users.city')
                ->count();
            return $count > 0 ? true : false;
        }
    }
}
