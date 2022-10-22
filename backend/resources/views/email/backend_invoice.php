<html>
   <head>
      <title>Quotataion invoice</title>
      <style>
         /* * {
            font-size: 10px;
            
         } */
         @media print {
            @page {
                  size: auto;
                  /* auto is the initial value */
                  size: A4 portrait;
                  margin: 0;
                  /* this affects the margin in the printer settings */
                  border: 1px solid red;
                  /* set a border for all printed pages */
            }
         }

         th {
            background-color: #f7f7f7;
            border-color: #959594;
            border-style: solid;
            border-width: 1px;
            text-align: center;
         }

         .bordered td {
            border-color: #959594;
            border-width: 4px;

         }

         .bordered td p {
            font-size: 12px;
            margin: 0px;
            padding: 0px;

         }

         .bordered td ul li {
            font-size: 11px;
            margin: 0px;
            padding: 0px;
         }

         ul {
            margin: 3;
         }

         table {
            /*border-collapse: collapse;*/
            table-layout: fixed;
         }
         .bgtdleft {
            background: #d2d2d2;
            text-align: left;
         }
         .bgtdright {
            background: #d2d2d2;
            text-align: right;
         }

         /* Para sobrescribir lo que está en div-table.css */
         .divTableCell,
         .divTableHead {
            padding: 0px !important;
            border: 0px !important;
         }
      </style>
   </head>
   <body>
      <div class="divTable">
         <div class="divTableBody">
            <div class="divTableRow">
               <table class="bordered width-100pc" width="100%" align="center">
                  <tbody>
                     <tr>
                           <td width="50%" style="border: none;">
                              <h1 style="font-size: 50px; margin-bottom: -25px">hello </h1>
                              <h2>THIS IS YOUR TAX INVOICE</h2>
                           </td>
                           <td width="50%" style="border: none;">
                              <p style="float:right;"><img src="https://imagefootage.com/assets/images/IF_Logo_Final.png"
                                       width="200px"></p>
                           </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="divTableRow">
               <table class="bordered width-100pc" width="100%" align="center"
                  style="border-style: double; border-width: 5px;">
                  <tbody>
                     <tr>
                           <td colspan="2" width="304">
                              <p>Customer Name: <strong><?php echo $quotation[0]['first_name'] ?> <?php echo $quotation[0]['last_name']?></strong></p>
                              <p>Address: <strong><?php echo $quotation[0]['address'] ?> </strong><?php echo $quotation[0]['cityname'] ?>&nbsp;&nbsp;  <?php echo $quotation[0]['statename'] ?>&nbsp;&nbsp; - <?php echo $quotation[0]['postal_code'] ?></p>
                              <p>Phone: <strong><?php echo $quotation[0]['mobile'] ?></strong></p>
                              <p>GSTIN: <strong><?php echo substr($quotation[0]['gst'], 0, 2) ?>XXX<?php echo substr($quotation[0]['gst'], 5, 10) ?></strong></p>
                              <p>PAN: <strong>XXX<?php echo substr($quotation[0]['pan'], 3, 7) ?></strong></p>
                              <br/>
                           </td>
                           <td colspan="2" width="304">
                              <p>Invoice No.: <strong><?php echo "Q".$quotation[0]['invoice_name'] ?></strong></p>
                              <p>Invoice Date: <strong><?php echo date("d.m.Y ",strtotime($quotation[0]['invicecreted'])) ?></strong></p>
                              <p>GSTIN: <strong>36AAFCC2629B1Z3</strong></p>
                              <p>PAN No.: <strong>AAFCC2629B</strong></p>
                              <p>SAC Code: <strong>997339</strong></p>
                              <p>Place: <strong>Hyderabad - Telangana </strong></p>
                              <p>Payment Due: <strong>Immediate</strong></p>
                              <br/> <br/>
                           </td>
                     </tr>
                     <tr>
                        <td colspan="2" width="302">
                           <p>Kind Attention: <br /> <strong><?php echo $quotation[0]['first_name'] ?> <?php echo $quotation[0]['last_name'] ?></strong><br /></p>
                        </td>
                        <td colspan="2" width="304">
                           <?php if(!empty($po) && !empty($po_date)) { ?>
                              <p>Purchase Order No. <?php echo $po; ?> dated <?php echo $po_date; ?></p>     
                           </php } ?>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2" width="302">
                           <p>Total number of image(s)/footage(s): <br/> <strong> <?php echo count($quotation); ?>
                           </strong></p>
                           <br/>
                           <br/>
                        </td>   
                        <td colspan="2" width="304">
                           <p>IF Sales Representative: Ashmita (capture from CRM)</p>
                           <p>Client: L&T Parel Project LLP</p>
                        </td>
                     </tr>
                     <tr>
                        <?php foreach($quotation as $k=>$value) { ?>
                           <td width="150">
                              <img src="<?php echo $value['product_image'] ?>" alt="image" width="140px" height="150px">
                              <p>Image ID: <?php echo $value['product_id'] ?></p>
                              <p>Size: <?php echo $value['product_size'] ?></p>
                              <p>Cost: <strong>INR <?php echo number_format($value['subtotal'], 2) ?>/-</strong></p>
                           </td>
                        <?php if(($k+1)%4 == 0) { ?>
                                 </tr><tr>
                              <?php }
                           } ?>
                     </tr>
                     <tr>
                        <td colspan="2" width="302" class="bgtdleft">
                           <p>Amount (INR)</p>
                        </td>
                        <td colspan="2" width="304" class="bgtdright">
                           <p><strong> <?php echo number_format(($quotation[0]['total'] - $quotation[0]['tax']), 2) ?></strong></p>
                        </td>
                     </tr>
                        <?php if(!empty($quotation[0]['tax'])) { ?>
                           <tr>
                              <td colspan="2" width="302" class="bgtdleft">
                                 <p>Add: GST @ 12%</p>
                              </td>
                              <td colspan="2" width="304" class="bgtdright">
                                 <p><strong><?php echo number_format($quotation[0]['tax'], 2) ?></strong></p>
                              </td>
                           </tr>
                        <?php } ?>
                     <tr>
                           <td colspan="2" width="302" class="bgtdleft">
                              <p>Total Invoice Amount (INR)</p>
                           </td>
                           <td colspan="2" width="304" class="bgtdright">
                              <p><strong><?php echo number_format($quotation[0]['total'], 2) ?></strong></p>
                           </td>
                     </tr>
                     <tr>
                           <td colspan="4" width="609" class="bgtdleft">
                              <p>In words: <strong><?php echo $amount_in_words ?></strong></p>
                           </td>
                     </tr>
                     <tr>
                           <td colspan="4" width="609">
                           <p><strong>Payment Instructions:</strong></p>
                           <p>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; License Rights are only assigned on payment of this invoice</p>
                           <p>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Payment should be made Immediate from the date of download of the image(s) and can be sent to: <br /> <strong>Conceptual Pictures Worldwide Pvt Ltd</strong>, # 10-3-89, R5 Chambers, 3rd Floor, Above Mohammed Khan Jewellers Building, Opposite Pillar No. 2, Humayun Nagar, Near Sarojini Devi Eye Hospital, Mehdipatnam &ndash; Hyderabad &ndash; 500028, Telangana.</p>
                           <p>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If not paid within credit period allowed, <strong>interest @ 24%</strong> will be charged.</p>
                           <p>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Payment can be made in favour of <strong>Conceptual Pictures Worldwide Pvt Ltd</strong>.<br /> A.&nbsp; Through A/c. Payee Cheques/DD payable at Hyderabad<br /> B. &nbsp;RTGS/NEFT to <strong>A/c. No. 50200000502220</strong>, <strong>HDFC Bank Ltd</strong>, Vijay Nagar Branch, Hyderabad<br /> IFSC Code: <strong>HDFC0001998</strong>.</p>
                           <p>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Goods once sold cannot be replaced or returned.</p>
                           <p>6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Acknowledgement of the Invoice will be deemed as acceptance of this bill in full unless we receive a written communication to the contrary within 7 days of the invoice date.</p>
                           <p>7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; All disputes are subject to Hyderabad Jurisdiction.</p>
                           <p>8.For online payments please click the link below<br>
                           <a href="<?php echo $quotation[0]['payment_url']; ?>" target="_blank" style="font-size: 14px;color:Red;">Payment Link</a></p>
                           </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="divTableRow">
               <table class="bordered width-100pc" width="100%" align="center">
                  <tbody>
                     <tr>
                           <!-- <td width="50%" style="border: none;">
                                 
                              </td>  -->
                           <td width="100%" style="border: none;">
                              <p style="float: right;">For&nbsp;<strong>Image Footage</strong>&nbsp;</p>
                           </td>
                     </tr>
                     <!-- <tr>
                              <td width="50%" style="border: none;">
                                 &nbsp;
                              </td>  
                              <td width="50%" style="border: none;">
                                 <p style="float: right;">&nbsp;</p>
                              </td> 
                        </tr>  -->
                     <tr>
                           <!-- <td width="40%" style="border: none;">
                                 
                              </td>  -->
                           <td width="100%" style="border: none;">
                              <p style="text-align: center;"><strong>This is computer generated Quotation.</strong>&nbsp;
                              </p>
                           </td>
                     </tr>

                  </tbody>
               </table>
            </div>
            <div class="divTableRow">
               <table class="bordered width-100pc" width="100%" align="center">
                  <tbody>
                     <tr>
                           <td width="50%" style="border: none;">
                              <p>&nbsp;<br /><strong>Image Footage&nbsp;</strong>&nbsp;<br />3rd Floor, # 10-3-89/A/B, R-5
                                 Chambers, Near Sarojini Devi Hospital, Humayun Nagar,&nbsp;<br />Hyderabad -
                                 500028,&nbsp;Telangana,&nbsp;India&nbsp;Phone: +91 40 6720 6720 Fax
                                 +91 40
                                 6673 8077&nbsp;</p>
                              <p><a href="http://about:blank/">info@imagefootage.com</a> &nbsp;&nbsp;&nbsp;&nbsp;<a
                                       href="http://about:blank/">www.imagefootage.com</a>&nbsp;</p>
                           </td>
                           <td width="50%" style="border: none;float: right;">
                              <p style="float: right; font-size: 25px;">
                                 <strong>LOOKING</strong>&nbsp;<br /><strong>FORWARD</strong>&nbsp;</p>
                           </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </body>
</html>