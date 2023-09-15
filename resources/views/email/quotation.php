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
    </style>
    <link rel="stylesheet" href="assets/css/email/quotation.css">
</head>

<body>
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
    <!-- Table paragraph section start -->
    <section class="table-paragraph">
        <div class="container">
            <div class="client-info-top">
                <div class="client-info-leftside">
                    <p>Customer Name: <span><strong><?php echo $quotation[0]['first_name'] ?> <?php echo $quotation[0]['last_name'] ?></span></strong></p>
                    <p>Address: <span><strong><?php echo $quotation[0]['address'] ?></strong></span>
                        <span class="block-text"><strong><?php echo $quotation[0]['cityname'] ?>&nbsp;&nbsp; <?php echo $quotation[0]['statename'] ?>&nbsp;&nbsp;<?php echo $quotation[0]['postal_code'] ?></strong></span>
                    </p>
                    <p>Phone: <span><strong><?php echo $quotation[0]['mobile'] ?></strong></span></p>
                </div>
                <div class="client-info-rightside">
                    <p>Estimate No.: <span><strong><?php echo "Q" . $quotation[0]['invoice_name'] ?></span></strong></p>
                    <p>Estimate Date: <span><strong><?php echo date("d.m.Y ", strtotime($quotation[0]['invicecreted'])) ?></strong></span></p>
                    <p>Place: <span><strong><?php echo $quotation[0]['cityname'] . "-" . $quotation[0]['statename'] ?></strong></span></p>
                </div>
            </div>
            <div class="client-info-bottom">
                <div class="client-info-leftside">
                    <p>Kind Attention: <span class="block-text"><strong><?php echo $quotation[0]['first_name'] ?> <?php echo $quotation[0]['last_name'] ?></strong></span></p>
                </div>
                <div class="client-info-rightside">
                    <p>Product Description: <span class="block-text"><strong>Images/Footage- <?php echo count($quotation); ?></strong></span></p>
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
                        <div class="<?php echo $class; ?>">
                            <div><img src="<?php echo $quotation[$i]['product_image']; ?>" alt="photo-gallery" width="200" height="108"></div>
                            <p>Image ID: <?php echo $quotation[$i]['product_id'] ?></p>
                            <p>Size: <?php echo $quotation[$i]['product_size'] ?></p>
                            <p>Cost: <span><strong>INR <?php echo number_format($quotation[$i]['subtotal'], 2) ?>/-</strong></span></p>
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
                <div class="col-lg-12 amount-divs">
                    <div class="start">Amount (INR)</div>
                    <div class="end"><strong><?php echo number_format($amount,2); ?></strong></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>Add: GST @ <?php echo config('constants.GST_VALUE') ?>%</p>
                </div>
            </div>
            <div class="licensing-terms">
                <h2 class="h3"><strong> Licensing Terms: </strong></h2>
                <div class="licensing-condition">
                    <h3 class="h4"><strong>Standard licenses</strong></h3>
                    <p><strong>Most Stock photos, vectors, and illustrations come with a Standard license you may:</strong></p>
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
                    <p><strong>With a Standard license, you may not:</strong></p>
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
                    <h3 class="h4"><strong>Enhanced /Extended licenses</strong></h3>
                    <p><strong>Enhanced / Extended licenses are available for Images, Stock videos, templates, 3D assets, and
                        Premium Collection.</strong></p>
                    <p><strong>With an Enhanced license, you may:</strong></p>
                    <ul>
                        <li>Use the asset with all the rights granted in the Standard license.</li>
                        <li>Reproduce the asset beyond the 500,000 copy/viewer restriction.</li>
                    </ul>
                    <p><strong>With an Enhanced license, you may not:</strong></p>
                    <ul>
                        <li>Distribute the stand-alone file.</li>
                        <li>Create merchandise, templates, or other products for resale or distribution where the
                            primary value of the product is associated with the asset itself. For example, you can't use
                            the asset to create a poster, t-shirt, or coffee mug that someone would buy specifically
                            because of the asset printed on it.</li>
                    </ul>
                </div>
            </div>
            <div class="terms-of-payment licensing-terms">
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
            <p>For <span>Image Footage</span></p>
            <img src="<?php echo $quotation[0]['signature']; ?>" alt="signature" width="171" height="89">
            <p>Authorized Signatory</p>
        </div>
    </section>
    <!-- Signature section end -->
    <!-- Footer start -->
    <footer>
        <div class="container">
            <div class="footer-left">
                <h2 class="h4"><strong>Image Footage</strong></h2>
                <p>3rd Floor, # 10-3-89/A/B, R-5 Chambers, Near Sarojini Devi Hospital, Humayun Nagar, Hyderabad -
                    500028, Telangana, Andhra Pradesh, India Phone: +91 40 6720 6720 <span> Fax +91 40 6673 8077</span>
                </p>
                <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
                <a href="<?php echo $quotation[0]['frontend_url']; ?>"><?php echo $quotation[0]['frontend_url']; ?></a>
            </div>
            <div class="footer-right">
                <h3 class="h2">looking forward</h3>
            </div>
        </div>
    </footer>
    <!-- Footer end -->
</body>

</html>