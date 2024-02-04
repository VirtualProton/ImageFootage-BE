<style>
    /* * {
        font-size: 12px;

    } */
    @media print {
    @page {
        size: A4;
        margin: 5px;
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
        border-style: solid;
        border-width: 1px;

    }
    .bordered td  p {
        font-size: 12px;
    }

    .bordered td ul li{
        font-size: 12px;
    }

    table {
        border-collapse: collapse;
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
            <table class="bordered width-100pc" width="100%">
                    <tbody>
                        <tr>
                            <td width="50%" style="border: none;">
                                <h1>hi <br/>Invoice</h1>
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
              <table class="bordered width-100pc" width="100%">
               <tbody>
               <tr>
               <td>
               <p>Customer Name:&nbsp;<strong><?php echo $orders['user']['first_name'] ?> <?php echo $orders['user']['last_name'] ?></strong>&nbsp;</p>
               <p>Address:&nbsp;<strong> <?php echo $orders['user']['address'] ?></strong></p>
               <p><strong><?php echo $orders['user']['city']['name'] ?>&nbsp;&nbsp;  <?php echo $orders['user']['state']['state'] ?>&nbsp;&nbsp;<?php echo $orders['user']['postal_code'] ?></strong></p>
               <p>Phone:&nbsp;<strong><?php echo $orders['user']['phone'] ?></strong>&nbsp;</p>
               </td>
               <td>
               <p>Transaction ID &nbsp;No.:&nbsp;<strong><?php echo $orders['transaction_id'] ?></strong>&nbsp;</p>
               <p>Transaction Date &nbsp;:&nbsp;<strong><?php echo date("F , d Y h:i:s a",strtotime($orders['created_at'])) ?></strong>&nbsp;</p>
               <p>Plan Expiry Date &nbsp;:&nbsp;<strong><?php echo date("F , d Y h:i:s a",strtotime($orders['package_expiry_date_from_purchage'])) ?></strong>&nbsp;</p>
               <p>Place:&nbsp;<strong><?php echo $orders['user']['state']['state'] ?> &ndash; <?php echo $orders['user']['country']['name'] ?></strong>&nbsp;</p>
               </td>
               </tr>
               <tr>
               <td>
               <p><strong>Online</strong>&nbsp;</p>
               </td>
               <td>
               <p>Product&nbsp;Description:&nbsp;&nbsp;<br /><strong>Subscription Plan</strong><strong>
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
               </strong>&nbsp;</p>
               </td>
               </tr>
               <tr>
               <td>
               <ul>
               <li>
               <strong> <?php echo $orders['package_name']." ".$plan; ?><br />
               Quantity:&nbsp;<?php  echo $orders['package_products_count'] ?> <br /></li>
               </ul>
               </td>
               <td>
               <p><strong>INR&nbsp;</strong><strong><?php echo number_format($orders['package_price'], 2) ?></strong>&nbsp;</p>
               </td>
               </tr>
               <tr>
               <td colspan="2">
               <p>Add:&nbsp;GST @ 12%&nbsp;</p>
               </td>
               </tr>
               <tr>
               <td colspan="2">
               <p><a href="http://about:blank/"><strong>S</strong><strong>tandard</strong><strong>&nbsp;Team Licensing Terms</strong></a><a href="http://about:blank/"><strong>:</strong></a>&nbsp;</p>
               <p>&nbsp;<br /><strong>With&nbsp;</strong><strong>a</strong><strong>Standard</strong><strong>&nbsp;license, you may:</strong>&nbsp;</p>
               <ul>
               <li>Reproduce up to 500,000 copies of the asset in product packaging, printed marketing materials, digital documents, or software.&nbsp;</li>
               </ul>
               <ul>
               <li>Include the asset in email marketing, mobile advertising, or a broadcast program if the expected number of viewers is fewer than 500,000.&nbsp;</li>
               </ul>
               <ul>
               <li>Post the asset to a website with no limitation on viewers. If the asset is used in an editorial manner, attribution is required in this format (&copy; Author Name - stock.adobe.com).&nbsp;</li>
               </ul>
               <ul>
               <li>Include the asset in products in a minor way, such as in a textbook.&nbsp;<br />&nbsp;</li>
               </ul>
               <p><strong>With a&nbsp;</strong><strong>Standard</strong><strong>&nbsp;license, you may not:</strong>&nbsp;</p>
               <ul>
               <li>Create merchandise or products for resale or distribution where the main value of the product is associated with the asset itself. For example, you can't use the asset to create a poster, t-shirt, or coffee mug that someone would buy specifically because of the asset printed on it.&nbsp;</li>
               </ul>
               <p>&nbsp;<br /><strong>Credit Packs</strong>&nbsp;</p>
               <ul>
               <li>Credits can be used to license any content on Adobe Stock. Different asset types have different credit costs. If you want many standard images, standard templates, or standard 3D assets, you can buy a standard subscription.</li>
               </ul>
               <ul>
               <li>For premium images, HD videos, 4K videos, and Editorial, credit costs may vary.</li>
               </ul>
               <ul>
               <li>Unused credits expire after one year from date of purchase</li>
               </ul>
               <p>&nbsp;<br /><strong>Enhanced Team Licensing Terms:</strong>&nbsp;</p>
               <p>Enhanced licenses are available for Adobe Stock Premium collection images, videos, templates, editorial and 3D assets.</p><br/>
               <p><strong>With an Enhanced license, you may:</strong></p>
               <ul>
               <li>Use the asset with all the rights granted in a Standard license.</li>
               </ul>
               <ul>
               <li>Reproduce the asset beyond the 500,000 copy/viewer restriction.</li>
               </ul>

               <p><strong>With an Enhanced license, you may not:</strong></p>
               <ul>
               <li>Create merchandise or products for resale or distribution where the main value of the product is associated with the asset itself. For example, you can't use the asset to create a poster, t-shirt, or coffee mug that someone would buy specifically because of the asset printed on it.</li>
               </ul>
               <p>&nbsp;<br /><strong>Terms of&nbsp;</strong><strong>Payment:</strong>&nbsp;</p>
               <ul>
               <li>License Rights are only assigned on&nbsp;issuance of a&nbsp;<strong>Purchase Order</strong>&nbsp;and&nbsp;<strong>Upfront Commitment</strong>.&nbsp;</li>
               </ul>
               <ul>
               <li>Payment can be made in favour of&nbsp;<strong>M/s. Conceptual Pictures Worldwide Private Limited</strong>.&nbsp;<br />A. Through&nbsp;A/c.&nbsp;Payee Cheques/DD payable at Hyderabad&nbsp;<br />B.&nbsp;&nbsp;RTGS/NEFT to&nbsp;<strong>A/c. No. 50200000502220</strong>,&nbsp;<strong>HDFC Bank Ltd</strong>, Vijay Nagar Branch, Hyderabad&nbsp;<br />IFSC Code:&nbsp;<strong>HDFC0001998</strong>.&nbsp;</li>
               </ul>
               <ul>
               <li>All disputes are subject to Hyderabad Jurisdiction.&nbsp;</li>
               </ul>

               </td>
               </tr>
               </tbody>
               </table>
            </div>

            <div class="divTableRow">
               <table class="bordered width-100pc" width="100%">
                  <tbody>
                     <tr>
                           <td width="50%" style="border: none;">
                              &nbsp;
                           </td>
                           <td width="50%" style="border: none;">
                              <p style="float: right;">For&nbsp;<strong><?php config('constants.company_name')?></strong>&nbsp;</p>
                           </td>
                     </tr>
                     <tr>
                           <td width="50%" style="border: none;">
                              &nbsp;
                           </td>
                           <td width="50%" style="border: none;">
                              <p style="float: right;">&nbsp;</p>
                           </td>
                     </tr>
                     <tr>
                           <td width="50%" style="border: none;">
                              &nbsp;
                           </td>
                           <td width="50%" style="border: none;">
                              <p style="float: right;"><strong>Authorized Signatory&nbsp;</strong>&nbsp;</p>
                           </td>
                     </tr>
                  </tbody>
               </table>
            </div>

            <div class="divTableRow">
                <table class="bordered width-100pc" width="100%">
                    <tbody>
                        <tr>
                            <td width="50%" style="border: none;">
                                <p>&nbsp;<br /><strong><?php config('constants.company_name')?>&nbsp;</strong>&nbsp;<br />3rd Floor, # 10-3-89/A/B, R-5
                                    Chambers, Near Sarojini Devi Hospital, Humayun Nagar,&nbsp;<br/>Hyderabad -
                                    500028,&nbsp;Telangana,&nbsp;India&nbsp;Phone: +91 40 6720 6720 Fax +91 40
                                    6673 8077&nbsp;</p>
                                <p><a href="http://about:blank/">info@imagefootage.com</a> <a
                                        href="http://about:blank/">www.imagefootage.com</a>&nbsp;</p>
                            </td>
                            <td width="50%" style="border: none;float: right;">
                                <p style="float: right;"><strong>LOOKING</strong>&nbsp;<br /><strong>FORWARD</strong>&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
