<style>
    /* * {
        font-size: 10px;
        
    } */
   @media print{
  @page {
    size: auto;   /* auto is the initial value */
    size: A4 portrait;
    margin: 0;  /* this affects the margin in the printer settings */
    border: 1px solid red;  /* set a border for all printed pages */
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
    .bordered td  p {
        font-size: 12px;
        margin: 0px;  
        padding: : 0px; 

    }

    .bordered td ul li{
        font-size: 11px;
        margin: 0px;  
        padding: : 0px;  
    }

    ul { margin: 3; }
    
    table {
        /*border-collapse: collapse;*/
    }
    
    /* Para sobrescribir lo que está en div-table.css */
    .divTableCell,
    .divTableHead {
        padding: 0px !important;
        border: 0px !important;
    }
    </style>
 <div class="divTable">
        <div class="divTableBody">
            <div class="divTableRow">
            <table class="bordered width-100pc" width="100%" align="center">
                    <tbody>
                        <tr>
                            <td width="50%" style="border: none;">
                                <h1 style="font-size: 50px; margin-bottom: -25px">hi </h1><h2>THIS IS AN ESTIMATE</h2>
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
              <table class="bordered width-100pc" width="100%" align="center" style="border-style: double; border-width: 5px;">
               <tbody>
               <tr>
                 <td width="50%">
                   <p>Customer Name:&nbsp;<strong><?php echo $orders['first_name'] ?> <?php echo $orders['last_name'] ?></strong>&nbsp;</p>
                   <p>Address:&nbsp;<strong> <?php echo $orders['address'] ?></strong></p>
                   <p><strong><?php echo $orders['cityname'] ?>&nbsp;&nbsp;  <?php echo $orders['statename'] ?>&nbsp;&nbsp;<?php echo $orders['postal_code'] ?></strong></p>
                   <p>Phone:&nbsp;<strong><?php echo $orders['mobile'] ?></strong>&nbsp;</p>
                   <p>GST:&nbsp;<strong><?php echo $orders['gst'] ?></strong>&nbsp;</p>
                   <p>PAN:&nbsp;<strong><?php echo $orders['pan'] ?></strong>&nbsp;</p>
                 </td>

                 <td width="50%">
                   <p>Estimate Number &nbsp;No.:&nbsp;<strong><?php echo "Q".$orders['invoice_name'] ?></strong>&nbsp;</p>
                   <p>Estimate Date &nbsp;:&nbsp;<strong><?php echo date("F , d Y h:i:s a",strtotime($orders['invicecreted'])) ?></strong>&nbsp;</p>
                   <p> &nbsp;&nbsp;<strong><?php //echo date("F , d Y h:i:s a",strtotime($orders['package_expiry_date_from_purchage'])) ?></strong>&nbsp;</p>
                   <p>Place:&nbsp;<strong><?php echo $orders['statename']?> &ndash; <?php echo $orders['countryname'] ?></strong>&nbsp;</p>
                 </td>
               </tr>
               <tr>
               <td>
               </br>
               <p><strong></strong>&nbsp;</p>
               </td>
               <td>
               <p>Product&nbsp;Description:&nbsp;&nbsp;<br /><strong></strong><strong> 
               <?php 
               if($orders['package_plan']==1){
                  $plan = 'Download Pack For 1 year';
               }else{
                  if ($orders['package_expiry_yearly'] == 0) {
                     $plan = 'Subscription Pack For 1 Month';
                  } else {
                     $plan = 'Subscription Pack For 1 Year';
                  }
               }
               if ($orders['package_type'] != 'Image') {
                  if($orders['pacage_size']==1){
                     echo $orders['package_name']." HD ".$plan;
                  }else{
                     echo $orders['package_name']." 4K ".$plan;
                  }
               }else{
                  echo $orders['package_name']." ".$plan;
               }
               ?>
               </strong>
                Quantity:&nbsp;1<?php //echo $orders['package_products_count'] ?>
               </p>
               </td>
               </tr>
               <tr>
                    <td colspan="2">
                    <p><strong>Amount (INR) :- <?php echo number_format($orders['package_price'], 2) ?></strong>&nbsp;</p>
                    </td>
                </tr>
                @if(!empty($orders['tax']))
                <tr>
                    <td colspan="2">
                    <p><strong>GST extra&nbsp; <?php echo number_format($orders['tax'], 2) ?></strong>&nbsp;</p>
                    </td>
                </tr>
                @endif  
                <tr>
                    <td colspan="2">
                    <p><strong>Total Invoice Amount (INR) :- <?php echo number_format($orders['total'], 2) ?></strong>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <p><strong>In words Total Amount :- Rupees <?php echo $amount_in_words ?> ONLY </strong>&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <p><strong>In words Package Amount :- Rupees <?php echo $package_price_in_words ?> ONLY </strong>&nbsp;</p>
                    </td>
                </tr>
               <tr>
               <td colspan="2">
               </br>
               <p><a href="http://about:blank/"><strong>S</strong><strong>tandard</strong><strong>&nbsp;Team Licensing Terms</strong></a><a href="http://about:blank/"><strong>:</strong></a>&nbsp;
               &nbsp;<br /><strong>With&nbsp;</strong><strong>a </strong><strong>Standard</strong><strong>&nbsp;license, you may:</strong>&nbsp;</p>
               <ul>
               <li>Reproduce up to 500,000 copies of the asset in product packaging, printed marketing materials, digital documents, or software.&nbsp;</li>
               
               <li>Include the asset in email marketing, mobile advertising, or a broadcast program if the expected number of viewers is fewer than 500,000.&nbsp;</li>
               
               <li>Post the asset to a website with no limitation on viewers. If the asset is used in an editorial manner, attribution is required in this format (&copy; Author Name - stock.adobe.com).&nbsp;</li>
             
               <li>Include the asset in products in a minor way, such as in a textbook.&nbsp; &nbsp;</li>
               </ul>
               <p><strong>With a&nbsp;</strong><strong>Standard</strong><strong>&nbsp;license, you may not:</strong>&nbsp;</p>
               <ul>
               <li>Create merchandise or products for resale or distribution where the main value of the product is associated with the asset itself. For example, you can't use the asset to create a poster, t-shirt, or coffee mug that someone would buy specifically because of the asset printed on it.&nbsp;</li>
               </ul>
               <p>&nbsp;<strong>Credit Packs</strong>&nbsp;</p>
               <ul>
               <li>Credits can be used to license any content on Adobe Stock. Different asset types have different credit costs. If you want many standard images, standard templates, or standard 3D assets, you can buy a standard subscription.</li>
               
               <li>For premium images, HD videos, 4K videos, and Editorial, credit costs may vary.</li>
               
               <li>Unused credits expire after one year from date of purchase</li>
               </ul>
               <p><strong>Enhanced Team Licensing Terms:</strong>&nbsp;</p>
               <ul>
                <li>
               <p>Enhanced licenses are available for Adobe Stock Premium collection images, videos, templates, editorial and 3D assets.</p></li>
             </ul>
               <p><strong>With an Enhanced license, you may:</strong></p>
               <ul>
               <li>Use the asset with all the rights granted in a Standard license.</li>
               
               <li>Reproduce the asset beyond the 500,000 copy/viewer restriction.</li>
               </ul>

               <p><strong>With an Enhanced license, you may not:</strong></p>
               <ul>
               <li>Create merchandise or products for resale or distribution where the main value of the product is associated with the asset itself. For example, you can't use the asset to create a poster, t-shirt, or coffee mug that someone would buy specifically because of the asset printed on it.</li>
               </ul>
               <p>&nbsp;<strong>Terms of&nbsp;</strong><strong>Payment:</strong>&nbsp;</p>
               <ul>
               <li>License Rights are only assigned on&nbsp;issuance of a&nbsp;<strong>Purchase Order</strong>&nbsp;and&nbsp;<strong>Upfront Commitment</strong>.&nbsp;</li>
               
               <li>Payment can be made in favour of&nbsp;<strong>M/s. Conceptual Pictures Worldwide Private Limited</strong>.&nbsp;<br />A. Through&nbsp;A/c.&nbsp;Payee Cheques/DD payable at Hyderabad&nbsp;<br />B.&nbsp;&nbsp;RTGS/NEFT to&nbsp;<strong>A/c. No. 50200000502220</strong>,&nbsp;<strong>HDFC Bank Ltd</strong>, Vijay Nagar Branch, Hyderabad&nbsp;<br />IFSC Code:&nbsp;<strong>HDFC0001998</strong>.&nbsp;</li>
              
               <li>For online payments please click the link below<br>
                   <p><a href="<?php echo $orders['payment_url']; ?>" target="_blank" style="font-size: 14px;color:Red;">Payment Link</a></p>
                </li>


               <li>All disputes are subject to Hyderabad Jurisdiction.&nbsp;</li>
               </ul>

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
                              <p style="text-align: center;"><strong>This is computer generated Quotation.</strong>&nbsp;</p>
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
                                    Chambers, Near Sarojini Devi Hospital, Humayun Nagar,&nbsp;<br/>Hyderabad -
                                    500028,&nbsp;Telangana,&nbsp;Andhra&nbsp;Pradesh, India&nbsp;Phone: +91 40 6720 6720 Fax +91 40
                                    6673 8077&nbsp;</p>
                                <p><a href="http://about:blank/">info@imagefootage.com</a> &nbsp;&nbsp;&nbsp;&nbsp;<a
                                        href="http://about:blank/">www.imagefootage.com</a>&nbsp;</p>
                            </td>
                            <td width="50%" style="border: none;float: right;">
                                <p style="float: right; font-size: 25px;"><strong>LOOKING</strong>&nbsp;<br /><strong>FORWARD</strong>&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    