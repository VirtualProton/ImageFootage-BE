<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image-Footage Estimate</title>
    <?php
    $items = $quotation ?? $estimate ?? [];
    $firstItem = $items[0] ?? [];
    $documentLabel = strtoupper(trim((string) ($firstItem['document_label'] ?? 'Estimate')));
    $estimateNumber = trim((string) ($firstItem['estimate_number'] ?? $firstItem['invoice_name'] ?? ''));
    $estimateNumber = $estimateNumber !== '' && stripos($estimateNumber, 'Q') !== 0 ? 'Q' . $estimateNumber : $estimateNumber;
    $estimateDateRaw = $firstItem['estimate_date'] ?? $firstItem['invicecreted'] ?? $firstItem['invoice_created'] ?? null;
    $estimateDate = !empty($estimateDateRaw) ? date('d.m.Y', strtotime($estimateDateRaw)) : date('d.m.Y');
    $validUntilRaw = $firstItem['valid_until'] ?? $firstItem['expiry_date'] ?? null;
    $validUntil = !empty($validUntilRaw) ? date('d.m.Y', strtotime($validUntilRaw)) : '';
    $companyName = trim((string) ($firstItem['issuer_company'] ?? config('constants.company_name') ?? 'Imagefootage'));
    $contactName = trim((string) (($firstItem['first_name'] ?? '') . ' ' . ($firstItem['last_name'] ?? '')));
    $clientCompany = trim((string) ($firstItem['company'] ?? $contactName));
    $clientAddress = trim((string) ($firstItem['address'] ?? ''));
    $clientLocation = implode(', ', array_filter([
        trim((string) ($firstItem['cityname'] ?? '')),
        trim((string) ($firstItem['statename'] ?? '')),
        trim((string) ($firstItem['postal_code'] ?? '')),
    ]));
    $clientCountry = trim((string) ($firstItem['countryname'] ?? ''));
    $clientEmail = trim((string) ($firstItem['email'] ?? $firstItem['email_id'] ?? ''));
    $clientMobile = trim((string) ($firstItem['mobile'] ?? ''));
    $accountManager = trim((string) ($firstItem['contact_owner'] ?? 'Imagefootage Sales Team'));
    $currencySymbol = (($firstItem['currency'] ?? 'INR') === 'USD') ? '$' : '&#8377;';
    $taxAmount = (float) ($firstItem['tax'] ?? 0);
    $discountAmount = (float) ($firstItem['discount_amount'] ?? 0);
    $totalAmount = (float) ($firstItem['total'] ?? 0);
    $subTotal = max($totalAmount - $taxAmount, 0);
    $amountInWordsText = trim((string) ($amount_in_words ?? ''));
    $amountInWordsLine = $amountInWordsText !== '' ? 'Rupees ' . $amountInWordsText . ' only' : '';
    ?>
    <style>
        * {
            box-sizing: border-box;
        }

        @page {
            margin: 24px;
        }

        body {
            margin: 0;
            color: #111827;
            font-family: "Noto Sans", "DejaVu Sans", Arial, sans-serif;
            font-size: 12px;
            line-height: 1.45;
        }

        .estimate-sheet {
            width: 100%;
        }

        .header,
        .details,
        .summary,
        .footer {
            width: 100%;
            border-collapse: collapse;
        }

        .header td {
            vertical-align: top;
            padding-bottom: 20px;
            border-bottom: 1px solid #E5E7EB;
        }

        .company-name {
            margin: 0 0 6px;
            font-size: 20px;
            font-weight: 700;
        }

        .muted {
            color: #6B7280;
        }

        .document-title {
            margin: 0;
            text-align: right;
            font-size: 32px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .meta {
            margin-top: 8px;
            text-align: right;
        }

        .section-title {
            margin: 22px 0 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .details td {
            width: 50%;
            vertical-align: top;
            padding-right: 24px;
        }

        .details td:last-child {
            padding-right: 0;
        }

        .items {
            width: 100%;
            margin-top: 22px;
            border-collapse: collapse;
        }

        .items th {
            padding: 9px 8px;
            background: #1F2937;
            color: #FFFFFF;
            font-size: 11px;
            text-align: left;
            text-transform: uppercase;
        }

        .items td {
            padding: 10px 8px;
            border-bottom: 1px solid #E5E7EB;
            vertical-align: top;
        }

        .right {
            text-align: right;
        }

        .summary {
            margin-top: 18px;
        }

        .summary td {
            padding: 5px 0;
        }

        .summary-label {
            width: 78%;
            text-align: right;
            color: #374151;
            padding-right: 18px !important;
        }

        .summary-value {
            width: 22%;
            text-align: right;
            font-weight: 700;
        }

        .grand-total td {
            padding-top: 10px;
            border-top: 1px solid #111827;
            font-size: 14px;
        }

        .terms {
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #E5E7EB;
        }

        .terms ol {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        .terms li {
            margin-bottom: 5px;
        }

        .footer td {
            padding-top: 24px;
            vertical-align: bottom;
        }
    </style>
</head>

<body>
    <div class="estimate-sheet">
        <table class="header">
            <tr>
                <td>
                    <p class="company-name"><?php echo e($companyName); ?></p>
                    <div class="muted">Image, footage, music and custom content licensing</div>
                </td>
                <td>
                    <h1 class="document-title"><?php echo e($documentLabel); ?></h1>
                    <div class="meta">
                        <?php if ($estimateNumber !== '') { ?>
                            <div><strong>Estimate No:</strong> <?php echo e($estimateNumber); ?></div>
                        <?php } ?>
                        <div><strong>Date:</strong> <?php echo e($estimateDate); ?></div>
                        <?php if ($validUntil !== '') { ?>
                            <div><strong>Valid Until:</strong> <?php echo e($validUntil); ?></div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        </table>

        <table class="details">
            <tr>
                <td>
                    <h2 class="section-title">Bill To</h2>
                    <?php if ($clientCompany !== '') { ?><div><strong><?php echo e($clientCompany); ?></strong></div><?php } ?>
                    <?php if ($contactName !== '' && $contactName !== $clientCompany) { ?><div><?php echo e($contactName); ?></div><?php } ?>
                    <?php if ($clientAddress !== '') { ?><div><?php echo e($clientAddress); ?></div><?php } ?>
                    <?php if ($clientLocation !== '') { ?><div><?php echo e($clientLocation); ?></div><?php } ?>
                    <?php if ($clientCountry !== '') { ?><div><?php echo e($clientCountry); ?></div><?php } ?>
                </td>
                <td>
                    <h2 class="section-title">Contact</h2>
                    <?php if ($clientEmail !== '') { ?><div><strong>Email:</strong> <?php echo e($clientEmail); ?></div><?php } ?>
                    <?php if ($clientMobile !== '') { ?><div><strong>Mobile:</strong> <?php echo e($clientMobile); ?></div><?php } ?>
                    <div><strong>Account Manager:</strong> <?php echo e($accountManager); ?></div>
                </td>
            </tr>
        </table>

        <table class="items">
            <thead>
                <tr>
                    <th style="width: 44px;">#</th>
                    <th>Description</th>
                    <th style="width: 70px;" class="right">Qty</th>
                    <th style="width: 110px;" class="right">Rate</th>
                    <th style="width: 120px;" class="right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $index => $item) {
                    $description = $item['title'] ?? $item['product_name'] ?? $item['description'] ?? $item['package_name'] ?? 'Content license';
                    $quantity = (float) ($item['quantity'] ?? $item['qty'] ?? 1);
                    $rate = (float) ($item['price'] ?? $item['amount'] ?? $item['subtotal'] ?? 0);
                    $amount = (float) ($item['line_total'] ?? $item['total_price'] ?? ($quantity * $rate));
                ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo e($description); ?></td>
                        <td class="right"><?php echo rtrim(rtrim(number_format($quantity, 2), '0'), '.'); ?></td>
                        <td class="right"><?php echo $currencySymbol; ?> <?php echo number_format($rate, 2); ?></td>
                        <td class="right"><?php echo $currencySymbol; ?> <?php echo number_format($amount, 2); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <table class="summary">
            <tr>
                <td class="summary-label">Subtotal</td>
                <td class="summary-value"><?php echo $currencySymbol; ?> <?php echo number_format($subTotal, 2); ?></td>
            </tr>
            <?php if ($discountAmount > 0) { ?>
                <tr>
                    <td class="summary-label">Discount</td>
                    <td class="summary-value">-<?php echo $currencySymbol; ?> <?php echo number_format($discountAmount, 2); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td class="summary-label">Tax</td>
                <td class="summary-value"><?php echo $currencySymbol; ?> <?php echo number_format($taxAmount, 2); ?></td>
            </tr>
            <tr class="grand-total">
                <td class="summary-label">Estimated Total</td>
                <td class="summary-value"><?php echo $currencySymbol; ?> <?php echo number_format($totalAmount, 2); ?></td>
            </tr>
            <?php if ($amountInWordsLine !== '') { ?>
                <tr>
                    <td class="summary-label">Amount in Words</td>
                    <td class="summary-value"><?php echo e($amountInWordsLine); ?></td>
                </tr>
            <?php } ?>
        </table>

        <div class="terms">
            <h2 class="section-title">Terms</h2>
            <ol>
                <li>This estimate is valid for 30 days unless a different validity date is mentioned above.</li>
                <li>Prices and asset availability are subject to change until the license is confirmed.</li>
                <li>License rights are issued only after payment confirmation and required approvals.</li>
                <li>Taxes shown are estimates and may change based on applicable law at billing time.</li>
            </ol>
        </div>

        <table class="footer">
            <tr>
                <td class="muted">Prepared by <?php echo e($accountManager); ?></td>
                <td class="right"><strong><?php echo e($companyName); ?></strong></td>
            </tr>
        </table>
    </div>
</body>

</html>
