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

        .main {
            border: 1px solid black;
            padding: 10px
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
                <h1 class="h1"><strong>hi</strong></h1>
                <span><strong>this is an estimate</strong></span>
            </div>
            <div class="header-logo">
                <img src="<?php echo $quotation[0]['company_logo']; ?>" alt="logo" width="1920" height="351">
            </div>
        </div>
    </header>
    <!-- Header end -->
    <!-- Footer start -->
    <footer>
        <?php if ($quotation[0]['flag'] == 0) { ?>
            <div class="container">
                <div class="footer-left">
                    <h2 class="h4"><strong><?php config('constants.company_name') ?></strong></h2>
                    <p style="font-size: 11px;">3rd Floor, # 10-3-89/A/B, R-5 Chambers, Near Sarojini Devi Hospital, Humayun Nagar, Hyderabad -
                        500028, Telangana, Andhra Pradesh, India Phone: +91 40 6720 6720 <span> Fax +91 40 6673 8077</span>
                    </p>
                    <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
                    <a href="<?php echo $quotation[0]['frontend_url']; ?>"><?php echo $quotation[0]['frontend_url']; ?></a>
                </div>
                <div class="footer-right">
                    <h3 class="h2">looking forward</h3>
                </div>
            </div>
        <?php } else { ?>
            <div class="container">
                <div class="footer-left" style="font-size: 11px;">
                    <h2 class="h4"><strong>Conceptual Pictures Worldwide Private Limited</strong></h2>
                    <p>3rd Floor, # 10-3-89/A/B, R-5 Chambers,
                        Humayun Nagar, Hyderabad - 500028, Telangana,
                        Andhra Pradesh, India Phone: +91 40 6720 6720
                    </p>
                    <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
                    <a href="<?php echo $quotation[0]['frontend_url']; ?>"><?php echo $quotation[0]['frontend_url']; ?></a>
                </div>
                <div class="footer-right">
                    <h3 class="h3">looking forward</h3>
                </div>
            </div>
        <?php } ?>
    </footer>
    <!-- Footer end -->
    <!-- Wrap the content of your PDF inside a main tag -->
    <main class="main">
        <!-- Table paragraph section start -->
        <section class="table-paragraph">
            <div class="container">
                <div class="client-info-top">
                    <div class="client-info-leftside">
                        <?php if ($quotation[0]['flag'] == 2) { ?>

                            <p style="font-size: 11px;">Customer Name: <span><strong><?php echo !empty($quotation[0]['company']) ? $quotation[0]['company'] : $quotation[0]['first_name'] . ' ' . $quotation[0]['last_name'] ?> </span></strong></p>
                        <?php } ?>
                        <?php if ($quotation[0]['flag'] !== 2) { ?>
                            <p style="font-size: 11px;">Customer Name: <span><strong><?php echo $quotation[0]['first_name'] . ' ' . $quotation[0]['last_name'] ?> </span></strong></p>
                        <?php } ?>
                        <p style="font-size: 11px;">Address: <span><strong><?php echo $quotation[0]['address'] ?></strong></span>
                            <span class="block-text" style="white-space: break-spaces; display:inline;"><strong><?php echo $quotation[0]['cityname'] ?>&nbsp;&nbsp; <?php echo $quotation[0]['statename'] ?>&nbsp;&nbsp;<?php echo $quotation[0]['postal_code'] ?></strong></span>
                        </p>
                        <p style="font-size: 11px;">Mobile: <span><strong><?php echo $quotation[0]['mobile'] ?></strong></span></p>
                    </div>
                    <div class="client-info-rightside">
                        <p style="font-size: 11px;">Estimate No.: <span><strong><?php echo "Q" . $quotation[0]['invoice_name'] ?></span></strong></p>
                        <p style="font-size: 11px;">Estimate Date: <span><strong><?php echo date("d.m.Y ", strtotime($quotation[0]['invicecreted'])) ?></strong></span></p>
                        <p style="font-size: 11px;">GSTIN: <span><strong><?php echo config('constants.GSTIN_VALUE') ?></strong></span></p>
                        <p style="font-size: 11px;">PAN No.: <span><strong><?php echo config('constants.PAN_VALUE') ?></strong></span></p>
                        <p style="font-size: 11px;">SAC Code: <span><strong><?php echo config('constants.SAC_CODE') ?></strong></span></p>
                        <p style="font-size: 11px;">Vendor Code : <span><strong><?php echo $quotation[0]['vendor_code'] ?></strong></span></p>
                        <p style="font-size: 11px;">Place: <span><strong><?php echo config('constants.QI_ADDRESS') ?></strong></span></p>
                    </div>
                </div>
                <div class="client-info-bottom">
                    <div class="client-info-leftside">
                        <p style="font-size: 11px;">Kind Attention: <span class="block-text" style="white-space: break-spaces; display:inline;"><strong><?php echo $quotation[0]['first_name'] ?> <?php echo $quotation[0]['last_name'] ?></strong></span></p>
                    </div>
                    <div class="client-info-rightside">
                        <?php if ($quotation[0]['flag'] == 2) { ?>
                            <p style="font-size: 11px;">End Client: <span class="block-text" style="display:inline;"><strong><?php echo $quotation[0]['end_client'] ?></strong></span></p>
                        <?php } ?>
                        <p style="font-size: 11px;">Product Description: <span class="block-text"><strong>Images/Footage - <?php echo count($quotation); ?></strong></span></p>
                    </div>
                </div>
                <?php
                $amount = 0;
                for ($i = 0; $i < count($quotation); $i++) {
                    if ($i % 3 == 0) {
                        ?>
                        <div class="row">
                        <?php
                        }
                        if (!empty($quotation[$i])) {
                            $amount += $quotation[$i]['total'] - $quotation[$i]['tax'];
                            if ($i % 3 == 1) {
                                $class = "col-lg-4 second-div";
                            } else {
                                $class = "col-lg-4 ";
                            } ?>
                            <div class="<?php echo $class; ?>" style="font-size: 11px;">
                                <div style="padding-top: 10px;">
                                    <?php if ($quotation[$i]['type'] == 'Music') { ?>
                                        <img src="<?php echo $quotation[0]['music_image']; ?>" alt="photo-gallery" width="200" height="108" style="width:100%">
                                    <?php } else { ?>
                                        <img src="<?php echo $quotation[$i]['product_image']; ?>" alt="photo-gallery" width="200" height="108" style="width:100%">
                                    <?php } ?>
                                </div>


                                <?php if (!empty($quotation[$i]['product_id']) || !empty($quotation[$i]['product_image'])) { ?>
                                    <p style="font-size: 11px;">Product ID: <span><strong><?php echo $quotation[$i]['product_id']; ?></strong></span></p>
                                    <p style="font-size: 11px;">Size: <span><strong><?php echo $quotation[$i]['product_size']; ?></strong></span></p>
                                    <p style="font-size: 11px;">Cost: <span><strong>INR <?php echo number_format($quotation[$i]['subtotal'], 2) ?>/-</strong></span></p>
                                <?php  } ?>
                            </div>
                        <?php
                        }
                        if ($i % 3 == 0) {
                            ?>
                        </div>
                    <?php
                    }
                }
                ?>
                <div class="row mb-0 amount-divs-row">
                    <div class="col-lg-12 amount-divs" style="padding: 0; width:100%; ">

                        <div class="start-end">
                            <!-- <div class="start" >Total (INR)</div>
                         <div class="end"><strong>987465</strong></div> -->

                            <table width="100%">
                                <tr>
                                    <td width="50%" style="text-align: left; padding: 10px; background-color: rgba(89, 89, 89, 0.29);font-size: 11px;">
                                        Total (INR)
                                    </td>
                                    <td width="50%" style="text-align: right; padding: 10px; background-color: rgba(89, 89, 89, 0.29);font-size: 11px;">
                                        <strong><?php echo $quotation[0]['total']; ?></strong>
                                    </td>
                                </tr>
                            </table>
                        </div>


                        <?php
                        if ($quotation[0]['tax'] != 0) {
                            ?>
                            <div class="row" style="border:1px solid white;">
                                <div class="col-lg-12" style="padding: 0;width:100%">
                                    <p style="padding: 10px;background-color: rgba(89, 89, 89, 0.29);margin: 4px 0;font-size: 11px;">Added: GST @ <?php echo config('constants.GST_VALUE') ?>%</p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-lg-12 single-gray-block" style="margin-bottom:20px;width:100%;border:1px solid white;font-size: 11px;">
                            <p>In words: <strong>Rupees <?php echo $amount_in_words . ' only' ?></strong></p>
                        </div>
                    </div>
                </div>


                <div class="licensing-terms" style="font-size: 11px;">
                    <h3 class="h3"><strong> Licensing Terms: </strong></h3>
                    <div class="licensing-condition">
                        <h3 class="h4"><strong>Standard licenses</strong></h3>
                        <p style="font-size: 13px;"><strong>Most Stock photos, vectors, and illustrations come with a Standard license you may:</strong></p>
                        <ul>
                            <li>Reproduce up to 500,000 copies of the asset in all media, including product packaging,
                                printed marketing materials, digital documents, or software.</li>
                            <li>Include the asset in email marketing, mobile advertising, or a broadcast or digital program
                                if the expected number of viewers is fewer than 500,000.</li>
                            <li>Post the asset to a website or social media site with no limitation on views.</li>
                            <li>Include the asset in some types of products, such as inside a textbook, as long as the
                                primary value of the product is not the asset itself, and the product is not reproduced more
                                than 500,000 times.</li>
                            <li>Share the unmodified asset with your employees and contractors who have contractually agreed
                                to abide by the license terms.</li>
                            <li>Transfer the license to your client or employer.</li>
                        </ul>
                        <p style="font-size: 13px;"><strong>With a Standard license, you may not:</strong></p>
                        <ul>
                            <li>Distribute the stand-alone file.</li>
                            <li>Create merchandise, templates, or other products for resale or distribution where the
                                primary value of the product is associated with the asset itself. For example, you can't use
                                the asset to create a poster, t-shirt, or coffee mug that someone would buy specifically
                                because of the asset printed on it.</li>
                            <li>Transfer the license to more than one employer or client, unless separately licensed for
                                each.</li>
                        </ul>
                    </div>
                    <div class="licensing-condition">
                        <h3 class="h3"><strong>Enhanced /Extended licenses</strong></h3>
                        <p style="font-size: 13px;"><strong>Enhanced / Extended licenses are available for Images, Stock videos, templates, 3D assets, and
                                Premium Collection.</strong></p>
                        <p style="font-size: 13px;"><strong>With an Enhanced license, you may:</strong></p>
                        <ul>
                            <li>Use the asset with all the rights granted in the Standard license.</li>
                            <li>Reproduce the asset beyond the 500,000 copy/viewer restriction.</li>
                        </ul>
                        <p style="font-size: 13px;"><strong>With an Enhanced license, you may not:</strong></p>
                        <ul>
                            <li>Distribute the stand-alone file.</li>
                            <li>Create merchandise, templates, or other products for resale or distribution where the
                                primary value of the product is associated with the asset itself. For example, you can't use
                                the asset to create a poster, t-shirt, or coffee mug that someone would buy specifically
                                because of the asset printed on it.</li>
                        </ul>
                    </div>
                </div>
                <div class="terms-of-payment licensing-terms" style="font-size: 11px;">
                    <h3 class="h4"><strong>Terms of Payment: </strong></h3>
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
                        <li>For Payment through Credit/Debit Card <a href="<?php echo $quotation[0]['payment_url']; ?>"><strong>click here</strong></a></li>
                        <li>All disputes are subject to Hyderabad Jurisdiction.</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Table paragraph section end -->
        <!-- Signature section start -->
        <section class="signature">
            <div class="container">
                <p>For <span><?php config('constants.company_name') ?></span></p>
                <img src="<?php echo $quotation[0]['signature']; ?>" alt="signature" width="171" height="89">
                <p>Authorized Signatory</p>
            </div>
        </section>
        <!-- Signature section end -->
    </main>
</body>

</html>