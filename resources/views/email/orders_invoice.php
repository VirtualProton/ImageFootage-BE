<html>
   <head>
      <title>Order invoice</title>
   </head>
   <body>
      <div class="container">
         <table width="100%" class="table taxpdf" style="border-collapse: collapse; ">
            <thead></thead>
            <tbody>
               <tr class="rr1">
                  <td width="40%" style="vertical-align: top; font-size: 12px;">
                     <div class="qutationtext">
                        <p>Dear ,<?php echo $orders['bill_firstname'] ?> <?php echo $orders['bill_lastname'] ?></p>
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
						<td>Order ID:</td>
                              <td><?php echo $orders['txn_id'] ?></td>
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
                              <td style="color: #fc8041; font-weight: 700">Created On:</td>
                              <td style="color: #fc8041; font-weight: 700"><?php echo date("F , d Y",strtotime($orders['created_at'])) ?></td>
                           </tr>
                          <tr>
                              <td style="color: #fc8041; font-weight: 700">Subtotal:</td>
                              <td style="color: #fc8041; font-weight: 700">Rs. <?php echo $orders['order_total']-$orders['tax'] ?></td>
                           </tr>
                           <tr>
                              <td style="color: #fc8041; font-weight: 700">Application tax:</td>
                              <td style="color: #fc8041; font-weight: 700">Rs. <?php echo $orders['tax'] ?></td>
                           </tr>
                           <tr>
                              <td style="color: #fc8041; font-weight: 700">Total:</td>
                              <td style="color: #fc8041; font-weight: 700">Rs. <?php echo $orders['order_total'] ?></td>
                           </tr>
                           <tr>
                              <td>User Details:</td>
                           </tr>
                           <tr>
                              <td colspan="2">
                                 <p style="margin: 0px;"><span><?php echo $orders['bill_firstname'] ?> <?php echo $orders['bill_lastname'] ?></span></p>
                                 <p style="margin: 0px;"><?php echo $orders['bill_address1'] ?></p>
                                 <p style="margin: 0px;"></p>
                                 <p style="margin: 0px;"><?php echo $orders['city']['name'] ?></p>
                                 <p style="margin: 0px;"><?php echo $orders['state']['state'] ?></p>
                                 <p style="margin: 0px;"><?php echo $orders['bill_zip'] ?></p>
                                 <p style="margin: 0px;"><?php echo $orders['country']['name'] ?></p>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </td>
               </tr>
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
                        $subtotalarray = $subtotalarray+$value['standard_price'];
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
                                    <video width="200" height="150"
                                           poster="<?php echo $value['product_thumb']; ?>" controls
                                           onmouseover="this.play()" onmouseout="this.pause()">
                                        <source src="<?php echo $value['product_thumb']; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </a>
                                <?php } ?>
							</td>
									 <td colspan="2" width="50%">
										<table width="100%" style="font-size:12px;">
										<tr>
											  <td style="text-align: right; font-weight: bold;">Product size:</td>
											  <td><?php echo $value['standard_size'] ?></td>
										   </tr>

											<!-- if(!empty($value['usageType'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">'.$value['catTitle1'].':</td>
											  <td>'.$value['catValue1'].'</td>
										   </tr>'; 
											}if(!empty($value['catTitle2'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">'.$value['catTitle2'].':</td>
											  <td>'.$value['catValue2'].'</td>
										   </tr>'; 
											}if(!empty($value['catTitle3'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">'.$value['catTitle3'].':</td>
											  <td>'.$value['catValue3'].'</td>
										   </tr>'; 
											}if(!empty($value['catTitle4'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">'.$value['catTitle4'].':</td>
											  <td>'.$value['catValue4'].'</td>
										   </tr>'; 
											}if(!empty($value['catTitle5'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">'.$value['catTitle5'].':</td>
											  <td>'.$value['catValue5'].'</td>
										   </tr>'; 
											}if(!empty($value['catTitle6'])){
										
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">'.$value['catTitle6'].':</td>
											  <td>'.$value['catValue6'].'</td>
										   </tr>'; 
											}if(!empty($value['catTitle7'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">'.$value['catTitle7'].':</td>
											  <td>'.$value['catValue7'].'</td>
										   </tr>'; 
											}if(!empty($value['start_date'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">Start date:</td>
											  <td>'.$value['start_date'].'</td>
										   </tr>'; 
											}if(!empty($value['end_date'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">End date:</td>
											  <td>'.$value['end_date'].'</td>
										   </tr>'; 
											}if(!empty($value['teritery_type'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">Type of teritery:</td>
											  <td>'.$value['teritery_type'].'</td>
										   </tr>'; 
											}if(!empty($value['teritery1'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">Country:</td>
											  <td>'.$value['teritery1'].'</td>
										   </tr>'; 
											}if(!empty($value['teritery2'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">State:</td>
											  <td>'.$value['teritery2'].'</td>
										   </tr>'; 
											}if(!empty($value['teritery3'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">City:</td>
											  <td>'.$value['teritery3'].'</td>
										   </tr>'; 
											}if(!empty($value['userindustry'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">UserIndustry:</td>
											  <td>'.$value['userindustry'].'</td>
										   </tr>'; 
											}if(!empty($value['username'])){
												$html .='<tr>
											  <td style="text-align: right; font-weight: bold;">Username:</td>
											  <td>'.$value['username'].'</td>
										   </tr>'; 
											}
										    -->
							
									</table>
									 </td>
									 <td width="25%" style="vertical-align: top; text-align: right; font-size: 18px;">
										<p style="margin: 0px; text-align: right; font-weight: bold; " ><strong>Price:</strong></p>
										<p style="margin: 0px; text-align: right;  font-weight: bold;"><strong>Rs. <?php echo $value['standard_price']  ?></strong></p>
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
   </body>
</html>
