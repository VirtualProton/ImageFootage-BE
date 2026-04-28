<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image-Footage Estimate</title>
    <?php
    $documentLabel = 'ESTIMATE';
    $helloColor = ((int) ($orders['flag'] ?? 0) === 0) ? '#2563EB' : '#B45309';
    $issuerCompanyName = ((int) ($orders['flag'] ?? 0) === 0)
        ? (config('constants.company_name') ?: 'Imagefootage')
        : 'Conceptual Pictures Worldwide Pvt. Ltd.';

    $contactName = trim((string) (($orders['first_name'] ?? '') . ' ' . ($orders['last_name'] ?? '')));
    $clientCompanyName = trim((string) ($orders['company'] ?? ''));
    if ($clientCompanyName === '') {
        $clientCompanyName = $contactName !== '' ? $contactName : 'Client';
    }

    $estimateNumber = 'Q' . trim((string) ($orders['invoice_name'] ?? ''));
    $estimateDate = !empty($orders['invicecreted']) ? date('d.m.Y', strtotime((string) $orders['invicecreted'])) : '';
    $clientCode = trim((string) ($orders['vendor_code'] ?? ''));
    $clientAddressParts = array_filter([
        trim((string) ($orders['address'] ?? '')),
        trim((string) ($orders['address2'] ?? '')),
    ]);
    $clientAddress = implode(', ', $clientAddressParts);
    $clientLocationParts = array_filter([
        trim((string) ($orders['cityname'] ?? '')),
        trim((string) ($orders['statename'] ?? '')),
        trim((string) ($orders['postal_code'] ?? '')),
    ]);
    $clientLocation = implode(', ', $clientLocationParts);
    $clientCountry = trim((string) ($orders['countryname'] ?? ''));
    $clientMobile = trim((string) ($orders['mobile'] ?? ''));
    $clientEmail = trim((string) ($orders['email'] ?? ($orders['email_id'] ?? '')));
    $clientPan = trim((string) ($orders['pan'] ?? ''));
    $clientGstin = trim((string) ($orders['gst'] ?? ''));
    $accountManager = trim((string) ($orders['contact_owner'] ?? ''));
    if ($accountManager === '') {
        $accountManager = 'Imagefootage Sales Team';
    }

    $currencyCode = strtoupper(trim((string) ($orders['currency'] ?? 'INR')));
    $currencySymbol = $currencyCode === 'USD' ? '$' : '&#8377;';
    $taxAmount = (float) ($orders['tax'] ?? 0);
    $totalAmount = (float) ($orders['total'] ?? 0);
    $subTotal = max($totalAmount - $taxAmount, 0);
    $discountAmount = (float) ($orders['discount_amount'] ?? 0);
    $amountInWordsText = trim((string) ($amount_in_words ?? ''));
    $amountInWordsLine = $amountInWordsText !== '' ? 'Rupees ' . $amountInWordsText . ' only' : '';
    $paymentStatus = strtolower(trim((string) ($orders['payment_status'] ?? '')));
    $showPaymentCta = !empty($orders['payment_url']) && !in_array($paymentStatus, ['transction success', 'completed'], true);

    $productDescription = trim((string) ($orders['description'] ?? ($orders['package_name'] ?? 'Package Estimate')));
    $packageQuantity = trim((string) ($orders['package_products_count'] ?? ''));
    $packageType = trim((string) ($orders['package_type'] ?? ''));
    $licenseName = trim((string) ($orders['licence_name'] ?? ''));
    $salesCopy = $accountManager;

    $packageValidity = '';
    if ((int) ($orders['package_plan'] ?? 0) === 1) {
        $validYears = (int) ($orders['package_expiry_yearly'] ?? 0);
        $packageValidity = $validYears > 0 ? 'Download Pack for ' . $validYears . ' year' . ($validYears > 1 ? 's' : '') : 'Download Pack';
    } else {
        $validYears = (int) ($orders['package_expiry_yearly'] ?? 0);
        $validMonths = (int) ($orders['package_expiry'] ?? 0);
        if ($validYears > 0) {
            $packageValidity = 'Subscription Pack for ' . $validYears . ' year' . ($validYears > 1 ? 's' : '');
        } elseif ($validMonths > 0) {
            $packageValidity = 'Subscription Pack for ' . $validMonths . ' month' . ($validMonths > 1 ? 's' : '');
        } else {
            $packageValidity = 'Subscription Pack';
        }
    }

    $packageFormat = '';
    if (strcasecmp($packageType, 'Footage') === 0) {
        $packageFormat = ((int) ($orders['pacage_size'] ?? 0) === 1) ? 'HD' : '4K';
    } elseif (strcasecmp($packageType, 'Image') === 0) {
        $packageFormat = 'XL';
    }

    $packageDescriptorParts = array_filter([
        trim((string) ($orders['package_name'] ?? '')),
        $packageFormat,
        $licenseName !== '' ? $licenseName . ' License' : '',
        $packageValidity,
    ]);
    $packageDescriptor = implode('  |  ', $packageDescriptorParts);

    $frontendUrl = trim((string) ($orders['frontend_url'] ?? 'https://imagefootage.com/#/'));
    $remitAddress = '3rd Floor, R5 Chambers, Opp. Pillar No. 02, Mehdipatnam, Hyderabad, Telangana 500028';
    $paymentTerms = [
        'License rights are assigned only after the required purchase order and payment confirmation are received.',
        'Payment can be made in favor of Conceptual Pictures Worldwide Pvt. Ltd. via account payee cheque, RTGS, or NEFT.',
        'Bank transfer: A/c No. 50200000502220, HDFC Bank Ltd, Vijayanagar Colony Branch, Hyderabad, IFSC HDFC0001998.',
        'All disputes are subject to Hyderabad jurisdiction.',
    ];
    $licenseTermsAllowed = [
        'Reproduce up to 500,000 copies of the asset in product packaging, printed marketing materials, digital documents, or software.',
        'Include the asset in email marketing, mobile advertising, or a broadcast program if expected viewership is below 500,000.',
        'Publish the asset on a website without a viewer cap. Editorial usage requires attribution in the format "(c) Author Name - ' . ($orders['frontend_name'] ?? 'imagefootage') . '".',
        'Include the asset in products in a minor or supportive way, such as inside a textbook or presentation.',
    ];
    $licenseTermsRestricted = [
        'Do not create merchandise or products for resale where the primary value is the asset itself, including posters, t-shirts, mugs, or similar goods.',
    ];
    ?>
    <style>
        * {
            box-sizing: border-box;
        }

        @page {
            margin: 20px 24px 24px 24px;
        }

        body {
            margin: 0;
            color: #111827;
            font-family: "Noto Sans", "DejaVu Sans", Inter, Roboto, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.45;
        }

        .sheet {
            width: 100%;
        }

        .section {
            width: 100%;
            margin: 0 0 24px;
            padding: 0 0 24px;
            border-bottom: 1px solid #E5E7EB;
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            margin: 0 0 14px;
            color: #111827;
            font-size: 14px;
            font-weight: 700;
        }

        .header-table,
        .info-grid,
        .details-grid,
        .summary-layout,
        .bank-grid,
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .header-table td,
        .info-grid td,
        .details-grid td,
        .summary-layout td,
        .bank-grid td,
        .meta-table td {
            vertical-align: top;
        }

        .logo-cell {
            width: 56%;
            padding-right: 16px;
            padding-top: 4px;
        }

        .logo-cell img {
            max-width: 132px;
            width: auto;
            height: auto;
            display: block;
        }

        .title-cell {
            width: 44%;
            text-align: right;
        }

        .eyebrow {
            margin: 0 0 2px;
            color: #9CA3AF;
            font-size: 9px;
            font-weight: 400;
            letter-spacing: 0.5em;
            text-transform: uppercase;
        }

        .document-label {
            margin: 0;
            color: #6B7280;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.42em;
            text-transform: uppercase;
        }

        .hello-heading {
            margin: 2px 0 0;
            font-size: 54px;
            line-height: 0.88;
            font-weight: 700;
        }

        .info-grid {
            margin-top: 20px;
            border-top: 1px solid #E5E7EB;
        }

        .info-grid > tbody > tr > td {
            width: 50%;
            padding-top: 18px;
            padding-right: 22px;
        }

        .info-grid > tbody > tr > td:last-child {
            padding-right: 0;
            padding-left: 22px;
        }

        .details-grid > tbody > tr > td,
        .bank-grid > tbody > tr > td {
            width: 50%;
            padding-right: 22px;
        }

        .details-grid > tbody > tr > td:last-child,
        .bank-grid > tbody > tr > td:last-child {
            padding-right: 0;
            padding-left: 22px;
        }

        .detail-label,
        .bank-label,
        .meta-label {
            width: 120px;
            padding: 3px 12px 3px 0;
            color: #6B7280;
            font-size: 11px;
            white-space: nowrap;
        }

        .detail-value,
        .bank-value,
        .meta-value {
            padding: 3px 0;
            color: #111827;
            font-weight: 700;
            word-break: break-word;
        }

        .details-name {
            margin: 0 0 8px;
            color: #111827;
            font-size: 14px;
            font-weight: 700;
        }

        .details-copy,
        .bank-copy {
            margin: 0 0 4px;
            color: #374151;
            font-size: 12px;
        }

        .package-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 12px;
        }

        .package-table th {
            padding: 11px 12px;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: 700;
            text-align: left;
            background: #3F3F46;
        }

        .package-table th:first-child {
            width: 52px;
            padding-left: 0;
            padding-right: 0;
        }

        .package-table th:last-child {
            width: 160px;
            text-align: right;
        }

        .package-card {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            border-top: 1px solid #E5E7EB;
        }

        .package-card > tbody > tr > td {
            padding: 16px 0;
            vertical-align: top;
            border-bottom: 1px solid #E5E7EB;
        }

        .package-sr {
            width: 52px;
            padding-right: 0;
            color: #111827;
            font-size: 13px;
            font-weight: 700;
        }

        .package-copy {
            padding-right: 12px;
        }

        .package-title {
            margin: 0 0 10px;
            color: #111827;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.35;
        }

        .package-subcopy {
            margin: 0 0 10px;
            color: #374151;
            font-size: 12px;
            line-height: 1.5;
        }

        .package-price {
            width: 160px;
            text-align: right;
            color: #111827;
            font-size: 14px;
            font-weight: 700;
            white-space: nowrap;
        }

        .summary-copy-cell {
            width: 54%;
            padding-right: 20px;
        }

        .summary-copy-label {
            color: #6B7280;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .summary-copy-value {
            margin: 4px 0 14px;
            color: #111827;
            font-size: 20px;
            font-weight: 700;
        }

        .summary-copy-text {
            color: #374151;
            font-size: 12px;
            line-height: 1.6;
        }

        .summary-box-cell {
            width: 46%;
        }

        .summary-box {
            width: 320px;
            margin-left: auto;
            border-collapse: collapse;
        }

        .summary-box td {
            padding: 9px 12px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 12px;
        }

        .summary-box td:first-child {
            color: #6B7280;
        }

        .summary-box td:last-child {
            text-align: right;
            color: #111827;
            font-weight: 700;
        }

        .summary-box .discount-value {
            color: #059669;
        }

        .summary-box .total-row td {
            padding-top: 14px;
            padding-bottom: 14px;
            color: #111827;
            font-size: 15px;
            font-weight: 700;
            border-top: 2px solid #D1D5DB;
            border-bottom: 2px solid #D1D5DB;
        }

        .terms-section {
            color: #6B7280;
        }

        .terms-heading {
            margin: 14px 0 8px;
            color: #111827;
            font-size: 12px;
            font-weight: 700;
        }

        .terms-list {
            margin: 0;
            padding-left: 18px;
        }

        .terms-list li {
            margin-bottom: 8px;
            font-size: 11px;
            line-height: 1.55;
        }

        .cta-link {
            display: inline-block;
            margin-top: 12px;
            padding: 10px 18px;
            background: #DC2626;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
        }

        .signoff-grid {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .signoff-grid td {
            width: 50%;
            vertical-align: bottom;
        }

        .signoff-note {
            color: #374151;
            font-size: 12px;
            line-height: 1.55;
        }

        .signoff-meta {
            margin-top: 12px;
            color: #2563EB;
            font-size: 12px;
        }

        .signature-block {
            text-align: right;
        }

        .signature-block img {
            max-width: 150px;
            height: auto;
            display: inline-block;
        }

        .signature-copy {
            margin: 6px 0 0;
            color: #111827;
            font-size: 12px;
            font-weight: 700;
        }

        @media screen {
            body {
                padding: 24px 0;
            }

            .sheet {
                max-width: 980px;
                margin: 0 auto;
                padding: 32px;
                box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            }
        }

        @media print {
            .sheet {
                padding: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="sheet">
        <section class="section">
            <table class="header-table" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="logo-cell">
                        <img src="<?php echo $orders['company_logo']; ?>" alt="Company Logo">
                    </td>
                    <td class="title-cell">
                        <div class="eyebrow">THIS IS YOUR</div>
                        <div class="document-label"><?php echo htmlspecialchars($documentLabel); ?></div>
                        <div class="hello-heading" style="color: <?php echo $helloColor; ?>;">hello</div>
                    </td>
                </tr>
            </table>

            <table class="info-grid" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table class="meta-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="meta-label">Estimate No.</td>
                                <td class="meta-value"><?php echo htmlspecialchars($estimateNumber); ?></td>
                            </tr>
                            <tr>
                                <td class="meta-label">Estimate Date</td>
                                <td class="meta-value"><?php echo htmlspecialchars($estimateDate); ?></td>
                            </tr>
                            <tr>
                                <td class="meta-label">Vendor Code</td>
                                <td class="meta-value"><?php echo htmlspecialchars($clientCode !== '' ? $clientCode : '-'); ?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="meta-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="meta-label">Company Name</td>
                                <td class="meta-value"><?php echo htmlspecialchars($issuerCompanyName); ?></td>
                            </tr>
                            <tr>
                                <td class="meta-label">GSTIN</td>
                                <td class="meta-value"><?php echo htmlspecialchars((string) config('constants.GSTIN_VALUE')); ?></td>
                            </tr>
                            <tr>
                                <td class="meta-label">PAN No.</td>
                                <td class="meta-value"><?php echo htmlspecialchars((string) config('constants.PAN_VALUE')); ?></td>
                            </tr>
                            <tr>
                                <td class="meta-label">SAC Code</td>
                                <td class="meta-value"><?php echo htmlspecialchars((string) config('constants.SAC_CODE')); ?></td>
                            </tr>
                            <tr>
                                <td class="meta-label">Place</td>
                                <td class="meta-value"><?php echo htmlspecialchars((string) config('constants.QI_ADDRESS')); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section">
            <table class="details-grid" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="section-title">Client Details</div>
                        <p class="details-name"><?php echo htmlspecialchars($clientCompanyName); ?></p>
                        <?php if ($clientAddress !== '') { ?>
                            <p class="details-copy"><?php echo htmlspecialchars($clientAddress); ?></p>
                        <?php } ?>
                        <?php if ($clientLocation !== '') { ?>
                            <p class="details-copy"><?php echo htmlspecialchars($clientLocation); ?></p>
                        <?php } ?>
                        <?php if ($clientCountry !== '') { ?>
                            <p class="details-copy"><?php echo htmlspecialchars($clientCountry); ?></p>
                        <?php } ?>
                        <table class="meta-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="meta-label">Kind Attention</td>
                                <td class="meta-value"><?php echo htmlspecialchars($contactName !== '' ? $contactName : $clientCompanyName); ?></td>
                            </tr>
                            <?php if ($clientEmail !== '') { ?>
                                <tr>
                                    <td class="meta-label">Mail ID</td>
                                    <td class="meta-value"><?php echo htmlspecialchars($clientEmail); ?></td>
                                </tr>
                            <?php } ?>
                            <?php if ($clientMobile !== '') { ?>
                                <tr>
                                    <td class="meta-label">Contact No.</td>
                                    <td class="meta-value"><?php echo htmlspecialchars('+91 - ' . $clientMobile); ?></td>
                                </tr>
                            <?php } ?>
                            <?php if ($clientPan !== '') { ?>
                                <tr>
                                    <td class="meta-label">Client PAN</td>
                                    <td class="meta-value"><?php echo htmlspecialchars($clientPan); ?></td>
                                </tr>
                            <?php } ?>
                            <?php if ($clientGstin !== '') { ?>
                                <tr>
                                    <td class="meta-label">Client GSTIN</td>
                                    <td class="meta-value"><?php echo htmlspecialchars($clientGstin); ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td>
                        <div class="section-title">Estimate Details</div>
                        <p class="details-name"><?php echo htmlspecialchars($productDescription); ?></p>
                        <p class="details-copy">Prepared by <?php echo htmlspecialchars($salesCopy); ?></p>
                        <?php if ($packageValidity !== '') { ?>
                            <p class="details-copy"><?php echo htmlspecialchars($packageValidity); ?></p>
                        <?php } ?>
                        <table class="meta-table" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="meta-label">Package Type</td>
                                <td class="meta-value"><?php echo htmlspecialchars($packageType !== '' ? $packageType : 'Package'); ?></td>
                            </tr>
                            <tr>
                                <td class="meta-label">Quantity</td>
                                <td class="meta-value"><?php echo htmlspecialchars(trim($packageQuantity . ' ' . $packageType)); ?></td>
                            </tr>
                            <?php if ($licenseName !== '') { ?>
                                <tr>
                                    <td class="meta-label">License</td>
                                    <td class="meta-value"><?php echo htmlspecialchars($licenseName . ' License'); ?></td>
                                </tr>
                            <?php } ?>
                            <?php if ($packageFormat !== '') { ?>
                                <tr>
                                    <td class="meta-label">Delivery</td>
                                    <td class="meta-value"><?php echo htmlspecialchars($packageFormat); ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section">
            <div class="section-title">Package Summary</div>
            <table class="package-table" cellpadding="0" cellspacing="0">
                <tr>
                    <th>S. No.</th>
                    <th>Description</th>
                    <th>Unit Price</th>
                </tr>
            </table>

            <table class="package-card" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="package-sr">1</td>
                    <td class="package-copy">
                        <p class="package-title"><?php echo htmlspecialchars($productDescription); ?></p>
                        <p class="package-subcopy"><?php echo htmlspecialchars('Quantity: ' . trim($packageQuantity . ' ' . $packageType)); ?></p>
                        <?php if ($packageDescriptor !== '') { ?>
                            <p class="package-subcopy"><?php echo htmlspecialchars($packageDescriptor); ?></p>
                        <?php } ?>
                        <?php if ($taxAmount > 0) { ?>
                            <p class="package-subcopy"><?php echo htmlspecialchars('GST @ ' . ((string) config('constants.GST_VALUE')) . '% added at checkout'); ?></p>
                        <?php } ?>
                    </td>
                    <td class="package-price"><?php echo $currencySymbol; ?><?php echo number_format($totalAmount, 2); ?></td>
                </tr>
            </table>
        </section>

        <section class="section">
            <table class="summary-layout" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="summary-copy-cell">
                        <div class="summary-copy-label">Estimated Assets</div>
                        <div class="summary-copy-value"><?php echo htmlspecialchars($packageQuantity !== '' ? $packageQuantity : '1'); ?></div>
                        <?php if ($amountInWordsLine !== '') { ?>
                            <div class="summary-copy-label">Amount In Words</div>
                            <div class="summary-copy-text"><?php echo htmlspecialchars($amountInWordsLine); ?></div>
                        <?php } ?>
                    </td>
                    <td class="summary-box-cell">
                        <table class="summary-box" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>Sub Total</td>
                                <td><?php echo $currencySymbol; ?><?php echo number_format($subTotal, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td class="discount-value">-<?php echo $currencySymbol; ?><?php echo number_format($discountAmount, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Tax (GST)</td>
                                <td><?php echo $currencySymbol; ?><?php echo number_format($taxAmount, 2); ?></td>
                            </tr>
                            <tr class="total-row">
                                <td>Total Due</td>
                                <td><?php echo $currencySymbol; ?><?php echo number_format($totalAmount, 2); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section terms-section">
            <div class="section-title">Licensing Terms</div>
            <div class="terms-heading">With a Standard license, you may:</div>
            <ul class="terms-list">
                <?php foreach ($licenseTermsAllowed as $term) { ?>
                    <li><?php echo htmlspecialchars($term); ?></li>
                <?php } ?>
            </ul>

            <div class="terms-heading">With a Standard license, you may not:</div>
            <ul class="terms-list">
                <?php foreach ($licenseTermsRestricted as $term) { ?>
                    <li><?php echo htmlspecialchars($term); ?></li>
                <?php } ?>
            </ul>
        </section>

        <section class="section">
            <table class="bank-grid" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="section-title">Terms of Payment</div>
                        <ul class="terms-list">
                            <?php foreach ($paymentTerms as $term) { ?>
                                <li><?php echo htmlspecialchars($term); ?></li>
                            <?php } ?>
                        </ul>
                        <?php if ($showPaymentCta) { ?>
                            <a class="cta-link" href="<?php echo $orders['payment_url']; ?>">Confirm Selection with Razorpay</a>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="section-title">Remit To</div>
                        <p class="details-name" style="font-size: 14px;"><?php echo htmlspecialchars($issuerCompanyName); ?></p>
                        <p class="bank-copy"><?php echo htmlspecialchars($remitAddress); ?></p>
                        <p class="bank-copy">Email: info@imagefootage.com</p>
                        <p class="bank-copy">Website: <?php echo htmlspecialchars($frontendUrl); ?></p>
                        <table class="meta-table" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
                            <tr>
                                <td class="bank-label">Account Name</td>
                                <td class="bank-value">Conceptual Pictures Worldwide Pvt. Ltd.</td>
                            </tr>
                            <tr>
                                <td class="bank-label">Account Number</td>
                                <td class="bank-value">50200000502220</td>
                            </tr>
                            <tr>
                                <td class="bank-label">Bank Name</td>
                                <td class="bank-value">HDFC Bank Ltd</td>
                            </tr>
                            <tr>
                                <td class="bank-label">IFSC Code</td>
                                <td class="bank-value">HDFC0001998</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section">
            <table class="signoff-grid" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="signoff-note">
                            Estimate prepared by <?php echo htmlspecialchars($issuerCompanyName); ?>.
                            Please review the package details and confirm your selection to proceed with licensing.
                        </div>
                        <div class="signoff-meta">
                            info@imagefootage.com<br>
                            <?php echo htmlspecialchars($frontendUrl); ?>
                        </div>
                    </td>
                    <td class="signature-block">
                        <div class="signoff-note" style="margin-bottom: 8px;">For <?php echo htmlspecialchars($issuerCompanyName); ?></div>
                        <img src="<?php echo $orders['signature']; ?>" alt="Authorized Signature">
                        <div class="signature-copy">Authorized Signatory</div>
                    </td>
                </tr>
            </table>
        </section>
    </div>
</body>

</html>
