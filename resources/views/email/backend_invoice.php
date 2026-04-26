<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Image-Footage</title>
   <style>
      @font-face {
         font-family: 'Lato', sans-serif;
         src: url('fonts/Lato-Regular.ttf') format('truetype');
         font-weight: normal;
         font-style: normal;
      }

      @font-face {
         font-family: 'Lato', sans-serif;
         src: url('fonts/Lato-Italic.ttf') format('truetype');
         font-weight: normal;
         font-style: italic;
      }

      @font-face {
         font-family: 'Lato', sans-serif;
         src: url('fonts/Lato-Bold.ttf') format('truetype');
         font-weight: normal;
         font-style: bold;
      }

      @page {
         margin-top: 30px;
         margin-bottom: 50px;
      }

      header {
         position: relative;
         top: auto;
         left: auto;
         right: auto;
         bottom: auto;
      }

      body {
         font-family: 'Inter', Arial, sans-serif;
         margin-top: 0.5cm;
         margin-left: 2cm;
         margin-right: 2cm;
         margin-bottom: 2cm;
      }

      .main {
         padding: 10px;
      }

      /* Invoice header */
      .invoice-header-table {
         width: 100%;
         border-bottom: 1px solid #ddd;
         margin-bottom: 0;
         padding-bottom: 20px;
      }

      .invoice-header-table td {
         vertical-align: bottom;
      }

      .invoice-logo {
         width: 160px;
      }

      .invoice-logo img {
         max-width: 160px;
         height: auto;
      }

      .invoice-title-cell {
         text-align: right;
         padding-bottom: 5px;
      }

      .invoice-title-line1 {
         font-size: 11px;
         letter-spacing: 6px;
         color: #888888;
         text-transform: uppercase;
         display: block;
         font-weight: 400;
         margin-bottom: 0;
      }

      .invoice-title-line2 {
         font-size: 11px;
         letter-spacing: 8px;
         color: #888888;
         text-transform: uppercase;
         display: block;
         font-weight: 400;
         margin-bottom: 2px;
      }

      .invoice-title-hello {
         font-size: 50px;
         font-weight: 700;
         color: #F7B403;
         /* #f7b500 */
         font-style: normal;
         line-height: 1;
         letter-spacing: -1px;
         display: block;
      }

      /* Invoice info section */
      .invoice-info-table {
         width: 100%;
         margin-top: 10px;
         margin-bottom: 15px;
         border-collapse: collapse;
      }

      .invoice-info-table td {
         padding: 4px 12px;
         font-size: 13px;
         vertical-align: top;
      }

      .invoice-info-table .label {
         color: #777;
         width: 100px;
         white-space: nowrap;
      }

      .invoice-info-table .value {
         color: #111;
         font-weight: 700;
      }

      /* Client details section */
      .client-details-section {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 15px;
      }

      .client-details-section td {
         padding: 4px 12px;
         font-size: 13px;
         vertical-align: top;
      }

      .client-details-title {
         font-size: 15px;
         font-weight: 700;
         padding: 8px 12px;
      }

      .client-label {
         color: #777;
         width: 110px;
         white-space: nowrap;
      }

      .client-value {
         color: #111;
         font-weight: 700;
      }

      /* Items table */
      .items-table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 10px;
      }

      .items-table thead th {
         background-color: #444;
         color: #fff;
         padding: 10px 12px;
         font-size: 13px;
         text-align: left;
      }

      .items-table thead th:last-child {
         text-align: right;
      }

      .items-table tbody td {
         padding: 10px 12px;
         font-size: 13px;
         vertical-align: top;
         border-bottom: 1px solid #eee;
      }

      .items-table .sno-col {
         width: 50px;
         text-align: center;
      }

      .items-table .price-col {
         width: 120px;
         text-align: right;
         font-weight: 700;
         white-space: nowrap;
      }

      .item-title {
         font-weight: 700;
         font-size: 14px;
         margin-bottom: 8px;
      }

      .item-body {
         display: table;
         width: 100%;
      }

      .item-thumb {
         display: table-cell;
         width: 130px;
         vertical-align: top;
         padding-right: 12px;
      }

      .item-thumb img {
         width: 120px;
         height: 80px;
         object-fit: cover;
         background-color: #eee;
         display: block;
      }

      .item-details {
         display: table-cell;
         vertical-align: top;
         font-size: 13px;
         line-height: 22px;
      }

      .item-details strong {
         font-weight: 700;
      }

      /* Amount rows */
      .amount-table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 2px;
      }

      .amount-table td {
         padding: 10px 12px;
         font-size: 14px;
         background-color: rgba(89, 89, 89, 0.15);
      }

      .amount-table .amount-label {
         text-align: left;
      }

      .amount-table .amount-value {
         text-align: right;
         font-weight: 700;
      }

      .single-gray-block {
         padding: 8px 12px;
         font-size: 14px;
         background-color: rgba(89, 89, 89, 0.15);
         margin-bottom: 15px;
      }

      /* Licensing / payment */
      .licensing-terms .h3 {
         font-size: 18px;
         font-weight: 700;
         color: #0563c1;
         margin-bottom: 12px;
         text-decoration: underline;
      }

      .licensing-terms ul,
      .licensing-terms ol {
         margin-left: 40px;
         margin-bottom: 15px;
      }

      .licensing-terms li {
         line-height: 24px;
         font-size: 14px;
      }

      /* Signature */
      .signature {
         text-align: right;
         padding: 50px 0 0 0;
      }

      .signature p {
         font-size: 14px;
      }

      .signature p span {
         font-size: 18px;
         font-weight: 700;
      }

      .signature img {
         width: 110px;
         height: auto;
         margin: 7px 0;
      }

      .page-break {
         page-break-before: always;
      }
   </style>
   <link rel="stylesheet" href="assets/css/email/quotation.css">
</head>

<body>
   <!-- Header start -->
   <header>
      <div class="container" style="margin-left: 2cm; margin-right: 2cm;">
         <table class="invoice-header-table" cellpadding="0" cellspacing="0">
            <tr>
               <td class="invoice-logo" style="width: 200px; vertical-align: bottom; text-align: right;">
                  <img src="<?php echo $quotation[0]['company_logo']; ?>" alt="logo">
               </td>
               <td class="invoice-title-cell">
                  <span class="invoice-title-line1">THIS IS YOUR</span>
                  <span class="invoice-title-line2">ESTIMATE</span>
                  <span class="invoice-title-hello" style="color: <?php echo ($quotation[0]['flag'] == 0) ? '#1a7cbf' : '#F7B403'; ?>;">hello</span>
               </td>
            </tr>
         </table>
      </div>
   </header>
   <!-- Header end -->
   <!-- Main content -->
   <main class="main">

      <!-- Invoice Info Section -->
      <table class="invoice-info-table" cellpadding="0" cellspacing="0">
         <tr>
            <td class="label" width="12%">Estimate No.</td>
            <td class="value" width="38%"><?php echo config('constants.INVOICE_PREFIX') . $quotation[0]['invoice_name']; ?></td>
            <td class="label" width="15%">Company Name</td>
            <td class="value" width="35%">Conceptual Pictures Worldwide Pvt. Ltd</td>
         </tr>
         <tr>
            <td class="label">Estimate Date</td>
            <td class="value"><?php echo date("d.m.Y", strtotime($quotation[0]['invicecreted'])); ?></td>
            <td class="label">Company Pan No</td>
            <td class="value"><?php echo config('constants.PAN_VALUE'); ?></td>
         </tr>
         <tr>
            <td class="label">Client Code</td>
            <td class="value"><?php echo $quotation[0]['vendor_code']; ?></td>
            <td class="label">GSTIN</td>
            <td class="value"><?php echo config('constants.GSTIN_VALUE'); ?></td>
         </tr>
         <tr>
            <td class="label"></td>
            <td class="value"></td>
            <td class="label">CIN Number</td>
            <td class="value"><?php echo config('constants.CIN_VALUE') ?? ''; ?></td>
         </tr>
      </table>

      <hr style="border: none; border-top: 1px solid #ddd; margin: 0 0 15px;">

      <!-- Client Details Section -->
      <table class="client-details-section" cellpadding="0" cellspacing="0">
         <tr>
            <td colspan="4" class="client-details-title">Client Details</td>
         </tr>
         <tr>
            <td colspan="2" style="padding: 8px 12px; vertical-align: top; width: 50%;">
               <p style="margin: 0 0 3px; font-weight: 700;">
                  <?php echo !empty($quotation[0]['company']) ? $quotation[0]['company'] : $quotation[0]['first_name'] . ' ' . $quotation[0]['last_name']; ?>
               </p>
               <p style="margin: 0 0 3px;"><?php echo $quotation[0]['address'] ?? ''; ?></p>
               <p style="margin: 0 0 3px;">
                  <?php echo $quotation[0]['cityname'] ?? ''; ?>
                  <?php if (!empty($quotation[0]['postal_code'])) { ?> - <?php echo $quotation[0]['postal_code']; ?><?php } ?>
               </p>
               <p style="margin: 0 0 8px;"><?php echo $quotation[0]['countryname'] ?? ''; ?></p>
               <p style="margin: 0 0 3px;">Pan No &nbsp; <strong><?php echo $quotation[0]['pan'] ?? ''; ?></strong></p>
               <p style="margin: 0 0 3px;">GSTIN &nbsp; <strong><?php echo $quotation[0]['gst'] ?? ''; ?></strong></p>
            </td>
            <td colspan="2" style="padding: 8px 12px; vertical-align: top; width: 50%;">
               <table cellpadding="0" cellspacing="0" style="width: 100%;">
                  <tr>
                     <td class="client-label">Ordered By</td>
                     <td class="client-value"><?php echo $quotation[0]['first_name'] . ' ' . $quotation[0]['last_name']; ?></td>
                  </tr>
                  <tr>
                     <td class="client-label">Mail ID</td>
                     <td class="client-value"><?php echo $quotation[0]['email'] ?? ''; ?></td>
                  </tr>
                  <tr>
                     <td class="client-label">Contact No.</td>
                     <td class="client-value"><?php echo $quotation[0]['mobile'] ?? ''; ?></td>
                  </tr>
                  <tr>
                     <td class="client-label">Sales Person</td>
                     <td class="client-value"><?php echo $quotation[0]['contact_owner'] ?? (Auth::guard('admins')->user()->name ?? ''); ?></td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>

      <!-- Items Table -->
      <table class="items-table" cellpadding="0" cellspacing="0">
         <thead>
            <tr>
               <th class="sno-col">S. No.</th>
               <th>Description</th>
               <th style="text-align: right;">Unit Price</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $amount = 0;
            for ($i = 0; $i < count($quotation); $i++) {
               if (!empty($quotation[$i])) {
                  $amount += $quotation[$i]['total'] - $quotation[$i]['tax'];
                  $itemCode = trim($quotation[$i]['product_id'] ?? '');
                  $itemName = trim($quotation[$i]['name'] ?? '');
                  $itemTitle = $itemCode . (($itemCode !== '' && $itemName !== '') ? ' : ' : '') . $itemName;
                  if ($itemTitle === '') {
                     $itemTitle = 'Asset ' . ($i + 1);
                  }
            ?>
               <tr<?php if ($i > 0 && $i % 5 == 0) { ?> class="page-break"<?php } ?>>
                  <td class="sno-col"><?php echo $i + 1; ?></td>
                  <td>
                     <div class="item-title"><?php echo htmlspecialchars($itemTitle); ?></div>
                     <table cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tr>
                           <td style="width: 130px; vertical-align: top; padding-right: 12px;">
                              <?php if ($quotation[$i]['type'] == 'Music') { ?>
                                 <div style="width: 120px; height: 80px; background-color: #f5f5f5; text-align: center; line-height: 80px;">
                                    <span style="font-size: 36px; color: #bbb;">&#9835;</span>
                                 </div>
                              <?php } elseif ($quotation[$i]['type'] == 'Footage') { ?>
                                 <div style="width: 120px; height: 80px; background-color: #f5f5f5; text-align: center; line-height: 80px;">
                                    <span style="font-size: 36px; color: #bbb;">&#9654;</span>
                                 </div>
                              <?php } else { ?>
                                 <div style="width: 120px; height: 80px; background-color: #f5f5f5; text-align: center; line-height: 80px;">
                                    <span style="font-size: 36px; color: #bbb;">&#9728;</span>
                                 </div>
                              <?php } ?>
                           </td>
                           <td style="vertical-align: top; font-size: 13px; line-height: 22px;">
                              <?php if (!empty($quotation[$i]['type'])) { ?>
                                 <div><strong>File Type:</strong> <?php echo htmlspecialchars($quotation[$i]['type']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['licence_type'])) { ?>
                                 <div><strong>License Type:</strong> <?php echo htmlspecialchars(strip_tags($quotation[$i]['licence_type'])); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['product_size'])) { ?>
                                 <div><strong>Size:</strong> <?php echo htmlspecialchars($quotation[$i]['product_size']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['size'])) { ?>
                                 <div><strong>Resolution Type:</strong> <?php echo htmlspecialchars($quotation[$i]['size']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['resolution'])) { ?>
                                 <div><strong>Resolution:</strong> <?php echo htmlspecialchars($quotation[$i]['resolution']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['format'])) { ?>
                                 <div><strong>File Format:</strong> <?php echo htmlspecialchars($quotation[$i]['format']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['duration'])) { ?>
                                 <div><strong>Duration:</strong> <?php echo htmlspecialchars($quotation[$i]['duration']); ?></div>
                              <?php } ?>
                           </td>
                        </tr>
                     </table>
                  </td>
                  <td class="price-col"><?php echo number_format($quotation[$i]['subtotal'], 2); ?></td>
               </tr>
            <?php
               }
            }
            ?>
         </tbody>
      </table>

      <!-- Total Assets & Summary Section -->
      <?php
         $taxAmount = (float) ($quotation[0]['tax'] ?? 0);
         $totalAmount = (float) ($quotation[0]['total'] ?? 0);
         $subTotal = max($totalAmount - $taxAmount, 0);
         $discountAmount = 0;
         $currencySymbol = ($quotation[0]['currency'] ?? 'INR') === 'USD' ? '$' : '₹';
      ?>
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px; margin-bottom: 10px;">
         <tr>
            <td style="vertical-align: top; width: 50%; padding: 10px 0;">
               <p style="font-size: 14px; font-weight: 700;">Total Assets: <?php echo count($quotation); ?></p>
            </td>
            <td style="vertical-align: top; width: 50%;">
               <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tr>
                     <td style="padding: 8px 12px; font-size: 13px; border-bottom: 1px solid #eee;">Sub Total</td>
                     <td style="padding: 8px 12px; font-size: 13px; text-align: right; border-bottom: 1px solid #eee;"><?php echo $currencySymbol; ?><?php echo number_format($subTotal, 2); ?></td>
                  </tr>
                  <?php if ($discountAmount > 0) { ?>
                  <tr>
                     <td style="padding: 8px 12px; font-size: 13px; border-bottom: 1px solid #eee;">Discount</td>
                     <td style="padding: 8px 12px; font-size: 13px; text-align: right; border-bottom: 1px solid #eee; color: #2a9d4e;">- <?php echo $currencySymbol; ?><?php echo number_format($discountAmount, 2); ?></td>
                  </tr>
                  <?php } ?>
                  <?php if (!empty($taxAmount)) { ?>
                  <tr>
                     <td style="padding: 8px 12px; font-size: 13px; border-bottom: 1px solid #eee;">IGST <?php echo config('constants.GST_VALUE'); ?>%</td>
                     <td style="padding: 8px 12px; font-size: 13px; text-align: right; border-bottom: 1px solid #eee;"><?php echo $currencySymbol; ?><?php echo number_format($taxAmount, 2); ?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td style="padding: 10px 12px; font-size: 14px; font-weight: 700; background-color: #e8e8e8; color: #000;"><strong>Total Due</strong></td>
                     <td style="padding: 10px 12px; font-size: 14px; font-weight: 700; text-align: right; background-color: #e8e8e8; color: #000;"><strong><?php echo $currencySymbol; ?><?php echo number_format($totalAmount, 2); ?></strong></td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>

      <!-- System-generated notice -->
      <div style="border-top: 3px solid #c8a415; padding-top: 10px; margin-bottom: 20px;">
         <p style="font-size: 12px; font-style: italic; color: #555; line-height: 18px;">
            This is a system-generated invoice and does not require any official signature. It reflects our records of the transaction with you. Please inform us immediately if you notice any discrepancies in the details.
         </p>
      </div>

      <!-- Remit To / Bank Transfers Section -->
      <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; border-collapse: collapse; margin-bottom: 0;">
         <tr>
            <hr style="border: none; border-top: 2px solid #0a0a0a; margin: 0 0 15px;">
            <td style="vertical-align: top; width: 45%; padding: 15px 20px; border-right: 1px solid #ddd;">
               <p style="font-size: 14px; font-weight: 700; margin: 0 0 10px;">Remit To</p>
               <p style="font-size: 13px; margin: 0 0 3px;">Conceptual Pictures Worldwide Pvt. Ltd.</p>
               <p style="font-size: 13px; margin: 0 0 3px;">R5 Chambers, 3rd Floor,</p>
               <p style="font-size: 13px; margin: 0 0 3px;">Opp. Pillar No. 02, Mehdipatnam,</p>
               <p style="font-size: 13px; margin: 0 0 8px;">Hyderabad, Telangana 500028</p>
               <p style="font-size: 13px; margin: 0;">Finance: accounts@conceptualpictures.com</p>
            </td>
            <td style="vertical-align: top; width: 55%; padding: 15px 20px;">
               <p style="font-size: 14px; font-weight: 700; margin: 0 0 10px;">Bank Transfers To</p>
               <table cellpadding="0" cellspacing="0" style="width: 100%;">
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Account Name:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">Conceptual Pictures Worldwide Pvt. Ltd.</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Account Type:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">Current</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Bank Name:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">HDFC Bank Ltd</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Bank Address:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">Mallepally, Vijaynagar Colony, Hyderabad 500057</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Bank Account:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">50200000502220</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Swift Code:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">HDFCINBB</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">IFSC Code:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">HDFC0001998</td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>

      <!-- Pay Online Button -->
      <?php if (!empty($quotation[0]['payment_url'])) { ?>
      <div style="margin-bottom: 25px; padding: 12px 20px; background-color: #f5f5f5; border-top: 1px solid #ddd;">
         <table cellpadding="0" cellspacing="0">
            <tr>
               <td style="font-size: 14px; padding-right: 15px; vertical-align: middle;">For Online Payment</td>
               <td style="vertical-align: middle;">
                  <a href="<?php echo htmlspecialchars($quotation[0]['payment_url']); ?>" style="display: inline-block; background: <?php echo ($quotation[0]['flag'] == 0) ? '#1a7cbf' : '#e6a817'; ?>; color: #ffffff; text-decoration: none; padding: 10px 24px; border-radius: 4px; font-weight: 700; font-size: 14px;">Pay Online &rarr;</a>
               </td>
            </tr>
         </table>
      </div>
      <?php } ?>

      <!-- Invoice Terms & License Conditions -->
      <div style="margin-bottom: 20px;">
         <h2 style="font-size: 16px; font-weight: 700; margin: 0 0 8px;">Invoice Terms &amp; License Conditions.</h2>
         <hr style="border: none; border-top: 2px solid #0a0a0a; margin: 0 0 15px;">
         <ol style="margin-left: 20px; padding-left: 0; font-size: 13px; line-height: 22px;">
            <li style="margin-bottom: 10px;">This Invoice is valid for 30 days from the date of issue unless stated otherwise. Prices are subject to change after the validity period.</li>
            <li style="margin-bottom: 10px;">All content is subject to availability at the time of licensing. The Company reserves the right to replace unavailable assets with comparable alternatives.</li>
            <li style="margin-bottom: 10px;">
               <strong>License Grant:</strong> Upon receipt of full payment, ImageFootage grants a non-exclusive, non-transferable, royalty-free license to use the licensed content strictly in accordance with the License Type specified on this invoice. Licenses usually include:
               <ol style="list-style-type: upper-alpha; margin-left: 20px; margin-top: 8px;">
                  <li style="margin-bottom: 5px;">Digital/Standard License – Online Commercial or Editorial use (no broadcast / theater / DVD / VOD). Including promotion / marketing / merchandising / endorsement of a brand, product or commercial service.</li>
                  <li style="margin-bottom: 5px;">Commercial License – Indoor / outdoor TV / POP / Online (no broadcast / theater / DVD / VOD). Including promotion / marketing / merchandising / endorsement of a brand, product or commercial service.</li>
                  <li style="margin-bottom: 5px;">Non Commercial License – All Media Non Commercial (Editorial) (including broadcast / theater / DVD / VOD). No promotion / marketing / merchandising / endorsement of a brand, product or commercial service.</li>
                  <li style="margin-bottom: 5px;">All Media License – EXTENDED All Media (including TVC / Broadcast, Theater / DVD / VOD). Including promotion / marketing / merchandising / endorsement of a brand, product or commercial service.</li>
               </ol>
            </li>
            <li style="margin-bottom: 10px;">
               <strong>Usage Restrictions:</strong> Content may not be resold, sublicensed, redistributed, or made available as standalone files. Use in unlawful, misleading, defamatory, or pornographic content is strictly prohibited.
            </li>
            <li style="margin-bottom: 10px;">
               <strong>Ownership:</strong> All intellectual property rights remain the property of ImageFootage and/or its licensors. No ownership rights are transferred to the client.
            </li>
         </ol>
      </div>

   </main>
</body>

</html>