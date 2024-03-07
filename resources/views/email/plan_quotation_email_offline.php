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
        header{
            position: fixed;
            top: 0px;
            left: 0px;
            height: 100px;
        }
        footer{
            position: fixed;
            bottom: 0px;
            left: 0px;
            height: 130px;
        }

        .client-info-bottom.price-div .client-info-rightside{
            text-align: right;
        }

        .main{
            border:1px solid black;
            padding:10px
        }

    </style>
    <link rel="stylesheet" href="assets/css/email/quotation_pack.css">
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <div class="container">
            <div class="header-text">
                <h1 class="h1"><strong>hi</strong></h1>
                <span class="upper-case"><strong>this is an estimate</strong></span>
            </div>
            <div class="header-logo">
                <img src="<?php echo $orders['company_logo']; ?>" alt="logo" width="1920" height="351">
            </div>
        </div>
    </header>

    <footer>
        <div class="container">
            <div class="footer-left">
                <h2 class="h4"><strong><?php config('constants.company_name')?></strong></h2>
                <p>3rd Floor, # 10-3-89/A/B, R-5 Chambers, Near Sarojini Devi Hospital, Humayun Nagar, Hyderabad - 500028, Telangana, Andhra Pradesh, India Phone: +91 40 6720 6720 <span> Fax +91 40 6673 8077</span>
                </p>
                <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
                <a href="<?php echo $orders['frontend_url']; ?>"><?php echo $orders['frontend_url']; ?></a>
            </div>
            <div class="footer-right">
                <h3 class="h2">looking forward</h3>
            </div>
        </div>
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main class="main">
        <!-- Table paragraph section start -->
        <section class="table-paragraph">
            <div class="container">
                <div class="client-info-top">
                    <div class="client-info-leftside">
                        <p>Customer Name: <span><strong><?php echo $orders['first_name'] ?? ''; ?> <?php echo $orders['last_name'] ?? ''; ?></span></strong></p>
                        <p>Address: <span><strong><?php echo $orders['address'] ?? ''; ?></strong></span>
                            <?php if (!empty($orders['address2'])) { ?>
                                <span><strong><?php echo $orders['address2'] ?? ''; ?></strong></span>
                            <?php } ?>
                            <span class="block-text"><strong><?php echo $orders['cityname'] ?? ''; ?>&nbsp;&nbsp; <?php echo $orders['statename'] ?? ''; ?>&nbsp;&nbsp;<?php echo $orders['postal_code'] ?? ''; ?></strong></span>
                        </p>
                        <p>Mobile: <span><strong><?php echo "+91 - " . $orders['mobile'] ?? ''; ?></strong></span></p>
                    </div>
                    <div class="client-info-rightside">
                        <p>Estimate No.: <span><strong><?php echo $orders['invoice_name'] ?? ''; ?></span></strong></p>
                        <p>Estimate Date: <span><strong><?php echo date("d.m.Y ", strtotime($orders['invicecreted'])) ?></strong></span></p>
                        <p>GSTIN: <span><strong><?php echo config('constants.GSTIN_VALUE')?></strong></span></p>
                  <p>PAN No.: <span><strong><?php echo config('constants.PAN_VALUE') ?></strong></span></p>
                        <p>SAC Code: <span><strong><?php echo config('constants.SAC_CODE') ?></strong></span></p>
                        <p>Vendor Code : <span><strong><?php echo config('constants.VENDOR_CODE') ?></strong></span></p>
                        <p>Place: <span><strong><?php echo config('constants.QI_ADDRESS') ?></strong></span></p>
                    </div>
                </div>
                <div class="client-info-bottom">
                    <div class="client-info-leftside">
                        <p>Kind Attention: <span class="block-text"><strong><?php echo $orders['first_name'] . ' ' . $orders['last_name']; ?></strong></span></p>
                    </div>
                    <div class="client-info-rightside">
                        <p>Product Description: <span class="block-text"><strong><?php echo $orders['description'] ?? ''; ?></strong></span></p>
                    </div>
                </div>
                <div class="client-info-bottom price-div" style="padding-top: 15px;padding-bottom:0px;">
                    <div class="client-info-leftside">
                        <p><strong><?php echo $orders['description'] ?? '' ?></strong></p>
                        <p>Quantity: <?php echo $orders['package_products_count'] ?? '' ?>&nbsp;<?php echo $orders['package_type'] ?? ''; ?></p>
                        <p> <?php
                        if ($orders['package_plan'] == 1) {
                            $plan = 'Download Pack For '.$orders['package_expiry_yearly'].' year';
                        } else {
                            if ($orders['package_expiry_yearly'] == 0 || $orders['package_expiry_yearly'] == null) {
                                $plan = 'Subscription Pack For '.$orders['package_expiry'].' Month';
                            } else {
                                $plan = 'Subscription Pack For '.$orders['package_expiry_yearly'].' Year';
                            }
                        }
                        if ($orders['package_type'] == 'Footage') {
                                if ($orders['pacage_size'] == 1) {
                                    echo $orders['package_name'] . " HD " . $plan;
                                } else {
                                    echo $orders['package_name'] . " 4K " . $plan;
                                }
                            }else if($orders['package_type'] == 'Image'){
                                echo $orders['package_name'] ." XL";
                            }
                             else {
                                echo $orders['package_name'] . " " . $plan;
                            }
                            ?>&nbsp;
                            <?php echo $orders['licence_name']." Licence"; ?></p>

                    </div>
                    <div class="client-info-rightside">
                        <p><strong>(INR) <?php echo number_format($orders['total'], 2); ?></strong></p>
                    </div>
                </div>
                <?php
                if( isset($orders['tax']) && $orders['tax'] != 0){
                    ?>
                    <div class="price-div">
                        <p>Added: GST @ <?php echo config('constants.GST_VALUE') ?>%</p>
                    </div>
                    <?php
                }
                ?>

                <div class="price-div">
                    <p>In words: <strong>Rupees &nbsp; <?php echo $amount_in_words.' only' ?></strong></p>
                </div>

                <div class="licensing-terms">
                    <h2 class="h3"><strong> Licensing Terms: </strong></h2>
                    <div class="licensing-condition">
                        <h4><strong>With a Standard license, you may:</strong></h4>
                        <ul>
                            <li>Reproduce up to 500,000 copies of the asset in product packaging, printed marketing materials, digital documents, or software.</li>
                            <li>Include the asset in email marketing, mobile advertising, or a broadcast program if the expected number of viewers is fewer than 500,000.</li>
                            <li>Post the asset to a website with no limitation on viewers. If the asset is used in an editorial manner, attribution is required in this format (© Author Name - <?php echo $orders['frontend_name']; ?>).</li>
                            <li>Include the asset in products in a minor way, such as in a textbook.</li>
                        </ul>
                        <p><strong>With a Standard license, you may not:</strong></p>
                        <ul>
                            <li>Create merchandise or products for resale or distribution where the main value of the product is associated with the asset itself. For example, you can't use the asset to create a poster, t-shirt, or coffee mug that someone would buy specifically because of the asset printed on it.</li>
                        </ul>
                    </div>
                    <div class="licensing-condition">
                        <h4><strong>FOR OTHER THAN THE MENTIONED USAGES PLEASE BUY EXTENDED LICENSE</strong></h3>
                    </div>
                </div>
                <div class="terms-of-payment licensing-terms">
                    <h4><strong>Terms of Payment: </strong></h4>
                    <ul>
                        <li>License Rights are only assigned on issuance of a <span><strong>Purchase Order</strong></span> and <span><strong>Upfront
                                    Commitment</strong></span>.</li>
                        <li>Payment can be made in favour of <span><strong>M/s. Conceptual Pictures Worldwide Private
                                    Limited</strong></span>.
                            <ol>
                                <li>Through A/c. Payee Cheques/DD payable at Hyderabad</li>
                                <li> RTGS/NEFT to <span><strong>A/c. No. 50200000502220, HDFC Bank Ltd</strong></span>, Vijay Nagar Branch,
                                    Hyderabad
                                    IFSC Code: <span><strong>HDFC0001998</strong></span>.</li>
                            </ol>
                        </li>
                        <li>All disputes are subject to Hyderabad Jurisdiction.</li>
                    </ul>
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
