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


class PaymentController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $transactionId = rand(1,1000000);
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

              $hash=hash('sha512', 'moyhzpcW|46464|100|123456|amit pathak|amitpathak.bansal@gmail.com|||||6578||||||k5fBBBjPVs');
//            $strReqst = "https://sandboxsecure.payu.in/_payment";
//            $strReqst .= "&key=moyhzpcW";
//            $strReqst .= "&productinfo=123456";
//            $strReqst .= "&amount=100";
//            $strReqst .= "&txnid=46464";
//            $strReqst .= "&firstname=amit pathak";
//            $strReqst .= "&email=amitpathak.bansal@gmail.com";
//            $strReqst .= "&phone=987706301";
//            $strReqst .= "&surl=http://localhost/imagefootage/payment";
//            $strReqst .= "&furl=http://localhost/imagefootage/fpayment";
//            $strReqst .= "&udf5=6578";
//            $strReqst .= "&hash=".$hash;
//            echo json_encode(['url'=>$strReqst]);


//             Payumoney::pay([
//                'txnid'       => $transactionId,
//                'amount'      => 10.50,
//                'productinfo' => 'A book',
//                'firstname'   => 'Peter',
//                'email'       => 'abc@example.com',
//                'phone'       => '1234567890',
//                'surl'        => url('payumoney-test/return'),
//                'furl'        => url('payumoney-test/return'),
//            ])->send();

             //return view('payu');
              $url = url('/payu/'.$transactionId);
             echo json_encode(['url'=>$url]);
            //return redirect('/payu/'.$transactionId);
             //return 1;
           // echo json_encode(['hash'=>$hash]);
       }
        //print_r($allFields); die;

      //  return response()->json($all_products);
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
                                'order_status'=>$_POST['desc'],'response_payment'=>json_encode($_POST)]);
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

    public function orderDetails(Request $request){
        $allFields = $request->all();
        if(count($allFields)>0){
            $OrderData = Orders::with('items')
                ->where('txn_id','=',$allFields['id'])
                ->get()->toArray();
             echo json_encode(['status'=>"success",'data'=>$OrderData]);
        }else{
            echo json_encode(['status'=>"fail",'data'=>'','message'=>'Some error happened']);
        }

    }

    public function payu($transaction){
        $OrderData = Orders::with('items')->with('user')
            ->where('txn_id','=',$transaction)
            ->get()->toArray();
        //echo "<pre>";
        //print_r($OrderData);
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
                'furl'        => url('api/payUResponsefail'),
            ])->send();
    }

    public function payUResponse(Request $request){

        $result = Payumoney::completePay($_POST);
        //echo "<pre>";
        //print_r($result); die;
        if ($result->checksumIsValid() && $result->isSuccess()) {
            $transaction = $result->getTransactionId();
            $status = $result->getStatus();
            $params = $result->getParams();
            //echo "<pre>";
            //print_r($params);
           // die;
            Orders::where('txn_id',$params['txnid'])
                ->update(['payment_mode'=>$params['bankcode'],
                    'order_status'=>$status,'response_payment'=>json_encode($params)]);
            $orders = Orders::where('txn_id',$params['txnid'])->first();
            Usercart::where('cart_added_by',$orders->user_id)->delete();
            return redirect('/orderConfirmation/'.$params['txnid']);
        } else {
            return redirect('/orderFailed');
        }

    }

    public function payUResponsefail(){

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
            //return Redirect::to($url);
            //header("Location: $url");
        }else if($allFields['type']=='payu'){

            $hash=hash('sha512', 'moyhzpcW|46464|100|123456|amit pathak|amitpathak.bansal@gmail.com|||||6578||||||k5fBBBjPVs');
//            $strReqst = "https://sandboxsecure.payu.in/_payment";
//            $strReqst .= "&key=moyhzpcW";
//            $strReqst .= "&productinfo=123456";
//            $strReqst .= "&amount=100";
//            $strReqst .= "&txnid=46464";
//            $strReqst .= "&firstname=amit pathak";
//            $strReqst .= "&email=amitpathak.bansal@gmail.com";
//            $strReqst .= "&phone=987706301";
//            $strReqst .= "&surl=http://localhost/imagefootage/payment";
//            $strReqst .= "&furl=http://localhost/imagefootage/fpayment";
//            $strReqst .= "&udf5=6578";
//            $strReqst .= "&hash=".$hash;
//            echo json_encode(['url'=>$strReqst]);


//             Payumoney::pay([
//                'txnid'       => $transactionId,
//                'amount'      => 10.50,
//                'productinfo' => 'A book',
//                'firstname'   => 'Peter',
//                'email'       => 'abc@example.com',
//                'phone'       => '1234567890',
//                'surl'        => url('payumoney-test/return'),
//                'furl'        => url('payumoney-test/return'),
//            ])->send();

            //return view('payu');
            $url = url('/payu/'.$transactionId);
            echo json_encode(['url'=>$url]);
            //return redirect('/payu/'.$transactionId);
            //return 1;
            // echo json_encode(['hash'=>$hash]);
        }
        //print_r($allFields); die;

        //  return response()->json($all_products);
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
                            'payment_status'=>$_POST['desc'],'response_payment'=>json_encode($_POST)]);
                     return redirect('http://localhost:4200/user-profile');
                }else{
                    return redirect('http://localhost:4200/orderFailed/'.$_POST['mer_txn']);
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

}
