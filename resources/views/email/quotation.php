<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Image-Footage</title>
   <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
   <!-- <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&display=swap" rel="stylesheet"> -->
   <link rel="stylesheet" href="assets/css/email/quotation.css">
</head>

<body>
   <!-- Header start -->
   <header>
      <div class="container">
         <div class="header-text">
            <h1 class="h1">hi</h1>
            <span>this is an estimate</span>
         </div>
         <div class="header-logo">
            <img src="images/conceptual_logo.png" alt="logo" width="1920" height="351">
         </div>
      </div>
   </header>
   <!-- Header end -->
   <!-- Table paragraph section start -->
   <section class="table-paragraph">
        <div class="container">
            <div class="client-info-top">
                <div class="client-info-leftside">
                    <p>Customer Name: <span><?php echo $quotation[0]['first_name'] ?> <?php echo $quotation[0]['last_name'] ?></strong></span></p>
                    <p>Address: <span><?php echo $quotation[0]['address'] ?></span>
                        <span class="block-text"><?php echo $quotation[0]['cityname'] ?>&nbsp;&nbsp; <?php echo $quotation[0]['statename'] ?>&nbsp;&nbsp;<?php echo $quotation[0]['postal_code'] ?></span>
                    </p>
                    <p>Phone: <span><?php echo $quotation[0]['mobile'] ?></span></p>
                </div>
                <div class="client-info-rightside">
                    <p>Estimate No.: <span><?php echo "Q" . $quotation[0]['invoice_name'] ?></span></p>
                    <p>Estimate Date: <span><?php echo date("d.m.Y ", strtotime($quotation[0]['invicecreted'])) ?></span></p>
                    <p>Place: <span>Hyderabad – Telangana</span></p>
                </div>
            </div>
            <div class="client-info-bottom">
                <div class="client-info-leftside">
                    <p>Kind Attention: <span class="block-text"><?php echo $quotation[0]['first_name'] ?> <?php echo $quotation[0]['last_name'] ?></span></p>
                </div>
                <div class="client-info-rightside">
                    <p>Product Description: <span class="block-text"><?php echo $quotation[0]['description'] ?></span></p> 
                    <!-- verify -->
                </div>
            </div>
            <div class="row">
                <?php 
                $amount = 0;
                if(!empty($quotation)){
                    foreach($quotation as $index => $single_quotation){
                        $amount += $single_quotation['subtotal'];
                        if($index > 0) {
                            $class = "col-lg-4 ml-1-p";
                        } else {
                            $class = "col-lg-4";
                        } ?>
                        <div class=<?php echo $class; ?>>
                            <div><img src="<?php echo $single_quotation['product_image']; ?>" alt="photo-gallery" width="200" height="108"></div>
                            <p>Image ID: <?php echo $single_quotation['product_id'] ?></p>
                            <p>Size: <?php echo $single_quotation['product_size'] ?></p>
                            <p>Cost: <span>INR <?php echo $single_quotation['subtotal'] ?>/-</span></p>
                        </div>
                  <?php  
                  }
                } 
                ?>
            </div>
            <div class="row mb-0 amount-divs-row">
                <div class="col-lg-12 amount-divs">
                    <div class="start">Amount (INR)</div>
                    <div class="end"><?php echo $amount.'/-'; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>Add: GST @ 18%</p>
                </div>
            </div>
            <div class="licensing-terms">
                <h2 class="h3">Licensing Terms: </h2>
                <div class="licensing-condition">
                    <h3 class="h4">Standard licenses</h3>
                    <p>Most Stock photos, vectors, and illustrations come with a Standard license you may:</p>
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
                    <p>With a Standard license, you may not:</p>
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
                    <h3 class="h4">Enhanced /Extended licenses</h3>
                    <p>Enhanced / Extended licenses are available for Images, Stock videos, templates, 3D assets, and
                        Premium Collection.</p>
                    <p>With an Enhanced license, you may:</p>
                    <ul>
                        <li>Use the asset with all the rights granted in the Standard license.</li>
                        <li>Reproduce the asset beyond the 500,000 copy/viewer restriction.</li>
                    </ul>
                    <p>With an Enhanced license, you may not:</p>
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
                <h3 class="h4">Terms of Payment: </h3>
                <ul>
                    <li>License Rights are only assigned on issuance of a <span>Purchase Order</span> and <span>Upfront
                            Commitment</span>.</li>
                    <li>Payment can be made in favour of <span>M/s. Conceptual Pictures Worldwide Private
                            Limited</span>.
                        <ol>
                            <li>Through A/c. Payee Cheques/DD payable at Hyderabad</li>
                            <li> RTGS/NEFT to <span>A/c. No. 50200000502220, HDFC Bank Ltd</span>, Vijay Nagar Branch,
                                Hyderabad
                                IFSC Code: <span>HDFC0001998</span>.</li>
                        </ol>
                    </li>
                    <li>For Payment through Credit/Debit Card <a href="#">click here</a></li>
                    <li>All disputes are subject to Hyderabad Jurisdiction.</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Table paragraph section end -->

    <!-- Footer start -->
    <footer>
        <div class="container">
            <div class="footer-left">
                <h2 class="h4">Image Footage</h2>
                <p>3rd Floor, # 10-3-89/A/B, R-5 Chambers, Near Sarojini Devi Hospital, Humayun Nagar, Hyderabad -
                    500028, Telangana, Andhra Pradesh, India Phone: +91 40 6720 6720 <span> Fax +91 40 6673 8077</span>
                </p>
                <a href="info@imagefootage.com" class="info">info@imagefootage.com </a>
                <a href="www.imagefootage.com">www.imagefootage.com</a>
            </div>
            <div class="footer-right">
                <h3 class="h2">looking forward</h3>
            </div>
        </div>
    </footer>
    <!-- Footer end -->
</body>

</html>