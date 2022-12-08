<html>
   <head>
      <title>Plan invoice</title>
   </head>
   <body>
      <div class="container">
         <table width="100%" class="table taxpdf" style="border-collapse: collapse; ">
            <thead></thead>
            <tbody>
               <tr class="rr1">
                  <td width="40%" style="vertical-align: top; font-size: 12px;">
                     <div class="qutationtext">
                        <p>Dear ,<?php echo $orders['user']['first_name'] ?> <?php echo $orders['user']['last_name'] ?></p>
                       <p> There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. </p>
                        <br>
                        <p>Find your <a href="#"> local contact information </a></p>
                        <p> Email: <a href="mailto:rashmi.spright343@gmail.com">rashmi.spright343@gmail.com</a></p>
                     </div>
                  </td>
                  <td width="60%" style="vertical-align: top; background: #eff1e6; ">
                     <div style="background: #eff1e6;">
                        <table width="100%" style=" background: #eff1e6; padding: 10px;  font-size: 12px; ">
                           <tr>
						<td>Plan Order ID:</td>
                              <td><?php echo $orders['transaction_id'] ?></td>
                           </tr>

                        <!-- <tr>
                              <td>Site:</td>
                              <td>27-SEP-16</td>
                           </tr> -->
						  
                        <tr>
                              <td>Username:</td>
                              <td><?php echo $orders['user']['user_name'] ?></td>
                           </tr>
                            <tr>
                                <td>Plan Name:</td>
                                <td><?php echo $orders['package_name'];?></td>
                            </tr>
                            <tr>
                                <td style="color: #fc8041; font-weight: 700">Plan Description:</td>
                                <td style="color: #fc8041; font-weight: 700">
                                    <?php if($orders['package_plan']==1){
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
                                 </td>
                            </tr>
                            <tr>
                                <td style="color: #fc8041; font-weight: 700">No of Downloads:</td>
                                <td style="color: #fc8041; font-weight: 700"><?php  echo $orders['package_products_count']?></td>
                            </tr>
                           <tr>
                              <td style="color: #fc8041; font-weight: 700">Created On:</td>
                              <td style="color: #fc8041; font-weight: 700"><?php echo date("F , d Y h:i:s a",strtotime($orders['created_at'])) ?></td>
                           </tr>
                            <tr>
                                <td style="color: #fc8041; font-weight: 700">Plan Expiry on:</td>
                                <td style="color: #fc8041; font-weight: 700"><?php echo date("F , d Y h:i:s a",strtotime($orders['package_expiry_date_from_purchage'])) ?></td>
                            </tr>

                          <tr>
                              <td style="color: #fc8041; font-weight: 700">Total Price:</td>
                              <td style="color: #fc8041; font-weight: 700">Rs. <?php echo $orders['package_price'] ?></td>
                           </tr>
                            <tr>
                                <td style="color: #fc8041; font-weight: 700">Payment status:</td>
                                <td style="color: #fc8041; font-weight: 700"><?php echo $orders['payment_status']. " ( ".$orders['payment_gatway_provider']." ) " ?></td>
                            </tr>
                           <tr>
                              <td>User Details :</td>
                               <td>&nbsp;</td>
                           </tr>
                           <tr>
                              <td colspan="2">
                                 <p style="margin: 0px;"><span><?php echo $orders['user']['first_name'] ?> <?php echo $orders['user']['last_name'] ?></span></p>
                                 <p style="margin: 0px;"><?php echo $orders['user']['address'] ?></p>
                                 <p style="margin: 0px;"></p>
                                 <p style="margin: 0px;"><?php echo $orders['user']['city']['name'] ?></p>
                                 <p style="margin: 0px;"><?php echo $orders['user']['state']['state'] ?></p>
                                 <p style="margin: 0px;"><?php echo $orders['user']['postal_code'] ?></p>
                                 <p style="margin: 0px;"><?php echo $orders['user']['country']['name'] ?></p>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </td>
               </tr>

            </tbody>
         </table>
      </div>
   </body>
</html>
