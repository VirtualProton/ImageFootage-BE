<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image-Footage Invoice</title>
    <?php
    $documentLabel = 'INVOICE';
    $helloColor = ((int) ($quotation[0]['flag'] ?? 0) === 0) ? '#2563EB' : '#B45309';
    $issuerCompanyName = ((int) ($quotation[0]['flag'] ?? 0) === 0)
        ? (config('constants.company_name') ?: 'Imagefootage')
        : 'Conceptual Pictures Worldwide Pvt. Ltd.';
    $contactName = trim((string) (($quotation[0]['first_name'] ?? '') . ' ' . ($quotation[0]['last_name'] ?? '')));
    $clientCompanyName = trim((string) ($quotation[0]['company'] ?? ''));
    if ($clientCompanyName === '') {
        $clientCompanyName = $contactName;
    }
    $endClientName = trim((string) ($quotation[0]['end_client'] ?? ''));
    if ($endClientName === '') {
        $endClientName = $contactName;
    }
    $orderedByName = $contactName !== '' ? $contactName : $clientCompanyName;
    $invoiceNumber = trim((string) config('constants.INVOICE_PREFIX')) . trim((string) ($quotation[0]['invoice_name'] ?? ''));
    $invoiceDate = !empty($quotation[0]['invicecreted']) ? date('d.m.Y', strtotime($quotation[0]['invicecreted'])) : '';
    $clientCode = trim((string) ($quotation[0]['vendor_code'] ?? ''));
    $clientAddress = trim((string) ($quotation[0]['address'] ?? ''));
    $clientLocationParts = array_filter([
        trim((string) ($quotation[0]['cityname'] ?? '')),
        trim((string) ($quotation[0]['statename'] ?? '')),
        trim((string) ($quotation[0]['postal_code'] ?? '')),
    ]);
    $clientLocation = implode(', ', $clientLocationParts);
    $clientCountry = trim((string) ($quotation[0]['countryname'] ?? ''));
    $clientGstin = trim((string) ($quotation[0]['gst'] ?? ''));
    $clientPan = trim((string) ($quotation[0]['pan'] ?? ''));
    $clientEmail = trim((string) ($quotation[0]['email'] ?? ($quotation[0]['email_id'] ?? '')));
    $clientMobile = trim((string) ($quotation[0]['mobile'] ?? ''));
    $accountManager = trim((string) ($quotation[0]['contact_owner'] ?? ''));
    if ($accountManager === '') {
        $accountManager = 'Imagefootage Sales Team';
    }
    $taxAmount = (float) ($quotation[0]['tax'] ?? 0);
    $totalAmount = (float) ($quotation[0]['total'] ?? 0);
    $discountAmount = (float) ($quotation[0]['discount_amount'] ?? 0);
    $subTotal = max($totalAmount - $taxAmount, 0);
    $currencySymbol = (($quotation[0]['currency'] ?? 'INR') === 'USD') ? '$' : '&#8377;';
    $totalItems = count($quotation);
    $amountInWordsText = trim((string) ($amount_in_words ?? ''));
    $amountInWordsLine = $amountInWordsText !== '' ? 'Rupees ' . $amountInWordsText . ' only' : '';
    $paymentStatus = strtolower(trim((string) ($quotation[0]['payment_status'] ?? '')));
    $showPaymentCta = !empty($quotation[0]['payment_url']) && !in_array($paymentStatus, ['transction success', 'completed'], true);
    $placeholderImage = $quotation[0]['placeholder_image'] ?? ($quotation[0]['template_image'] ?? ($quotation[0]['music_image'] ?? ''));
    $placeholderVideo = $quotation[0]['placeholder_video'] ?? ($quotation[0]['template_image'] ?? $placeholderImage);
    $placeholderMusic = $quotation[0]['placeholder_music'] ?? ($quotation[0]['music_image'] ?? ($quotation[0]['template_image'] ?? $placeholderImage));
    $terms = [
        'This invoice is valid for 30 days from the date of issue unless stated otherwise. Pricing and availability may change after that period.',
        'All content remains subject to availability at the time of licensing. If an asset becomes unavailable, we may replace it with a comparable alternative.',
        'License rights are assigned only after receipt of full payment and any required purchase order or written confirmation.',
        'Licensed assets may not be resold, sublicensed, redistributed, or delivered as standalone source files to third parties.',
        'Payments can be made in favor of Conceptual Pictures Worldwide Pvt. Ltd. via cheque, RTGS, or NEFT using the bank details below.',
        'All disputes are subject to Hyderabad jurisdiction. Please notify us immediately if any invoice detail needs correction before processing.',
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

        .invoice-sheet {
            width: 100%;
        }

        .section {
            width: 100%;
            padding: 0 0 24px;
            margin: 0 0 24px;
            border-bottom: 1px solid #E5E7EB;
        }

        .section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            margin: 0 0 14px;
            font-size: 14px;
            font-weight: 700;
            color: #111827;
        }

        .header-section {
            padding-top: 8px;
        }

        .header-table,
        .info-grid,
        .details-grid,
        .summary-layout,
        .bank-grid,
        .item-meta-table,
        .detail-pairs,
        .bank-pairs {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo-cell {
            width: 58%;
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
            width: 42%;
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
            table-layout: fixed;
            border-top: 1px solid #E5E7EB;
        }

        .info-grid > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding-top: 18px;
            padding-right: 22px;
        }

        .info-grid > tbody > tr > td:last-child {
            padding-right: 0;
            padding-left: 22px;
        }

        .detail-pairs td,
        .bank-pairs td,
        .item-meta-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .detail-label,
        .bank-label,
        .item-meta-label {
            width: 118px;
            color: #6B7280;
            font-size: 11px;
            padding-right: 12px;
            white-space: nowrap;
        }

        .detail-value,
        .bank-value,
        .item-meta-value {
            color: #111827;
            font-weight: 700;
            word-break: break-word;
        }

        .details-grid {
            table-layout: fixed;
        }

        .details-grid > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding-right: 22px;
        }

        .details-grid > tbody > tr > td:last-child {
            padding-right: 0;
            padding-left: 22px;
        }

        .details-name {
            margin: 0 0 8px;
            font-size: 14px;
            font-weight: 700;
            color: #111827;
        }

        .details-copy {
            margin: 0 0 4px;
            color: #374151;
            font-size: 12px;
        }

        .details-section .detail-pairs {
            margin-top: 10px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            height: auto;
            min-height: auto;
            margin-bottom: 12px;
        }

        .items-table thead {
            display: table-header-group;
        }

        .items-table tbody {
            display: table-row-group;
        }

        .items-table th {
            padding: 11px 12px;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: 700;
            text-align: left;
            background: #3F3F46;
            border: none;
        }

        .items-table .col-sno {
            width: 52px;
            text-align: left;
            padding-left: 0;
            padding-right: 0;
        }

        .items-table .col-description {
            text-align: left;
            padding-left: 0;
            padding-right: 12px;
        }

        .items-table .col-price {
            width: 140px;
            text-align: right;
        }

        .items-table > tbody > tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .items-table > tbody > tr > td {
            vertical-align: top;
            padding-top: 14px;
            padding-bottom: 14px;
            border-top: 1px solid #E5E7EB;
        }

        .item-card-sr {
            width: 52px;
            padding-left: 0;
            padding-right: 0;
            text-align: left;
            font-size: 13px;
            font-weight: 700;
            color: #111827;
        }

        .item-card-description {
            padding-left: 0;
            padding-right: 12px;
            text-align: left;
        }

        .item-card-price {
            width: 140px;
            padding-left: 10px;
            padding-right: 16px;
            text-align: right;
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            white-space: nowrap;
        }

        .item-title {
            margin: 0 0 10px;
            color: #111827;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.35;
            text-align: left;
        }

        .item-content-wrap {
            width: 100%;
            min-width: 0;
            text-align: left;
        }

        .item-card-inner {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .item-card-inner td {
            padding: 0;
            vertical-align: top;
            border: 0;
        }

        .item-card-thumb-cell {
            width: 126px;
            padding-right: 16px;
        }

        .item-card-meta-cell {
            min-width: 0;
            text-align: left;
        }

        .asset-thumbnail {
            width: 110px;
            height: 80px;
            border: 1px solid #D1D5DB;
            overflow: hidden;
        }

        .asset-thumbnail img {
            width: 110px;
            height: 80px;
            display: block;
            object-fit: cover;
        }

        .item-meta-table {
            table-layout: fixed;
        }

        .item-meta-table td {
            padding: 0 0 4px;
            vertical-align: top;
        }

        .item-meta-table tr:last-child td {
            padding-bottom: 0;
        }

        .item-meta-label {
            width: 116px;
            color: #111827;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            padding-right: 8px;
            line-height: 1.35;
            text-align: left;
        }

        .item-meta-value {
            color: #374151;
            font-size: 12px;
            font-weight: 400;
            line-height: 1.35;
            text-align: left;
            word-break: break-word;
            overflow-wrap: break-word;
            padding-left: 0;
        }

        .item-extra-row td {
            padding-top: 8px;
        }

        .item-extra {
            margin-top: 0;
            color: #4B5563;
            font-size: 11px;
            line-height: 1.4;
        }

        .summary-layout > tbody > tr > td {
            vertical-align: top;
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
            font-weight: 700;
            color: #111827;
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

        .bank-grid {
            table-layout: fixed;
        }

        .bank-grid > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding-right: 18px;
        }

        .bank-grid > tbody > tr > td:last-child {
            padding-right: 0;
            padding-left: 18px;
        }

        .bank-copy {
            margin: 0 0 4px;
            color: #374151;
            font-size: 12px;
        }

        .terms-section {
            color: #6B7280;
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

        @media screen {
            body {
                padding: 24px 0;
            }

            .invoice-sheet {
                max-width: 980px;
                margin: 0 auto;
                padding: 32px;
                box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            }
        }

        @media print {
            .items-table {
                height: auto !important;
                min-height: auto !important;
            }

            .invoice-sheet {
                padding: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-sheet">
        <section class="section header-section">
            <table class="header-table" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="logo-cell">
                        <img src="<?php echo $quotation[0]['company_logo']; ?>" alt="Company Logo">
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
                        <table class="detail-pairs" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="detail-label">Invoice No.</td>
                                <td class="detail-value"><?php echo htmlspecialchars($invoiceNumber); ?></td>
                            </tr>
                            <tr>
                                <td class="detail-label">Invoice Date</td>
                                <td class="detail-value"><?php echo htmlspecialchars($invoiceDate); ?></td>
                            </tr>
                            <tr>
                                <td class="detail-label">Client Code</td>
                                <td class="detail-value"><?php echo htmlspecialchars($clientCode); ?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="detail-pairs" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="detail-label">Company Name</td>
                                <td class="detail-value"><?php echo htmlspecialchars($issuerCompanyName); ?></td>
                            </tr>
                            <tr>
                                <td class="detail-label">Company Pan No</td>
                                <td class="detail-value"><?php echo htmlspecialchars((string) config('constants.PAN_VALUE')); ?></td>
                            </tr>
                            <tr>
                                <td class="detail-label">GSTIN</td>
                                <td class="detail-value"><?php echo htmlspecialchars((string) config('constants.GSTIN_VALUE')); ?></td>
                            </tr>
                            <tr>
                                <td class="detail-label">CIN Number</td>
                                <td class="detail-value"><?php echo htmlspecialchars((string) config('constants.CIN_VALUE')); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section details-section">
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
                        <table class="detail-pairs" cellpadding="0" cellspacing="0">
                            <?php if ($clientPan !== '') { ?>
                                <tr>
                                    <td class="detail-label">Pan No</td>
                                    <td class="detail-value"><?php echo htmlspecialchars($clientPan); ?></td>
                                </tr>
                            <?php } ?>
                            <?php if ($clientGstin !== '') { ?>
                                <tr>
                                    <td class="detail-label">GSTIN</td>
                                    <td class="detail-value"><?php echo htmlspecialchars($clientGstin); ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td>
                        <div class="section-title">End Client Details</div>
                        <table class="detail-pairs" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="detail-label">End Client</td>
                                <td class="detail-value"><?php echo htmlspecialchars($endClientName); ?></td>
                            </tr>
                            <tr>
                                <td class="detail-label">Ordered By</td>
                                <td class="detail-value"><?php echo htmlspecialchars($orderedByName); ?></td>
                            </tr>
                            <?php if ($clientEmail !== '') { ?>
                                <tr>
                                    <td class="detail-label">Mail ID</td>
                                    <td class="detail-value"><?php echo htmlspecialchars($clientEmail); ?></td>
                                </tr>
                            <?php } ?>
                            <?php if ($clientMobile !== '') { ?>
                                <tr>
                                    <td class="detail-label">Contact No.</td>
                                    <td class="detail-value"><?php echo htmlspecialchars($clientMobile); ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class="detail-label">Sales Person</td>
                                <td class="detail-value"><?php echo htmlspecialchars($accountManager); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section">
            <table class="items-table" cellpadding="0" cellspacing="0">
                <colgroup>
                    <col style="width: 52px;">
                    <col>
                    <col style="width: 140px;">
                </colgroup>
                <thead>
                    <tr>
                        <th class="col-sno">S. No.</th>
                        <th class="col-description">Description</th>
                        <th class="col-price">Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($quotation as $index => $item) {
                        if (empty($item)) {
                            continue;
                        }

                        $rawItemName = trim((string) ($item['name'] ?? ''));
                        $rawItemCode = trim((string) ($item['product_id'] ?? ''));
                        $itemTitle = 'Asset ' . ($index + 1);
                        if ($rawItemCode !== '' && $rawItemName !== '' && strcasecmp($rawItemCode, $rawItemName) !== 0) {
                            $itemTitle = $rawItemCode . ' : ' . $rawItemName;
                        } elseif ($rawItemCode !== '') {
                            $itemTitle = $rawItemCode;
                        } elseif ($rawItemName !== '') {
                            $itemTitle = $rawItemName;
                        }

                        $itemType = trim((string) ($item['type'] ?? ''));
                        $itemThumb = trim((string) ($item['product_image_pdf'] ?? ($item['product_image'] ?? '')));
                        if ($itemThumb === '') {
                            $itemTypeKey = strtolower($itemType);
                            if (strpos($itemTypeKey, 'music') !== false) {
                                $itemThumb = $placeholderMusic;
                            } elseif (strpos($itemTypeKey, 'footage') !== false || strpos($itemTypeKey, 'video') !== false) {
                                $itemThumb = $placeholderVideo;
                            } else {
                                $itemThumb = $placeholderImage;
                            }
                        }

                        $resolutionValue = trim((string) ($item['resolution'] ?? ''));
                        $sizeValue = trim((string) ($item['product_size'] ?? ''));
                        if ($resolutionValue === '') {
                            $resolutionValue = trim((string) ($item['size'] ?? ''));
                        }
                        $licenseValue = trim(strip_tags((string) ($item['licence_type'] ?? '')));
                        if ($licenseValue === '') {
                            $licenseValue = trim((string) ($item['product_type'] ?? ''));
                        }
                        $labelValue = trim((string) ($item['size'] ?? ''));
                        $licensingModelValue = trim((string) ($item['product_type'] ?? ''));
                        $durationValue = trim((string) ($item['duration'] ?? ''));
                        $formatValue = trim((string) ($item['format'] ?? ''));
                        $extraDetails = trim(strip_tags((string) ($item['extra_details'] ?? '')));
                        $metaRows = [];
                        if ($itemType !== '') {
                            $metaRows[] = ['File Type', $itemType];
                        }
                        if ($sizeValue !== '') {
                            $metaRows[] = ['Size', $sizeValue];
                        }
                        if ($labelValue !== '' && strcasecmp($labelValue, $sizeValue) !== 0) {
                            $metaRows[] = ['Label', $labelValue];
                        }
                        if ($resolutionValue !== '' && strcasecmp($resolutionValue, $sizeValue) !== 0 && strcasecmp($resolutionValue, $labelValue) !== 0) {
                            $metaRows[] = ['Resolution', $resolutionValue];
                        }
                        if ($licenseValue !== '') {
                            $metaRows[] = ['License Type', $licenseValue];
                        }
                        if ($licensingModelValue !== '' && strcasecmp($licensingModelValue, $licenseValue) !== 0) {
                            $metaRows[] = ['Licensing Model', $licensingModelValue];
                        }
                        if ($formatValue !== '') {
                            $metaRows[] = ['File Format', $formatValue];
                        }
                        if ($durationValue !== '') {
                            $metaRows[] = ['Duration', $durationValue];
                        }
                        ?>
                        <tr class="item-card-row">
                            <td class="item-card-sr"><?php echo $index + 1; ?></td>
                            <td class="item-card-description">
                                <div class="item-content-wrap">
                                    <p class="item-title"><?php echo htmlspecialchars($itemTitle); ?></p>
                                    <table class="item-card-inner" cellpadding="0" cellspacing="0">
                                        <colgroup>
                                            <col style="width: 126px;">
                                            <col>
                                        </colgroup>
                                        <tr>
                                            <td class="item-card-thumb-cell">
                                                <div class="asset-thumbnail">
                                                    <img src="<?php echo $itemThumb; ?>" alt="Asset Thumbnail">
                                                </div>
                                            </td>
                                            <td class="item-card-meta-cell">
                                                <table class="item-meta-table" cellpadding="0" cellspacing="0">
                                                    <colgroup>
                                                        <col style="width: 116px;">
                                                        <col>
                                                    </colgroup>
                                                    <?php foreach ($metaRows as $metaRow) { ?>
                                                        <tr>
                                                            <td class="item-meta-label"><?php echo htmlspecialchars($metaRow[0]); ?>:</td>
                                                            <td class="item-meta-value"><?php echo htmlspecialchars($metaRow[1]); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php if ($extraDetails !== '') { ?>
                                            <tr class="item-extra-row">
                                                <td colspan="2">
                                                    <div class="item-extra"><?php echo nl2br(htmlspecialchars($extraDetails)); ?></div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </td>
                            <td class="item-card-price"><?php echo $currencySymbol; ?><?php echo number_format((float) ($item['subtotal'] ?? 0), 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

        <section class="section">
            <table class="summary-layout" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="summary-copy-cell">
                        <div class="summary-copy-label">Total Assets</div>
                        <div class="summary-copy-value"><?php echo $totalItems; ?></div>
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

        <section class="section">
            <table class="bank-grid" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="section-title">Remit To</div>
                        <p class="details-name" style="font-size: 14px;"><?php echo htmlspecialchars($issuerCompanyName); ?></p>
                        <p class="bank-copy">R5 Chambers, 3rd Floor</p>
                        <p class="bank-copy">Opp. Pillar No. 02, Mehdipatnam</p>
                        <p class="bank-copy">Hyderabad, Telangana 500028</p>
                        <p class="bank-copy">accounts@conceptualpictures.com</p>
                        <?php if ($showPaymentCta) { ?>
                            <a class="cta-link" href="<?php echo $quotation[0]['payment_url']; ?>">Pay Invoice with Razorpay</a>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="section-title">Bank Transfer Details</div>
                        <table class="bank-pairs" cellpadding="0" cellspacing="0">
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
                                <td class="bank-label">Branch</td>
                                <td class="bank-value">Mallepally, Vijayanagar Colony, Hyderabad 500057</td>
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

        <section class="section terms-section">
            <div class="section-title">Terms &amp; Conditions</div>
            <ol class="terms-list">
                <?php foreach ($terms as $term) { ?>
                    <li><?php echo htmlspecialchars($term); ?></li>
                <?php } ?>
            </ol>
        </section>
    </div>
</body>

</html>
