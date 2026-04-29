<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$randomPath = env('RANDOM_PATH_FOR_LOGS', 'all-logs');
Route::get($randomPath, [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Auth::routes();

if (app()->environment('local') || config('app.debug')) {
    $pdfImageBase64 = function ($relativePath) {
        $absolutePath = public_path(ltrim(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, (string) $relativePath), DIRECTORY_SEPARATOR));

        if (file_exists($absolutePath)) {
            $mime = mime_content_type($absolutePath);
            $data = base64_encode(file_get_contents($absolutePath));

            return 'data:' . $mime . ';base64,' . $data;
        }

        return asset($relativePath);
    };

    $pdfImagePath = function ($relativePath) {
        $absolutePath = public_path(ltrim(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, (string) $relativePath), DIRECTORY_SEPARATOR));

        if (file_exists($absolutePath)) {
            return 'file:///' . str_replace('\\', '/', $absolutePath);
        }

        return asset($relativePath);
    };

    $buildPreviewQuotationData = function (\Illuminate\Http\Request $request) use ($pdfImageBase64, $pdfImagePath) {
        $sampleFlag = (int) $request->query('flag', 0);
        $sampleCount = max(5, min(10, (int) $request->query('count', 8)));
        $documentLabel = trim((string) $request->query('label', 'Estimate'));
        if ($documentLabel === '') {
            $documentLabel = 'Estimate';
        }
        $paymentMethod = strtolower((string) $request->query('payment', 'offline')) === 'online' ? 'online' : 'offline';
        $userId = $request->query('user_id');
        $invoiceId = $request->query('invoice_id');
        $quotation = [];

        if (!empty($userId) && !empty($invoiceId)) {
            $quotation = array_map(function ($row) {
                return (array) $row;
            }, app(\App\Models\Common::class)->getData($invoiceId, $userId) ?? []);
        }

        if (empty($quotation)) {
            $sampleCatalog = [
                [
                    'product_id' => 'IF-VID-2048',
                    'name' => 'City skyline drone footage',
                    'type' => 'Footage',
                    'licence_type' => 'Commercial License',
                    'product_size' => '4K UHD',
                    'size' => 'Landscape',
                    'resolution' => '3840 x 2160',
                    'format' => 'MP4',
                    'duration' => '00:22',
                    'subtotal' => 8500.00,
                ],
                [
                    'product_id' => 'IF-MUS-0987',
                    'name' => 'Ambient corporate underscore',
                    'type' => 'Music',
                    'licence_type' => 'Digital / Standard License',
                    'product_size' => 'Stereo',
                    'size' => 'Audio Track',
                    'resolution' => '48 kHz / 24 bit',
                    'format' => 'WAV',
                    'duration' => '01:35',
                    'subtotal' => 4200.00,
                ],
                [
                    'product_id' => 'IF-IMG-5541',
                    'name' => 'Modern office collaboration still',
                    'type' => 'Image',
                    'licence_type' => 'All Media License',
                    'product_size' => '6000 px',
                    'size' => 'Landscape',
                    'resolution' => '6000 x 4000',
                    'format' => 'JPG',
                    'duration' => '',
                    'subtotal' => 3500.00,
                ],
                [
                    'product_id' => 'IF-VID-7310',
                    'name' => 'Night traffic time-lapse sequence',
                    'type' => 'Footage',
                    'licence_type' => 'All Media License',
                    'product_size' => 'HD',
                    'size' => 'Landscape',
                    'resolution' => '1920 x 1080',
                    'format' => 'MOV',
                    'duration' => '00:18',
                    'subtotal' => 5600.00,
                ],
                [
                    'product_id' => 'IF-MUS-4412',
                    'name' => 'Cinematic piano ambience',
                    'type' => 'Music',
                    'licence_type' => 'Commercial License',
                    'product_size' => 'Stereo',
                    'size' => 'Audio Track',
                    'resolution' => '48 kHz / 24 bit',
                    'format' => 'MP3',
                    'duration' => '02:12',
                    'subtotal' => 3900.00,
                ],
                [
                    'product_id' => 'IF-IMG-8823',
                    'name' => 'Healthcare consultation portrait',
                    'type' => 'Image',
                    'licence_type' => 'Digital / Standard License',
                    'product_size' => '5200 px',
                    'size' => 'Portrait',
                    'resolution' => '5200 x 7800',
                    'format' => 'JPG',
                    'duration' => '',
                    'subtotal' => 2800.00,
                ],
                [
                    'product_id' => 'IF-VID-6654',
                    'name' => 'Factory assembly close-up reel',
                    'type' => 'Footage',
                    'licence_type' => 'Commercial License',
                    'product_size' => '4K UHD',
                    'size' => 'Landscape',
                    'resolution' => '4096 x 2160',
                    'format' => 'MP4',
                    'duration' => '00:31',
                    'subtotal' => 9100.00,
                ],
                [
                    'product_id' => 'IF-MUS-3004',
                    'name' => 'Upbeat launch campaign bed',
                    'type' => 'Music',
                    'licence_type' => 'All Media License',
                    'product_size' => 'Stereo',
                    'size' => 'Audio Track',
                    'resolution' => '44.1 kHz / 16 bit',
                    'format' => 'WAV',
                    'duration' => '00:54',
                    'subtotal' => 4700.00,
                ],
                [
                    'product_id' => 'IF-IMG-9140',
                    'name' => 'Executive workspace overhead still',
                    'type' => 'Image',
                    'licence_type' => 'Commercial License',
                    'product_size' => '7000 px',
                    'size' => 'Landscape',
                    'resolution' => '7000 x 4667',
                    'format' => 'PNG',
                    'duration' => '',
                    'subtotal' => 3200.00,
                ],
                [
                    'product_id' => 'IF-VID-5521',
                    'name' => 'Retail store walkthrough clip',
                    'type' => 'Footage',
                    'licence_type' => 'Digital / Standard License',
                    'product_size' => 'Full HD',
                    'size' => 'Landscape',
                    'resolution' => '1920 x 1080',
                    'format' => 'MP4',
                    'duration' => '00:27',
                    'subtotal' => 5100.00,
                ],
            ];

            $items = array_slice($sampleCatalog, 0, $sampleCount);

            $subTotal = array_sum(array_column($items, 'subtotal'));
            $taxAmount = round($subTotal * ((float) config('constants.GST_VALUE', 18) / 100), 2);
            $totalAmount = $subTotal + $taxAmount;
            $baseInvoice = [
                'invoice_name' => 'PREVIEW-1001',
                'invicecreted' => now()->format('Y-m-d H:i:s'),
                'vendor_code' => 'VND-2047',
                'company' => 'Preview Client Pvt. Ltd.',
                'first_name' => 'Ananya',
                'last_name' => 'Rao',
                'address' => '8-2-120/76/1, Road No. 2, Banjara Hills',
                'cityname' => 'Hyderabad',
                'statename' => 'Telangana',
                'postal_code' => '500034',
                'countryname' => 'India',
                'pan' => 'ABCDE1234F',
                'gst' => '36ABCDE1234F1Z5',
                'email' => 'preview.client@example.com',
                'mobile' => '+91 98765 43210',
                'contact_owner' => 'Preview Sales Team',
                'currency' => 'INR',
                'flag' => $sampleFlag,
                'tax' => $taxAmount,
                'total' => $totalAmount,
                'end_client' => 'Preview End Client LLP',
            ];

            $quotation = array_map(function ($item) use ($baseInvoice) {
                return array_merge($baseInvoice, $item);
            }, $items);
        }

        $activeFlag = isset($quotation[0]['flag']) ? (int) $quotation[0]['flag'] : $sampleFlag;
        $quotation[0]['flag'] = $activeFlag;
        $quotation[0]['company_logo'] = $activeFlag === 0
            ? $pdfImageBase64('images/new-design-logo.png')
            : $pdfImageBase64('images/conceptual_logo.png');
        $quotation[0]['placeholder_music'] = $pdfImageBase64('images/placeholder-music.png');
        $quotation[0]['placeholder_video'] = $pdfImageBase64('images/placeholder-video.png');
        $quotation[0]['placeholder_image'] = $pdfImageBase64('images/placeholder-image.png');
        $quotation[0]['template_image'] = $quotation[0]['template_image'] ?? $pdfImagePath('images/music-img.png');
        $quotation[0]['music_image'] = $quotation[0]['music_image'] ?? $pdfImagePath('images/music-img.png');
        $quotation[0]['signature'] = $quotation[0]['signature'] ?? $pdfImageBase64('images/signature.png');
        $quotation[0]['frontend_url'] = $quotation[0]['frontend_url'] ?? (config('app.front_end_url') ?: config('app.url'));
        $quotation[0]['document_label'] = $quotation[0]['document_label'] ?? $documentLabel;
        $quotation[0]['payment_url'] = $paymentMethod === 'online'
            ? ($quotation[0]['payment_url'] ?? 'https://example.com/pay/backend-invoice-preview')
            : '';
        $quotation[0]['contact_owner'] = $quotation[0]['contact_owner'] ?? 'Preview Sales Team';

        return [$quotation, $paymentMethod];
    };

    $buildPreviewPackageQuotationData = function (\Illuminate\Http\Request $request) use ($pdfImageBase64, $pdfImagePath) {
        $sampleFlag = (int) $request->query('flag', 0);
        $paymentMethod = strtolower((string) $request->query('payment', 'offline')) === 'online' ? 'online' : 'offline';
        $userId = $request->query('user_id');
        $invoiceId = $request->query('invoice_id');
        $orders = [];

        if (!empty($userId) && !empty($invoiceId)) {
            $subscriptionRows = array_map(function ($row) {
                return (array) $row;
            }, app(\App\Models\Common::class)->getSubData($invoiceId, $userId) ?? []);

            $orders = $subscriptionRows[0] ?? [];
        }

        if (empty($orders)) {
            $kind = strtolower((string) $request->query('kind', 'download')) === 'subscription' ? 'subscription' : 'download';
            $packageTypeInput = trim((string) $request->query('package_type', 'Image'));
            $packageType = $packageTypeInput !== '' ? ucfirst(strtolower($packageTypeInput)) : 'Image';
            $quantity = max(1, (int) $request->query('quantity', 25));
            $discountLabel = trim((string) $request->query('discount_label', '35% Off'));
            $currency = strtoupper(trim((string) $request->query('currency', 'INR')));
            $subtotal = (float) $request->query('subtotal', 178750);
            $taxRate = (float) config('constants.GST_VALUE', 18);
            $taxAmount = round($subtotal * ($taxRate / 100), 2);
            $totalAmount = (float) $request->query('total', $subtotal + $taxAmount);
            $packageName = trim((string) $request->query('package_name', $quantity . ' ' . ($packageType === 'Image' ? 'Images' : $packageType) . ' (' . $discountLabel . ')'));
            $description = trim((string) $request->query(
                'description',
                ucfirst($kind) . ' Plan - ' . $packageType . ' - ' . $packageName . ' Pack'
            ));

            $orders = [
                'invoice_name' => 'PREVIEW-PACK-1001',
                'invicecreted' => now()->format('Y-m-d H:i:s'),
                'vendor_code' => 'VND-2047',
                'company' => 'Preview Client Pvt. Ltd.',
                'first_name' => 'Pritam',
                'last_name' => 'Biswas',
                'address' => '102, Ashiyana Residency',
                'address2' => 'Neknampur Road, Alkapur Township',
                'cityname' => 'Hyderabad',
                'statename' => 'Telangana',
                'postal_code' => '500089',
                'countryname' => 'India',
                'pan' => 'ABCDE1234F',
                'gst' => '36ABCDE1234F1Z5',
                'email' => 'preview.client@example.com',
                'mobile' => '9652314406',
                'contact_owner' => 'Preview Sales Team',
                'currency' => $currency,
                'flag' => $sampleFlag,
                'tax' => $taxAmount,
                'total' => $totalAmount,
                'package_plan' => $kind === 'download' ? 1 : 0,
                'package_expiry' => $kind === 'subscription' ? 1 : 0,
                'package_expiry_yearly' => $kind === 'download' ? 1 : 0,
                'pacage_size' => strtolower($packageType) === 'footage' ? 1 : 0,
                'package_name' => $packageName,
                'package_type' => $packageType,
                'package_products_count' => $quantity,
                'package_price' => $subtotal,
                'description' => $description,
                'licence_name' => trim((string) $request->query('licence_name', 'All Media')),
                'invoice_type' => $kind === 'download' ? 2 : 1,
                'job_number' => 'PO-2026-0428',
                'po_detail' => now()->format('Y-m-d'),
            ];
        }

        $orders['flag'] = isset($orders['flag']) ? (int) $orders['flag'] : $sampleFlag;
        $orders['company_logo'] = $orders['flag'] === 0
            ? $pdfImageBase64('images/new-design-logo.png')
            : $pdfImageBase64('images/conceptual_logo.png');
        $orders['signature'] = $orders['signature'] ?? $pdfImageBase64('images/signature.png');
        $orders['frontend_url'] = $orders['frontend_url'] ?? (config('app.front_end_url') ?: config('app.url'));
        $orders['INVOICE_PREFIX'] = $orders['INVOICE_PREFIX'] ?? (config('constants.INVOICE_PREFIX') ?: '');

        $frontendHost = parse_url((string) $orders['frontend_url'], PHP_URL_HOST);
        $orders['frontend_name'] = $orders['frontend_name'] ?? ($frontendHost ?: 'imagefootage.com');
        $orders['payment_url'] = $paymentMethod === 'online'
            ? ($orders['payment_url'] ?? 'https://example.com/pay/backend-plan-quotation-preview')
            : '';
        $orders['payment_method'] = $paymentMethod;
        $orders['description'] = $orders['description'] ?? ('Package Estimate - ' . ($orders['package_name'] ?? ''));
        $orders['package_products_count_in_words'] = $orders['package_products_count_in_words'] ?? app(\App\Models\Common::class)->convert_number_to_words((int) ($orders['package_products_count'] ?? 0));

        return [$orders, $paymentMethod];
    };

    $streamPreviewPdf = function (string $html, string $fileName) {
        if (\App\Support\BrowserPdf::isAvailable()) {
            try {
                $pdfBinary = \App\Support\BrowserPdf::render($html);
                $renderer = \App\Support\BrowserPdf::lastRenderer() ?: 'browser';
                \Log::info('Preview PDF rendered with browser engine.', [
                    'file' => $fileName,
                    'renderer' => $renderer,
                ]);

                return response($pdfBinary, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $fileName . '"',
                    'X-PDF-Renderer' => $renderer,
                ]);
            } catch (\Throwable $exception) {
                \Log::warning('Browser PDF preview rendering failed. Falling back to Dompdf.', [
                    'file' => $fileName,
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        \Log::info('Preview PDF rendered with Dompdf fallback.', [
            'file' => $fileName,
            'renderer' => 'dompdf',
        ]);

        return \PDF::setOptions([
            'isRemoteEnabled' => false,
            'isHtml5ParserEnabled' => true,
            'dpi' => 96,
            'defaultFont' => 'sans-serif',
        ])->loadHTML($html)->stream($fileName, [
            'Attachment' => false,
        ])->header('X-PDF-Renderer', 'dompdf');
    };

    Route::get('/backend-invoice-preview', function (\Illuminate\Http\Request $request) use ($buildPreviewQuotationData, $streamPreviewPdf) {
        [$quotation, $paymentMethod] = $buildPreviewQuotationData($request);
        $quotation[0]['document_label'] = 'Invoice';

        $viewData = [
            'quotation' => $quotation,
            'amount_in_words' => '',
            'payment_method' => $paymentMethod,
            'po' => '',
            'po_date' => $quotation[0]['po_detail'] ?? '',
        ];
        $html = view('email.backend_invoice', $viewData)->render();

        if (strtolower((string) $request->query('format')) === 'pdf') {
            return $streamPreviewPdf($html, 'backend-invoice-preview.pdf');
        }

        return response($html);
    })->name('backend.invoice.preview');

    Route::get('/backend-quotation-preview', function (\Illuminate\Http\Request $request) use ($buildPreviewQuotationData, $streamPreviewPdf) {
        [$quotation, $paymentMethod] = $buildPreviewQuotationData($request);
        $amountInWords = '';

        if (!empty($quotation[0]['total'])) {
            $amountInWords = app(\App\Models\Common::class)->convert_number_to_words((int) round((float) $quotation[0]['total']));
        }

        $viewData = [
            'quotation' => $quotation,
            'amount_in_words' => $amountInWords,
            'payment_method' => $paymentMethod,
        ];
        $html = view('email.quotation', $viewData)->render();

        if (strtolower((string) $request->query('format')) === 'pdf') {
            return $streamPreviewPdf($html, 'backend-quotation-preview.pdf');
        }

        return response($html);
    })->name('backend.quotation.preview');

    Route::get('/backend-plan-quotation-preview', function (\Illuminate\Http\Request $request) use ($buildPreviewPackageQuotationData, $streamPreviewPdf) {
        [$orders, $paymentMethod] = $buildPreviewPackageQuotationData($request);
        $amountInWords = '';

        if (!empty($orders['total'])) {
            $amountInWords = app(\App\Models\Common::class)->convert_number_to_words((int) round((float) $orders['total']));
        }

        $viewData = [
            'orders' => $orders,
            'amount_in_words' => $amountInWords,
            'package_price_in_words' => '',
            'payment_method' => $paymentMethod,
        ];
        $html = view('email.plan_quotation_email_offline', $viewData)->render();

        if (strtolower((string) $request->query('format')) === 'pdf') {
            return $streamPreviewPdf($html, 'backend-plan-quotation-preview.pdf');
        }

        return response($html);
    })->name('backend.plan.quotation.preview');

    Route::get('/backend-plan-invoice-preview', function (\Illuminate\Http\Request $request) use ($buildPreviewPackageQuotationData, $streamPreviewPdf) {
        [$orders, $paymentMethod] = $buildPreviewPackageQuotationData($request);
        $amountInWords = '';
        $invoiceTotal = (float) ($orders['total'] ?? ($orders['package_price'] ?? 0));

        if ($invoiceTotal > 0) {
            $amountInWords = app(\App\Models\Common::class)->convert_number_to_words((int) round($invoiceTotal));
        }

        $viewData = [
            'orders' => $orders,
            'amount_in_words' => strtoupper($amountInWords),
            'payment_method' => $paymentMethod,
        ];
        $html = view('email.plan_invoice_email_offline', $viewData)->render();

        if (strtolower((string) $request->query('format')) === 'pdf') {
            return $streamPreviewPdf($html, 'backend-plan-invoice-preview.pdf');
        }

        return response($html);
    })->name('backend.plan.invoice.preview');
}

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/login', 'AdminController@login');
    Route::post('/authenticate', 'AdminController@authenticate');
    Route::get('logout', 'AdminController@logout');


    Route::get('forget-password', 'ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}', 'ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

    // All authenticated admin routes with permission checking
    Route::group(['middleware' => ['admin', 'check.permission']], function () {

    Route::get('/outstanding-report-data', 'InvoiceController@getOutstandingReportData')->name('admin.outstanding.data');
    // ...existing code...
    Route::get('invoice/{user_id}/{id}', 'InvoiceController@showDetail')->name('admin.invoice.detail');
// ...existing code...


    Route::get('/dashboard', 'DashboardController@dashboard');
    Route::get('/add_product', 'ProductController@index');
    Route::post('/createproduct', 'ProductController@create');
    Route::get('/all_products', 'ProductController@productsList');
    Route::get('/subadmin/status/{status}/{id}', 'SubAdminController@status');
    Route::get('/subadmin/access_management', 'SubAdminController@access_management');
    Route::post('/save_access', 'SubAdminController@save_access');
    Route::post('/subadmin/mapping_data', 'SubAdminController@mapping_data');

    Route::get('/subadmin/view/{id}', 'SubAdminController@view');
    Route::resource('/subadmin', 'SubAdminController');
    Route::get('/product/{status}/{id}', 'ProductController@changeProductStatus');
    Route::get('/deleteproduct/{id}', 'ProductController@destroy');
    Route::get('/editproduct/{id}', 'ProductController@updateProduct');
    Route::post('/editproduct', 'ProductController@update');
    Route::get('/viewproduct/{id}', 'ProductController@viewproduct');
    Route::get('/email', 'ProductController@html_email');
    Route::post('/update_product_verify', 'ProductController@ajaxProductVerify');
    Route::get('/add_product_category', 'ProductCategoryController@index');
    Route::post('/insert_product_category', 'ProductCategoryController@createCategory');
    Route::get('/all_product_category', 'ProductCategoryController@productCategoryList');
    Route::get('/productcategory/{status}/{id}', 'ProductCategoryController@changeProductStatus');
    Route::get('/deleteproductcategory/{id}', 'ProductCategoryController@destroy');
    Route::get('/updateproductcategory/{id}', 'ProductCategoryController@updateProduct');
    Route::post('/editproductcategory', 'ProductCategoryController@editProductCategory');
    Route::get('/add_product_subcategory', 'ProductSubCategoryController@index');
    Route::post('/insert_product_subcategory', 'ProductSubCategoryController@addProductSubCategory');
    Route::get('/all_product_subcategory', 'ProductSubCategoryController@productSubCategoryList');
    Route::get('/productsubcategory/{status}/{id}', 'ProductSubCategoryController@changeProductStatus');
    Route::get('/deleteproductsubcategory/{id}', 'ProductSubCategoryController@destroy');
    Route::get('/updateproductsubcategory/{id}', 'ProductSubCategoryController@updateProduct');
    Route::post('/editproductsubcategory', 'ProductSubCategoryController@update');
    Route::post('/get_related_subcat', 'ProductController@get_relatedsubcat');
    // Route::get('/product/{id}', 'ProductController@getProduct');
    Route::post('/get-filters', 'ProductController@getFilters');
    Route::post('/edit-filters', 'ProductController@editFilters');

    //ContributorController
    Route::get('/add_contributor', 'ContributorController@index');
    Route::post('/addcontributor', 'ContributorController@addcontributor');
    Route::get('/contributor_list', 'ContributorController@contributorList');
    Route::get('/contributor_status/{status}/{id}', 'ContributorController@changeContributorStatus');
    Route::get('/updatecontributor/{id}', 'ContributorController@updateContributor');
    Route::post('/editcontributor', 'ContributorController@editcontributor');
    Route::get('/viewcontributor/{id}', 'ContributorController@viewcontributor');
    Route::get('/deletecontributor/{id}', 'ContributorController@destroy');
    Route::post('/request_for_contributorpass/{id}', 'ContributorController@requestForContributorPass');
    Route::post('/ajaxRequestForUserPass/{id}', 'ContributorController@ajaxRequestForUserPass');
    Route::post('/ajaxRequestForUserDesc', 'ContributorController@ajaxRequestForUserDesc');

    Route::get('/contributorotpvalidate/{id}', 'ContributorController@contVerifyRegisteriedOtp');
    Route::post('/contributorotpvalidateprocess', 'ContributorController@contVerifyRegisteriedOtpprocess');
    Route::get('/contributor_set_password/{id}', 'ContributorController@contSetPassword');
    Route::post('/contributorsetpasswordprocess', 'ContributorController@setContributorPassword');
    Route::get('/contributorotpreset/{id}', 'ContributorController@contributorotpverifyReset');
    Route::post('/contributorotpvaliprocess', 'ContributorController@verifyOtpforsetpass');
    Route::get('/contributor_reset_password/{id}', 'ContributorController@contResetPassword');
    Route::post('/contributorresetpassprocess', 'ContributorController@contResetPasswordProcess');

    //end ContributorController

    Route::get('/create_package', 'PackageController@createPackage');
    Route::post('/addpackage', 'PackageController@addPackage');
    Route::get('/package_list', 'PackageController@packageList');
    Route::get('/package/{status}/{id}', 'PackageController@changePackageStatus');
    Route::get('/package/home/{view}/{id}', 'PackageController@changePackageHomeView');
    Route::get('/updatepackage/{id}', 'PackageController@updatePackage');
    Route::post('/editpackage', 'PackageController@editPackage');
    Route::get('/deletepackage/{id}', 'PackageController@deletePackage');

    Route::get('/create_static_pages', 'StaticPagesController@createStaticPage');
    Route::post('/addstaticpage', 'StaticPagesController@addStaticPage');
    Route::get('/static_pages_list', 'StaticPagesController@statiePagesList');
    Route::get('/staticpages/{status}/{id}', 'StaticPagesController@changePackageStatus');
    Route::get('/updatestaticpage/{id}', 'StaticPagesController@updateStaticPage');
    Route::post('/editstaticpage', 'StaticPagesController@editStaticPage');
    Route::get('/deletestaticpage/{id}', 'StaticPagesController@deleteStaticPage');
    Route::get('/add_product_colors', 'ProductColorController@addProductColor');
    Route::post('/addproductcolorprocess', 'ProductColorController@addProductColorProcess');
    Route::get('/product_colors_list', 'ProductColorController@productColorsList');
    Route::get('/product_colors_status/{status}/{id}', 'ProductColorController@changePackageStatus');
    Route::get('/deletepcolor/{id}', 'ProductColorController@deletePcolorPage');
    Route::get('/editproductcolor/{id}', 'ProductColorController@editProduCtcolor');
    Route::post('/updateproductcolor', 'ProductColorController@updateProductColor');
    Route::get('/add_api_quota', 'ProductApiController@addApiQuota');
    Route::post('/insertapiquota', 'ProductApiController@insertApiQuota');
    Route::get('/api_quota_list', 'ProductApiController@apiQuotaList');
    Route::get('/updateapiquata/{id}', 'ProductApiController@updateApiQuata');
    Route::post('/editapiquata', 'ProductApiController@editApiQuata');
    Route::get('/deleteapiquata/{id}', 'ProductApiController@deleteapiquata');

    //product gender
    Route::get('/add_product_gender', 'ProductGenderController@addProductGender');
    Route::post('/addproductgenderprocess', 'ProductGenderController@addProductColorProcess');
    Route::get('/product_gender_list', 'ProductGenderController@ProductGendersList');
    Route::get('/product_gender_status/{status}/{id}', 'ProductGenderController@changeGenderStatus');
    Route::get('/deletepgender/{id}', 'ProductGenderController@deletePgenderPage');
    Route::get('/editproductgender/{id}', 'ProductGenderController@editProduCtgender');
    Route::post('/updateproductgender', 'ProductGenderController@updateProductGender');
    //Product ethinicities
    Route::get('/add_product_ethinicities', 'ProductEthinicitiesController@addProductGender');
    Route::post('/addproductethinicitiesprocess', 'ProductEthinicitiesController@addProductEthinicitiesProcess');
    Route::get('/product_ethinicities_list', 'ProductEthinicitiesController@ProductEthinicitiesList');
    Route::get('/product_ethinicities_status/{status}/{id}', 'ProductEthinicitiesController@changeEthinicitiesStatus');
    Route::get('/deletepethinicities/{id}', 'ProductEthinicitiesController@deletePethinicitiesPage');
    Route::get('/editproductethinicities/{id}', 'ProductEthinicitiesController@editProductEthinicities');
    Route::post('/updateproductethinicities', 'ProductEthinicitiesController@updateProductEthinicities');

    //Product locations
    Route::get('/add_product_locations', 'ProductLocationsController@addProductLocation');
    Route::post('/addproduct_ocations_rocess', 'ProductLocationsController@addProductLocationsProcess');
    Route::get('/product_locations_list', 'ProductLocationsController@ProductLocationsList');
    Route::get('/product_locations_status/{status}/{id}', 'ProductLocationsController@changeLocationsStatus');
    Route::get('/deletelocation/{id}', 'ProductLocationsController@deleteProductLocation');
    Route::get('/editproductlocation/{id}', 'ProductLocationsController@editProductLocations');
    Route::post('/updateproductlocation', 'ProductLocationsController@updateProductLocations');

    //Product image sizes
    Route::get('/add_product_image_sizes', 'ProductImageSizesController@addProductImageSize');
    Route::post('/addproduct_imagesizes_process', 'ProductImageSizesController@addProductImageSizesProcess');
    Route::get('/product_image_sizes_list', 'ProductImageSizesController@ProductImageSizesList');
    Route::get('/product_imagesizes_status/{status}/{id}', 'ProductImageSizesController@changeProductImageSizesStatus');
    Route::get('/deleteproductimagesizes/{id}', 'ProductImageSizesController@deleteProductImageSizes');
    Route::get('/editproductimagesizes/{id}', 'ProductImageSizesController@editProductImageSizes');
    Route::post('/updateproductimagesizes', 'ProductImageSizesController@updateProductImageSizes');

    //Product image types
    Route::get('/add_product_image_types', 'ProductImageTypesController@addProductImageType');
    Route::post('/addproduct_imagetype_process', 'ProductImageTypesController@addProductImageTypesProcess');
    Route::get('/product_image_types_list', 'ProductImageTypesController@productImageTypesList');
    Route::get('/product_imagetypes_status/{status}/{id}', 'ProductImageTypesController@changeProductImageTypesStatus');
    Route::get('/deleteproductimagestatus/{id}', 'ProductImageTypesController@deleteProductImageTypes');
    Route::get('/editproductimagetypes/{id}', 'ProductImageTypesController@editProductImageTypes');
    Route::post('/updateproductimagetypes', 'ProductImageTypesController@updateProductImageTypes');

    //Product peoples
    Route::get('/add_product_image_peoples', 'ProductImagePeoplesController@addProductImageSize');
    Route::post('/addproduct_imagepeoples_process', 'ProductImagePeoplesController@addProductPeoplesProcess');
    Route::get('/product_image_peoples_list', 'ProductImagePeoplesController@ProductPeoplesList');
    Route::get('/product_imagepeoples_status/{status}/{id}', 'ProductImagePeoplesController@changeProductPeoplesStatus');
    Route::get('/deleteproductpeoples/{id}', 'ProductImagePeoplesController@deleteProductPeoples');
    Route::get('/editproductpeoples/{id}', 'ProductImagePeoplesController@editProductPeoples');
    Route::post('/updateproductpeoples', 'ProductImagePeoplesController@updateProductPeoples');
    //orders related
    Route::get('/orders', 'ProductOrdersController@index');
    Route::get('/users/user_orders/{id}', 'ProductOrdersController@userOrderList');
    Route::get('/userListapi/{id}', 'ProductOrdersController@userListapi');
    //subscriber
    Route::get('/getSubscribers', 'SubscribersController@getSubscribers');

    //Product  Orientations
    Route::get('/add_product_orientations ', 'ProductImageOrientationsController@addProductOrientations');
    Route::post('/addproduct_orientations_process', 'ProductImageOrientationsController@addProductOrientationsProcess');
    Route::get('/product_orientations_list', 'ProductImageOrientationsController@ProductOrientationsList');
    Route::get('/product_orientations_status/{status}/{id}', 'ProductImageOrientationsController@changeProductOrientationsStatus');
    Route::get('/deleteproductorientations/{id}', 'ProductImageOrientationsController@deleteProductOrientations');
    Route::get('/editproductorientations/{id}', 'ProductImageOrientationsController@editProductOrientations');
    Route::post('/updateproductorientations', 'ProductImageOrientationsController@updateProductOrientations');

    //Product  Sort Types
    Route::get('/add_product_sort_type', 'ProductImageSortTypesController@addImageSortTypes');
    Route::post('/addproduct_sort_type_process', 'ProductImageSortTypesController@addImageSortTypesProcess');
    Route::get('/product_sort_type_list', 'ProductImageSortTypesController@ImageSortTypesList');
    Route::get('/product_sort_type_status/{status}/{id}', 'ProductImageSortTypesController@changeImageSortTypeStatus');
    Route::get('/deleteproductsorttype/{id}', 'ProductImageSortTypesController@deleteImageSortTypes');
    Route::get('/editproductsort_type/{id}', 'ProductImageSortTypesController@editImageSortTypes');
    Route::post('/updatproductsort_type', 'ProductImageSortTypesController@updateImageSortTypes');

    //bulk upload products
    Route::get('/upload_products_csv', 'ProductBulkUploadController@uploadCSV');
    Route::post('/produt_bulk_upload', 'ProductBulkUploadController@importCSV');

    //for api
    Route::get('/products_api', 'ProductController@productListApi');
    //end api
    Route::get('/accounts/status/{status}/{id}', 'AccountController@status');
    Route::get('/accounts/view/{id}', 'AccountController@show');

    Route::resource('/accounts', 'AccountController');

    # Promo Code
    Route::get('/promo-codes/status/{status}/{id}', 'PromoCodeController@status');
    Route::post('/getPromoCode', 'PromoCodeController@getActivePromoCode');
    Route::resource('/promo-codes', 'PromoCodeController');

    Route::get('/users/status/{status}/{id}', 'UserController@status');
    Route::get('/users/show/{id}', 'UserController@show');
    Route::get('/users/showComment/{id}', 'UserController@showComment');



    Route::resource('/users', 'UserController');
    Route::post('/getStatesByCounty', 'CommonController@getStatesByCounty');
    Route::post('/getCityByState', 'CommonController@getCityByState');

    Route::get('/send_invoice', 'InvoiceController@send_invoice');
    Route::post('/get_email_template', 'InvoiceController@get_email_template');
    Route::get('/purchase_orders', 'InvoiceController@purchase_orders');


    Route::post('/sendmail', 'InvoiceController@sendmail');
    //Route::get('/product/{id}', 'ProductController@getproduct');
    //custom Invoice routes
    Route::get('/users/invoices/{id}', 'UserController@invoices');
    Route::post('/users/comments/', 'InvoiceController@comments');

    Route::post('/users/update_user/', 'UserController@updateUser');
    Route::post('/users/plan/', 'UserController@providePlan');
    Route::post('/comments/{id}/updateCommentStatus', 'InvoiceController@updateCommentStatus');

    Route::get('/quotation/{id}', 'InvoiceController@quotation');
    Route::get('/quotation2/{id}', 'InvoiceController@quotation2');
    Route::get('/edit_quotation/{user_id}/{id}', 'InvoiceController@edit_quotation');
    Route::post('/edit_quotation_data', 'InvoiceController@edit_quotation_data');
    Route::post('/saveInvoice', 'InvoiceController@saveInvoice');
    Route::post('/create_invoice', 'InvoiceController@create_invoice');
    Route::post('/change_invoice_status', 'InvoiceController@change_invoice_status');
    Route::post('/get-package-items', 'InvoiceController@getPackageItems');
    Route::get('/subscribers', 'SubscribersController@index')->name('subscribers');
    Route::get('/subscribers/details/{id}', 'SubscribersController@subscribers_details');

    // Route for update expiration date
    Route::get('/edit-expire-date/{id}', 'SubscribersController@editExpireDate')->name('editExpireDate');
    Route::post('/update-expire-date', 'SubscribersController@updateExpiredDate')->name('updateExpiredDate');

    Route::post('/plans', 'PackageController@plans');
    Route::post('/saveSubscriptionInvoice', 'InvoiceController@saveSubscriptionInvoice');
    Route::post('/saveDownloadInvoice', 'InvoiceController@saveDownloadInvoice');
    Route::post('/create_invoice_subcription', 'InvoiceController@create_invoice_subcription');
    Route::get('/invoice_cancel/{id}', 'InvoiceController@invoiceCancel');

    //Route::get('dashboard', 'Admin\DashboardController@dashboard');
    //Route::get('login', 'Admin\DashboardController@login');
    //Route::post('admin_login_process', 'Admin\DashboardController@admin_login_process');
    //Route::get('logout', 'Admin\DashboardController@logout');
    Route::get('/new_registrants', 'UserController@newRegistrants');
    Route::get('/user_cart', 'UserController@userCart');
    Route::get('/abandoned_cart', 'UserController@abandoned_cart');
    Route::get('/new_client_sales', 'UserController@newClientSales');
    Route::get('/quotation_report', 'InvoiceController@quotationReport');
    Route::get('/quotation_cancel/{id}', 'InvoiceController@quotationCancel');
    Route::get('/outstanding_report', 'InvoiceController@outstandingReport');



    Route::post('/changeAbandonedCartStatus/{id}', 'UserController@changeAbandonedCartStatus');
    Route::get('/edit_profile/{id}', 'SubAdminController@editProfile');
    Route::post('/subadmin/edit_profile/{id}', 'SubAdminController@updateProfile');
    //Route for Promtion
    Route::get('/add_promotion', 'PromotionController@index');
    Route::post('/createpromotion', 'PromotionController@create');
    Route::get('/list_promotion', 'PromotionController@promotionList');

    Route::get('/promotionstatus/{status}/{id}', 'PromotionController@changePromotionStatus');
    Route::get('/deletepromotion/{id}', 'PromotionController@destroy');
    Route::get('/updatepromotion/{id}', 'PromotionController@updatePromotion');
    Route::post('/editpromotion', 'PromotionController@editPromotion');

    //Route for Module
    Route::get('/add_module', 'ModuleController@index');
    Route::post('/createmodule', 'ModuleController@create');
    Route::get('/list_module', 'ModuleController@modulesList');

    Route::get('/modulestatus/{status}/{id}', 'ModuleController@changeModulesStatus');
    Route::get('/deletemodule/{id}', 'ModuleController@destroy');
    Route::get('/updatemodule/{id}', 'ModuleController@updateModules');
    Route::post('/editmodules', 'ModuleController@editModules');

    // Route for po binding
    Route::get('/add_po', 'InvoiceController@addPO');
    Route::post('/save_po', 'InvoiceController@savePO');
    Route::post('/get_invoice', 'InvoiceController@get_invoice');
    Route::post('/update_po', 'InvoiceController@update_po');
    // Route for discount module
    Route::get('/list_discount_message', 'DiscountMessageController@index');
    Route::get('/add_discount_message', 'DiscountMessageController@create');
    Route::post('/creatediscountmessage', 'DiscountMessageController@store');
    Route::get('/editdiscountmessage/{id}', 'DiscountMessageController@edit');
    Route::post('/updatediscountmessage', 'DiscountMessageController@update');
    Route::get('/deletediscountmessage/{id}', 'DiscountMessageController@destroy');
    Route::get('/discountmessagestatus/{status}/{id}', 'DiscountMessageController@changeStatus');

    // Route for block module editorial page

    Route::resource('/editorials', 'EditorialController');
    Route::post('/get-editorial-images', 'EditorialController@getEditorialImages');
    Route::post('/get-main-images', 'EditorialController@getMainImages');
    Route::get('/editorials/status/{status}/{id}', 'EditorialController@changeStatus');
        Route::post('/price/check-duplicate', 'PriceController@checkDuplicate')->name('admin.price.check-duplicate');
    Route::resource('/price', 'PriceController');

    }); // end check.permission middleware group
});

Route::get('emailVerification', 'UserContactusController@emailVerification');
Route::get('payu/{id}', 'PaymentController@payu');
Route::get('payuplan/{id}', 'PaymentController@payuplan');
Route::get('frontend-plan-invoice-preview', 'PaymentController@frontendPlanInvoicePreview')->name('frontend.plan.invoice.preview');
Route::get('frontend-order-invoice-preview', 'PaymentController@frontendOrderInvoicePreview')->name('frontend.order.invoice.preview');
Route::get('invoiceConfirmation/{id}', 'PaymentController@invoiceConfirmation');
Route::get('invoiceFailed/{id}', 'PaymentController@invoiceFailed');

// Route for active user account
Route::get('active_user_account/{token?}', "UserController@activeUserAccount");
