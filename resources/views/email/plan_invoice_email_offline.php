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
        }

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            height: 100px;
        }
    </style>
    <link rel="stylesheet" href="assets/css/email/quotation_pack.css">
</head>

<body>
    <!-- Header start -->
    <header>
        <div class="container">
            <div class="header-text">
                <h1 class="h1"><strong>hello</strong></h1>
                <span class="upper-case"><strong>THIS IS YOUR TAX INVOICE</strong></span>
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
                <p>3rd Floor, # 10-3-89/A/B, R-5 Chambers, Opp Pillar No. 2, Humayun Nagar, Hyderabad - 500028, Telangana, Andhra Pradesh, India Phone: +91 40 6720 6720
                </p>
                <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
                <a href="<?php echo $orders['frontend_url']; ?>"><?php echo $orders['frontend_url']; ?></a>
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
            <div class="container pack_invoice">
                <div class="client-info-top">
                    <div class="client-info-leftside">
                        <p>Customer Name: <span><strong><?php echo $orders['first_name'] ?? ''; ?> <?php echo $orders['last_name'] ?? ''; ?></span></strong></p>
                        <p>Address: <span><strong><?php echo $orders['address'] ?? ''; ?></strong></span>
                            <?php if (!empty($orders['address2'])) { ?>
                                <span><strong><?php echo $orders['address2'] ?? ''; ?></strong></span>
                            <?php } ?>
                            <span class="block-text"><strong><?php echo $orders['cityname'] ?? ''; ?>&nbsp;&nbsp; <?php echo $orders['statename'] ?? ''; ?>&nbsp;&nbsp;<?php echo $orders['postal_code'] ?? ''; ?></strong></span>
                        </p>
                        <p>Phone: <span><strong><?php echo "+91 - " . $orders['mobile'] ?? ''; ?></strong></span></p>
                        <p>GSTIN: <span><strong><?php echo $orders['gst']; ?></strong></span></p>
                    </div>
                    <div class="client-info-rightside">
                        <p>Invoice No.: <span><strong><?php echo $orders['INVOICE_PREFIX'] . $orders['invoice_name']; ?></span></strong></p>
                        <p>Invoice Date: <span><strong><?php echo date("d.m.Y ", strtotime($orders['invicecreted'])) ?></strong></span></p>
                        <p>GSTIN: <span><strong><?php echo config('constants.GSTIN_VALUE') ?></strong></span></p>
                        <p>PAN No.: <span><strong><?php echo config('constants.PAN_VALUE') ?></strong></span></p>
                        <p>SAC Code: <span><strong><?php echo config('constants.SAC_CODE') ?></strong></span></p>
                        <p>Vendor Code : <span><strong><?php echo config('constants.VENDOR_CODE') ?></strong></span></p>
                        <p>Place: <span><strong><?php echo config('constants.QI_ADDRESS') ?></strong></span></p>
                        <p>Payment Due: <span><strong><?php echo ucfirst($payment_method) ?></strong></span></p>
                    </div>
                </div>
                <div class="client-info-bottom">
                    <div class="client-info-leftside">
                        <p>Kind Attention: <span class="block-text"><strong><?php echo $orders['first_name'] . ' ' . $orders['last_name']; ?></strong></span></p>
                    </div>
                    <div class="client-info-rightside">
                        <p>Purchase Order No.: <span class="block-text"><strong><?php echo "IN" . $orders['invoice_name']; ?></strong></span></p>
                        <p>dated<span class="block-text"><strong><?php echo date("d.M.Y", strtotime($orders['invicecreted'])) ?></strong></span></p>
                    </div>
                </div>
                <div class="client-info-bottom">
                    <div class="client-info-leftside">
                        <p>Total number of image(s)/footage(s):</p>
                        <p><span><strong><?php echo $orders['package_products_count'] . ' (' . $orders['package_products_count_in_words'] . ')'; ?></strong></span></p>
                    </div>
                    <div class="client-info-rightside">
                        <p>IF Sales Representative: <span><strong><?php echo Auth::guard('admins')->user()->name; ?></strong></span></p>
                        <p>End Client: <span><strong><?php echo $orders['company'] ?></strong></span></p>
                    </div>
                </div>
                <div class="price-div package-title-div pb-10">
                    <div class="client-info-leftside">
                        <p><strong><?php echo $orders['package_name'] ?? '' ?></strong></p>
                        <p>Quantity: <?php echo $orders['package_products_count'] ?? '' ?>&nbsp;<?php echo $orders['package_type'] ?? ''; ?></p>
                        <p>
                            <?php
                            if ($orders['package_plan'] == 1) {
                                $plan = 'Download Pack For 1 year';
                            } else {
                                if ($orders['package_expiry_yearly'] == 0) {
                                    $plan = 'Subscription Pack For 1 Month';
                                } else {
                                    $plan = 'Subscription Pack For 1 Year';
                                }
                            }
                            if ($orders['package_type'] != 'Image') {
                                if ($orders['pacage_size'] == 1) {
                                    echo $orders['package_name'] . " HD " . $plan;
                                } else {
                                    echo $orders['package_name'] . " 4K " . $plan;
                                }
                            } else {
                                echo $orders['package_name'] . " " . $plan;
                            }
                            ?>&nbsp;
                            <?php echo number_format(($orders['total'] - $orders['tax']), 2) ?>
                        </p>
                    </div>
                    <div class="client-info-rightside">
                        <p><strong>INR <?php echo number_format(($orders['total'] - $orders['tax']), 2) ?></strong></p>
                    </div>
                </div>
                <div class="price-div pb-10">
                    <div class="client-info-leftside">
                        <p>Amount (INR):</p>
                    </div>
                    <div class="client-info-rightside">
                        <p><span class="block-text"><strong><?php echo number_format(($orders['total'] - $orders['tax']), 2) ?></strong></span></p>
                    </div>
                </div>
                <div class="price-div pb-10">
                    <div class="client-info-leftside">
                        <p>Add: GST @: <?php echo config('constants.GST_VALUE') ?>%</p>
                    </div>
                    <div class="client-info-rightside">
                        <p><span class="block-text"><strong><?php echo number_format($orders['tax'], 2) ?></strong></span></p>
                    </div>
                </div>
                <div class="price-div pb-10">
                    <div class="client-info-leftside">
                        <p>Total Invoice Amount (INR)</p>
                    </div>
                    <div class="client-info-rightside">
                        <p><span class="block-text"><strong><?php echo number_format($orders['total'], 2) ?></strong></span></p>
                    </div>
                </div>
                <div class="price-div">
                    <div class="client-info-leftside">
                        <p>In words:</p>
                    </div>
                    <div class="client-info-rightside">
                        <p><span class="block-text"><strong>Rupees &nbsp; <?php echo $amount_in_words ?></strong></span></p>
                    </div>
                </div>
                <div class="licensing-terms">
                    <h2 class="h3"><strong>Payment Instructions:</strong></h2>
                    <div class="licensing-condition">
                        <ul>
                            <li>License Rights are only assigned on payment of this invoice.</li>

                            <li>Payment should be made Immediate from the date of download of the image(s) and can be sent to:
                                <span><strong>Image Footage,</strong></span> c/o Conceptual Pictures Worldwide Pvt. Ltd., 3rd Floor, R5 Chambers, Opposite Pillar No. 2, Humayun Nagar, Mehdipatnam – Hyderabad – 500028, Telangana.
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
