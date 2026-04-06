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
use DataTables;
use App\Http\Pond5\FootageApi;
use App\Http\Pond5\ImageApi as Pond5ImageApi;
use App\Models\UserPackage;
use App\Models\UserProductDownload;
use App\Http\Pond5\MusicApi;
use Illuminate\Support\Facades\Log;
use App\Models\Account;
use App\Models\Admin;

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

    /**
     * 
     * Order relation with payment
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'id');
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

    public function edit_quotation($user_id, $quotation_id)
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
            $po_date = isset($data['po_date']) ? $data['po_date'] : date('Y-m-d');
            return $this->Common->create_invoice($data['quotation_id'], $data['user_id'], $po, $po_date, $data['payment_method'], $data);
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
            $po_date = isset($data['po_date']) ? $data['po_date'] : date('Y-m-d');
            return $this->Common->create_invoice_subscription($data['quotation_id'], $data['user_id'], $po, $po_date, $data['payment_method'], $data);
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


    public function quotationReport()
    {
        $user = Auth::guard('admins')->user();
        $account = new Account();
        $admin = new Admin();
        $agentlist = [];
        $account_manager_name = "";
        $userState = $user->state;

        // Build the base query
        $query = Invoice::where('invoice_url', null)->where('status', '<>', 3);

        // If not admin (role_id != 1), filter by logged-in user
        if ($user->role_id != 1) {
            $query->where('user_id', $user->id);
        }

        $quotations = $query->get()->toArray();

        foreach ($quotations as &$quotation) {
            $userDetails = User::find($quotation['user_id']);
            if (!empty($userDetails)) {
                if (!empty($userDetails->account_manager_id)) {
                    $account_manager = $admin->getAgentData($userDetails->account_manager_id);
                    $account_manager_name = !empty($account_manager) ? $account_manager['name'] : "";
                }
                $quotation['account_manager_name'] = $account_manager_name;
                $quotation['user_name'] = $userDetails->first_name . ' ' . $userDetails->last_name;
            } else {
                $quotation['account_manager_name'] = "";
                $quotation['user_name'] = "N/A";
            }
        }
        return view('admin.invoice.quotationsReport', compact('quotations'));
    }


    public function quotationCancel($id)
    {
        // $quotation = Invoice::where('id', $id)->get();
        // Invoice::where('id', $id)->update(array('status' => '3'));
        // return Redirect::back()->with('message', 'Quotation Cancelled');
        // $quotation['status'] = 3;
        // // $quotation->update();
        // $quotations = Invoice::where('invoice_url', null)->where('status', '<>', 3)->get()->toArray();
        // // echo "<pre>"; print_r($quotations); die;

        // return view('admin.invoice.quotationsReport', compact('quotations'));

        if (Invoice::where('id', $id)->update(array('status' => '3'))) {
            return redirect("admin/quotation_report")->with("success", "Quotation Cancelled !!!");
        } else {
            return redirect("admin/quotation_report")->with("error", "Due to some error, Quotation is not updated yet. Please try again!");
        }
    }

    /**
     * 
     * Display outstanding report page
     * @return \Illuminate\View\View
     */
    public function outstandingReport()
    {
        return view('admin.invoice.outstandingReport');
    }

    /**
     * 
     * Get outstanding report data for DataTables with server-side processing
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOutstandingReportData(Request $request)
    {
        try {
            \Log::info('Outstanding Report Data Request', [
                'request' => $request->all()
            ]);

            $user = Auth::guard('admins')->user();

            if (!$user) {
                \Log::error('User not authenticated');
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Get pagination parameters from DataTables
            $start = $request->input('start', 0);
            $length = $request->input('length', 10);
            $searchValue = $request->input('search.value', '');

            // Base query
            $query = Invoice::query();

            // Apply role-based filter
            // If not admin (role_id != 1), show only user-specific records
            if ($user->role_id != 1) {
                $query->where('user_id', $user->id);
            }

            if ($request->filled('client_name') && !empty(trim($request->client_name))) {
                $clientName = trim($request->client_name);
                $query->where(function ($q) use ($clientName) {
                    $q->where('user_id', '=', $clientName)
                        ->orWhere('email_id', '=', $clientName)
                        ->orWhere('invoice_name', '=', $clientName);
                });
            }

            // Apply start date filter from custom filter
            if ($request->filled('start_date') && !empty(trim($request->start_date))) {
                $startDate = trim($request->start_date);
                $query->whereDate('invoice_created', '>=', $startDate);
            }

            // Apply end date filter from custom filter
            if ($request->filled('end_date') && !empty(trim($request->end_date))) {
                $endDate = trim($request->end_date);
                $query->whereDate('invoice_created', '<=', $endDate);
            }

            // Apply search filter
            if (!empty($searchValue)) {
                $query->where(function ($q) use ($searchValue) {
                    $q->where('invoice_name', 'like', "%{$searchValue}%")
                        ->orWhere('user_id', 'like', "%{$searchValue}%")
                        ->orWhere('id', 'like', "%{$searchValue}%");
                });
            }

            // Get total records count
            $totalRecords = $query->count();
            $filteredRecords = $query->count();


            $invoices = $query->orderBy('id', 'desc')
                ->skip($start)
                ->take($length)
                ->get();
            $data = [];

            foreach ($invoices as $invoice) {
                $data[] = [
                    'id' => $invoice->id ?? null,
                    'invoice_name' => $invoice->invoice_name ?? 'N/A',
                    'user_id' => $invoice->user_id ?? 'N/A',
                    'invoice_created' => !empty($invoice->invoice_created) ? date('Y-m-d H:i:s', strtotime($invoice->invoice_created)) : 'N/A',
                    'payment_status' => $invoice->payment_status ? 'Completed' : 'Pending',
                ];
            }

            \Log::info('Total Records Found', ['count' => $totalRecords]);

            $response = [
                'draw' => (int) $request->input('draw', 1),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $data
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error('Outstanding Report Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'draw' => intval($request->input('draw', 1)),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => $e->getMessage()
            ], 200); // Return 200 to prevent DataTables from showing generic error
        }
    }

    // ...existing code...


    public function addPO()
    {
        return view('admin.invoice.add_po');
    }

    public function savePO(Request $request)
    {
        $this->validate($request, [
            'invoice_no' => 'required',
            'po_no'   => 'required|unique:imagefootage_performa_invoices,job_number,' . $request->invoice_no,
            'po_date'   => 'required'
        ], [
            'po_no.required' => 'The PO no field is required.',
            'po_no.unique' => 'The PO no must be unique.',
            'po_date.required' => 'The PO date field is required.'
        ]);
        Log::info('Request Data: ', $request->all());
        $update = Invoice::where('id', '=', $request->invoice_no)->update(['job_number' => $request->po_no, 'po_detail' => $request->po_date]);
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
            'po_no'   => 'required|unique:imagefootage_performa_invoices,job_number,' . $request->invoice_id
        ]);
        if ($validation->fails()) {
            $resp = array();
            $resp['statusdesc']  =   $validation->errors()->first();
            $resp['statuscode']   =   "0";
            return response()->json(compact('resp'));
        }
        $data = $request->all();
        if (!empty($data['invoice_id']) && isset($data['po_no'])) {
            return $this->Common->update_po($data['invoice_id'], $data['po_no']);
        }
    }

    public function invoiceCancel($id)
    {
        $update = Invoice::where('id', $id)->update([
            'status' => '3',
            'cancel_date' => date('Y-m-d H:i:s'),
            'cancelled_by' => Auth::guard('admins')->user()->id
        ]);
        if ($update) {
            return redirect()->back()->with("success", "Quotation Cancelled !!!");
        } else {
            return redirect()->back()->with("error", "Due to some error, Quotation is not updated yet. Please try again!");
        }
    }

    public function showDetail($userId, $invoiceId)
    {
        $invoice = Invoice::where('user_id', $userId)
            ->where('id', $invoiceId)
            ->firstOrFail();

        return view('admin.invoice.invoice_details', compact('invoice'));
    }

    // ...existing code...

    public function getData(Request $request)
    {
        $query = Invoice::select([
            'id',
            'invoice_name',
            'user_id',
            'email_id',
            'invoice_created',
            'payment_status'
        ]);

        // Apply client name/ID filter
        if ($request->filled('client_name')) {
            $clientName = $request->client_name;
            $query->where(function ($q) use ($clientName) {
                $q->where('user_id', 'like', "%{$clientName}%")
                    ->orWhere('email_id', 'like', "%{$clientName}%");
            });
        }

        // Apply date range filter
        if ($request->filled('start_date')) {
            $query->whereDate('invoice_created', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('modified', '<=', $request->end_date);
        }

        return DataTables::of($query)->make(true);
    }

    public function updateCommentStatus(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        $comment->status = $request->input('status');
        $comment->save();

        return response()->json(['success' => 'Comment status updated successfully']);
    }

    /**
     * Get package/invoice items for download on behalf
     */
    public function getPackageItems(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $userId = $request->input('user_id');
            $productWeb = $request->input('product_web');
            $total = $request->input('total');
            $packageId = $request->input('package_id');
            $user = User::find($userId);

            if (empty($user)) {
                return response()->json(['status' => '0', 'message' => 'User not found.']);
            }

            $pacakegalist = UserPackage::whereIn('payment_status', ['Completed', 'Transction Success'])
                ->where('user_id', '=', $userId)
                ->where('id', '=', $packageId)
                ->where('package_expiry_date_from_purchage', '>', Now())
                ->get();

            if ($pacakegalist->isNotEmpty()) {
                if ($pacakegalist[0]->package_type == 'Image') {
                    $flag = 'Image';
                    $type = 2;
                } else if ($pacakegalist[0]->package_type == 'Footage') {
                    $flag = 'Footage';
                    $type = 3;
                } else {
                    $flag = 'Music';
                    $type = 1;
                }
            } else {
                return response()->json(['status' => '0', 'message' => 'No active package found for this product!!']);
            }

            // Get invoice/order items

            $checkdownload = UserProductDownload::where('product_id_api', $productId)->where('web_type', $flag)->where('user_id', $userId)->first();
            if (!empty($checkdownload)) {
                return response()->json(['status' => 'failed', 'message' => 'This product is already downloaded.']);
            }
            $download = 0;
            $downoad_type = 0;
            if ($pacakegalist->isNotEmpty()) {
                foreach ($pacakegalist as $perpack) {
                    if ($perpack->package_plan == '1' && $perpack->downloaded_product < $perpack->package_products_count) { // For download type package
                        $download = 1;
                    }
                    if ($type == 3) {
                        $downoad_type = 1;
                    }
                }
            } else {
                return response()->json(['status' => '0', 'message' => 'Please select correct package to download!!']);
            }

            if ($download == 1) {
                if ($type == 3) {

                    if ($downoad_type == 0) {
                        return response()->json(['status' => '0', 'message' => 'Please select correct package to download!!']);
                    }
                    $footageMedia = new Pond5ImageApi();
                    $download_id = $productId;
                    $version =  $download_id . ':1';
                    $product_details_data = $footageMedia->download($productId, $download_id, $version);
                    
                    Log::info('Footage API Response Type: ' . gettype($product_details_data));
                    if (is_array($product_details_data) && !empty($product_details_data)) {
                        $dataCheck = UserProductDownload::where('product_id_api', $download_id)->where('web_type', $type)->where('user_id', $userId)->first();
                        $product_id = $download_id;
                        $dataInsert = array(
                            'user_id' => $userId,
                            'package_id' => $packageId,
                            'product_id' => $product_id,
                            'product_id_api' => $download_id,
                            'id_media' => $download_id,
                            'download_url' => $product_details_data['url'] ?? '',
                            'downloaded_date' => date('Y-m-d H:i:s'),
                            'product_name' => '',
                            'product_desc' => '',
                            'product_thumb' => '',
                            'web_type' => $type,
                            'product_size' =>  '',
                            'product_price' => $total,
                            'product_poster' => '',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'redownloded_date' => null,
                            'licence_type' => '',
                            'product_type' => 'Footage'
                        );
                        UserProductDownload::insert($dataInsert);
                        if (empty($dataCheck)) {
                            UserPackage::where('user_id', '=', $userId)
                                ->where('package_type', '=', $flag)
                                ->where('id', '=', $packageId)
                                ->update([
                                    'downloaded_product' => DB::raw('downloaded_product+1'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                        }
                        // Send email notification
                        $this->sendDownloadNotificationEmail($user, $productId, 'Footage', $product_details_data);
                        return response()->json(['status' => 'success', 'message' => 'Footage downloaded successfully', 'data' => $product_details_data]);
                    }
                    
                    Log::error('Footage API response not valid array', ['response' => $product_details_data, 'type' => gettype($product_details_data)]);
                    return response()->json(['status' => 'failed', 'message' => 'Failed to download footage', 'data' => $product_details_data]);
                } else if ($type == 2) {
                    // Download Images from Pond5
                    $product_details_data = null;
                    $download_id = $productId;
                    $version = $download_id . ':1';
                    
                    if ($productWeb == 2) { // If image is from PantherMedia
                        $imageMedia = new Pond5ImageApi();
                        $product_details_data = $imageMedia->download($productId, $download_id, $version);
                    } elseif ($productWeb == 3) { // If image is from Pond5
                        $footageMedia = new Pond5ImageApi();
                        $product_details_data = $footageMedia->download($productId, $download_id, $version);
                    }

                    Log::info('Image API Response Type: ' . gettype($product_details_data));
                    // Validate API response is an array before proceeding
                    if (is_array($product_details_data) && !empty($product_details_data)) {
                        $dataCheck = UserProductDownload::select('product_id')->where('product_id_api', $productId)->where('web_type', $type)->where('user_id', $userId)->first();

                        $isPending = isset($product_details_data['download_status']) && 
                                   is_array($product_details_data['download_status']) &&
                                   isset($product_details_data['download_status']['status']) && 
                                   $product_details_data['download_status']['status'] == "pending";
                        
                        if ($isPending) {
                            $dataInsert = array(
                                'user_id' => $userId,
                                'package_id' => $packageId,
                                'product_id' => $productId,
                                'id_download' => $product_details_data['download_status']['id_download'] ?? null,
                                'product_id_api' => $productId,
                                'id_media' => $productId,
                                'download_url' => $product_details_data['download_status']['queue_hash'] ?? '',
                                'downloaded_date' => date('Y-m-d H:i:s'),
                                'product_name' => 'Download ON Behalf',
                                'product_desc' => 'Download ON Behalf',
                                'product_thumb' => '',
                                'web_type' => $type,
                                'product_size' => '',
                                'product_price' => $total,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'licence_type' => '',
                                'redownloded_date' => null,
                                'product_type' => 'Image'
                            );
                        } else {
                            $dataInsert = array(
                                'user_id' => $userId,
                                'package_id' => $packageId,
                                'product_id' => $productId,
                                'id_download' => $product_details_data['transaction'] ?? null,
                                'product_id_api' => $productId,
                                'id_media' => $productId,
                                'download_url' => $product_details_data['url'] ?? '',
                                'downloaded_date' => date('Y-m-d H:i:s'),
                                'product_name' => 'Download ON Behalf',
                                'product_desc' => 'Download ON Behalf',
                                'product_thumb' => '',
                                'web_type' => $type,
                                'product_size' => '',
                                'product_price' => $total,
                                'product_poster' => '',
                                'selected_product' => '',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'licence_type' => '',
                                'redownloded_date' => null,
                                'product_type' => 'Image'
                            );
                        }

                        UserProductDownload::insert($dataInsert);

                        if (empty($dataCheck)) {
                            UserPackage::where('user_id', '=', $userId)
                                ->where('package_type', '=', $flag)
                                ->where('id', '=', $packageId)
                                ->update([
                                    'downloaded_product' => DB::raw('downloaded_product+1'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                        }
                        
                        // Send email notification
                        $this->sendDownloadNotificationEmail($user, $productId, 'Image', $product_details_data);
                        return response()->json(['status' => 'success', 'message' => 'Image downloaded successfully', 'data' => $product_details_data]);
                    } else {
                        Log::error('API response not valid array', ['response' => $product_details_data, 'type' => gettype($product_details_data)]);
                        $errorMsg = is_string($product_details_data) ? $product_details_data : 'Image download failed';
                        return response()->json(['status' => 'failed', 'message' => $errorMsg, 'data' => []]);
                    }
                } else if ($type == 4) {
                    // Download music from pond5
                    $footageMedia = new FootageApi();
                    //TODO Need to change for api_product_id
                    $download_id = $productId;
                    $version = $download_id . ':0';
                    $product_details_data = $footageMedia->download($download_id, $version);
                    
                    Log::info('Music API Response Type: ' . gettype($product_details_data));
                    if (is_array($product_details_data) && !empty($product_details_data)) {
                        $dataCheck = UserProductDownload::select('product_id')->where('product_id_api', $productId)->where('web_type', $type)->where('user_id', $userId)->first();

                        /** TODO : set the array as per response */
                        $dataInsert = array(
                            'user_id' => $userId,
                            'package_id' => $packageId,
                            'product_id' => $productId,
                            'product_id_api' => $productId,
                            'id_media' => $productId,
                            'download_url' => $product_details_data['url'] ?? '',
                            'downloaded_date' => date('Y-m-d H:i:s'),
                            'product_name' => 'Download ON Behalf',
                            'product_desc' => 'Download ON Behalf',
                            'product_thumb' => '',
                            'web_type' => $type,
                            'product_size' => '',
                            'product_price' => $total,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                            'licence_type' => '',
                            'redownloded_date' => null,
                            'product_type' => 'Music'
                        );

                        UserProductDownload::insert($dataInsert);

                        if (empty($dataCheck)) {
                            UserPackage::where('user_id', '=', $userId)
                                ->where('package_type', '=', $flag)
                                ->where('id', '=', $packageId)
                                ->update([
                                    'downloaded_product' => DB::raw('downloaded_product+1'),
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                        }
                        // Send email notification
                        $this->sendDownloadNotificationEmail($user, $productId, 'Music', $product_details_data);
                        return response()->json(['status' => 'success', 'message' => 'Music downloaded successfully', 'data' => $product_details_data]);
                    }
                    
                    Log::error('Music API response not valid array', ['response' => $product_details_data, 'type' => gettype($product_details_data)]);
                    $errorMsg = is_string($product_details_data) ? $product_details_data : 'Failed to download music';
                    return response()->json(['status' => 'failed', 'message' => $errorMsg, 'data' => $product_details_data]);
                }
            } else {
                return response()->json(['status' => '0', 'message' => 'Download pack limit has been over already !!']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching package items: ' . $e->getMessage());
            return response()->json([
                'resp' => [
                    'statuscode' => '0',
                    'statusdesc' => 'Error fetching items: ' . $e->getMessage(),
                    'data' => []
                ]
            ], 500);
        }
    }

    /**
     * Helper method to send download notification email
     */
    private function sendDownloadNotificationEmail($user, $productId, $productType, $downloadData)
    {
        try {
            $emailData = [
                'user_name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'product_id' => $productId,
                'product_type' => $productType,
                'download_url' => $downloadData['url'] ?? $downloadData['queue_hash'] ?? '',
                'admin_name' => Auth::guard('admins')->user()->name ?? 'Admin'
            ];

            Mail::send('emails.download_on_behalf', $emailData, function ($message) use ($emailData) {
                $message->to($emailData['email'])
                    ->subject('Your Product has been Downloaded')
                    ->from('admin@imagefootage.com', 'ImageFootage Admin');
            });

            Log::info('Download notification email sent to: ' . $emailData['email']);
        } catch (\Exception $e) {
            Log::error('Failed to send download notification email: ' . $e->getMessage());
            // Don't fail the download if email fails
        }
    }
}
