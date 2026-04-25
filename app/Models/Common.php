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
use Illuminate\Support\Facades\App;
use Helper;
use App\Http\AtomPay\TransactionRequest;
use App\Http\AtomPay\TransactionResponse;
use App\Models\Invoice;
use App\Models\PromoCode;
use App\Models\InvoiceItem;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Http\Request;



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
        $this->baseurl         = $hostname;
        $this->keyRazorId      = config('payments.keyRazorId');
        $this->keyRazorSecret  = config('payments.keyRazorSecret');
        $this->atomRequestKey  = config('payments.atomRequestKey');
        $this->atomResponseKey = config('payments.atomResponseKey');
        $this->login           = config('payments.login');
        $this->mode            = config('payments.mode');
        $this->password        = config('payments.password');
        $this->clientcode      = config('payments.clientcode');
        $this->atomprodId      = config('payments.atomprodId');
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
                    'category_name'     => $category_name,
                    'category_order'    => '',
                    'category_added_by' => '1',
                    'category_status'   => 'Active'

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

    private function createRazorpayPaymentLink($amountInRupees, $description, $referenceId, $customerName, $customerEmail, $customerContact, $currency = 'INR')
    {
        try {
            $amountInPaise = (int) round(((float) $amountInRupees) * 100);
            if ($amountInPaise <= 0) {
                return null;
            }

            $api = new Api($this->keyRazorId, $this->keyRazorSecret);
            $payload = [
                'amount' => $amountInPaise,
                'currency' => $currency,
                'description' => $description,
                'reference_id' => (string) $referenceId,
                'customer' => [
                    'name' => (string) ($customerName ?? ''),
                    'email' => (string) ($customerEmail ?? ''),
                    'contact' => (string) ($customerContact ?? ''),
                ],
                'notify' => [
                    'sms' => false,
                    'email' => false,
                ],
                'callback_url' => rtrim(config('app.url'), '/') . '/api/razorpayInvoiceResponse',
                'callback_method' => 'get',
            ];

            $paymentLink = $api->paymentLink->create($payload);
            return $paymentLink['url'] ?? ($paymentLink['short_url'] ?? null);
        } catch (\Throwable $e) {
            \Log::error('Razorpay payment link generation failed', [
                'reference_id' => $referenceId,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    private function pdfImagePath($relativePath)
    {
        $absolutePath = public_path(ltrim(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, (string) $relativePath), DIRECTORY_SEPARATOR));
        return 'file:///' . str_replace('\\', '/', $absolutePath);
    }

    private function buildAtomReturnUrl($path)
    {
        $configuredBase = env('ATOM_CALLBACK_BASE_URL') ?: config('app.url');
        $baseUrl = rtrim((string) $configuredBase, '/');

        // Prevent non-public callback hosts from being embedded in customer-facing payment URLs.
        if ($baseUrl === '' || preg_match('/localhost|127\\.0\\.0\\.1|0\\.0\\.0\\.0/i', $baseUrl)) {
            $baseUrl = 'https://api.imagefootage.com';
        }

        return $baseUrl . '/' . ltrim((string) $path, '/');
    }


    public function save_proforma($data)
    {
        $res = $this->verifyUserDetailsExist($data['uid']);
        if (!$res) {
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
        $currency = $data['products']['product'][0]['currency'] ?? 'INR';

        $insert = array(
            'user_id'         => $data['uid'],
            'end_client'      => $data['end_client'] ?? '',
            'email_id'        => $data['email'],
            'flag'            => $data['flag'],
            'invoice_name'    => $this->random_numbers(),
            'created'         => date('Y-m-d'),
            'modified'        => date('Y-m-d H:i:s'),
            'promo_code'      => '',
            'tax'             => $data['tax'] ?? '',
            'tax_selected'    => json_encode($selected_taxes),
            'total'           => $data['total'],
            'status'          => '0',
            'invoice_type'    => '3',
            'proforma_type'   => '1',
            'expiry_invoices' => $data['expiry_date'],
            'created_by'      => Auth::guard('admins')->user()->id,
            'promo_code_id'   => isset($data['promo_code_id']) ? $data['promo_code_id'] : 0,
            'cancelled_on'    => $cancelled_on,
            'currency'        => $currency,
        );
        DB::table('imagefootage_performa_invoices')->insert($insert);
        $id = DB::getPdo()->lastInsertId();

        // Update Total applied code in promo code
        if (!empty($data['promo_code_id'])) {
            $promoCode                     = PromoCode::find($data['promo_code_id']);
            $currentUsed                   = $promoCode->total_applied_code;
            $promoCode->total_applied_code = $currentUsed + 1;
            $promoCode->save();
        }
        // End Update Total applied code in promo code

        if (count($data['products']) > 0) {
            foreach ($data['products']['product'] as $eachproduct) {
                if (isset($eachproduct['image']) && filter_var($eachproduct['image'], FILTER_VALIDATE_URL)) {
                    $image = $eachproduct['image'];
                } else {
                    $image = isset($eachproduct['image']) && !empty($eachproduct['image']) ? $this->imagesaver($eachproduct['image']) : '';
                }
                $licence_type = $eachproduct['pro_type'] == 'right_managed' ? $eachproduct['licence_type'] : '';
                $insert_product = array(
                    'invoice_id'    => $id,
                    'user_id'       => $data['uid'],
                    'product_id'    => isset($eachproduct['name']) ? $eachproduct['name'] : '',
                    'product_type'  => $eachproduct['pro_type'],
                    'type'          => $eachproduct['type'],
                    'product_size'  => $eachproduct['pro_size'],
                    'licence_type'  => $licence_type,
                    'product_image' => $image,
                    'subtotal'      => $eachproduct['price'],
                    'status'        => "1",
                    'product_web'   => 'imagefootage',
                    'licence_type'  => $eachproduct['licence_type'],
                    'extra_details' => isset($eachproduct['extra_details']) ? $eachproduct['extra_details'] : null
                );
                DB::table('imagefootage_performa_invoice_items')->insert($insert_product);
            }
            if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
                $update = [
                    'status' => 3,
                    'expiry_invoices' => $data['expiry_date'],
                    'created_at'      => date('Y-m-d H:i:s'),
                    'updated_at'      => date('Y-m-d H:i:s'),
                    'cancelled_on'    => $cancelled_on,
                    'cancelled_by'    => Auth::guard('admins')->user()->id
                ];
                Invoice::where('id', '=', $data['old_quotation'])->update($update);
            }
            // dd($id,$data['uid']);
            $dataForEmail = $this->getData($id, $data['uid']);
            $dataForEmail = json_decode(json_encode($dataForEmail), true);
            // dd($dataForEmail);
            $transactionRequest = new TransactionRequest();
            //Setting all values here
            $transactionRequest->setMode($this->mode);
            $transactionRequest->setLogin($this->login);
            $transactionRequest->setPassword($this->password);
            $transactionRequest->setProductId($this->atomprodId);
            $transactionRequest->setAmount($dataForEmail[0]['total']);
            $transactionRequest->setTransactionCurrency($currency);
            $transactionRequest->setTransactionAmount($dataForEmail[0]['total']);

            $transactionRequest->setReturnUrl($this->buildAtomReturnUrl('/api/atomPayInvoiceResponse'));
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
            
            // Generate Razorpay payment link BEFORE PDF generation so correct URL is embedded
            $quotationPayOnlineLink = $this->createRazorpayPaymentLink(
                $dataForEmail[0]['total'] ?? 0,
                'Quotation Payment for ' . ($dataForEmail[0]['invoice_name'] ?? ''),
                'QTN-' . ($dataForEmail[0]['invoice_name'] ?? ''),
                trim(($dataForEmail[0]['first_name'] ?? '') . ' ' . ($dataForEmail[0]['last_name'] ?? '')),
                $dataForEmail[0]['email'] ?? ($dataForEmail[0]['email_id'] ?? ''),
                $dataForEmail[0]['mobile'] ?? '',
                $currency
            );
            $dataForEmail[0]['payment_url'] = $quotationPayOnlineLink;
            // dd($dataForEmail);
            $data["subject"] = "Quotation (" . $dataForEmail[0]['invoice_name'] . ")";
            $data["email"]   = $data['email'];
            $data["invoice"] = $dataForEmail[0]['invoice_name'];
            $data["name"]    = $dataForEmail[0]['first_name'];
            $amount_in_words =  $this->convert_number_to_words($dataForEmail[0]['total']);
            if ($data['flag'] == 0) {
                // For other quotations use image footage logo
                $dataForEmail[0]['company_logo'] = $this->pdfImagePath('images/new-design-logo.png');
            } else {
                // For form2 quotation use other logo
                $dataForEmail[0]['company_logo'] = $this->pdfImagePath('images/conceptual_logo.png');
            }
            $dataForEmail[0]['template_image'] = $this->pdfImagePath('images/music-img.png');
            $dataForEmail[0]['music_image'] = $this->pdfImagePath('images/music-img.png');
            $dataForEmail[0]['signature']     = $this->pdfImagePath('images/signature.png');
            $front_end_url_name               = config('app.front_end_url');
            $frontend_name                    = explode('//', rtrim($front_end_url_name, '/#/'));
            $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
            $dataForEmail[0]["frontend_url"]  = $front_end_url_name;
            //PDF genration and email
            $pdf = PDF::loadHTML(view('email.quotation', ['quotation' => $dataForEmail, 'amount_in_words' => $amount_in_words]));
            $fileName = $data["invoice"] . "_quotation.pdf";
            $pdfDirectory = storage_path('app/public/pdf');
            if (!is_dir($pdfDirectory)) {
                mkdir($pdfDirectory, 0777, true);
            }

            $pdf->save($pdfDirectory . '/' . $fileName);

            try {
                $customTemplatePath = base_path('email_task/Send Custom Quotation/Custom/Quotation-CP.html');
                $customTemplateHtml = '';
                if (file_exists($customTemplatePath)) {
                    $customTemplateHtml = file_get_contents($customTemplatePath);

                    $customerName = trim(($dataForEmail[0]['first_name'] ?? '') . ' ' . ($dataForEmail[0]['last_name'] ?? ''));
                    $clientCompanyName = $dataForEmail[0]['company'] ?? '';

                    // Use CID placeholders and replace them with embedded images while sending mail.
                    $companyLogoUrl = '[CP_LOGO_CID]';
                    $defaultImageThumb = '[CP_IMAGE_CID]';
                    $defaultVideoThumb = '[CP_VIDEO_CID]';
                    $defaultMusicThumb = '[CP_MUSIC_CID]';
                    $addressParts = array_filter([
                        $dataForEmail[0]['address'] ?? '',
                        $dataForEmail[0]['address2'] ?? '',
                    ]);
                    $clientAddress = implode('<br>', $addressParts);
                    $city = $dataForEmail[0]['cityname'] ?? '';
                    $postalCode = $dataForEmail[0]['postal_code'] ?? '';
                    $country = $dataForEmail[0]['countryname'] ?? '';
                    $taxAmount = (float) ($dataForEmail[0]['tax'] ?? 0);
                    $totalAmount = (float) ($dataForEmail[0]['total'] ?? 0);
                    $subTotal = max($totalAmount - $taxAmount, 0);

                    $replaceMap = [
                        '[Estimate Number]' => 'Q' . $dataForEmail[0]['invoice_name'],
                        '[Estimate Date]' => date('d.m.Y', strtotime($dataForEmail[0]['invicecreted'])),
                        '[Company Logo URL]' => $companyLogoUrl,
                        '[Client Name]' => $customerName,
                        '[Client Email]' => $dataForEmail[0]['email'] ?? '',
                        '[End Client Name]' => $dataForEmail[0]['end_client'] ?? '',
                        '[Client Code]' => $dataForEmail[0]['vendor_code'] ?? '',
                        '[Company Name]' => $clientCompanyName,
                        '[Address]' => $clientAddress,
                        '[City]' => $city,
                        '[Postal Code]' => $postalCode,
                        '[Country]' => $country,
                        '[Client PAN Number]' => $dataForEmail[0]['pan'] ?? '',
                        '[Client GSTIN]' => $dataForEmail[0]['gst'] ?? '',
                        '[Client Contact Number]' => $dataForEmail[0]['mobile'] ?? '',
                        '[Account Manager]' => $dataForEmail[0]['contact_owner'] ?? '',
                        '[sub total]' => number_format($subTotal, 2),
                        '[discount amount]' => '0.00',
                        '[tax percentage]' => (string) config('constants.GST_VALUE'),
                        '[tax amount]' => number_format($taxAmount, 2),
                        '[total number of items]' => (string) count($dataForEmail),
                        '[total due]' => number_format($totalAmount, 2),
                        '[PAY_ONLINE_LINK]' => $quotationPayOnlineLink,
                    ];
                    $customTemplateHtml = str_replace(array_keys($replaceMap), array_values($replaceMap), $customTemplateHtml);

                    $itemRowsHtml = '';
                    foreach ($dataForEmail as $index => $item) {
                        $itemTitle = trim((string) ($item['product_id'] ?? ''));
                        if ($itemTitle === '') {
                            $itemTitle = 'Asset ' . ($index + 1);
                        }

                        $itemType = strtolower((string) ($item['type'] ?? ''));
                        $itemThumbUrl = $defaultImageThumb;
                        if (strpos($itemType, 'music') !== false) {
                            $itemThumbUrl = !empty($defaultMusicThumb) ? $defaultMusicThumb : $defaultImageThumb;
                        } elseif (strpos($itemType, 'footage') !== false || strpos($itemType, 'video') !== false) {
                            $itemThumbUrl = !empty($defaultVideoThumb) ? $defaultVideoThumb : $defaultImageThumb;
                        }

                        $detailLines = [];
                        if (!empty($item['type'])) {
                            $detailLines[] = '<div class="dl"><strong>File Type:</strong> ' . e($item['type']) . '</div>';
                        }
                        if (!empty($item['product_size'])) {
                            $detailLines[] = '<div class="dl"><strong>Size:</strong> ' . e($item['product_size']) . '</div>';
                        }
                        if (!empty($item['licence_type'])) {
                            $detailLines[] = '<div class="dl"><strong>License Type:</strong> ' . e(strip_tags($item['licence_type'])) . '</div>';
                        }
                        if (!empty($item['product_type'])) {
                            $detailLines[] = '<div class="dl"><strong>Licensing Model:</strong> ' . e($item['product_type']) . '</div>';
                        }
                        if (!empty($item['duration'])) {
                            $detailLines[] = '<div class="dl"><strong>Duration:</strong> ' . e($item['duration']) . '</div>';
                        }

                        for ($catIndex = 1; $catIndex <= 7; $catIndex++) {
                            $catTitle = trim((string) ($item['catTitle' . $catIndex] ?? ''));
                            $catValue = trim((string) ($item['catValue' . $catIndex] ?? ''));
                            if ($catTitle !== '' && $catValue !== '') {
                                $detailLines[] = '<div class="dl"><strong>' . e($catTitle) . ':</strong> ' . e($catValue) . '</div>';
                            }
                        }

                        $extraDetailsRaw = $item['extra_details'] ?? '';
                        $extraDetails = trim(strip_tags((string) $extraDetailsRaw));
                        $extraDetailsBlock = $extraDetails !== ''
                            ? '<div class="item-full">' . nl2br(e($extraDetails)) . '</div>'
                            : '';

                        $itemRowsHtml .= '<div class="item-row">'
                            . '<div class="item-sno">' . ($index + 1) . '</div>'
                            . '<div>'
                            . '<div class="item-title">' . e($itemTitle) . '</div>'
                            . '<div class="item-body">'
                            . '<div class="item-thumb"><img src="' . e($itemThumbUrl) . '" alt="Asset Thumbnail" style="width:110px;height:76px;object-fit:cover;display:block;"></div>'
                            . '<div class="item-details">' . implode('', $detailLines) . '</div>'
                            . '</div>'
                            . $extraDetailsBlock
                            . '</div>'
                            . '<div class="item-price">' . number_format((float) ($item['subtotal'] ?? 0), 2) . '</div>'
                            . '</div>';
                    }

                    $customTemplateHtml = str_replace('[ITEM_ROWS]', $itemRowsHtml, $customTemplateHtml);

                    // Hide field blocks where values are empty or unresolved placeholders.
                    $customTemplateHtml = preg_replace(
                        '/<div class="info-row">\s*<span class="info-label">[^<]*<\/span>\s*<span class="info-value">\s*(?:\[[^\]]+\]|)\s*<\/span>\s*<\/div>/is',
                        '',
                        $customTemplateHtml
                    );
                    $customTemplateHtml = preg_replace(
                        '/<div>\s*<span class="lbl">[^<]*<\/span>\s*<span class="val">\s*(?:\[[^\]]+\]|)\s*<\/span>\s*<\/div>/is',
                        '',
                        $customTemplateHtml
                    );
                    $customTemplateHtml = preg_replace('/\[(?!CP_(?:LOGO|IMAGE|VIDEO|MUSIC)_CID\])[^\]]+\]/', '', $customTemplateHtml);
                    $customTemplateHtml = preg_replace('/<div class="pan-row">\s*<\/div>/is', '', $customTemplateHtml);
                }

                \Log::info('Quotation mail attempt started in save_proforma', [
                    'quotation_id' => $id,
                    'user_id' => $data['uid'] ?? null,
                    'recipient' => $data['email'] ?? '',
                    'invoice' => $data['invoice'] ?? '',
                    'mail_driver' => config('mail.driver'),
                ]);

                Mail::send([], [], function ($message) use ($data, $pdf, $fileName, $customTemplateHtml) {
                    $message->to($data["email"])
                        ->from(config('mail.from.address', 'info@imagefootage.com'), config('mail.from.name', 'Imagefootage'))
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), $fileName);

                    $message->setBody('Please check your quotation in the attached PDF.', 'text/plain');
                });

                \Log::info('Quotation mail attempt completed in save_proforma', [
                    'quotation_id' => $id,
                    'user_id' => $data['uid'] ?? null,
                    'recipient' => $data['email'] ?? '',
                    'invoice' => $data['invoice'] ?? '',
                    'mail_failures' => Mail::failures(),
                ]);

                $s3Client = new S3Client([
                    'region' => 'us-east-2',
                    'version' => '2006-03-01',
                    'suppress_php_deprecation_warning' => true,
                ]);
                $path = 'quotation/' . $fileName;
                $source = fopen($pdfDirectory . '/' . $fileName, 'rb');
                $uploader = new MultipartUploader($s3Client, $source, [
                    'bucket' => 'imgfootage',
                    'key' => $path,
                ]);
                $fileupresult = [];
                try {
                    $fileupresult = $uploader->upload();
                } catch (MultipartUploadException $e) {
                    \Log::error('Quotation S3 upload failed in save_proforma', [
                        'error' => $e->getMessage(),
                        'file' => $fileName,
                    ]);
                }
                $pdf_path = $fileupresult['ObjectURL'] ?? '';
                if (!empty($pdf_path)) {
                    DB::table('imagefootage_performa_invoices')
                        ->where('id', '=', $id)
                        ->update(['quotation_url' => $pdf_path]);
                    unlink($pdfDirectory . '/' . $fileName);
                }
            } catch (\Exception $exception) {
                \Log::error('Quotation save/mail failed in save_proforma', [
                    'quotation_id' => $id,
                    'user_id' => $data['uid'] ?? null,
                    'recipient' => $data['email'] ?? '',
                    'error' => $exception->getMessage(),
                ]);
                $this->serverstatuscode = "0";
                $this->serverstatusdes  = $exception->getMessage();
                $this->statusdesc  =   "Quotation saved but email could not be sent. " . $exception->getMessage();
                $this->statuscode  =   "0";
                return response()->json(compact('this'));
            }
            if (Mail::failures()) {
                $this->statusdesc  =   "Error sending mail.";
                $this->statuscode  =   "0";
            } else {
                $this->statusdesc  =   "Quotation sent succesfully.";
                $this->statuscode  =   "1";
            }
            return response()->json(compact('this'));
        }
    }


    public function getData($invoice_id, $user_id)
    {
        if (!empty($invoice_id) && !empty($user_id)) {
            $all_datas = DB::table('imagefootage_performa_invoices')
                ->select('imagefootage_performa_invoices.*', 'imagefootage_performa_invoices.modified as invicecreted', 'imagefootage_performa_invoice_items.*', 'usr.first_name', 'usr.last_name', 'usr.title', 'usr.user_name', 'usr.contact_owner', 'usr.email', 'usr.mobile', 'usr.phone', 'usr.postal_code', 'usr.description', 'usr.gst', 'usr.pan', 'usr.company', 'usr.vendor_code', 'ct.name as cityname', 'st.state as statename', 'cn.name as countryname')
                ->join('imagefootage_performa_invoice_items', 'imagefootage_performa_invoice_items.invoice_id', '=', 'imagefootage_performa_invoices.id')
                ->join('imagefootage_users as usr', 'usr.id', '=', 'imagefootage_performa_invoices.user_id')
                ->where('imagefootage_performa_invoices.id', '=', $invoice_id)
                ->where('imagefootage_performa_invoices.user_id', '=', $user_id)
                ->join('countries as cn', 'cn.id', '=', 'usr.country', 'left')
                ->join('states as st', 'st.id', '=', 'usr.state', 'left')
                ->join('cities as ct', 'ct.id', '=', 'usr.city', 'left')
                ->get()
                ->toArray();
            return  $all_datas;
        }
    }
    public function getSubData($invoice_id, $user_id)
    {
        if (!empty($invoice_id) && !empty($user_id)) {
            $all_datas = DB::table('imagefootage_performa_invoices')
                ->select('imagefootage_performa_invoices.*', 'imagefootage_performa_invoices.modified as invicecreted', 'usr.first_name', 'usr.last_name', 'usr.title', 'usr.user_name', 'usr.contact_owner', 'usr.email', 'usr.mobile', 'usr.phone', 'usr.postal_code', 'usr.address', 'usr.address2', 'usr.description', 'usr.gst', 'usr.pan', 'usr.company', 'usr.vendor_code', 'ct.name as cityname', 'st.state as statename', 'cn.name as countryname', 'imagefootage_user_package.id as package_id', 'imagefootage_user_package.package_name', 'imagefootage_user_package.package_description', 'imagefootage_user_package.package_plan', 'imagefootage_user_package.package_expiry_yearly', 'imagefootage_user_package.package_expiry', 'imagefootage_user_package.package_type', 'imagefootage_user_package.pacage_size', 'imagefootage_user_package.package_products_count', 'imagefootage_user_package.package_price', 'licence_type.licence_name')
                ->join('imagefootage_user_package', 'imagefootage_user_package.id', '=', 'imagefootage_performa_invoices.package_id')
                ->join('licence_type', 'licence_type.id', '=', 'imagefootage_user_package.footage_tier')
                ->join('imagefootage_users as usr', 'usr.id', '=', 'imagefootage_performa_invoices.user_id')
                ->where('imagefootage_performa_invoices.id', '=', $invoice_id)
                ->where('imagefootage_performa_invoices.user_id', '=', $user_id)
                ->join('countries as cn', 'cn.id', '=', 'usr.country')
                ->join('states as st', 'st.id', '=', 'usr.state')
                ->join('cities as ct', 'ct.id', '=', 'usr.city')
                ->get()
                ->toArray();
            return  $all_datas;
        }
    }

    public function getQuotationData($quotation_id)
    {
        if (!empty($quotation_id)) {
            $all_datas = Invoice::select('imagefootage_performa_invoices.*')
                ->with('items')
                ->with('user_package:id,package_type,package_expiry,package_expiry_yearly,package_id')
                ->where('imagefootage_performa_invoices.id', '=', $quotation_id)
                ->first()
                ->toArray();
            return  response()->json($all_datas);
        }
    }

    public function create_invoice($quotation_id, $user_id, $po, $po_date, $payment_method, $request_data)
    {
        ini_set('max_execution_time', 0);
        @set_time_limit(0);
        User::where('id', $user_id)->update(['gst' => $request_data['gst'], 'pan' => $request_data['pan'], 'mobile' => $request_data['phone'], 'phone' => $request_data['phone']]);
        $dataForEmail = $this->getData($quotation_id, $user_id);

        $dataForEmail = json_decode(json_encode($dataForEmail), true);
        if (empty($dataForEmail) || !isset($dataForEmail[0])) {
            $invoiceMeta = Invoice::select('invoice_type', 'package_id')->where('id', $quotation_id)->first();
            if ($invoiceMeta && (in_array((int) $invoiceMeta->invoice_type, [1, 2], true) || !empty($invoiceMeta->package_id))) {
                return $this->create_invoice_subscription($quotation_id, $user_id, $po, $po_date, $payment_method, $request_data);
            }

            \Log::warning('create_invoice called with missing invoice item data', [
                'quotation_id' => $quotation_id,
                'user_id' => $user_id,
            ]);

            return response()->json([
                'resp' => [
                    'statuscode' => '0',
                    'statusdesc' => 'Invoice data not found for this quotation. Please regenerate quotation or use correct invoice flow.'
                ]
            ], 422);
        }

        $amount_in_words   =  $this->convert_number_to_words($dataForEmail[0]['total']);
        $transactionRequest = new TransactionRequest();
        $currency = $request_data['currency'] ?? 'INR';
        //Setting all values here
        $transactionRequest->setMode($this->mode);
        $transactionRequest->setLogin($this->login);
        $transactionRequest->setPassword($this->password);
        $transactionRequest->setProductId($this->atomprodId);
        $transactionRequest->setAmount($dataForEmail[0]['total']);
        $transactionRequest->setTransactionCurrency($currency);
        $transactionRequest->setTransactionAmount($dataForEmail[0]['total']);

        $transactionRequest->setReturnUrl($this->buildAtomReturnUrl('/api/atomPayInvoiceResponse'));
        $transactionRequest->setClientCode($this->clientcode);
        $transactionRequest->setTransactionId($dataForEmail[0]['invoice_name']);
        $datenow = date("d/m/Y h:m:s", strtotime($dataForEmail[0]['invoice_created']));
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

        $dataForEmail[0]['company_logo'] = $this->pdfImagePath('images/new-design-logo.png');
        $dataForEmail[0]['music_image'] = $this->pdfImagePath('images/music-img.png');
        if ($dataForEmail[0]['flag'] == 0) {
            // For other quotations use image footage logo
            $dataForEmail[0]['company_logo'] = $this->pdfImagePath('images/new-design-logo.png');
        } else {
            // For form2 quotation use other logo
            $dataForEmail[0]['company_logo'] = $this->pdfImagePath('images/conceptual_logo.png');
        }
        $dataForEmail[0]['signature']     = $this->pdfImagePath('images/signature.png');
        $front_end_url_name               = config('app.front_end_url');
        $frontend_name                    = explode('//', rtrim($front_end_url_name, '/#/'));
        $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
        $dataForEmail[0]["frontend_url"]  = $front_end_url_name;
        $dataForEmail[0]['po_detail'] = $po_date;

        $data["subject"] = "Invoice (" . $dataForEmail[0]['invoice_name'] . ")";
        $recipientEmail = trim((string) ($dataForEmail[0]['email_id'] ?? $dataForEmail[0]['email'] ?? ''));
        $data["email"]   = $recipientEmail;
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
        $data["name"]    = $dataForEmail[0]['first_name'];
        
        // Generate Razorpay payment link BEFORE PDF generation so correct URL is embedded
        $invoicePayOnlineLink = '';
        if ($payment_method == 'online') {
            $invoicePayOnlineLink = $this->createRazorpayPaymentLink(
            ($dataForEmail[0]['total'] ?? 0),
            'Invoice Payment for ' . ($dataForEmail[0]['invoice_name'] ?? ''),
            'INV-' . ($dataForEmail[0]['invoice_name'] ?? ''),
            $dataForEmail[0]['first_name'] ?? '',
            $data["email"] ?? '',
            $dataForEmail[0]['mobile'] ?? '',
            $currency
        );
        }
        $dataForEmail[0]['payment_url'] = $invoicePayOnlineLink ?? '';

        $pdfDirectory = storage_path('app/public/pdf');
        if (!is_dir($pdfDirectory)) {
            mkdir($pdfDirectory, 0777, true);
        }
        $pdf = PDF::setOptions([
            'isRemoteEnabled' => false,
            'isHtml5ParserEnabled' => true,
            'dpi' => 96,
            'defaultFont' => 'sans-serif'
        ])->loadHTML(view('email.backend_invoice', ['quotation' => $dataForEmail, 'amount_in_words' => strtoupper($amount_in_words), 'payment_method' => $payment_method, 'po' => $po, 'po_date' => $po_date]));
        $fileName = $dataForEmail[0]['invoice_name'] . "_invoice.pdf";
        $pdf->save($pdfDirectory . '/' . $fileName);
        // if ($payment_method == 'online') {

        //     // Send payment link to customer via email
        //     $mailData = [
        //         'cname' => $dataForEmail[0]['first_name'],
        //         'cemail' => $data["email"],
        //         'payment_link' => $invoicePayOnlineLink
        //     ];

        //     Mail::send('completepaymentmail', $mailData, function ($message) use ($mailData, $pdf, $fileName) {
        //         $message->to($mailData['cemail'], $mailData['cname'])
        //             ->from(config('mail.from.address', 'info@imagefootage.com'), config('mail.from.name', 'Imagefootage'))
        //             ->subject('Complete Your Payment - ' . config('constants.company_name'))
        //             ->attachData($pdf->output(), $fileName);
        //     });
        // }
        $isCustomIfInvoice = (int) ($dataForEmail[0]['flag'] ?? 0) === 2;
        $customInvoiceTemplatePath = $isCustomIfInvoice
            ? base_path('email_task/Send Quotation/Custom/Invoice-IF.html')
            : base_path('email_task/Send Custom Quotation/Custom/Invoice-CP.html');
        $customTemplateHtml = '';
        if (file_exists($customInvoiceTemplatePath)) {
            $customTemplateHtml = file_get_contents($customInvoiceTemplatePath);

            $customerName = trim(($dataForEmail[0]['first_name'] ?? '') . ' ' . ($dataForEmail[0]['last_name'] ?? ''));
            $clientCompanyName = $dataForEmail[0]['company'] ?? '';
            $addressParts = array_filter([
                $dataForEmail[0]['address'] ?? '',
                $dataForEmail[0]['address2'] ?? '',
            ]);
            $clientAddress = implode('<br>', $addressParts);
            $city = $dataForEmail[0]['cityname'] ?? '';
            $postalCode = $dataForEmail[0]['postal_code'] ?? '';
            $country = $dataForEmail[0]['countryname'] ?? '';
            $taxAmount = (float) ($dataForEmail[0]['tax'] ?? 0);
            $totalAmount = (float) ($dataForEmail[0]['total'] ?? 0);
            $subTotal = max($totalAmount - $taxAmount, 0);

            $replaceMap = [
                '[Estimate Number]' => $dataForEmail[0]['invoice_name'],
                '[Estimate Date]' => date('d.m.Y', strtotime($dataForEmail[0]['invoice_created'] ?? date('Y-m-d'))),
                '[Invoice Number]' => $dataForEmail[0]['invoice_name'],
                '[Invoice Date]' => date('d.m.Y', strtotime($dataForEmail[0]['invoice_created'] ?? date('Y-m-d'))),
                '[Client Name]' => $customerName,
                '[Client Email]' => $dataForEmail[0]['email'] ?? ($dataForEmail[0]['email_id'] ?? ''),
                '[End Client Name]' => $dataForEmail[0]['end_client'] ?? '',
                '[Client Code]' => $dataForEmail[0]['vendor_code'] ?? '',
                '[Company Name]' => $clientCompanyName,
                '[Address]' => $clientAddress,
                '[City]' => $city,
                '[Postal Code]' => $postalCode,
                '[Country]' => $country,
                '[Client PAN Number]' => $dataForEmail[0]['pan'] ?? '',
                '[Client GSTIN]' => $dataForEmail[0]['gst'] ?? '',
                '[Client Contact Number]' => $dataForEmail[0]['mobile'] ?? '',
                '[Account Manager]' => $dataForEmail[0]['contact_owner'] ?? '',
                '[sub total]' => number_format($subTotal, 2),
                '[discount amount]' => '0.00',
                '[tax percentage]' => (string) config('constants.GST_VALUE'),
                '[tax amount]' => number_format($taxAmount, 2),
                '[total number of items]' => (string) count($dataForEmail),
                '[total due]' => number_format($totalAmount, 2),
                '[PAY_ONLINE_LINK]' => $invoicePayOnlineLink,
            ];
            $customTemplateHtml = str_replace(array_keys($replaceMap), array_values($replaceMap), $customTemplateHtml);

            $defaultImageThumb = '[CP_IMAGE_CID]';
            $defaultVideoThumb = '[CP_VIDEO_CID]';
            $defaultMusicThumb = '[CP_MUSIC_CID]';
            $itemRowsHtml = '';
            foreach ($dataForEmail as $index => $item) {
                $itemCode = trim((string) ($item['product_id'] ?? ''));
                $itemName = trim((string) ($item['name'] ?? ''));
                $itemTitle = trim($itemCode . (($itemCode !== '' && $itemName !== '') ? ' : ' : '') . $itemName);
                if ($itemTitle === '') {
                    $itemTitle = 'Asset ' . ($index + 1);
                }

                $itemType = strtolower((string) ($item['type'] ?? ''));
                $itemThumbUrl = $defaultImageThumb;
                if (strpos($itemType, 'music') !== false) {
                    $itemThumbUrl = $defaultMusicThumb;
                } elseif (strpos($itemType, 'footage') !== false || strpos($itemType, 'video') !== false) {
                    $itemThumbUrl = $defaultVideoThumb;
                }

                $detailLines = [];
                if (!empty($item['type'])) {
                    $detailLines[] = '<div class="dl"><strong>File Type:</strong> ' . e($item['type']) . '</div>';
                }
                if (!empty($item['licence_type'])) {
                    $detailLines[] = '<div class="dl"><strong>License Type:</strong> ' . e(strip_tags($item['licence_type'])) . '</div>';
                }
                if (!empty($item['product_size'])) {
                    $detailLines[] = '<div class="dl"><strong>Size:</strong> ' . e($item['product_size']) . '</div>';
                }
                if (!empty($item['size'])) {
                    $detailLines[] = '<div class="dl"><strong>Resolution Type:</strong> ' . e($item['size']) . '</div>';
                }
                if (!empty($item['resolution'])) {
                    $detailLines[] = '<div class="dl"><strong>Resolution:</strong> ' . e($item['resolution']) . '</div>';
                }
                if (!empty($item['format'])) {
                    $detailLines[] = '<div class="dl"><strong>File Format:</strong> ' . e($item['format']) . '</div>';
                }
                if (!empty($item['product_type'])) {
                    $detailLines[] = '<div class="dl"><strong>Licensing Model:</strong> ' . e($item['product_type']) . '</div>';
                }
                if (!empty($item['duration'])) {
                    $detailLines[] = '<div class="dl"><strong>Duration:</strong> ' . e($item['duration']) . '</div>';
                }
                for ($catIndex = 1; $catIndex <= 7; $catIndex++) {
                    $catTitle = trim((string) ($item['catTitle' . $catIndex] ?? ''));
                    $catValue = trim((string) ($item['catValue' . $catIndex] ?? ''));
                    if ($catTitle !== '' && $catValue !== '') {
                        $detailLines[] = '<div class="dl"><strong>' . e($catTitle) . ':</strong> ' . e($catValue) . '</div>';
                    }
                }

                $extraDetailsRaw = $item['extra_details'] ?? '';
                $extraDetails = trim(strip_tags((string) $extraDetailsRaw));
                $extraDetailsBlock = $extraDetails !== ''
                    ? '<div class="item-full">' . nl2br(e($extraDetails)) . '</div>'
                    : '';

                $itemRowsHtml .= '<div class="item-row">'
                    . '<div class="item-sno">' . ($index + 1) . '</div>'
                    . '<div>'
                    . '<div class="item-title">' . e($itemTitle) . '</div>'
                    . '<div class="item-body">'
                    . '<div class="item-thumb"><img src="' . e($itemThumbUrl) . '" alt="Asset Thumbnail" style="width:110px;height:76px;object-fit:cover;display:block;"></div>'
                    . '<div class="item-details">' . implode('', $detailLines) . '</div>'
                    . '</div>'
                    . $extraDetailsBlock
                    . '</div>'
                    . '<div class="item-price">' . number_format((float) ($item['subtotal'] ?? 0), 2) . '</div>'
                    . '</div>';
            }

            if (!empty($itemRowsHtml)) {
                $firstItemPos = strpos($customTemplateHtml, '<div class="item-row">');
                $assetsPos = strpos($customTemplateHtml, '<div class="assets-line">');
                if ($firstItemPos !== false && $assetsPos !== false && $firstItemPos < $assetsPos) {
                    $customTemplateHtml = substr($customTemplateHtml, 0, $firstItemPos)
                        . $itemRowsHtml . "\n\n    "
                        . substr($customTemplateHtml, $assetsPos);
                }
            }

            $customTemplateHtml = preg_replace('/<img\s+src="[^"]*"\s+alt="Company Logo"/i', '<img src="[CP_LOGO_CID]" alt="Company Logo"', $customTemplateHtml, 1);
            $customTemplateHtml = preg_replace('/<div class="info-row">\s*<span class="info-label">[^<]*<\/span>\s*<span class="info-value">\s*(?:\[[^\]]+\]|)\s*<\/span>\s*<\/div>/is', '', $customTemplateHtml);
            $customTemplateHtml = preg_replace('/<div>\s*<span class="lbl">[^<]*<\/span>\s*<span class="val">\s*(?:\[[^\]]+\]|)\s*<\/span>\s*<\/div>/is', '', $customTemplateHtml);
            $customTemplateHtml = preg_replace('/\[(?!CP_(?:LOGO|IMAGE|VIDEO|MUSIC)_CID\])[^\]]+\]/', '', $customTemplateHtml);
            $customTemplateHtml = preg_replace('/<div class="pan-row">\s*<\/div>/is', '', $customTemplateHtml);
        }

        $invoiceMailFailures = [];
        $mailMessageId = null;
        $mailDispatchException = null;
        if (empty($recipientEmail) || !filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
            $invoiceMailFailures = [empty($recipientEmail) ? 'missing_recipient_email' : $recipientEmail];
            \Log::warning('Invoice mail skipped due to invalid recipient in create_invoice', [
                'quotation_id' => $quotation_id,
                'user_id' => $user_id,
                'recipient' => $recipientEmail,
                'invoice' => $data["invoice"] ?? null,
            ]);
        } else {
            \Log::info('Invoice mail attempt started in create_invoice', [
                'quotation_id' => $quotation_id,
                'user_id' => $user_id,
                'recipient' => $recipientEmail,
                'invoice' => $data["invoice"] ?? null,
                'mail_driver' => config('mail.driver'),
            ]);
            try {
                Mail::send([], [], function ($message) use ($data, $pdf, $fileName, $customTemplateHtml, $isCustomIfInvoice, &$mailMessageId) {
                    $message->to($data["email"])
                        ->from(config('mail.from.address', 'info@imagefootage.com'), config('mail.from.name', 'Imagefootage'))
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), $fileName);
                    $mailMessageId = $message->getId();

                    $message->setBody('Please check your invoice in the attached PDF.', 'text/plain');
                });
                $invoiceMailFailures = Mail::failures();
                \Log::info('Invoice mail attempt completed in create_invoice', [
                    'quotation_id' => $quotation_id,
                    'user_id' => $user_id,
                    'recipient' => $recipientEmail,
                    'invoice' => $data["invoice"] ?? null,
                    'mail_message_id' => $mailMessageId,
                    'mail_failures' => $invoiceMailFailures,
                ]);
            } catch (\Throwable $e) {
                $mailDispatchException = $e;
                \Log::error('Invoice mail send threw exception in create_invoice', [
                    'quotation_id' => $quotation_id,
                    'user_id' => $user_id,
                    'recipient' => $recipientEmail,
                    'invoice' => $data["invoice"] ?? null,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $s3Client = new S3Client([
            'region' => 'us-east-2',
            'version' => '2006-03-01'
        ]);
        $path = 'invoice/' . $fileName;
        $source = fopen($pdfDirectory . '/' . $fileName, 'rb');
        $uploader = new MultipartUploader($s3Client, $source, [
            'bucket' => 'imgfootage',
            'key' => $path,
        ]);
        $fileupresult = [];
        try {
            $fileupresult = $uploader->upload();
        } catch (MultipartUploadException $e) {
            \Log::error('Invoice S3 upload failed in create_invoice', ['error' => $e->getMessage(), 'file' => $fileName]);
        }
        $pdf_path = $fileupresult['ObjectURL'] ?? '';
        if (!empty($pdf_path)) {
            $update_data = ['invoice_url' => $pdf_path, 'proforma_type' => '2', 'job_number' => $po, 'po_detail' => $po_date, 'invoice_created' => date('Y-m-d H:i:s'), 'payment_method' => $request_data['payment_method']];
            if (!empty($request_data['payment_method'] == 'chq') && !empty($request_data['expiry_due_date'])) {
                $update_data['expiry_due_date'] = $request_data['expiry_due_date'];
            }
            DB::table('imagefootage_performa_invoices')
                ->where('id', '=', $quotation_id)
                ->update($update_data);
            unlink($pdfDirectory . '/' . $fileName);
        } else {
            // Keep local fallback so the flow does not break if S3 is unavailable.
            $localPdfPath = $pdfDirectory . '/' . $fileName;
            if (file_exists($localPdfPath)) {
                DB::table('imagefootage_performa_invoices')
                    ->where('id', '=', $quotation_id)
                    ->update([
                        'invoice_url' => url('storage/pdf/' . $fileName),
                        'proforma_type' => '2',
                        'job_number' => $po,
                        'po_detail' => $po_date,
                        'invoice_created' => date('Y-m-d H:i:s'),
                        'payment_method' => $request_data['payment_method']
                    ]);
            }
        }
        $resp = array();
        if ($mailDispatchException) {
            Session::flash("error", "Error sending mail");
            $resp['statusdesc']   =   "Error sending mail: " . $mailDispatchException->getMessage();
            $resp['statuscode']   =   "0";
        } elseif (!empty($invoiceMailFailures)) {
            $failureInfo = implode(', ', $invoiceMailFailures);
            Session::flash("error", "Error sending mail");
            $resp['statusdesc']   =   "Error sending mail to: " . $failureInfo;
            $resp['statuscode']   =   "0";
        } else {
            Session::flash("success", "Invoice sent succesfully");
            $resp['statusdesc']  =   "Invoice sent succesfully";
            $resp['statuscode']  =   "1";
        }
        $resp['mail_to'] = $recipientEmail;
        $resp['mail_driver'] = config('mail.driver');
        $resp['mail_message_id'] = $mailMessageId;
        return response()->json(compact('resp'));
    }

    public function create_invoice_subscription($quotation_id, $user_id, $po, $po_date, $payment_method, $request_data)
    {
        ini_set('max_execution_time', 0);
        @set_time_limit(0);
        $dataForEmail = $this->getSubData($quotation_id, $user_id);
        $dataForEmail = json_decode(json_encode($dataForEmail), true);
        if ($request_data['payment_method'] == 'chq') {
            $this->findPackage($dataForEmail[0]['package_id']);
        }

        $amount_in_words   = isset($dataForEmail[0]['total']) && !empty($dataForEmail[0]['total']) ? $this->convert_number_to_words($dataForEmail[0]['total']) : '';
        $total = $dataForEmail[0]['total'] ?? 0;

        $transactionRequest = new TransactionRequest();
        //Setting all values here
        $transactionRequest->setMode($this->mode);
        $transactionRequest->setLogin($this->login);
        $transactionRequest->setPassword($this->password);
        $transactionRequest->setProductId($this->atomprodId);
        $transactionRequest->setAmount($total);
        $transactionRequest->setTransactionCurrency("INR");
        $transactionRequest->setTransactionAmount($total);

        $transactionRequest->setReturnUrl($this->buildAtomReturnUrl('/api/atomSubPayInvoiceResponse'));
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
        $currency = 'INR';
//test commit
        $dataForEmail[0]['company_logo']                    = $this->pdfImagePath('images/new-design-logo.png');
        $dataForEmail[0]['signature']                       = $this->pdfImagePath('images/signature.png');
        $front_end_url_name                                 = config('app.front_end_url');
        $frontend_name                                      = explode('//', rtrim($front_end_url_name, '/#/'));
        $dataForEmail[0]["frontend_name"]                   = $frontend_name[1] ?? '';
        $dataForEmail[0]["frontend_url"]                    = $front_end_url_name;
        $dataForEmail[0]["INVOICE_PREFIX"]                  = config('constants.INVOICE_PREFIX') ?? '';
        $dataForEmail[0]["GSTIN_VALUE"]                     = config('constants.GSTIN_VALUE') ?? '';
        $dataForEmail[0]["PAN_VALUE"]                       = config('constants.PAN_VALUE') ?? '';
        $dataForEmail[0]['package_products_count_in_words'] =  $this->convert_number_to_words($dataForEmail[0]['package_products_count']) ?? '';
        $dataForEmail[0]['po_detail'] = $po_date;

        $data["subject"] = "Invoice (" . $dataForEmail[0]['invoice_name'] . ")";
        $recipientEmail = trim((string) ($dataForEmail[0]['email_id'] ?? $dataForEmail[0]['email'] ?? ''));
        $data["email"]   = $recipientEmail;
        $data["invoice"] = $dataForEmail[0]['invoice_name'];
        $data['name']    = $dataForEmail[0]['first_name'];
        
        // Generate Razorpay payment link BEFORE PDF generation so correct URL is embedded
        $invoicePayOnlineLink = $this->createRazorpayPaymentLink(
            ($dataForEmail[0]['total'] ?? 0),
            'Invoice Payment for ' . ($dataForEmail[0]['invoice_name'] ?? ''),
            'INV-SUB-' . ($dataForEmail[0]['invoice_name'] ?? ''),
            $dataForEmail[0]['first_name'] ?? '',
            $data["email"] ?? '',
            $dataForEmail[0]['mobile'] ?? '',
            $currency
        );
        $dataForEmail[0]['payment_url'] = $invoicePayOnlineLink;

        $pdf = PDF::setOptions([
            'isRemoteEnabled' => false,
            'isHtml5ParserEnabled' => true,
            'dpi' => 96,
            'defaultFont' => 'sans-serif'
        ])->loadHTML(view('email.plan_invoice_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words' => strtoupper($amount_in_words), 'payment_method' => $payment_method]));

        $fileName = $dataForEmail[0]['invoice_name'] . "_invoice.pdf";
        $pdf->save(storage_path('app/public/pdf') . '/' . $fileName);
        $isDownloadInvoice = (int) ($dataForEmail[0]['invoice_type'] ?? 0) === 2;
        $customTemplateHtml = '';
        if ($isDownloadInvoice) {
            $customInvoiceTemplatePath = base_path('email_task/Send Quotation/Download Pack/Invoice-IFP.html');
            if (file_exists($customInvoiceTemplatePath)) {
                $customTemplateHtml = file_get_contents($customInvoiceTemplatePath);
                $customerName = trim(($dataForEmail[0]['first_name'] ?? '') . ' ' . ($dataForEmail[0]['last_name'] ?? ''));
                $clientCompanyName = $dataForEmail[0]['company'] ?? '';
                $addressParts = array_filter([
                    $dataForEmail[0]['address'] ?? '',
                    $dataForEmail[0]['address2'] ?? '',
                ]);
                $clientAddress = implode('<br>', $addressParts);
                $city = $dataForEmail[0]['cityname'] ?? '';
                $postalCode = $dataForEmail[0]['postal_code'] ?? '';
                $country = $dataForEmail[0]['countryname'] ?? '';
                $taxAmount = (float) ($dataForEmail[0]['tax'] ?? 0);
                $totalAmount = (float) ($dataForEmail[0]['total'] ?? 0);
                $subTotal = max($totalAmount - $taxAmount, 0);

                $replaceMap = [
                    '[Estimate Number]' => $dataForEmail[0]['invoice_name'],
                    '[Estimate Date]' => date('d.m.Y', strtotime($dataForEmail[0]['invicecreted'] ?? date('Y-m-d'))),
                    '[Client Name]' => $customerName,
                    '[Client Email]' => $dataForEmail[0]['email'] ?? ($dataForEmail[0]['email_id'] ?? ''),
                    '[Client Code]' => $dataForEmail[0]['vendor_code'] ?? '',
                    '[Company Name]' => $clientCompanyName,
                    '[Address]' => $clientAddress,
                    '[City]' => $city,
                    '[Postal Code]' => $postalCode,
                    '[Country]' => $country,
                    '[Client PAN Number]' => $dataForEmail[0]['pan'] ?? '',
                    '[Client GSTIN]' => $dataForEmail[0]['gst'] ?? '',
                    '[Client Contact Number]' => $dataForEmail[0]['mobile'] ?? '',
                    '[Account Manager]' => $dataForEmail[0]['contact_owner'] ?? '',
                    '[Package Name]' => $dataForEmail[0]['package_name'] ?? '',
                    '[Price]' => number_format((float) ($dataForEmail[0]['package_price'] ?? $subTotal), 2),
                    '[sub total]' => number_format($subTotal, 2),
                    '[discount amount]' => '0.00',
                    '[tax percentage]' => (string) config('constants.GST_VALUE'),
                    '[tax amount]' => number_format($taxAmount, 2),
                    '[total number of items]' => '1',
                    '[total due]' => number_format($totalAmount, 2),
                    '[PAY_ONLINE_LINK]' => $invoicePayOnlineLink,
                ];
                $customTemplateHtml = str_replace(array_keys($replaceMap), array_values($replaceMap), $customTemplateHtml);

                $downloadRowsHtml = '<div class="item-row">'
                    . '<div class="item-sno">1</div>'
                    . '<div><div class="item-title">' . e($dataForEmail[0]['package_name'] ?? 'Download Pack') . '</div></div>'
                    . '<div class="item-price">' . number_format((float) ($dataForEmail[0]['package_price'] ?? $subTotal), 2) . '</div>'
                    . '</div>';
                $firstItemPos = strpos($customTemplateHtml, '<div class="item-row">');
                $assetsPos = strpos($customTemplateHtml, '<div class="assets-line">');
                if ($firstItemPos !== false && $assetsPos !== false && $firstItemPos < $assetsPos) {
                    $customTemplateHtml = substr($customTemplateHtml, 0, $firstItemPos)
                        . $downloadRowsHtml . "\n\n    "
                        . substr($customTemplateHtml, $assetsPos);
                }

                $customTemplateHtml = preg_replace('/<img\s+src="[^"]*"\s+alt="Company Logo"/i', '<img src="[CP_LOGO_CID]" alt="Company Logo"', $customTemplateHtml, 1);
                $customTemplateHtml = preg_replace('/<div class="info-row">\s*<span class="info-label">[^<]*<\/span>\s*<span class="info-value">\s*(?:\[[^\]]+\]|)\s*<\/span>\s*<\/div>/is', '', $customTemplateHtml);
                $customTemplateHtml = preg_replace('/<div>\s*<span class="lbl">[^<]*<\/span>\s*<span class="val">\s*(?:\[[^\]]+\]|)\s*<\/span>\s*<\/div>/is', '', $customTemplateHtml);
                $customTemplateHtml = preg_replace('/\[(?!CP_(?:LOGO|IMAGE|VIDEO|MUSIC)_CID\])[^\]]+\]/', '', $customTemplateHtml);
                $customTemplateHtml = preg_replace('/<div class="pan-row">\s*<\/div>/is', '', $customTemplateHtml);
            }
        }

        $invoiceMailFailures = [];
        $mailMessageId = null;
        $mailDispatchException = null;
        if (empty($recipientEmail) || !filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
            $invoiceMailFailures = [empty($recipientEmail) ? 'missing_recipient_email' : $recipientEmail];
            \Log::warning('Invoice mail skipped due to invalid recipient in create_invoice_subscription', [
                'quotation_id' => $quotation_id,
                'user_id' => $user_id,
                'recipient' => $recipientEmail,
                'invoice' => $data["invoice"] ?? null,
            ]);
        } else {
            \Log::info('Invoice mail attempt started in create_invoice_subscription', [
                'quotation_id' => $quotation_id,
                'user_id' => $user_id,
                'recipient' => $recipientEmail,
                'invoice' => $data["invoice"] ?? null,
                'mail_driver' => config('mail.driver'),
            ]);
            try {
                if ($isDownloadInvoice) {
                    Mail::send([], [], function ($message) use ($data, $pdf, $fileName, $customTemplateHtml, &$mailMessageId) {
                        $message->to($data["email"])
                            ->from(config('mail.from.address', 'info@imagefootage.com'), config('mail.from.name', 'Imagefootage'))
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), $fileName);
                        $mailMessageId = $message->getId();

                        $message->setBody('Please check your invoice in the attached PDF.', 'text/plain');
                    });
                } else {
                    Mail::send('invoice', $data, function ($message) use ($data, $pdf, $fileName, &$mailMessageId) {
                        $message->to($data["email"])
                            ->from(config('mail.from.address', 'info@imagefootage.com'), config('mail.from.name', 'Imagefootage'))
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), $fileName);
                        $mailMessageId = $message->getId();
                    });
                }
                $invoiceMailFailures = Mail::failures();
                \Log::info('Invoice mail attempt completed in create_invoice_subscription', [
                    'quotation_id' => $quotation_id,
                    'user_id' => $user_id,
                    'recipient' => $recipientEmail,
                    'invoice' => $data["invoice"] ?? null,
                    'mail_message_id' => $mailMessageId,
                    'mail_failures' => $invoiceMailFailures,
                ]);
            } catch (\Throwable $e) {
                $mailDispatchException = $e;
                \Log::error('Invoice mail send threw exception in create_invoice_subscription', [
                    'quotation_id' => $quotation_id,
                    'user_id' => $user_id,
                    'recipient' => $recipientEmail,
                    'invoice' => $data["invoice"] ?? null,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $s3Client = new S3Client([
            'region' => 'us-east-2',
            'version' => '2006-03-01'
        ]);
        $path = 'invoice/' . $fileName;
        $pdfDirectory = storage_path('app/public/pdf');
        $source = fopen($pdfDirectory . '/' . $fileName, 'rb');
        $uploader = new MultipartUploader($s3Client, $source, [
            'bucket' => 'imgfootage',
            'key' => $path,
        ]);
        $fileupresult = [];
        try {
            $fileupresult = $uploader->upload();
        } catch (MultipartUploadException $e) {
            \Log::error('Invoice S3 upload failed in create_invoice_subscription', ['error' => $e->getMessage(), 'file' => $fileName]);
        }
        $pdf_path = $fileupresult['ObjectURL'] ?? '';
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
                ->update(['order_type' => '2']);
            unlink($pdfDirectory . '/' . $fileName);
        } else {
            $localPdfPath = $pdfDirectory . '/' . $fileName;
            if (file_exists($localPdfPath)) {
                DB::table('imagefootage_performa_invoices')
                    ->where('id', '=', $quotation_id)
                    ->update([
                        'invoice_url' => url('storage/pdf/' . $fileName),
                        'proforma_type' => '2',
                        'invoice_created' => date('Y-m-d H:i:s'),
                        'job_number' => $po,
                        'po_detail' => $po_date,
                        'payment_method' => $payment_method
                    ]);
                DB::table('imagefootage_user_package')
                    ->where('id', '=', $dataForEmail[0]['package_id'])
                    ->update(['order_type' => '2']);
            }
        }
        $resp = array();
        if ($mailDispatchException) {
            Session::flash("error", "Error sending mail");
            $resp['statusdesc']  =   "Error sending mail: " . $mailDispatchException->getMessage();
            $resp['statuscode']   =   "0";
        } elseif (!empty($invoiceMailFailures)) {
            $failureInfo = implode(', ', $invoiceMailFailures);
            Session::flash("error", "Error sending mail");
            $resp['statusdesc']  =   "Error sending mail to: " . $failureInfo;
            $resp['statuscode']   =   "0";
        } else {
            Session::flash("success", "Invoice sent succesfully");
            $resp['statusdesc']  =   "Invoice sent succesfully";
            $resp['statuscode']  =   "1";
        }
        $resp['mail_to'] = $recipientEmail;
        $resp['mail_driver'] = config('mail.driver');
        $resp['mail_message_id'] = $mailMessageId;
        return response()->json(compact('resp'));
    }

    public function change_invoice_status($quotation_id, $status)
    {
        $update = Invoice::where('id', '=', $quotation_id)
            ->update(['status' => $status]);
        $resp = array();
        if ($update) {
            $resp['statusdesc'] = "Your Quotation/Invoice status changed successfully.";
            $resp['statuscode'] = "1";
        } else {
            $resp['statusdesc'] = "Error in change status.";
            $resp['statuscode'] = "0";
        }
        return response()->json(compact('resp'));
    }

    public function save_subscription_proforma($data)
    {
        $res = $this->verifyUserDetailsExist($data['uid']);
        if (!$res) {
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
        $packge                            = new UserPackage();
        $packge->user_id                   = $data['uid'];
        $packge->package_id                = $allFields['package_id'];
        $packge->package_name              = $allFields['package_name'];
        $packge->package_price             = $allFields['package_price'];
        $packge->package_description       = $allFields['package_description'];
        $packge->package_products_count    = $allFields['package_products_count'];
        $packge->package_type              = $allFields['package_type'];
        $packge->package_permonth_download = $allFields['package_permonth_download'];
        $packge->package_expiry            = $allFields['package_expiry'];
        $packge->package_plan              = $allFields['package_plan'];
        $packge->package_pcarry_forward    = $allFields['package_pcarry_forward'];
        $packge->package_expiry_yearly     = $allFields['package_expiry_yearly'];
        $packge->pacage_size               = $allFields['pacage_size'];
        $packge->status                    = 0;
        $packge->order_type                = 2;
        $packge->created_at                = date('Y-m-d H:i:s');
        $packge->footage_tier              = isset($allFields['footage_tier']) && !empty($allFields['footage_tier']) ? (int)$allFields['footage_tier'] : NULL;
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
            'user_id'         => $data['uid'],
            'email_id'        => $data['email'],
            'invoice_name'    => $this->random_numbers(),
            'invoice_type'    => '1',
            'created'         => date('Y-m-d H:i:s'),
            'modified'        => date('Y-m-d H:i:s'),
            'promo_code'      => '',
            'tax'             => $data['tax'] ?? '',
            'tax_selected'    => "GST",
            'total'           => $data['total'],
            'status'          => '0',
            'proforma_type'   => '1',
            'package_id'      => $packge->id,
            'expiry_invoices' => $data['expiry_date'],
            'promo_code_id'   => isset($data['promo_code_id']) ? $data['promo_code_id'] : 0,
            'created_by'      => Auth::guard('admins')->user()->id,
            'flag'            => $data['flag'] ?? '',
            'cancelled_on'    => $cancelled_on,
        );

        DB::table('imagefootage_performa_invoices')->insert($insert);
        $id = DB::getPdo()->lastInsertId();

        // Update Total applied code in promo code
        if (!empty($data['promo_code_id'])) {
            $promoCode                     = PromoCode::find($data['promo_code_id']);
            $currentUsed                   = $promoCode->total_applied_code;
            $promoCode->total_applied_code = $currentUsed + 1;
            $promoCode->save();
        }
        // End Update Total applied code in promo code

        if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
            $update = [
                'status'          => 3,
                'expiry_invoices' => $data['expiry_date'],
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
                'cancelled_on'    => $cancelled_on,
                'cancelled_by'    => Auth::guard('admins')->user()->id
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

        $transactionRequest->setReturnUrl($this->buildAtomReturnUrl('/api/atomSubPayInvoiceResponse'));
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
        $currency = 'INR';
        
        // Generate Razorpay payment link BEFORE PDF generation so correct URL is embedded
        $quotationPayOnlineLink = $this->createRazorpayPaymentLink(
            $dataForEmail[0]['total'] ?? 0,
            'Subscription Quotation Payment for ' . ($dataForEmail[0]['invoice_name'] ?? ''),
            'QTN-SUB-' . ($dataForEmail[0]['invoice_name'] ?? ''),
            trim(($dataForEmail[0]['first_name'] ?? '') . ' ' . ($dataForEmail[0]['last_name'] ?? '')),
            $dataForEmail[0]['email'] ?? ($dataForEmail[0]['email_id'] ?? ''),
            $dataForEmail[0]['mobile'] ?? '',
            $currency
        );
        $dataForEmail[0]['payment_url'] = $quotationPayOnlineLink;

        $data["subject"]                  = "Subscription Quotation (" . $dataForEmail[0]['invoice_name'] . ")";
        $data["email"]                    = $data['email'];
        $data["invoice"]                  = $dataForEmail[0]['invoice_name'];
        $data["name"]                     = $dataForEmail[0]['first_name'];
        $amount_in_words                  =  $this->convert_number_to_words($dataForEmail[0]['total']);
        $package_price_in_words           =  $this->convert_number_to_words($dataForEmail[0]['package_price']);
        $dataForEmail[0]['company_logo']  = $this->pdfImagePath('images/new-design-logo.png');
        $dataForEmail[0]['signature']     = $this->pdfImagePath('images/signature.png');
        $dataForEmail[0]['description']   = 'Subscription Plan – Images – ' . $package_name . ' Pack';
        $front_end_url_name               = config('app.front_end_url');
        $frontend_name                    = explode('//', rtrim($front_end_url_name, '/#/'));
        $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
        $dataForEmail[0]["frontend_url"]  = $front_end_url_name;

        $pdfDirectory = storage_path('app/public/pdf');
        if (!is_dir($pdfDirectory)) {
            mkdir($pdfDirectory, 0777, true);
        }
        $pdf = PDF::loadHTML(view('email.plan_quotation_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words' => $amount_in_words, 'package_price_in_words' => $package_price_in_words]));
        $fileName = $data["invoice"] . "subscription_quotation.pdf";
        $pdf->save($pdfDirectory . '/' . $fileName);
        try {
            $customTemplatePath = base_path('email_task/Send Quotation/Custom/Quotation-IF.html');
            $customTemplateHtml = '';
            if (file_exists($customTemplatePath)) {
                $customTemplateHtml = file_get_contents($customTemplatePath);
                $customerName = trim(($dataForEmail[0]['first_name'] ?? '') . ' ' . ($dataForEmail[0]['last_name'] ?? ''));
                $clientCompanyName = $dataForEmail[0]['company'] ?? '';
                $city = $dataForEmail[0]['cityname'] ?? '';
                $postalCode = $dataForEmail[0]['postal_code'] ?? '';
                $country = $dataForEmail[0]['countryname'] ?? '';
                $taxAmount = (float) ($dataForEmail[0]['tax'] ?? 0);
                $totalAmount = (float) ($dataForEmail[0]['total'] ?? 0);
                $subTotal = max($totalAmount - $taxAmount, 0);
                $replaceMap = [
                    '[Estimate Number]' => 'S' . $dataForEmail[0]['invoice_name'],
                    '[Estimate Date]' => date('d.m.Y', strtotime($dataForEmail[0]['invicecreted'] ?? date('Y-m-d'))),
                    '[Company Logo URL]' => '[CP_LOGO_CID]',
                    '[Client Name]' => $customerName,
                    '[Client Email]' => $dataForEmail[0]['email'] ?? '',
                    '[Company Name]' => $clientCompanyName,
                    '[Address]' => $dataForEmail[0]['address'] ?? '',
                    '[City]' => $city,
                    '[Postal Code]' => $postalCode,
                    '[Country]' => $country,
                    '[Client PAN Number]' => $dataForEmail[0]['pan'] ?? '',
                    '[Client GSTIN]' => $dataForEmail[0]['gst'] ?? '',
                    '[Client Contact Number]' => $dataForEmail[0]['mobile'] ?? '',
                    '[sub total]' => number_format($subTotal, 2),
                    '[discount amount]' => '0.00',
                    '[tax percentage]' => (string) config('constants.GST_VALUE'),
                    '[tax amount]' => number_format($taxAmount, 2),
                    '[total due]' => number_format($totalAmount, 2),
                    '[Package Name]' => $dataForEmail[0]['package_name'] ?? '',
                    '[PAY_ONLINE_LINK]' => $quotationPayOnlineLink,
                ];
                $customTemplateHtml = str_replace(array_keys($replaceMap), array_values($replaceMap), $customTemplateHtml);
                $customTemplateHtml = preg_replace('/<div class="info-row">\s*<span class="info-label">[^<]*<\/span>\s*<span class="info-value">\s*(?:\[[^\]]+\]|)\s*<\/span>\s*<\/div>/is', '', $customTemplateHtml);
                $customTemplateHtml = preg_replace('/\[(?!CP_(?:LOGO|IMAGE|VIDEO|MUSIC)_CID\])[^\]]+\]/', '', $customTemplateHtml);
            }

            Mail::send([], [], function ($message) use ($data, $pdf, $fileName, $customTemplateHtml) {
                $message->to($data["email"])
                            ->from(config('mail.from.address', 'info@imagefootage.com'), config('mail.from.name', 'Imagefootage'))
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), $fileName);
                $message->setBody('Please check your subscription quotation in the attached PDF.', 'text/plain');
            });

            $s3Client = new S3Client([
                'region' => 'us-east-2',
                'version' => '2006-03-01',
                'suppress_php_deprecation_warning' => true,
            ]);

            $path = 'quotation/' . $fileName;
            $source = fopen(storage_path('app/public/pdf') . '/' . $fileName, 'rb');
            $uploader = new MultipartUploader($s3Client, $source, [
                'bucket' => 'imgfootage',
                'key' => $path,
            ]);
            $fileupresult = [];
            try {
                $fileupresult = $uploader->upload();
            } catch (MultipartUploadException $e) {
                \Log::error('Quotation S3 upload failed in save_subscription_proforma', [
                    'error' => $e->getMessage(),
                    'file' => $fileName,
                ]);
            }
            $pdf_path = $fileupresult['ObjectURL'] ?? '';
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
            $this->statusdesc  =   "Error sending mail.";
            $this->statuscode  =   "0";
        } else {
            $this->statusdesc  =   "Quotation of subscription type sent successfully";
            $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
    }


    public function save_download_proforma($data)
    {
        $res = $this->verifyUserDetailsExist($data['uid']);
        if (!$res) {
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
        $packge                            = new UserPackage();
        $packge->user_id                   = $data['uid'];
        $packge->package_id                = $allFields['package_id'];
        $packge->package_name              = $allFields['package_name'];
        $packge->package_price             = $allFields['package_price'];
        $packge->package_description       = $allFields['package_description'];
        $packge->package_products_count    = $allFields['package_products_count'];
        $packge->package_type              = $allFields['package_type'];
        $packge->package_permonth_download = $allFields['package_permonth_download'];
        $packge->package_expiry            = $allFields['package_expiry'];
        $packge->package_plan              = $allFields['package_plan'];
        $packge->package_pcarry_forward    = $allFields['package_pcarry_forward'];
        $packge->package_expiry_yearly     = $allFields['package_expiry_yearly'];
        $packge->pacage_size               = $allFields['pacage_size'];
        $packge->status                    = 0;
        $packge->order_type                = 2;
        $packge->created_at                = date('Y-m-d H:i:s');
        $packge->footage_tier              = isset($allFields['footage_tier']) && !empty($allFields['footage_tier']) ? (int)$allFields['footage_tier'] : NULL;
        if ($allFields['package_expiry'] != 0 && $allFields['package_expiry_yearly'] == 0) {
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s', strtotime("+" . $allFields['package_expiry'] . " months"));
        } else {
            $packge->package_expiry_date_from_purchage  = date('Y-m-d H:i:s', strtotime("+" . $allFields['package_expiry_yearly'] . " years"));
        }
        $packge->save();
        $currency = $data['plan_id']['currency'] ?? 'INR';
        $insert = array(
            'user_id'         => $data['uid'],
            'email_id'        => $data['email'],
            'invoice_name'    => $this->random_numbers(),
            'invoice_type'    => '2',
            'created'         => date('Y-m-d H:i:s'),
            'modified'        => date('Y-m-d H:i:s'),
            'promo_code'      => '',
            'tax'             => $data['tax'] ?? '',
            'tax_selected'    => "GST",
            'total'           => $data['total'],
            'status'          => '0',
            'proforma_type'   => '1',
            'package_id'      => $packge->id,
            'expiry_invoices' => $data['expiry_date'],
            'promo_code_id'   => isset($data['promo_code_id']) ? $data['promo_code_id'] : 0,
            'created_by'      => Auth::guard('admins')->user()->id,
            'flag'            => $data['flag'] ?? '',
            'cancelled_on'    => $cancelled_on,
            'currency'        => $currency,
        );

        DB::table('imagefootage_performa_invoices')->insert($insert);
        $id = DB::getPdo()->lastInsertId();

        // Update Total applied code in promo code
        if (!empty($data['promo_code_id'])) {
            $promoCode                     = PromoCode::find($data['promo_code_id']);
            $currentUsed                   = $promoCode->total_applied_code;
            $promoCode->total_applied_code = $currentUsed + 1;
            $promoCode->save();
        }
        // End Update Total applied code in promo code

        if (isset($data['old_quotation']) && $data['old_quotation'] > 0) {
            $update = [
                'status'          => 3,
                'expiry_invoices' => $data['expiry_date'],
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
                'cancelled_on'    => $cancelled_on,
                'cancelled_by'    => Auth::guard('admins')->user()->id
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
        $transactionRequest->setTransactionCurrency($currency);
        $transactionRequest->setTransactionAmount($dataForEmail[0]['total']);

        $transactionRequest->setReturnUrl($this->buildAtomReturnUrl('/api/atomSubPayInvoiceResponse'));
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
        
        // Generate Razorpay payment link BEFORE PDF generation so correct URL is embedded
        $quotationPayOnlineLink = $this->createRazorpayPaymentLink(
            $dataForEmail[0]['total'] ?? 0,
            'Download Pack Quotation Payment for ' . ($dataForEmail[0]['invoice_name'] ?? ''),
            'QTN-DP-' . ($dataForEmail[0]['invoice_name'] ?? ''),
            trim(($dataForEmail[0]['first_name'] ?? '') . ' ' . ($dataForEmail[0]['last_name'] ?? '')),
            $dataForEmail[0]['email'] ?? ($dataForEmail[0]['email_id'] ?? ''),
            $dataForEmail[0]['mobile'] ?? '',
            $currency
        );
        $dataForEmail[0]['payment_url'] = $quotationPayOnlineLink;

        $amount_in_words                  =  $this->convert_number_to_words($dataForEmail[0]['total']);
        $package_price_in_words           =  $this->convert_number_to_words($dataForEmail[0]['package_price']);

        $data["subject"]                  = "Download Quotation (" . $dataForEmail[0]['invoice_name'] . ")";
        $data["email"]                    = $data['email'];
        $data["invoice"]                  = $dataForEmail[0]['invoice_name'];
        $data["name"]                     = $dataForEmail[0]['first_name'];
        $dataForEmail[0]['company_logo']  = $this->pdfImagePath('images/new-design-logo.png');
        $dataForEmail[0]['signature']     = $this->pdfImagePath('images/signature.png');
        $dataForEmail[0]['description']   = 'Download Plan – ' . $dataForEmail[0]['package_type'] . ' - ' . $dataForEmail[0]['package_name'] . ' Pack';
        $front_end_url_name               = config('app.front_end_url');
        $frontend_name                    = explode('//', rtrim($front_end_url_name, '/#/'));
        $dataForEmail[0]["frontend_name"] = $frontend_name[1] ?? '';
        $dataForEmail[0]["frontend_url"]  = $front_end_url_name;

        $pdf = PDF::loadHTML(view('email.plan_quotation_email_offline', ['orders' => $dataForEmail[0], 'amount_in_words' => $amount_in_words, 'package_price_in_words' => $package_price_in_words]));
        $fileName = $data["invoice"] . "download_quotation.pdf";
        $pdfDirectory = storage_path('app/public/pdf');
        if (!is_dir($pdfDirectory)) {
            mkdir($pdfDirectory, 0777, true);
        }
        $pdf->save($pdfDirectory . '/' . $fileName);
        try {
            $customTemplatePath = base_path('email_task/Send Quotation/Download Pack/Quotation-IFP.html');
            $customTemplateHtml = '';
            if (file_exists($customTemplatePath)) {
                $customTemplateHtml = file_get_contents($customTemplatePath);
                $customerName = trim(($dataForEmail[0]['first_name'] ?? '') . ' ' . ($dataForEmail[0]['last_name'] ?? ''));
                $clientCompanyName = $dataForEmail[0]['company'] ?? '';
                $city = $dataForEmail[0]['cityname'] ?? '';
                $postalCode = $dataForEmail[0]['postal_code'] ?? '';
                $country = $dataForEmail[0]['countryname'] ?? '';
                $taxAmount = (float) ($dataForEmail[0]['tax'] ?? 0);
                $totalAmount = (float) ($dataForEmail[0]['total'] ?? 0);
                $subTotal = max($totalAmount - $taxAmount, 0);
                $replaceMap = [
                    '[Estimate Number]' => 'D' . $dataForEmail[0]['invoice_name'],
                    '[Estimate Date]' => date('d.m.Y', strtotime($dataForEmail[0]['invicecreted'] ?? date('Y-m-d'))),
                    '[Company Logo URL]' => '[CP_LOGO_CID]',
                    '[Client Name]' => $customerName,
                    '[Client Email]' => $dataForEmail[0]['email'] ?? '',
                    '[Company Name]' => $clientCompanyName,
                    '[Address]' => $dataForEmail[0]['address'] ?? '',
                    '[City]' => $city,
                    '[Postal Code]' => $postalCode,
                    '[Country]' => $country,
                    '[Client PAN Number]' => $dataForEmail[0]['pan'] ?? '',
                    '[Client GSTIN]' => $dataForEmail[0]['gst'] ?? '',
                    '[Client Contact Number]' => $dataForEmail[0]['mobile'] ?? '',
                    '[sub total]' => number_format($subTotal, 2),
                    '[discount amount]' => '0.00',
                    '[tax percentage]' => (string) config('constants.GST_VALUE'),
                    '[tax amount]' => number_format($taxAmount, 2),
                    '[total due]' => number_format($totalAmount, 2),
                    '[Package Name]' => $dataForEmail[0]['package_name'] ?? '',
                    '[PAY_ONLINE_LINK]' => $quotationPayOnlineLink,
                ];
                $customTemplateHtml = str_replace(array_keys($replaceMap), array_values($replaceMap), $customTemplateHtml);
                $customTemplateHtml = preg_replace('/<div class="info-row">\s*<span class="info-label">[^<]*<\/span>\s*<span class="info-value">\s*(?:\[[^\]]+\]|)\s*<\/span>\s*<\/div>/is', '', $customTemplateHtml);
                $customTemplateHtml = preg_replace('/\[(?!CP_(?:LOGO|IMAGE|VIDEO|MUSIC)_CID\])[^\]]+\]/', '', $customTemplateHtml);
            }

            Mail::send([], [], function ($message) use ($data, $pdf, $fileName, $customTemplateHtml) {
                $message->to($data["email"])
                            ->from(config('mail.from.address', 'info@imagefootage.com'), config('mail.from.name', 'Imagefootage'))
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), $fileName);
                $message->setBody('Please check your download pack quotation in the attached PDF.', 'text/plain');
            });

            $s3Client = new S3Client([
                'region' => 'us-east-2',
                'version' => '2006-03-01'
            ]);

            $path = 'quotation/' . $fileName;
            $source = fopen($pdfDirectory . '/' . $fileName, 'rb');
            $uploader = new MultipartUploader($s3Client, $source, [
                'bucket' => 'imgfootage',
                'key' => $path,
            ]);
            $fileupresult = [];
            try {
                $fileupresult = $uploader->upload();
            } catch (MultipartUploadException $e) {
                \Log::error('Quotation S3 upload failed in save_download_proforma', [
                    'error' => $e->getMessage(),
                    'file' => $fileName,
                ]);
            }
            $pdf_path = $fileupresult['ObjectURL'] ?? '';
            if (!empty($pdf_path)) {
                DB::table('imagefootage_performa_invoices')
                    ->where('id', '=', $id)
                    ->update(['quotation_url' => $pdf_path]);
                unlink($pdfDirectory . '/' . $fileName);
            }
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail.";
            $this->statuscode  =   "0";
        } else {
            $this->statusdesc  =   "Quotation of download type sent successfully.";
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
            90                  => 'Ninety',
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
        $localPath = public_path('image/') . $fullname;
        if (!file_put_contents($localPath, $data)) {
            return 'error';
        }

        $result = asset('image/' . $fullname);

        try {
            $s3Client = new S3Client([
                'region' => 'us-east-2',
                'version' => '2006-03-01',
                'suppress_php_deprecation_warning' => true,
            ]);
            $path = 'image/' . $fullname;
            $source = fopen($localPath, 'rb');
            $uploader = new MultipartUploader($s3Client, $source, [
                'bucket' => 'imgfootage',
                'key' => $path,
            ]);
            $fileupresult = $uploader->upload();

            if (!empty($fileupresult['ObjectURL'])) {
                $result = $fileupresult['ObjectURL'];
                unlink($localPath);
            }
        } catch (\Throwable $e) {
            // Keep the local file path if S3 upload fails so invoice save can continue.
        }

        /* it will return image name if image is saved successfully
        or it will return error on failing to save image. */
        return $result;
    }

    public function update_po($invoice_id, $po_no)
    {
        $update = Invoice::where('id', '=', $invoice_id)
            ->update(['job_number' => $po_no, 'po_detail' => date('Y-m-d')]);
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
            $user = User::where('id', $user_id)
                ->whereNotNull('country')
                ->whereNotNull('state')
                ->whereNotNull('city')
                ->whereNotNull('address')
                ->first();
            return !empty($user) ? true : false;
        }
    }

    public function findPackage($package_id)
    {
        if (!empty($package_id)) {
            UserPackage::where('id', $package_id)->update([
                'status' => 1,
                'payment_status' => 'Transction Success'
            ]);
        }
    }
}
