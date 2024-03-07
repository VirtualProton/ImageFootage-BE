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
         /* css reset */
         * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         }
         /* common css */
         body {
         font-family: 'Lato', sans-serif;
         color: #000000;
         font-weight: 400;
         margin-bottom: 140px;
         margin-top: 140px;
         }
         .main{
            border:1px solid black;
            padding:10px
        }

         .container {
         max-width: 1200px;
         width: 100%;
         padding: 0 20px;
         /* margin: 0 auto; */
         }
         /* Header start */
         header {
         margin-left: 2cm;
         margin-right: 2cm;
         padding: 20px 0 0 0;
         bottom: 3cm;
         /* display: table; */
         }
         .header-text {
         width: 55%;
         display: inline-block;
         }
         .header-text .h1 {
         color: #595959;
         font-size: 80px;
         font-weight: 900;
         }
         .header-text span {
         text-transform: uppercase;
         font-size: 14px;
         font-weight: 900;
         letter-spacing: 1px;
         }
         .header-logo {
         width: 43%;
         display: inline-block;
         display: inline-block;
         margin-bottom: 40px;
         margin-top: -30px;
         }
         .header-logo img {
         width: 100%;
         height: auto;
         display: block;
         }
         /* Header end */
         /* Table paragraph section start */
         .table-paragraph {
         padding: 0px 0 0 0;
         border: 1px solid black;
    padding: 10px 0;
    display: table;
         }
         .table-paragraph .container>div {
         margin-bottom: 20px;
         }
         .table-paragraph .container>div:last-child {
         margin-bottom: 0px;
         }
         /* client-info start */
         .client-info-leftside {
         width: 50%;
         display: inline-block;
         }
         .client-info-leftside p,
         .client-info-rightside p {
         max-width: 350px;
         font-size: 15px;
         word-spacing: 4px;
         line-height: 22px;
         }
         .client-info-leftside p span,
         .client-info-rightside p span {
         font-weight: 900;
         }
         .block-text {
         display: block;
         }
         .client-info-rightside {
         width: 50%;
         display: inline-block;
         vertical-align: top;
         }
         .client-info-top{
            white-space: nowrap;
         }
         /* client-info end */
         /* Photo gallery start */
         .row {
         clear: both;
         }
         .col-lg-4 {
         width: 30%;
         float: left;
         background-color: rgba(211, 211, 211, 0.5);
         padding: 10px;
         text-align: center;
         margin-bottom: 0.5% !important;
         margin-top: 0 !important;
         }
         .col-lg-12 {
         width: 100%;
         padding: 10px 10px 0 10px;
         }
         .second-div {
         margin-left: 4%;
         margin-right: 0.5%;
         }
         .col-lg-4 p span {
         font-weight: 900;
         }
         .mb-0 {
         margin-bottom: 0;
         }
         .amount-divs-row {
         background-color: rgba(89, 89, 89, 0.29);
         width: 100%;
         margin-bottom: 0 !important;
         }
         .amount-divs .end {
         font-weight: 900;
         font-size: 20px;
         display: inline-block;
         width: 15%;
         }
         .amount-divs .start {
         width: 85%;
         font-size: 20px;
         display: inline-block;
         }
         .photo-gallery {
         display: inline-block;
         /* width: calc((100% - 13px)/3); */
         width: 150px;
         margin-bottom: 5px;
         background-color: rgba(211, 211, 211, 0.5);
         padding: 10px;
         text-align: center;
         margin-right: 2px;
         }
         .photo-gallery img,
         .col-lg-4 div img {
         /* width: 100%; */
         /* height: auto; */
         padding: 10px 20px;
         }
         .photo-gallery p,
         .col-lg-4 p {
         margin-bottom: 5px;
         font-size: 15px;
         }
         .photo-gallery p span,
         .col-lg-4 p span {
         font-weight: 900;
         }
         /* Photo gallery end */
         /* total-cost start */
         .total-cost {
         text-align: justify;
         }
         .total-cost>div {
         background-color: rgba(89, 89, 89, 0.29);
         }
         .total-cost p {
         width: 49.5%;
         display: inline-block;
         font-size: 20px;
         padding: 15px 10px;
         }
         .total-cost>div p:nth-child(2) {
         text-align: end;
         font-weight: 900;
         }
         /* total-cost end */
         /* licensing-terms start */
         .licensing-terms .h3 {
         font-size: 20px;
         font-weight: 900;
         color: #0563c1;
         margin-bottom: 15px;
         text-decoration: underline;
         }
         .licensing-terms .h4 {
         font-size: 18px;
         font-weight: 900;
         text-decoration: underline;
         margin-bottom: 5px;
         }
         .licensing-terms p {
         font-size: 16px;
         font-weight: 900;
         margin-bottom: 15px;
         word-spacing: 4px;
         }
         .licensing-terms ul,
         .licensing-terms ol {
         margin-left: 50px;
         margin-bottom: 20px;
         }
         .licensing-terms ol li,
         .licensing-terms ul li {
         line-height: 25px;
         }
         /* licensing-terms end */
         /* Terms-of-payment start */
         .terms-of-payment ul {
         margin-top: 15px;
         list-style-type: auto;
         }
         .terms-of-payment ul li ol {
         margin-left: 30px;
         list-style-type: upper-alpha;
         }
         .terms-of-payment span {
         font-weight: 900;
         }
         .terms-of-payment ul li a {
         font-size: 18px;
         text-transform: uppercase;
         font-weight: 900;
         letter-spacing: 1px;
         padding-left: 5px;
         }
         /* Terms-of-payment end */
         /* Table paragraph section end */
         /* Footer start */
         footer {
         padding: 20px 0 0 0;
         margin-left: 2cm;
         margin-right: 2cm;
         }
         .footer-left {
         width: 62%;
         display: inline-block;
         }
         .footer-left .h4 {
         font-size: 13px;
         font-weight: 900;
         margin-bottom: 10px;
         }
         .footer-left p {
         max-width: 350px;
         word-spacing: 4px;
         line-height: 17px;
         font-size: 12px;
         margin-bottom: 10px;
         }
         .footer-left p span {
         display: block;
         }
         .footer-left a {
         font-size: 12px;
         color: #0563c1;
         display: inline-block;
         }
         .footer-left a.info {
         margin-right: 20px;
         }
         .footer-right {
         width: 32%;
         display: inline-block;
         /* vertical-align: to; */
         padding-bottom: 30px;
         }
         .footer-right .h2 {
         color: #595959;
         font-size: 40px;
         font-weight: 900;
         text-transform: uppercase;
         }
         /* Footer end */
         .upper-case {
         text-transform: uppercase;
         }
         /* Signature section start */
         .signature {
         text-align: right;
         padding: 50px 0 0 0;
         }
         .signature p {
         font-size: 16px;
         }
         .signature p span {
         font-size: 20px;
         font-weight: 900;
         }
         .signature img {
         width: 110px;
         height: auto;
         margin: 7px 0;
         }
         /* Signature section end */
         .single-gray-block {
         padding: 5px 10px;
         font-size: 20px;
         background-color: rgba(89, 89, 89, 0.29);
         }
         .page-break {
         page-break-before: always
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
               <img src="<?php echo $orders['company_logo']; ?>" alt="logo" width="1920" height="351">
            </div>
         </div>
      </header>
      <!-- Header end -->
      <!-- Footer start -->
      <footer>
         <div class="container">
            <div class="footer-left">
               <h2 class="h4"><strong><?php config('constants.company_name')?></strong></h2>
               <p>3rd Floor, # 10-3-89/A/B, R-5 Chambers, Near Sarojini Devi Hospital, Humayun Nagar, Hyderabad -
                  500028, Telangana, Andhra Pradesh, India Phone: +91 40 6720 6720 <span> Fax +91 40 6673 8077</span>
               </p>
               <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
            </div>
            <div class="footer-right">
               <h3 class="h2">THANK YOU</h3>
            </div>
         </div>
      </footer>
      <!-- Footer end -->
      <!-- Wrap the content of your PDF inside a main tag -->
      <main class="main">
         <!-- Table paragraph section start -->
         <section class="table-paragraph">
            <div class="container">
               <div class="client-info-top">
                  <div class="client-info-leftside">
                     <p>Customer Name: <span><strong><?php echo $orders['user']['first_name'] ?> <?php echo $orders['user']['last_name'] ?></span></strong></p>
                     <p>Address: <span><strong><?php echo $orders['bill_address1'] ?><?php echo $orders['city']['name'] ?>&nbsp;&nbsp; <?php echo $orders['state']['state'] ?>&nbsp;&nbsp; -<?php echo $orders['bill_zip'] ?></strong></span>
                  </p>
                  <p>Mobile: <span><strong><?php echo $orders['user']['mobile'] ?></strong></span></p>
                  <p>GSTIN: <span><strong><?php echo $orders['user']['gst']?></strong></span></p>
                  <p>PAN: <span><strong>XXX<?php echo $orders['user']['pan'] ?></strong></span></p>
                  </div>
                  <div class="client-info-rightside">
                  <p>Invoice No.: <span><strong><?php echo config('constants.INVOICE_PREFIX') ?></span></strong></p>
                  <p>Invoice Date: <span><strong><?php echo date("d.m.Y ", strtotime($orders['created_at'])) ?></strong></span></p>
                  <p>GSTIN: <span><strong><?php echo config('constants.GSTIN_VALUE')?></strong></span></p>
                  <p>PAN No.: <span><strong><?php echo config('constants.PAN_VALUE') ?></strong></span></p>
                  <p>SAC Code: <span><strong><?php echo config('constants.SAC_CODE') ?></strong></span></p>
                  <p>Place: <span><strong><?php echo config('constants.QI_ADDRESS') ?></strong></span></p>
                  <p>Payment Due: <span><strong>Online</strong></span></p>
                  </div>
               </div>
               <div class="client-info-bottom">
                  <div class="client-info-leftside">
                  <p>Kind Attention: <span class="block-text"><strong><?php echo $orders['user']['first_name'] ?> <?php echo $orders['user']['last_name'] ?></strong></span></p>
                  </div>
                  <div class="client-info-rightside">
                  <p>Purchase Order No.: <span class="block-text"><strong><?php echo $orders['id'] ?></strong></span></p>
                  <p>dated <span><strong><?php echo date("d.M.Y", strtotime($orders['order_date'])); ?></strong></span></p>
                  </div>
               </div>
               <div class="client-info-bottom">
                  <div class="client-info-leftside">
                  <p>Total number of image(s)/footage(s): <span class="block-text"><strong><?php echo count($orders['items']); ?></strong></span></p>
                  </div>
                  <div class="client-info-rightside">
                  <p>IF Sales Representative: <span class="block-text"><strong>Admin</strong></span></p>
                  <p>Client: <span><strong><?php echo $orders['user']['company'] ?></strong></span></p>
                  </div>
               </div>
               <div class="row">
                  <table width="100%" class="table taxpdf" style="border-collapse: collapse;">
                     <tbody>
                        <tr class="rr2">
                           <td colspan="2">
                              <div class="qoutedeail" style="text-align: left;">
                                 <h2 style="margin-bottom: 10px; padding: 0px 12px; ">Product Details</h2>
                                 <table width="100%" style="border-collapse: collapse;">
                                    <thead style="text-align: left;">
                                    </thead>
                                    <tbody>

                                       <tr>
                                          <th colspan="4"
                                             style="background: #F7FBFF; padding: 16px 12px; text-align: left; border-top: 1px solid #ddd;">

                                          </th>
                                       </tr>
                                       <?php
                                    $subtotalarray = 0;
                                    foreach($orders['items'] as $value){
                                    if($value['product_web']=='4'){
                                    $subtotalarray = $subtotalarray+$value['total'];
                                    }else{
                                    $subtotalarray = $subtotalarray+$value['standard_price'];
                                    }
                                    $protype=$value['product']['product_main_type']; ?>
                                       <tr>
                                          <td width="50%"
                                             style="vertical-align: top; padding:10px 10px; text-align: left; border-bottom: #ddd solid 1px;">
                                             <p style="margin: 0px; font-weight: bold; font-size:16px;">
                                             <?php echo $value['product']['product_id']  ?>
                                             </p>
                                             <p style="margin: 0px;font-weight: lighter;">
                                             <?php echo $protype; ?>
                                             </p>
                                             <a href="javascript:void(0)" style="padding-top: 12px; display: block;">
                                             <img src="<?php echo $value['product_thumb']; ?>" alt="product-img" width="200"
                                                height="150" style="object-fit: contain;" />
                                             </a>
                                          </td>
                                          <td colspan="2" width="50%"
                                             style="font-size:12px; border-bottom: #ddd solid 1px; padding:10px 10px">
                                             <table width="100%" style="font-size:12px;">
                                                <tr>
                                                   <td style="text-align: left; padding-bottom: 2px;">
                                                      <strong>Product size</strong>: <span><?php echo $value['standard_size']; ?></span>
                                                   </td>
                                                   <td></td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; padding-bottom: 2px;">
                                                      <p
                                                         style="margin: 0px; text-align: left; ">
                                                         <strong>Price:</strong> <span>Rs.
                                                         <?php echo $value['standard_price']  ?></span>
                                                      </p>
                                                   </td>
                                                </tr>
                                             </table>
                                          </td>
                                       </tr>
                                       <?php } ?>



                                       <tr>
                                          <td colspan="4">
                                             <table width="100%"
                                                style=" background: #F7FBFF; padding: 15px;">
                                                <tr>
                                                   <td colspan="2" width="80%"
                                                      style="text-align: right;  background: #F7FBFF; ">
                                                      Subtotal:
                                                   </td>
                                                   <td width="20%"
                                                      style="text-align: right;  background: #F7FBFF; ">
                                                      Rs. <?php  echo $subtotalarray?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td colspan="2" width="80%"
                                                      style="text-align: right;  background: #F7FBFF; ">
                                                      Tax:
                                                   </td>
                                                   <td width="20%"
                                                      style="text-align: right;  background: #F7FBFF; ">
                                                      Rs.  <?php  echo $orders['tax'] ?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td colspan="2" width="80%" style="text-align: right; ">
                                                      Total:
                                                   </td>
                                                   <td width="20%" style="text-align: right; "> Rs.<?php  echo $orders['order_total']?>
                                                   </td>
                                                </tr>
                                             </table>
                                          </td>
                                       </tr>
                                       <tr>
                                       <td colspan="4" style="font-size: 16px;">
                                        <p style="margin: 0px;"><span>In words:</span><strong><?php echo 'Rupees '.$amount_in_words.' only';?></strong>
                                            </p>
                                       </td>
                                       </tr>
                                       <br/>
                                       <tr>
                                          <td colspan="4" style="font-size: 12px;">
                                             <p style="margin: 0px;"><span>Note:</span> Any Sales tax
                                                included in this quote is an estimation and may change at
                                                the time of purchase. sales tax may be applied to your order
                                                in accordance with apllicable state and local tax laws.
                                             </p>
                                             <p style="margin: 0px;"><span>Note:</span> To review our
                                                licensing policy online, please visit our
                                             </p>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="licensing-terms">
                  <h2 class="h3"><strong>Payment Instructions:</strong></h2>
                  <div class="licensing-condition">
                     <ul>
                        <li>License Rights are only assigned on payment of this invoice.</li>
                        <li>Payment should be made Immediate from the date of download of the image(s) and can be
                           sent to:
                           <span><strong><?php config('constants.company_name')?>,</strong></span>
                           c/o Conceptual Pictures Worldwide Pvt. Ltd., 3rd Floor, R5 Chambers, Opposite Pillar No.
                           2, Humayun Nagar, Mehdipatnam – Hyderabad – 500028, Telangana.
                        </li>
                        <li>
                           If not paid within credit period allowed, <span><strong>interest @ 24%</strong></span>
                           will be charged.
                        </li>
                        <li>Payment can be made in favour of <span><strong>Conceptual Pictures Worldwide Pvt.
                           Ltd..</strong></span>
                        </li>
                     </ul>
                     <ol>
                        <li>Through A/c. Payee Cheques/DD payable at Hyderabad</li>
                        <li> RTGS/NEFT to <span><strong>A/c. No. 50200000502220, HDFC Bank Ltd</strong></span>,
                           Vijay Nagar Branch,
                           Hyderabad
                           IFSC Code: <span><strong>HDFC0001998</strong></span>.
                        </li>
                     </ol>
                     <ul>
                        <li>Goods once sold cannot be replaced or returned.</li>
                        <li>Acknowledgement of the Invoice will be deemed as acceptance of this bill in full unless
                           we receive a written communication to the contrary within 7 days of the invoice date.
                        </li>
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
               <img src="<?php echo $orders['signature']; ?>" alt="signature" width="171" height="89">
               <p>Authorized Signatory</p>
            </div>
         </section>
         <!-- Signature section end -->
      </main>
   </body>
</html>
