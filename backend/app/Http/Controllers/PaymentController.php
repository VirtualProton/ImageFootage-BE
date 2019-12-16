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
use CORS;

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
        $datenow = date("d/m/Y h:m:s");
        $transactionDate = str_replace(" ", "%20", $datenow);
        $transactionId = rand(1,1000000);
        $allFields = $request->all();
        $userData = User::with('country')
                 ->with('city')
                 ->with('state')
                 ->with('cart')
                 ->where('id','=',$allFields['tokenData']['Utype'])
                 ->get()->toArray();

        //dd($userData);
        if($allFields['usrData']['paymentGatway']=='atom'){
            $transactionRequest = new TransactionRequest();

//Setting all values here
            $transactionRequest->setMode("test");
            $transactionRequest->setLogin(197);
            $transactionRequest->setPassword("Test@123");
            $transactionRequest->setProductId("NSE");
            if(!empty($allFields['cartval'][0])){
                $tax = $allFields['cartval'][0]*8/100;
                $final_tax=round($tax,2);
                $transactionRequest->setAmount($allFields['cartval'][0]+$final_tax);
                $transactionRequest->setTransactionCurrency("INR");
                $transactionRequest->setTransactionAmount($allFields['cartval'][0]+$final_tax);
            }


            $transactionRequest->setReturnUrl(url('/api/atomPayResponse'));
            $transactionRequest->setClientCode(123);
            $transactionRequest->setTransactionId($transactionId);
            $transactionRequest->setTransactionDate($transactionDate);
            $transactionRequest->setCustomerName($allFields['usrData']['first_name']);
            $transactionRequest->setCustomerEmailId($userData[0]['email']);
            $transactionRequest->setCustomerMobile($userData[0]['phone']);
            $transactionRequest->setCustomerBillingAddress($allFields['usrData']['address']);
            $transactionRequest->setCustomerAccount($allFields['tokenData']['Utype']);
            $transactionRequest->setReqHashKey("KEY123657234");
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
            $orders->paymentgatway = $allFields['usrData']['paymentGatway'];
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


            $url = $transactionRequest->getPGUrl();
            echo json_encode(['url'=>$url]);
            //return Redirect::to($url);
            //header("Location: $url");
        }
        //print_r($allFields); die;

      //  return response()->json($all_products);
    }

    public function atomPayResponse(Request $request){
        $transactionResponse = new TransactionResponse();
        $transactionResponse->setRespHashKey("KEYRESP123657234");
        if($transactionResponse->validateResponse($_POST)){
           // echo "Transaction Processed <br/>";
           // print_r($_POST);
            if(count($_POST)>0){
                if($_POST['fcode']=='ok'){
                    $orders = new Orders();
                    $orders->payment_mode = $_POST['discriminator'];
                    $orders->order_status = $_POST['desc'];
                    $orders->response_payment = json_encode($_POST);
                    $orders->txn_id= $_POST['mer_txn'];
                    $orders->update();

                }
              echo json_encode(['status'=>"success",'data'=>$_POST['mer_txn']]);
            }else{
                echo json_encode(['status'=>"fail",'data'=>$_POST['mer_txn']]);
            }
        } else {
            echo "Invalid Signature";
        }

    }



    

}
