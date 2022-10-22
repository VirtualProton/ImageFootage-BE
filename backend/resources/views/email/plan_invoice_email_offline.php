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

    .bordered td ol li {
        font-size: 11px;
        margin: 0px;
        padding: 0px;
    }

    .bgtdleft {
        background: #d2d2d2;
        text-align: left;
    }
    .bgtdright {
        background: #d2d2d2;
        text-align: right;
    }


    ul {
        margin: 3;
    }

    table {
        /*border-collapse: collapse;*/
        table-layout: fixed;
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
                            <h1 style="font-size: 50px; margin-bottom: -25px">hello </h1>
                            <h2>THIS IS YOUR TAX INVOICE</h2>
                        </td>
                        <td width="50%" style="border: none;">
                            <p style="float:right;"><img src="https://imagefootage.com/assets/images/IF_Logo_Final.png" width="200px"></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="divTableRow">
            <table class="bordered width-100pc" width="100%" align="center" style="border-style: double; border-width: 5px;">
                <tbody>
                    <tr>
                        <td data-celllook="272">
                            <p><span data-contrast="auto">Customer Name:&nbsp;</span><strong><span data-contrast="auto"><?php echo $orders['first_name'] ?> <?php echo $orders['last_name'] ?></span></strong></p>
                            <p><span data-contrast="auto">Address:</span><span data-contrast="auto">&nbsp;</span><strong><span data-contrast="auto"><?php echo $orders['address'] ?></span></strong></p>
                            <p><span data-contrast="auto"><span data-ccp-parastyle="Table Paragraph" data-ccp-parastyle-defn="{&quot;ObjectId&quot;:&quot;511576d8-1f94-4a98-9def-7f82dfd06d0f|215&quot;,&quot;ClassId&quot;:1179649,&quot;Properties&quot;:[67122396,&quot;&quot;,134233614,&quot;true&quot;,201340122,&quot;2&quot;,201341983,&quot;0&quot;,335551547,&quot;1033&quot;,335559704,&quot;1033&quot;,335559739,&quot;0&quot;,335559740,&quot;240&quot;,469769226,&quot;Arial&quot;,469775450,&quot;Table Paragraph&quot;,469777841,&quot;Arial&quot;,469777842,&quot;Arial&quot;,469777843,&quot;Arial&quot;,469777844,&quot;Arial&quot;,469778129,&quot;TableParagraph&quot;,469778324,&quot;Normal&quot;]}">Ph</span></span><span data-contrast="auto"><span data-ccp-parastyle="Table Paragraph">one</span></span><span data-contrast="auto"><span data-ccp-parastyle="Table Paragraph">:&nbsp;</span></span><strong><span data-contrast="auto"><span data-ccp-parastyle="Table Paragraph">+&nbsp;</span></span></strong><strong><span data-contrast="auto"><span data-ccp-parastyle="Table Paragraph"><?php echo $orders['mobile'] ?></span></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559739&quot;:0,&quot;335559740&quot;:240}">&nbsp;</span></p>
                            <p><span data-contrast="auto">GSTIN:&nbsp;</span><strong><span data-contrast="auto"><?php echo $orders['gst'] ?></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:288}">&nbsp;</span></p>
                        </td>
                        <td data-celllook="272">
                            <p><span data-contrast="auto">Invoice No.:&nbsp;</span><strong><span data-contrast="auto">IN</span></strong><strong><span data-contrast="auto"><?php echo $orders['invoice_name'] ?></span></strong><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559738&quot;:100,&quot;335559740&quot;:288}">&nbsp;</span></p>
                            <p><span data-contrast="auto">Invoice Date:&nbsp;</span><strong><span data-contrast="auto"><?php echo date("d.M.Y",strtotime($orders['invicecreted'])) ?></span></strong><span data-contrast="auto">&nbsp;</span><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559738&quot;:100,&quot;335559740&quot;:288}">&nbsp;</span></p>
                            <p><span data-contrast="auto">GSTIN:&nbsp;</span><strong><span data-contrast="auto"><?php echo $orders['gst'] ?>&nbsp;</span></strong><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559738&quot;:100,&quot;335559740&quot;:288}">&nbsp;</span></p>
                            <p><span data-contrast="auto">PAN No.:&nbsp;</span><strong><span data-contrast="auto"><?php echo $orders['pan'] ?></span></strong><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559738&quot;:100,&quot;335559740&quot;:288}">&nbsp;</span></p>
                            <p><span data-contrast="auto">SAC Code:&nbsp;</span><strong><span data-contrast="auto"></span></strong><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559738&quot;:100,&quot;335559740&quot;:288}">&nbsp;</span></p>
                            <p><span data-contrast="auto">Place:&nbsp;</span><strong><span data-contrast="auto"><?php echo $orders['cityname'] ?> &ndash; <?php echo $orders['statename']?></span></strong>&nbsp;<br /><span data-contrast="auto">Payment Due:&nbsp;</span><strong><span data-contrast="auto"><?php echo ucfirst($payment_method) ?></span></strong><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559738&quot;:100,&quot;335559740&quot;:288}">&nbsp;</span></p>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td data-celllook="272">
                            <p><span data-contrast="auto">Kind Attention:&nbsp;</span>&nbsp;<br /><strong><span data-contrast="auto"><?php echo $orders['first_name'] ?> <?php echo $orders['last_name'] ?></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:259}">&nbsp;</span></p>
                        </td>
                        <td data-celllook="272">
                            <p><span data-contrast="auto">Purchase</span><span data-contrast="auto">&nbsp;Order No.</span><strong><span data-contrast="auto">&nbsp;</span></strong><strong><span data-contrast="auto"><?php echo "IN".$orders['invoice_name'] ?></span></strong>&nbsp;<br /><span data-contrast="auto">dated</span><strong><span data-contrast="auto">&nbsp;</span></strong><strong><span data-contrast="auto"><?php echo date("d.M.Y",strtotime($orders['invicecreted'])) ?></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:259}">&nbsp;</span></p>
                            <br/>
                        </td>
                    </tr>
                   
                    <tr>
                        <td data-celllook="272">
                            <p><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:288}">&nbsp;</span></p>
                        </td>
                        <td data-celllook="272">
                            <p><span data-contrast="auto">IF Sales Representative:</span><span data-contrast="auto">&nbsp;</span><strong><span data-contrast="auto"><?php echo Auth::guard('admins')->user()->name?></span></strong>&nbsp;<br /><span data-contrast="auto">Client:&nbsp;</span><strong><span data-contrast="auto"><?php echo $orders['company'] ?></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:288}">&nbsp;</span></p>
                            <p><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:288}">&nbsp;</span></p>
                            <p><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:288}">&nbsp;</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td data-celllook="65808" class="bgtdleft">
                            <p><strong><span data-contrast="auto"> 
                                    Team License &ndash; Royalty-free <?php echo $orders['package_type'] ?> Pack
                                </span></strong>&nbsp;<br />
                                <span data-contrast="auto">Quantity</span>
                                <span data-contrast="auto">:</span>
                                <span data-contrast="auto">&nbsp;<?php echo $orders['package_products_count'] ?> <?php echo $orders['package_type'] ?></span>&nbsp;<br />
                                <span data-contrast="auto">
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
                                </span>
                                <span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:259}">&nbsp;</span>
                            </p>
                        </td>
                        <td data-celllook="65808" class="bgtdright">
                            <p><strong><span data-contrast="auto"><?php echo number_format(($orders['total'] - $orders['tax']), 2) ?></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335551550&quot;:3,&quot;335551620&quot;:3,&quot;335559740&quot;:259}">&nbsp;</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td data-celllook="65808" class="bgtdleft">
                            <p><span data-contrast="auto">Amount&nbsp;</span><span data-contrast="auto">(</span><span data-contrast="auto">INR</span><span data-contrast="auto">)</span><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:259}">&nbsp;</span></p>
                        </td>
                        <td data-celllook="65808" class="bgtdright">
                            <p><strong><span data-contrast="auto"><?php echo number_format(($orders['total'] - $orders['tax']), 2) ?></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335551550&quot;:3,&quot;335551620&quot;:3,&quot;335559740&quot;:259}">&nbsp;</span></p>
                        </td>
                    </tr>
                    <?php if(!empty($orders['tax'])) { ?>
                        <tr>
                            <td data-celllook="65808" class="bgtdleft">
                                <p><span data-contrast="auto">Add</span><span data-contrast="auto">:&nbsp;</span><span data-contrast="auto">GST @ 1</span><span data-contrast="auto">2</span><span data-contrast="auto">%</span><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:259}">&nbsp;</span></p>
                            </td>
                            <td data-celllook="65808" class="bgtdright"> 
                                <p><strong><span data-contrast="auto"><?php echo number_format($orders['tax'], 2) ?></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335551550&quot;:3,&quot;335551620&quot;:3,&quot;335559740&quot;:259}">&nbsp;</span></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td data-celllook="65808" class="bgtdleft">
                            <p><span data-contrast="auto">Total Invoice Amount (INR)</span><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:259}">&nbsp;</span></p>
                        </td>
                        <td data-celllook="65808" class="bgtdright">
                            <p><strong><span data-contrast="auto"><?php echo number_format($orders['total'], 2) ?></span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335551550&quot;:3,&quot;335551620&quot;:3,&quot;335559740&quot;:259}">&nbsp;</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" data-celllook="65808" class="bgtdleft">
                            <p><span data-contrast="auto">In words:&nbsp;</span><strong><span
                                        data-contrast="auto">Rupees&nbsp;</span></strong>
                                        <strong><span
                                        data-contrast="auto"><?php echo $amount_in_words ?><strong><span
                                        data-contrast="auto">&nbsp;only</span></strong><span
                                    data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:259}">&nbsp;</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" data-celllook="65808">
                    </tr>
                    <tr>
                        <td colspan="2" data-celllook="272">
                            <p><strong><span data-contrast="auto">Payment Instructions:</span></strong><span data-ccp-props="{&quot;201341983&quot;:0,&quot;335559740&quot;:259}">&nbsp;</span></p>
                            <p>
                                <ol type="1">
                                    <li><span data-contrast="auto">License Rights are only assigned on payment of this invoice&nbsp;</span><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559685&quot;:714,&quot;335559738&quot;:160,&quot;335559739&quot;:160,&quot;335559740&quot;:259,&quot;335559991&quot;:357}">&nbsp;</span></li>
                               
                                    <li><span data-contrast="auto">Payment should be made Immediate from the date of download of&nbsp;</span><span data-contrast="auto">the&nbsp;</span><span data-contrast="auto">image</span><span data-contrast="auto">(s)</span><span data-contrast="auto">&nbsp;and can be sent to</span><span data-contrast="auto">:</span><span data-contrast="auto">&nbsp;</span>&nbsp;<br /><strong><span data-contrast="auto">Image Footage</span></strong><span data-contrast="auto">, # 10-3-89, R5 Chambers, 3rd Floor, Above Mohammed Khan Jewellers Building, Opp</span><span data-contrast="auto">osite&nbsp;</span><span data-contrast="auto">Pillar No</span><span data-contrast="auto">.</span><span data-contrast="auto">&nbsp;2, Humayun Nagar, Near Sarojini Devi Eye Hospital, Mehdipatnam &ndash; Hyderabad&nbsp;</span><span data-contrast="auto">&ndash;</span><span data-contrast="auto">&nbsp;500028</span><span data-contrast="auto">, Telangana</span><span data-contrast="auto">.</span><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559685&quot;:714,&quot;335559738&quot;:160,&quot;335559739&quot;:160,&quot;335559740&quot;:259,&quot;335559991&quot;:357}">&nbsp;</span></li>
                                
                                    <li><span data-contrast="auto">If not paid within credit period allowed,&nbsp;</span><strong><span data-contrast="auto">interest</span></strong><strong><span data-contrast="auto">&nbsp;</span></strong><strong><span data-contrast="auto">@</span></strong><strong><span data-contrast="auto">&nbsp;</span></strong><strong><span data-contrast="auto">24%</span></strong><span data-contrast="auto">&nbsp;will be charged.</span><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559685&quot;:714,&quot;335559738&quot;:160,&quot;335559739&quot;:160,&quot;335559740&quot;:259,&quot;335559991&quot;:357}">&nbsp;</span></li>
                               
                                    <li><span data-contrast="auto">Payment can be made in favour of&nbsp;</span><strong><span data-contrast="auto">Image Footage</span></strong><span data-contrast="auto">.</span>&nbsp;<br /><span data-contrast="auto">A</span><span data-contrast="auto">.&nbsp;&nbsp;</span><span data-contrast="auto">Through&nbsp;</span><span data-contrast="auto">A</span><span data-contrast="auto">/c.&nbsp;</span><span data-contrast="auto">P</span><span data-contrast="auto">ayee Cheques/DD payable at Hyderabad</span>&nbsp;<br /><span data-contrast="auto">B</span><span data-contrast="auto">.&nbsp;</span><span data-contrast="auto">&nbsp;RTGS/NEFT to&nbsp;</span><strong><span data-contrast="auto">A/c. No. 50200000502220</span></strong><span data-contrast="auto">,</span><span data-contrast="auto">&nbsp;</span><strong><span data-contrast="auto">HDFC Bank Ltd</span></strong><span data-contrast="auto">, Vijay Nagar Branch, Hyderabad</span>&nbsp;<br /><span data-contrast="auto">IFSC Code:&nbsp;</span><strong><span data-contrast="auto">HDFC0001998</span></strong><span data-contrast="auto">.</span><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559685&quot;:714,&quot;335559738&quot;:160,&quot;335559739&quot;:160,&quot;335559740&quot;:259,&quot;335559991&quot;:357}">&nbsp;</span></li>
                               
                                    <li><span data-contrast="auto"><a href="<?php echo $orders['payment_url']; ?>" target="_blank" style="font-size: 14px;color:Red;">Payment Link</a></li>
                               
                                    <li><span data-contrast="auto">Goods once sold cannot be replaced or returned.</span><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559685&quot;:714,&quot;335559738&quot;:160,&quot;335559739&quot;:160,&quot;335559740&quot;:259,&quot;335559991&quot;:357}">&nbsp;</span></li>
                                
                                    <li><span data-contrast="auto">Acknowledgement of the Invoice will be deemed as acceptance of this bill in full unless we receive a written communication to the contrary within 7 days of the invoice date.</span><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559685&quot;:714,&quot;335559738&quot;:160,&quot;335559739&quot;:160,&quot;335559740&quot;:259,&quot;335559991&quot;:357}">&nbsp;</span></li>
                               
                                    <li><span data-contrast="auto">All disputes are subject to Hyderabad Jurisdiction.</span><span data-ccp-props="{&quot;134233279&quot;:true,&quot;201341983&quot;:0,&quot;335559685&quot;:714,&quot;335559738&quot;:160,&quot;335559739&quot;:160,&quot;335559740&quot;:259,&quot;335559991&quot;:357}">&nbsp;</span></li>
                                </ol>
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
                                Chambers, Near Sarojini Devi Hospital, Humayun Nagar,&nbsp;<br />Hyderabad -
                                500028,&nbsp;Telangana,&nbsp;India&nbsp;Phone: +91 40 6720 6720 Fax +91 40
                                6673 8077&nbsp;</p>
                            <p><a href="http://about:blank/">info@imagefootage.com</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="http://about:blank/">www.imagefootage.com</a>&nbsp;</p>
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