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
               <h2 class="h4"><strong>Image Footage</strong></h2>
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
   <main>
      <!-- Table paragraph section start -->
      <section class="table-paragraph">
         <div class="container">
            <div class="client-info-top">
               <div class="client-info-leftside">
                  <p>Customer Name: <span><strong><?php echo $orders['user']['first_name'] ?> <?php echo $orders['user']['last_name'] ?></span></strong></p>
                  <p>Address: <span><strong><?php echo $orders['bill_address1'] ?><?php echo $orders['city']['name'] ?>&nbsp;&nbsp; <?php echo $orders['state']['state'] ?>&nbsp;&nbsp; -<?php echo $orders['bill_zip'] ?></strong></span>
                  </p>
                  <p>Phone: <span><strong><?php echo $orders['user']['mobile'] ?></strong></span></p>
                  <p>GSTIN: <span><strong><?php echo substr($orders['user']['gst'], 0, 2) ?>XXX<?php echo substr($orders['user']['gst'], 5, 10) ?></strong></span></p>
                  <p>PAN: <span><strong>XXX<?php echo substr($orders['user']['pan'], 3, 7) ?></strong></span></p>
               </div>
               <div class="client-info-rightside">
                  <p>Invoice No.: <span><strong><?php echo config('constants.INVOICE_PREFIX') ?></span></strong></p>
                  <p>Invoice Date: <span><strong><?php echo date("d.m.Y ", strtotime($orders['created_at'])) ?></strong></span></p>
                  <p>GSTIN: <span><strong><?php echo config('constants.GSTIN_VALUE') ?></strong></span></p>
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
                  <table width="100%" class="table taxpdf" style="border-collapse: collapse; ">
                  <tbody>
                  <tr class="rr2">
                  <td colspan="2">
                     <div class="qoutedeail" style="text-align: left;">
                        <h2 style="margin-bottom: 10px; padding: 0px 12px; ">Product Details</h2>
                        <table width="100%">
                           <thead style="text-align: left;">

                           </thead>
                           <tbody>
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
									 <th colspan="4" style="background: #eff1e6; padding: 16px 12px; text-align: left; border-top: 2px solid grey;">
										<p style="margin: 0px; font-weight: bold; font-size:16px;"><?php echo $value['product']['product_id']  ?></p>
										<p style="margin: 0px;font-weight: lighter;">
										 <?php echo $protype; ?>
										</p>
									 </th>
								  </tr>
						<tr>
							<td width="20%"  style="vertical-align: top; padding: 5px 20px; text-align: center;">
                               <?php if($value['product_web']=='2'){ ?>
                                <a href="javascript:void(0)" >
                                    <img src="<?php echo $value['product_thumb']; ?>" alt="product-img" width="200" height="150"/>
                                </a>
                                <?php
                               }else if($value['product_web']=='3'){ ?>
                                <a href="javascript:void(0)">
                                <img src="<?php echo $value['product_thumb']; ?>" alt="product-img" width="200" height="150"/>
                                </a>
                                <?php } if($value['product_web']=='4'){ ?>
                                <a href="javascript:void(0)" >
                                    <img src="<?php echo $value['product_thumb']; ?>" alt="product-img" width="200" height="150"/>
                                </a>
                                <?php
                               }?>
							</td>
									 <td colspan="2" width="50%">
										<table width="100%" style="font-size:12px;">
										<tr>
                                <?php if(isset($value['standard_size']) && !empty($value['standard_size'])){ ?>
											  <td style="text-align: right; font-weight: bold;">Product size:</td>
                                   	<td><?php echo $value['standard_size']; }?></td>
										   </tr>



									</table>
									 </td>
									 <td width="25%" style="vertical-align: top; text-align: right; font-size: 18px;">
										<p style="margin: 0px; text-align: right; font-weight: bold; " ><strong>Price:</strong></p>
                              <?php if($value['product_web']=='4'){ ?>
                                 <p style="margin: 0px; text-align: right;  font-weight: bold;"><strong>Rs. <?php echo $value['total']  ?></strong></p>
                              <?php } else{ ?>
										<p style="margin: 0px; text-align: right;  font-weight: bold;"><strong>Rs. <?php echo $value['standard_price']  ?></strong></p>
                              <?php }?>

									 </td>
								  </tr>

                              <?php } ?>
							<tr>
                                 <td colspan="4">
                                    <table width="100%" style="border-top: 2px solid #9e9e9e; background: #eff1e6; padding: 15px;">
                                       <tr>
                                          <td colspan="2" width="80%"  style="text-align: right;  background: #eff1e6; ">Subtotal:</td>
                                          <td width="20%" style="text-align: right;  background: #eff1e6; "> Rs. <?php  echo $subtotalarray?></td>
                                       </tr>
                                        <tr>
                                            <td colspan="2" width="80%"  style="text-align: right;  background: #eff1e6; ">Tax:</td>
                                            <td width="20%" style="text-align: right;  background: #eff1e6; "> Rs. <?php  echo $orders['tax'] ?></td>
                                        </tr>

                                            <tr>
                                          <td colspan="2" width="80%" style="text-align: right; ">Total:</td>
                                          <td  width="20%" style="text-align: right; "> Rs. <?php  echo $orders['order_total']?></td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                              <tr>

                              <td colspan="4" style="font-size: 12px;">
                                    <p style="margin: 0px;"><span>Note:</span> Any Sales tax included in this quote is an estimation and may change at the time of purchase. sales tax may be applied to your order in accordance with apllicable state and local tax laws.</p>
                                    <p style="margin: 0px;"><span>Note:</span> To review our licensing policy online, please visit our</p>
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
                     <li>Payment should be made Immediate from the date of download of the image(s) and can be sent to:
                        <span><strong>Image Footage,</strong></span>
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
            <p>For <span>Image Footage</span></p>
            <img src="<?php echo $orders['signature']; ?>" alt="signature" width="171" height="89">
            <p>Authorized Signatory</p>
         </div>
      </section>
      <!-- Signature section end -->
   </main>
</body>

</html>
