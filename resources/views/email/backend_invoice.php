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
         margin-top: 200px;
         margin-bottom: 400px;
      }

      header {
         position: fixed;
         top: 0px;
         left: 0px;
         height: 100px;
         right: 0cm;
         bottom: 5cm;
      }

      footer {
         position: fixed;
         bottom: 0px;
         left: 0px;
         right: 0cm;
         height: 130px;
      }

      body {
         margin-top: 3cm;
         margin-left: 2cm;
         margin-right: 2cm;
         margin-bottom: 3cm;
      }

      .col-lg-4 {
         padding-top: 0 !important;
      }

      .col-lg-4 div img {
         padding-top: 0 !important;
      }
      .main{
            border:1px solid black;
            padding:10px
        }

   </style>
   <link rel="stylesheet" href="assets/css/email/quotation.css">
</head>

<body>
   <!-- Define header and footer blocks before your content -->
   <!-- Header start -->
   <header>
      <div class="container">
         <div class="header-text">
            <h1 class="h1"><strong>hello</strong></h1>
            <span><strong>THIS IS YOUR TAX INVOICE</strong></span>
         </div>
         <div class="header-logo">
            <img src="<?php echo $quotation[0]['company_logo']; ?>" alt="logo" width="1920" height="351">
         </div>
      </div>
   </header>
   <!-- Header end -->
   <!-- Footer start -->
   <?php if ($quotation[0]['flag'] == 0) { ?>
      <footer>
         <div class="container">
            <div class="footer-left">
               <h2 class="h4"><strong><?php config('constants.company_name')?></strong></h2>
               <p>3rd Floor, # 10-3-89/A/B, R-5 Chambers, Near Sarojini Devi Hospital, Humayun Nagar, Hyderabad -
                  500028, Telangana, Andhra Pradesh, India Phone: +91 40 6720 6720 <span> Fax +91 40 6673 8077</span>
               </p>
               <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
               <a href="<?php echo $quotation[0]['frontend_url']; ?>"><?php echo $quotation[0]['frontend_url']; ?></a>
            </div>
            <div class="footer-right">
               <h3 class="h2">THANK YOU</h3>
            </div>
         </div>
      </footer>
   <?php } else { ?>
      <footer>
         <div class="container">
            <div class="footer-left">
               <h2 class="h4"><strong>Conceptual Pictures Worldwide Private Limited</strong></h2>
               <p>3rd Floor, # 10-3-89/A/B, R-5 Chambers,
                  Humayun Nagar, Hyderabad - 500028, Telangana,
                  Andhra Pradesh, India Phone: +91 40 6720 6720
               </p>
               <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
               <a href="<?php echo $quotation[0]['frontend_url']; ?>"><?php echo $quotation[0]['frontend_url']; ?></a>
            </div>
            <div class="footer-right">
               <h3 class="h2">THANK YOU</h3>
            </div>
         </div>
      </footer>
   <?php } ?>
   <!-- Footer end -->
   <!-- Wrap the content of your PDF inside a main tag -->
   <main class="main">
      <!-- Table paragraph section start -->
      <section class="table-paragraph">
         <div class="container">
            <div class="client-info-top">
               <div class="client-info-leftside">
               <?php if ($quotation[0]['flag'] == 2) { ?>

                    <p>Customer Name: <span><strong><?php echo !empty($quotation[0]['company']) ? $quotation[0]['company'] :$quotation[0]['first_name'].' '.$quotation[0]['last_name'] ?> </span></strong></p>
                    <?php }?>
                    <?php if ($quotation[0]['flag'] !== 2) { ?>
                    <p>Customer Name: <span><strong><?php echo $quotation[0]['first_name'].' '.$quotation[0]['last_name'] ?> </span></strong></p>
                    <?php } ?>
                  <p>Address: <span><strong><?php echo $quotation[0]['address'] ?><?php echo $quotation[0]['cityname'] ?>&nbsp;&nbsp; <?php echo $quotation[0]['statename'] ?>&nbsp;&nbsp; - <?php echo $quotation[0]['postal_code'] ?></strong></span>
                  </p>
                  <p>Mobile: <span><strong><?php echo $quotation[0]['mobile'] ?></strong></span></p>
                  <p>GSTIN: <span><strong><?php echo $quotation[0]['gst'] ?></strong></span></p>
                  <p>PAN: <span><strong><?php echo $quotation[0]['pan'] ?></strong></span></p>
               </div>
               <div class="client-info-rightside">
                  <p>Invoice No.: <span><strong><?php echo config('constants.INVOICE_PREFIX') . $quotation[0]['invoice_name'] ?></span></strong></p>
                  <p>Invoice Date: <span><strong><?php echo date("d.m.Y ", strtotime($quotation[0]['invicecreted'])) ?></strong></span></p>
                  <p>GSTIN: <span><strong><?php echo config('constants.GSTIN_VALUE')?></strong></span></p>
                  <p>PAN No.: <span><strong><?php echo config('constants.PAN_VALUE') ?></strong></span></p>
                  <p>SAC Code: <span><strong><?php echo config('constants.SAC_CODE') ?></strong></span></p>
                  <p>Vendor Code : <span><strong><?php echo config('constants.VENDOR_CODE') ?></strong></span></p>
                  <p>Place: <span><strong><?php echo config('constants.QI_ADDRESS') ?></strong></span></p>
                  <p>Payment Due: <span><strong><?php echo ucfirst($payment_method) ?></strong></span></p>
               </div>
            </div>
            <div class="client-info-bottom">
               <div class="client-info-leftside">
                  <p>Kind Attention: <span class="block-text"><strong><?php echo $quotation[0]['first_name'] ?> <?php echo $quotation[0]['last_name'] ?></strong></span></p>
               </div>
               <div class="client-info-rightside">
               <?php if ($quotation[0]['flag'] == 2) { ?>
                        <p>End Client: <br/><span class="block-text"><strong><?php echo $quotation[0]['end_client'] ?></strong></span></p>
                        <?php } ?>
                  <p>Purchase Order No.: <span class="block-text"><strong><?php echo $po ?? ''; ?></strong></span></p>
                  <p>dated <span><strong><?php echo date("d.M.Y", strtotime($quotation[0]['po_detail'])); ?></strong></span></p>
               </div>
            </div>
            <div class="client-info-bottom">
               <div class="client-info-leftside">
                  <p>Total number of image(s)/footage(s): <span class="block-text"><strong><?php echo count($quotation); ?></strong></span></p>
               </div>
               <div class="client-info-rightside">
                  <p>IF Sales Representative: <span class="block-text"><strong><?php echo Auth::guard('admins')->user()->name; ?></strong></span></p>
                  <p>Client: <span><strong><?php echo $quotation[0]['company'] ?></strong></span></p>
               </div>
            </div>
            <?php
            $amount = 0;
            $page_break_class = '';
            for ($i = 0; $i < count($quotation); $i++) {
               if ($i > 1 && $i % 6 == 0) {
                  $page_break_class = ' page-break';
               }
               if ($i % 3 == 0) {
            ?>
                  <div class="<?php echo "row" . $page_break_class ?>">
                  <?php
               }
               if (!empty($quotation[$i])) {
                  $amount += $quotation[$i]['total'] - $quotation[$i]['tax'];
                  if ($i % 3 == 1) {
                     $class = "col-lg-4 second-div";
                  } else {
                     $class = "col-lg-4 ";
                  } ?>
                     <div class="<?php echo $class; ?>">
                        <div>
                        <?php if ($quotation[$i]['type'] == 'Music') { ?>
                            <img src="<?php echo $quotation[0]['music_image']; ?>" alt="photo-gallery" width="200" height="108">
                            <?php }else{ ?>
                            <img src="<?php echo $quotation[$i]['product_image']; ?>" alt="photo-gallery" width="200" height="108">
                        <?php }?>

                        </div>
                        <?php if (!empty($quotation[$i]['product_id'])) {
                           echo '<p>Image ID: ' . $quotation[$i]['product_id'] . '</p>';
                        } else {
                           echo '<p><br></p>';
                        }  ?>
                        <p>Size: <?php echo $quotation[$i]['product_size'] ?></p>
                        <p>Cost: <span><strong>INR <?php echo number_format($quotation[$i]['subtotal'], 2) ?>/-</strong></span></p>
                     </div>
                  <?php
               }
               if ($i % 3 == 0) {
                  ?>
                  </div>
            <?php
               }
            }
            ?>
            <?php
            $break_amount_div = '';
            if (count($quotation) > 3 && count($quotation) < 7) {
               $break_amount_div = 'page-break';
            } ?>
            <div class="<?php echo 'row mb-0 amount-divs-row ' . $break_amount_div; ?>">
               <div class="col-lg-12 amount-divs">
                  <div class="start">Amount (INR)</div>
                  <div class="end"><strong><?php echo number_format(($quotation[0]['total'] - $quotation[0]['tax']), 2) ?></strong></div>
               </div>
            </div>
            <?php if (!empty($quotation[0]['tax'])) {
            ?>
               <div class="row mb-0 amount-divs-row">
                  <div class="col-lg-12 amount-divs">
                     <div class="start">Add: GST @ <?php echo config('constants.GST_VALUE') ?>%</div>
                     <div class="end"><strong><?php echo $quotation[0]['tax']; ?></strong></div>
                  </div>
               </div>
            <?php }
            ?>
            <div class="row mb-0 amount-divs-row">
               <div class="col-lg-12 amount-divs">
                  <div class="start">Total Invoice Amount (INR)</div>
                  <div class="end"><strong><?php echo number_format($quotation[0]['total'], 2) ?></strong></div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12 single-gray-block">
                  <p>In words: <strong>Rupees<?php echo $amount_in_words.' only' ?></strong></p>
               </div>
            </div>
            <div class="licensing-terms">
               <h2 class="h3"><strong>Payment Instructions:</strong></h2>
               <div class="licensing-condition">
                  <ul>
                     <li>License Rights are only assigned on payment of this invoice.</li>
                     <li>Payment should be made Immediate from the date of download of the image(s) and can be sent to:
                        <span><strong><?php config('constants.company_name')?>,</strong></span>
                        c/o Conceptual Pictures Worldwide Pvt. Ltd., 3rd Floor, R5 Chambers, Opposite Pillar No. 2, Humayun Nagar, Mehdipatnam – Hyderabad – 500028, Telangana.
                     </li>
                     <li>
                        If not paid within credit period allowed, <span><strong>interest @ 24%</strong></span> will be charged.
                     </li>
                     <li>Payment can be made in favour of <span><strong>Conceptual Pictures Worldwide Pvt. Ltd..</strong></span>
                     </li>
                  </ul>
                  <ol>
                     <li>Through A/c. Payee Cheques/DD payable at Hyderabad</li>
                     <li> RTGS/NEFT to <span><strong>A/c. No. 50200000502220, HDFC Bank Ltd</strong></span>, Vijay Nagar Branch,
                        Hyderabad
                        IFSC Code: <span><strong>HDFC0001998</strong></span>.</li>
                  </ol>
                  <ul>
                     <li>Goods once sold cannot be replaced or returned.</li>
                     <li>Acknowledgement of the Invoice will be deemed as acceptance of this bill in full unless we receive a written communication to the contrary within 7 days of the invoice date.</li>
                     <li>All disputes are subject to Hyderabad Jurisdiction.</li>
                  </ul>
               </div>
            </div>
         </div>
      </section>
      <!-- Table paragraph section end -->
      <!-- Signature section start -->
      <section class="signature">
         <div class="container">
            <p>For <span><?php config('constants.company_name')?></span></p>
            <img src="<?php echo $quotation[0]['signature']; ?>" alt="signature" width="171" height="89">
            <p>Authorized Signatory</p>
         </div>
      </section>
      <!-- Signature section end -->
   </main>
</body>

</html>
