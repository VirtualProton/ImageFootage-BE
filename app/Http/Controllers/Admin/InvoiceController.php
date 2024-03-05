<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use DB;
use PDF;
use Mail;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Common;
use App\Models\Package;
use App\Models\Comment;
use App\Models\Invoice;
use App\Models\Orders;
use Auth;
use Illuminate\Support\Facades\Validator;


class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('login', 'logout');
        $this->Common = new Common();
    }

    public function send_invoice()
    {
        $templates = DB::table('email_templates')
            ->where('type', '=', '2')
            ->get();
        return view('admin.invoice.index', compact('templates'));
    }

    public function get_email_template(Request $request)
    {
        $id = $request->input('templ_id');
        if ($id > 0) {
            $templateData = DB::table('email_templates')
                ->where('id', '=', $id)
                ->first();
            $replace = array('##first_name##', '##orderId##', '##productname##', '##logo##');
            $with = array('Amit', '123456', 'pond5images', 'imagefotage');
            $new_template = str_replace($replace, $with, $templateData->content);
            echo $new_template;
        }
    }

    public function sendmail(Request $request)
    {

        $data["email"] = $request->get("email");
        $data["text"] = $request->get("text");
        //print_r($data); die;
        // $data["subject"]=$request->get("subject");
        ini_set('max_execution_time', 0);
        //$data["email"]="amitpathak.bansal@gmail.com";
        //$data["client_name"]="Test email";
        $data["subject"] = "Invoice";

        $pdf = PDF::loadHTML($data["text"]);

        try {
            Mail::send('mail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"])
                    ->subject($data["subject"])
                    ->from('admin@imagefootage.com', 'Imagefootage')
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        } else {

            $this->statusdesc  =   "Invoice sent Succesfully";
            $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
    }

    public function quotation($user_id)
    {
        $getFootageSizeDetails = config('constants.footage_size_details');
        $getMusicLicenceDetails = config('constants.music_licence_details');
        $userDetail = User::find($user_id);
        $monthly_image_package_list = Package::where('package_plan', 2)->where('package_type', 'Image')->get()->toArray();
        return view('admin.invoice.quotation', compact('getFootageSizeDetails', 'getMusicLicenceDetails', 'userDetail'), ['packages' => $monthly_image_package_list]);
    }

    public function quotation2($user_id)
    {
        $getFootageSizeDetails = config('constants.footage_size_details');
        $getMusicLicenceDetails = config('constants.music_licence_details');
        $userDetail = User::find($user_id);
        $monthly_image_package_list = Package::where('package_plan', 2)->where('package_type', 'Image')->get()->toArray();
        return view('admin.invoice.quotation2', compact('getFootageSizeDetails', 'getMusicLicenceDetails', 'userDetail'), ['packages' => $monthly_image_package_list]);
    }

    public function saveInvoice(Request $request)
    {
        // echo "hi"; die;
        $data = json_decode(request()->getContent(), true);
        // print_r($data); die;
        return $this->Common->save_proforma($data);
    }

    public function invoice($user_id, $invoice_id)
    {
        if (!empty($invoice_id)) {
            $data = $this->Common->getData($invoice_id, $user_id);
            return view('admin.invoice.invoice', compact('user_id'));
        }
    }

    public function edit_quotation($user_id,$quotation_id)
    {
        $getFootageSizeDetails = config('constants.footage_size_details');
        $getMusicLicenceDetails = config('constants.music_licence_details');
        $userDetail = User::find($user_id);
        return view('admin.invoice.edit_quotation', compact('userDetail', 'getFootageSizeDetails', 'getMusicLicenceDetails'));
    }

    public function edit_quotation_data(Request $request)
    {
        $data = $request->all();
        //print_r($data); die;
        if (!empty($data['quotation'])) {
            return $this->Common->getQuotationData($data['quotation']);
        }
    }
    public function create_invoice(Request $request)
    {
        $data = $request->all();
        // Update user address
        $user = User::where('id', $data['user_id'])->first();
        if (!empty($data['country'])) {
            $user->country = $data['country'] ?? $user->country;
        }
        if (!empty($data['state'])) {
            $user->state = $data['state'] ?? $user->state;
        }
        if (!empty($data['city'])) {
            $user->city = $data['city'] ?? $user->city;
        }
        if (!empty($data['address'])) {
            $user->address = $data['address'] ?? $user->address;
        }
        if (!empty($data['address2'])) {
            $user->address2 = $data['address2'] ?? $user->address2;
        }
        if (!empty($data['postal_code'])) {
            $user->postal_code = $data['postal_code'] ?? $user->postal_code;
        }
        $user->save();
        if (!empty($data['quotation_id'])) {
            $po = isset($data['po']) ? $data['po'] : '';
            return $this->Common->create_invoice($data['quotation_id'], $data['user_id'], $po, '', $data['payment_method'], $data);
        }
    }

    public function create_invoice_subcription(Request $request)
    {
        $data = $request->all();
        // Update user address
        $user = User::where('id', $data['user_id'])->first();
        if (!empty($data['country'])) {
            $user->country = $data['country'] ?? $user->country;
        }
        if (!empty($data['state'])) {
            $user->state = $data['state'] ?? $user->state;
        }
        if (!empty($data['city'])) {
            $user->city = $data['city'] ?? $user->city;
        }
        if (!empty($data['address'])) {
            $user->address = $data['address'] ?? $user->address;
        }
        if (!empty($data['address2'])) {
            $user->address2 = $data['address2'] ?? $user->address2;
        }
        if (!empty($data['postal_code'])) {
            $user->postal_code = $data['postal_code'] ?? $user->postal_code;
        }
        $user->save();
        if (!empty($data['quotation_id'])) {
            $po = isset($data['po']) ? $data['po'] : '';
            return $this->Common->create_invoice_subscription($data['quotation_id'], $data['user_id'], $po, '', $data['payment_method'], $data);
        }
    }

    public function change_invoice_status(Request $request)
    {
        $data = $request->all();
        if (!empty($data['quotation_id']) && isset($data['status'])) {
            return $this->Common->change_invoice_status($data['quotation_id'], $data['status']);
        }
    }

    public function purchase_orders()
    {
        $this->User = new User;
        $userlist = $this->User->getPurchaseOrders();
        return view('admin.invoice.purchase_orders', compact('userlist'));
    }

    public function comments(Request $request)
    {
        if (isset($_POST['commentbtn'])) { 
        $this->validate($request, [
            'subject' => 'required|max:100',
            'user_id' => 'required',
            'comment' => 'required|max:190',
            'status' => 'required',
            //'agent_id' => 'required',
            //'expiry' => 'required',

        ]);

        $comment = new Comment();

        $comment['user_id'] = $request->user_id;
        $comment['subject'] = $request->subject;
        $comment['comment'] = $request->comment;
        $comment['status'] = $request->status;
        $comment['agent_id'] = $request->agent_id;
        $comment['created_by'] = $request->created_by;
        $comment['expiry'] = !empty($request->expiry) ? date('Y-m-d', strtotime($request->expiry)) : '';
        $comment->save();
        return Redirect::back()->with('success', 'Comment Saved');
    }
}

    public function saveSubscriptionInvoice(Request $request)
    {
        $data = json_decode(request()->getContent(), true);
        return $this->Common->save_subscription_proforma($data);
    }

    public function saveDownloadInvoice(Request $request)
    {
        $data = json_decode(request()->getContent(), true);
        return $this->Common->save_download_proforma($data);
    }


    public function quotationReport(){
        $user = Auth::guard('admins')->user();
        $userState = $user->state;
        // $user_id = 1;
        $quotations = Invoice::where('invoice_url', null)->where('status', '<>', 3)->get()->toArray();

        // if($user->department['department'] == 'Sales'){

        //     $quotations = Invoice::where('invoice_url', null)->where('status', '<>', 3)->where('state', $userState)->get()->toArray();
        // }
        // echo "<pre>"; print_r($quotations); die;
            
        return view('admin.invoice.quotationsReport', compact('quotations'));


    }

    
    public function quotationCancel($id){
        // $quotation = Invoice::where('id', $id)->get();
        // Invoice::where('id', $id)->update(array('status' => '3'));
        // return Redirect::back()->with('message', 'Quotation Cancelled');
        // $quotation['status'] = 3;
        // // $quotation->update();
        // $quotations = Invoice::where('invoice_url', null)->where('status', '<>', 3)->get()->toArray();
        // // echo "<pre>"; print_r($quotations); die;

        // return view('admin.invoice.quotationsReport', compact('quotations'));

        if(Invoice::where('id', $id)->update(array('status' => '3'))){
            return redirect("admin/quotation_report")->with("success", "Quotation Cancelled !!!");
        } else {
            return redirect("admin/quotation_report")->with("error", "Due to some error, Quotation is not updated yet. Please try again!");
        }
    }


    public function outstandingReport(){
        $user = Auth::guard('admins')->user();
        $all_orders_list= Orders::with(['items'=>function($query){
                   $query->select('order_id','product_id','product_name','product_web','standard_size','standard_price','product_thumb');
           }])->with('user')
          ->with('country')
          ->with('state')
          ->with('city')
          ->where('order_status', '<>', 'Transction Success')
          ->orWhere('order_status', null)
          ->orderBy('id','desc')
          ->get()->toArray();
         // echo "<pre>"; print_r($all_orders_list); die;

          if($user->department['department'] == 'Sales'){

            $all_orders_list= Orders::with(['items'=>function($query){
                   $query->select('order_id','product_id','product_name','product_web','standard_size','standard_price','product_thumb');
           }])->with('user')
          ->with('country')
          ->with('state')
          ->with('city')
          ->where('bill_state', $user->state)
          ->orderBy('id','desc')
          ->get()->toArray();
        }

         //echo "<pre>";print_r($all_orders_list); die;
        return view('admin.invoice.orderlist', ['orderlists' => $all_orders_list]);
    }

    public function addPO()
    {
        return view('admin.invoice.add_po');
    }

    public function savePO(Request $request)
    {
        $this->validate($request, [
            'invoice_no' => 'required',
            'po_no'   => 'required|unique:imagefootage_performa_invoices,job_number,'.$request->invoice_no
        ], [
            'po_no.required' => 'The PO no field is required.',
            'po_no.unique' => 'The PO no must be unique.'
        ]);
        $update = Invoice::where('id', '=', $request->invoice_no)->update(['job_number' => $request->po_no, 'po_detail' => date('Y-m-d')]);
        if ($update) {
            return redirect()->back()->with('success', 'PO no. updated successfully.');
        } else {
            return back()->with('warning', 'Some problem occured.');
        }

    }

    public function get_invoice(Request $request)
    {
        $invoices = Invoice::select('id', 'invoice_name')->get();

        $invoices_arr = '<option value="">--Select Invoice--</option>';
        foreach ($invoices as $key => $value) {
            $invoices_arr .= '<option value="' . $value->id . '">' . $value->invoice_name . '</option>';
        }
        echo $invoices_arr;
    }

    public function update_po(Request $request)
    {
        $validation = Validator::make($request->all(), [
                'po_no'   => 'required|unique:imagefootage_performa_invoices,job_number,'.$request->invoice_id
        ]);
        if ($validation->fails())
        {
            $resp =array();
            $resp['statusdesc']  =   $validation->errors()->first();
            $resp['statuscode']   =   "0";
            return response()->json(compact('resp')); 
        }
        $data = $request->all();
        if (!empty($data['invoice_id']) && isset($data['po_no'])) {
            return $this->Common->update_po($data['invoice_id'], $data['po_no']);
        }
    }

    public function invoiceCancel($id){
        $update = Invoice::where('id', $id)->update([
            'status' => '3',
            'cancel_date' => date('Y-m-d H:i:s'),
            'cancelled_by' => Auth::guard('admins')->user()->id
        ]);
        if($update){
            return redirect()->back()->with("success", "Quotation Cancelled !!!");
        } else {
            return redirect()->back()->with("error", "Due to some error, Quotation is not updated yet. Please try again!");
        }
    }
}