<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\AtomPay\TransactionRequest;
use App\Http\AtomPay\TransactionResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Orders;
use App\Models\OrderItem;
use App\Models\Usercart;
use App\Models\UserPackage;
use CORS;
use Payumoney;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Jobs\SendEmail;




class PaymentController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->keyRazorId = 'rzp_test_TcSjfuF7EzPHev';
        $this->keyRazorSecret = 'ZzP8Z9Z1dYUYykBPkgYlpGS6';
    }

    public function payment(Request $request){
        ini_set('max_execution_time', 0);
        date_default_timezone_set('Asia/Calcutta');
        $allFields = $request->all();
        if ($allFields['type'] == 'atom') {
            $datenow = date("d/m/Y h:m:s");
            $transactionDate = str_replace(" ", "%20", $datenow);
        }else{
            $datenow = date('Y-m-d');
        }
        $transactionId = rand(1,1000000).date("his");
        //echo "<pre>"; print_r($allFields); die;
        //DB::enableQueryLog();
        $userData = User::with('country')
                 ->with('city')
                 ->with('state')
                 ->with('cart')
                 ->where('id','=',$allFields['tokenData']['Utype'])
                 ->get()->toArray();
        //dd(DB::getQueryLog());
        //print_r($userData); die;
        $tax = $allFields['cartval'][0]*8/100;
        $final_tax=round($tax,2);
        $orders = new Orders();
        $orders->user_id = $allFields['tokenData']['Utype'];
        $orders->txn_id = $transactionId;
        $orders->tax = $final_tax;
        $orders->order_total = $allFields['cartval'][0]+$final_tax;
        $orders->order_date = date('Y-m-d H:i:s',strtotime($datenow));
        $orders->order_email = $userData[0]['email'];
        $orders->bill_firstname = $allFields['usrData']['first_name'];
        $orders->bill_lastname = $allFields['usrData']['last_name'];
        $orders->bill_address1 = $allFields['usrData']['address'];
        $orders->bill_city = $allFields['usrData']['city'];
        $orders->bill_state = $allFields['usrData']['state'];
        $orders->bill_country = $allFields['usrData']['country'];
        $orders->bill_zip = $allFields['usrData']['pincode'];
        $orders->paymentgatway = $allFields['type'];
        $orders->created_at = date('Y-m-d H:i:s');
        $orders->save();
        $order_id = $orders->id;
        if(count($userData)>0){
            foreach($userData[0]['cart'] as $eachCart) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order_id;
                $orderItem->product_id = $eachCart['cart_product_id'];
                $orderItem->product_type = $eachCart['cart_product_id'];
                $orderItem->standard_type = $eachCart['standard_type'];
                $orderItem->standard_size = $eachCart['standard_size'];
                $orderItem->standard_price = $eachCart['standard_price'];
                $orderItem->extended_name = $eachCart['extended_name'];
                $orderItem->extended_price = $eachCart['extended_price'];
                $orderItem->total = $eachCart['total'];
                $orderItem->product_name = $eachCart['product_name'];
                $orderItem->product_thumb = $eachCart['product_thumb'];
                $orderItem->product_desc = $eachCart['product_desc'];
                $orderItem->product_json = $eachCart['product_json'];
                $orderItem->selected_product = $eachCart['selected_product'];
                $orderItem->product_web = $eachCart['product_web'];
                $orderItem->token = $eachCart['token'];
                $orderItem->cart_added_by = $eachCart['cart_added_by'];
                $orderItem->cart_added_on = $eachCart['cart_added_on'];
                $orderItem->save();
            }
        }

        //dd($userData);
        if($allFields['type']=='atom'){
            $transactionRequest = new TransactionRequest();
            //Setting all values here
            $transactionRequest->setMode("test");
            $transactionRequest->setLogin(197);
            $transactionRequest->setPassword("Test@123");
            $transactionRequest->setProductId('NSE');
            if(!empty($allFields['cartval'][0])){

                $transactionRequest->setAmount($allFields['cartval'][0]+$final_tax);
                $transactionRequest->setTransactionCurrency("INR");
                $transactionRequest->setTransactionAmount($allFields['cartval'][0]+$final_tax);
            }
            $transactionRequest->setReturnUrl(url('/api/atomPayResponse'));
            $transactionRequest->setClientCode(007);
            $transactionRequest->setTransactionId($transactionId);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($allFields['usrData']['first_name']);
            $transactionRequest->setCustomerEmailId($userData[0]['email']);
            $transactionRequest->setCustomerMobile($userData[0]['phone']);
            $transactionRequest->setCustomerBillingAddress("India");
            $transactionRequest->setCustomerAccount($allFields['tokenData']['Utype']);
            $transactionRequest->setReqHashKey("KEY123657234");


            $url = $transactionRequest->getPGUrl();
            echo json_encode(['url'=>$url]);
            //return Redirect::to($url);
            //header("Location: $url");
        }else if($allFields['type']=='payu'){
              $url = url('/payu/'.$transactionId);
              echo json_encode(['url'=>$url]);
       }else if($allFields['type']=='rozerpay'){

            $displayCurrency = 'INR';
            $api = new Api($this->keyRazorId, $this->keyRazorSecret);
            $orderData = [
                'receipt'         => $transactionId,
                'amount'          => ($allFields['cartval'][0]+$final_tax) * 100, // 2000 rupees in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);

            $razorpayOrderId = $razorpayOrder['id'];
            if(!empty($razorpayOrderId)) {
                Orders::where('txn_id','=',$transactionId)->update(['rozor_pay_id'=>$razorpayOrderId]);
            }

            $displayAmount = $amount = $orderData['amount'];

            if ($displayCurrency !== 'INR')
            {
                $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                $exchange = json_decode(file_get_contents($url), true);

                $displayAmount = $exchange ['rates'][$displayCurrency] * $amount / 100;
            }
            $data = [
                "key"               => $this->keyRazorId,
                "amount"            => $amount,
                "name"              => $allFields['usrData']['first_name'],
                "description"       => "ImageFootage",
                "image"             => "https://imagefootage.com/assets/images/logoimage_new.png",
                "prefill"           => [
                    "name"              => $allFields['usrData']['first_name'],
                    "email"             => $userData[0]['email'],
                    "contact"           => $userData[0]['phone'],
                ],
                "notes"             => [
                    "address"           => $allFields['usrData']['address'],
                    "merchant_order_id" => $transactionId,
                ],
                "theme"             => [
                    "color"             => "#F37254"
                ],
                "order_id"          => $razorpayOrderId,
            ];
            if ($displayCurrency !== 'INR')
            {
                $data['display_currency']  = $displayCurrency;
                $data['display_amount']    = $displayAmount;
            }
            echo json_encode($data);


        }

    }

    public function atomPayResponse(Request $request){
        $transactionResponse = new TransactionResponse();
        $transactionResponse->setRespHashKey("KEYRESP123657234");
        if($transactionResponse->validateResponse($_POST)){
            //echo "Transaction Processed <br/>";
           // print_r($_POST);die;
            if(count($_POST)>0){
                if($_POST['f_code']=='Ok'){
                    Orders::where('txn_id',$_POST['mer_txn'])
                            ->update(['payment_mode'=>$_POST['discriminator'],
                                'order_status'=>'Transction Success','response_payment'=>json_encode($_POST)]);
                    $orders = Orders::where('txn_id',$_POST['mer_txn'])->first();
                    Usercart::where('cart_added_by',$orders->user_id)->delete();
                    return redirect('/orderConfirmation/'.$_POST['mer_txn']);
                 }else{
                    return redirect('/orderFailed/'.$_POST['mer_txn']);
                }
              //echo json_encode(['status'=>"success",'data'=>$_POST['mer_txn']]);

            }else{
                //echo json_encode(['status'=>"fail",'data'=>$_POST['mer_txn']]);
                return redirect('/orderFailed/'.$_POST['mer_txn']);
            }
        } else {
            echo "Invalid Signature";
        }

    }

    public function payu($transaction){
        $OrderData = Orders::with('items')->with('user')
            ->where('txn_id','=',$transaction)
            ->get()->toArray();

          $items= array();
          foreach($OrderData[0]['items'] as $each){
              array_push($items,$each['product_id']);
          }
          Payumoney::pay([
                'txnid'       => $transaction,
                'amount'      => $OrderData[0]['order_total'],
                'productinfo' => implode(',',$items),
                'firstname'   => $OrderData[0]['bill_firstname']." ".$OrderData[0]['bill_lastname'],
                'email'       => $OrderData[0]['order_email'],
                'phone'       => $OrderData[0]['user']['mobile'],
                'surl'        => url('api/payUResponse'),
                'furl'        => url('api/payUResponse'),
            ])->send();
    }

    public function payUResponse(Request $request){

        $result = Payumoney::completePay($_POST);
        $params = $result->getParams();
        if ($result->checksumIsValid() && $result->isSuccess()) {
            $transaction = $result->getTransactionId();
            $status = $result->getStatus();
            Orders::where('txn_id',$params['txnid'])
                ->update(['payment_mode'=>$params['bankcode'],
                    'order_status'=>$status,'response_payment'=>json_encode($params)]);
            $orders = Orders::where('txn_id',$params['txnid'])->first();
            Usercart::where('cart_added_by',$orders->user_id)->delete();
            return redirect('/orderConfirmation/'.$params['txnid']);
        } else {
            return redirect('/orderFailed/'.$params['txnid']);
        }

    }

    public function razor_response(Request $request){
         $data = $request->all();
         $api = new Api($this->keyRazorId, $this->keyRazorSecret);
         $success =true;
        try
        {
         $attributes  = $data['paymentRes'];
         $order  = $api->utility->verifyPaymentSignature($attributes);
        }catch(SignatureVerificationError $e){
            $success = false;
            $error = 'Razorpay Error : ' . $e->getMessage();
        }
        $orders = Orders::where('rozor_pay_id',$data['paymentRes']['razorpay_order_id'])->first();
        if($success===true){
           Orders::where('rozor_pay_id',$data['paymentRes']['razorpay_order_id'])
                  ->update(['order_status'=>"Transction Success",'response_payment'=>json_encode($data['paymentRes'])]);
                 Usercart::where('cart_added_by',$orders->user_id)->delete();
            $url = 'http://localhost:4200/orderConfirmation/'.$orders->txn_id;
       }else{
            $url = 'http://localhost:4200/orderFailed/'.$orders->txn_id;
        }
        echo json_encode(['url'=>$url]);


    }

    public function paymentPlan(Request $request){
        ini_set('max_execution_time', 0);
        date_default_timezone_set('Asia/Calcutta');
        $allFields = $request->all();
        //print_r($allFields); die;
        if ($allFields['type'] == 'atom') {
            $datenow = date("d/m/Y h:m:s");
            $transactionDate = str_replace(" ", "%20", $datenow);
        }else{
            $datenow = date('Y-m-d');
        }
        $transactionId = rand(1,1000000);
        //echo "<pre>"; print_r($allFields); die;
        //DB::enableQueryLog();
        $userData = User::where('id','=',$allFields['tokenData']['Utype'])->get()->toArray();
        //dd(DB::getQueryLog());
        //print_r($userData); die;
        //$tax = $allFields['cartval'][0]*8/100;
        //$final_tax=round($tax,2);

        $packge = new UserPackage();
        $packge->user_id = $allFields['tokenData']['Utype'];
        $packge->transaction_id = $transactionId;
        //$orders->tax = $final_tax;
        $packge->package_id = $allFields['plan']['package_id'];
        $packge->package_name = $allFields['plan']['package_name'];
        $packge->package_price = $allFields['plan']['package_price'];
        $packge->package_description = $allFields['plan']['package_description'];
        $packge->package_products_count = $allFields['plan']['package_products_count'];
        $packge->package_type = $allFields['plan']['package_type'];
        $packge->package_permonth_download = $allFields['plan']['package_permonth_download'];
        $packge->package_expiry = $allFields['plan']['package_expiry'];
        $packge->package_plan = $allFields['plan']['package_plan'];
        $packge->package_pcarry_forward = $allFields['plan']['package_pcarry_forward'];
        $packge->package_expiry_yearly = $allFields['plan']['package_expiry_yearly'];
        $packge->payment_gatway_provider = $allFields['type'];
        $packge->created_at = date('Y-m-d H:i:s');
        if($allFields['plan']['package_expiry'] !=0 && $allFields['plan']['package_expiry_yearly']==0){
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s',strtotime("+".$allFields['plan']['package_expiry']." months"));
        }else{
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s',strtotime("+".$allFields['plan']['package_expiry_yearly']." years"));
        }
        $packge->save();
        $packge_order_id = $packge->id;

        //dd($userData);
        if($allFields['type']=='atom'){
            $transactionRequest = new TransactionRequest();
            //Setting all values here
            $transactionRequest->setMode("test");
            $transactionRequest->setLogin(197);
            $transactionRequest->setPassword("Test@123");
            $transactionRequest->setProductId('NSE');
            if(!empty($allFields['plan']['package_price'])){

                $transactionRequest->setAmount($allFields['plan']['package_price']);
                $transactionRequest->setTransactionCurrency("INR");
                $transactionRequest->setTransactionAmount($allFields['plan']['package_price']);
            }
            $transactionRequest->setReturnUrl(url('/api/atomPayPlanResponse'));
            $transactionRequest->setClientCode(007);
            $transactionRequest->setTransactionId($transactionId);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($userData[0]['first_name']);
            $transactionRequest->setCustomerEmailId($userData[0]['email']);
            $transactionRequest->setCustomerMobile($userData[0]['phone']);
            $transactionRequest->setCustomerBillingAddress("India");
            $transactionRequest->setCustomerAccount($allFields['tokenData']['Utype']);
            $transactionRequest->setReqHashKey("KEY123657234");
            $url = $transactionRequest->getPGUrl();
            echo json_encode(['url'=>$url]);
        }else if($allFields['type']=='payu'){
            $url = url('/payuplan/'.$transactionId);
            echo json_encode(['url'=>$url]);
        }else if($allFields['type']=='rozerpay') {
            $displayCurrency = 'INR';
            $api = new Api($this->keyRazorId, $this->keyRazorSecret);
            $orderData = [
                'receipt' => $transactionId,
                'amount' => ($allFields['plan']['package_price']) * 100, // 2000 rupees in paise
                'currency' => 'INR',
                'payment_capture' => 1 // auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);

            $razorpayOrderId = $razorpayOrder['id'];
            if (!empty($razorpayOrderId)) {
                UserPackage::where('transaction_id', '=', $transactionId)->update(['rozor_pay_id' => $razorpayOrderId]);
            }

            $displayAmount = $amount = $orderData['amount'];

            if ($displayCurrency !== 'INR') {
                $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                $exchange = json_decode(file_get_contents($url), true);

                $displayAmount = $exchange ['rates'][$displayCurrency] * $amount / 100;
            }
            $data = [
                "key" => $this->keyRazorId,
                "amount" => $amount,
                "name" => $userData[0]['first_name'],
                "description" => "ImageFootage",
                "image" => "https://imagefootage.com/assets/images/logoimage_new.png",
                "prefill" => [
                    "name" => $userData[0]['first_name'],
                    "email" => $userData[0]['email'],
                    "contact" => $userData[0]['phone'],
                ],
                "notes" => [
                    "address" => $userData[0]['address'],
                    "merchant_order_id" => $transactionId,
                ],
                "theme" => [
                    "color" => "#F37254"
                ],
                "order_id" => $razorpayOrderId,
            ];
            if ($displayCurrency !== 'INR') {
                $data['display_currency'] = $displayCurrency;
                $data['display_amount'] = $displayAmount;
            }
            echo json_encode($data);
        }
  }

    public function atomPayPlanResponse(Request $request){
        $transactionResponse = new TransactionResponse();
        $transactionResponse->setRespHashKey("KEYRESP123657234");
        if($transactionResponse->validateResponse($_POST)){
            //echo "Transaction Processed <br/>";
            // print_r($_POST);die;
            if(count($_POST)>0){
                if($_POST['f_code']=='Ok'){
                    UserPackage::where('transaction_id',$_POST['mer_txn'])
                        ->update(['payment_mode'=>$_POST['discriminator'],
                            'payment_status'=>'Transction Success','response_payment'=>json_encode($_POST)]);
                     return redirect('http://localhost:4200/user-profile');
                }else{
                    return redirect('http://localhost:4200/planFailed/'.$_POST['mer_txn']);
                }
                //echo json_encode(['status'=>"success",'data'=>$_POST['mer_txn']]);

            }else{
                //echo json_encode(['status'=>"fail",'data'=>$_POST['mer_txn']]);
                return redirect('/orderFailed/'.$_POST['mer_txn']);
            }
        } else {
            echo "Invalid Signature";
        }

    }

    public function payuplan($transaction){
        $planData = UserPackage::with('user')
            ->where('transaction_id','=',$transaction)
            ->get()->toArray();

        $items= array();
        Payumoney::pay([
            'txnid'       => $transaction,
            'amount'      => $planData[0]['package_price'],
            'productinfo' => $planData[0]['package_name'],
            'firstname'   => $planData[0]['user']['first_name']." ".$planData[0]['user']['last_name'],
            'email'       => $planData[0]['user']['email'],
            'phone'       => $planData[0]['user']['mobile'],
            'surl'        => url('api/payUplanResponse'),
            'furl'        => url('api/planFailed'),
        ])->send();
    }

    public function payUplanResponse(Request $request){

        $result = Payumoney::completePay($_POST);
        $params = $result->getParams();
        if ($result->checksumIsValid() && $result->isSuccess()) {
            $transaction = $result->getTransactionId();
            $status = $result->getStatus();
            UserPackage::where('transaction_id',$params['txnid'])
                ->update(['payment_mode'=>$params['bankcode'],
                    'payment_status'=>$status,'response_payment'=>json_encode($params)]);
            return redirect('http://localhost:4200/user-profile');
        }

    }

    public function razor_plan_response(Request $request){
        $data = $request->all();
        $api = new Api($this->keyRazorId, $this->keyRazorSecret);
        $success =true;
        try
        {
            $attributes  = $data['paymentRes'];
            $order  = $api->utility->verifyPaymentSignature($attributes);
        }catch(SignatureVerificationError $e){
            $success = false;
            $error = 'Razorpay Error : ' . $e->getMessage();
        }
        $orders = UserPackage::where('rozor_pay_id',$data['paymentRes']['razorpay_order_id'])->first();
        if($success===true){
            UserPackage::where('rozor_pay_id',$data['paymentRes']['razorpay_order_id'])
                ->update(['payment_status'=>"Transction Success",'response_payment'=>json_encode($data['paymentRes'])]);
            $url = 'http://localhost:4200/user-profile';
        }else{
            $url = 'http://localhost:4200/planFailed/'.$orders->txn_id;
        }
        echo json_encode(['url'=>$url]);
  }

    //PDF payment link code start
    public function atomPayInvoiceResponse(){
        $transactionResponse = new TransactionResponse();
        $transactionResponse->setRespHashKey("KEYRESP123657234");
        if($transactionResponse->validateResponse($_POST)){
            //echo "Transaction Processed <br/>";
            // print_r($_POST);die;
            if(count($_POST)>0){
                if($_POST['f_code']=='Ok'){
                    DB::table('imagefootage_performa_invoices')->where('invoice_name',$_POST['mer_txn'])
                        ->update(['payment_mode'=>$_POST['discriminator'],
                            'payment_status'=>'Transction Success','payment_response'=>json_encode($_POST)]);
                    return redirect('/invoiceConfirmation/'.encrypt($_POST['mer_txn']));
                }else{
                    return redirect('/invoiceFailed/'.encrypt($_POST['mer_txn']));
                }
                //echo json_encode(['status'=>"success",'data'=>$_POST['mer_txn']]);

            }else{
                //echo json_encode(['status'=>"fail",'data'=>$_POST['mer_txn']]);
                return redirect('/orderFailed/'.$_POST['mer_txn']);
            }
        } else {
            echo "Invalid Signature";
        }
    }
    public function invoiceConfirmation($id){
         $invoice_id = decrypt($id);
         $dataForEmail = $this->getData($invoice_id);
         return view('invoiceconfirmation',['quotation' => $dataForEmail]);
    }
    public function getData($invoice_id){

        $all_datas = DB::table('imagefootage_performa_invoices')
            ->select('imagefootage_performa_invoices.*','imagefootage_performa_invoices.modified as invicecreted','imagefootage_performa_invoice_items.*','usr.first_name','usr.last_name','usr.title','usr.user_name','usr.contact_owner','usr.email','usr.mobile','usr.phone','usr.postal_code','usr.description','ct.name as cityname','st.state as statename','cn.name as countryname')
            ->join('imagefootage_performa_invoice_items','imagefootage_performa_invoice_items.invoice_id','=','imagefootage_performa_invoices.id')
            ->join('imagefootage_users as usr','usr.id','=','imagefootage_performa_invoices.user_id')
            ->where('imagefootage_performa_invoices.invoice_name','=',$invoice_id)
            ->join('countries as cn','cn.id','=','usr.country')
            ->join('states as st','st.id','=','usr.state')
            ->join('cities as ct','ct.id','=','usr.city')
            ->get()
            ->toArray();
        $dataForEmail = json_decode(json_encode($all_datas), true);
       return $dataForEmail;
    }
    public function invoiceFailed($id){
        $invoice_id = decrypt($id);
        $dataForEmail = $this->getData($invoice_id);
        return view('invoicefail',['quotation' => $dataForEmail]);

    }
    //PDF payment end

    public function orderDetails(Request $request){
        $allFields = $request->all();
        if(count($allFields)>0){
            $OrderData = Orders::with(['user'=>function($query1){
                $query1->select('id','user_name','first_name','last_name','city','state','country')
                ->with('country')
                ->with('state')
                ->with('city');
            }])->with(['items'=>function($query){
                $query->with('product');
            }]) ->where('txn_id','=',$allFields['id'])
                ->get()->toArray();
             SendEmail::dispatchNow($OrderData);
            echo json_encode(['status'=>"success",'data'=>$OrderData]);
        }else{
            echo json_encode(['status'=>"fail",'data'=>'','message'=>'Some error happened']);
        }

    }

}
