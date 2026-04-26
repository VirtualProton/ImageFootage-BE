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
         margin-top: 30px;
         margin-bottom: 50px;
      }

      header {
         position: relative;
         top: auto;
         left: auto;
         right: auto;
         bottom: auto;
      }

      body {
         margin-top: 0.5cm;
         margin-left: 2cm;
         margin-right: 2cm;
         margin-bottom: 2cm;
      }

      .main {
         padding: 10px;
      }

      /* Invoice header */
      .invoice-header-table {
         width: 100%;
         border-bottom: 1px solid #ddd;
         margin-bottom: 0;
         padding-bottom: 20px;
      }

      .invoice-header-table td {
         vertical-align: bottom;
      }

      .invoice-logo {
         width: 160px;
      }

      .invoice-logo img {
         max-width: 160px;
         height: auto;
         border: 1px dashed #ccc;
         padding: 8px 20px;
      }

      .invoice-title-cell {
         text-align: right;
         padding-bottom: 5px;
      }

      .invoice-title-line1 {
         font-size: 11px;
         letter-spacing: 6px;
         color: #888888;
         text-transform: uppercase;
         display: block;
         font-weight: 400;
         margin-bottom: 0;
      }

      .invoice-title-line2 {
         font-size: 11px;
         letter-spacing: 8px;
         color: #888888;
         text-transform: uppercase;
         display: block;
         font-weight: 400;
         margin-bottom: 2px;
      }

      .invoice-title-hello {
         font-size: 62px;
         font-weight: 700;
         color: #f7b500;
         /* #f7b500 */
         font-style: normal;
         line-height: 1;
         display: block;
      }

      /* Invoice info section */
      .invoice-info-table {
         width: 100%;
         margin-top: 10px;
         margin-bottom: 15px;
         border-collapse: collapse;
      }

      .invoice-info-table td {
         padding: 4px 12px;
         font-size: 13px;
         vertical-align: top;
      }

      .invoice-info-table .label {
         color: #888;
         width: 100px;
         white-space: nowrap;
      }

      .invoice-info-table .value {
         color: #6c6c6c;
         font-weight: 700;
      }

      /* Client details section */
      .client-details-section {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 15px;
      }

      .client-details-section td {
         padding: 4px 12px;
         font-size: 13px;
         vertical-align: top;
      }

      .client-details-title {
         font-size: 15px;
         font-weight: 700;
         padding: 8px 12px;
      }

      .client-label {
         color: #888;
         width: 110px;
         white-space: nowrap;
      }

      .client-value {
         color: #6c6c6c;
         font-weight: 700;
      }

      /* Items table */
      .items-table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 10px;
      }

      .items-table thead th {
         background-color: #444;
         color: #fff;
         padding: 10px 12px;
         font-size: 13px;
         text-align: left;
      }

      .items-table thead th:last-child {
         text-align: right;
      }

      .items-table tbody td {
         padding: 10px 12px;
         font-size: 13px;
         vertical-align: top;
         border-bottom: 1px solid #eee;
      }

      .items-table .sno-col {
         width: 50px;
         text-align: center;
      }

      .items-table .price-col {
         width: 120px;
         text-align: right;
         font-weight: 700;
         white-space: nowrap;
      }

      .item-title {
         font-weight: 700;
         font-size: 14px;
         margin-bottom: 8px;
      }

      .item-body {
         display: table;
         width: 100%;
      }

      .item-thumb {
         display: table-cell;
         width: 130px;
         vertical-align: top;
         padding-right: 12px;
      }

      .item-thumb img {
         width: 120px;
         height: 80px;
         object-fit: cover;
         background-color: #eee;
         display: block;
      }

      .item-details {
         display: table-cell;
         vertical-align: top;
         font-size: 13px;
         line-height: 22px;
      }

      .item-details strong {
         font-weight: 700;
      }

      /* Amount rows */
      .amount-table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 2px;
      }

      .amount-table td {
         padding: 10px 12px;
         font-size: 14px;
         background-color: rgba(89, 89, 89, 0.15);
      }

      .amount-table .amount-label {
         text-align: left;
      }

      .amount-table .amount-value {
         text-align: right;
         font-weight: 700;
      }

      .single-gray-block {
         padding: 8px 12px;
         font-size: 14px;
         background-color: rgba(89, 89, 89, 0.15);
         margin-bottom: 15px;
      }

      /* Licensing / payment */
      .licensing-terms .h3 {
         font-size: 18px;
         font-weight: 700;
         color: #0563c1;
         margin-bottom: 12px;
         text-decoration: underline;
      }

      .licensing-terms ul,
      .licensing-terms ol {
         margin-left: 40px;
         margin-bottom: 15px;
      }

      .licensing-terms li {
         line-height: 24px;
         font-size: 14px;
      }

      /* Signature */
      .signature {
         text-align: right;
         padding: 50px 0 0 0;
      }

      .signature p {
         font-size: 14px;
      }

      .signature p span {
         font-size: 18px;
         font-weight: 700;
      }

      .signature img {
         width: 110px;
         height: auto;
         margin: 7px 0;
      }

      .page-break {
         page-break-before: always;
      }
   </style>
   <link rel="stylesheet" href="assets/css/email/quotation.css">
</head>

<body>
   <!-- Header start -->
   <header>
      <div class="container" style="margin-left: 2cm; margin-right: 2cm;">
         <table class="invoice-header-table" cellpadding="0" cellspacing="0">
            <tr>
               <td class="invoice-logo" style="width: 200px; vertical-align: bottom;">
                  <?php if ($quotation[0]['flag'] == 0) { ?>
                  <svg width="200" height="36" viewBox="0 0 311 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g clip-path="url(#clip0_logo_if)">
                        <path d="M35.3956 56H20.9668C18.2122 56.0042 15.4839 55.4683 12.9382 54.4229C10.3924 53.3775 8.07939 51.8431 6.1316 49.9079C4.18381 47.9726 2.63957 45.6744 1.58739 43.1451C0.535211 40.6157-0.00421628 37.9049 2.48151e-05 35.168V20.832C-0.00421628 18.0951 0.535211 15.3843 1.58739 12.855C2.63957 10.3256 4.18381 8.02745 6.1316 6.09218C8.07939 4.15691 10.3924 2.6226 12.9382 1.57718C15.4839 0.53177 18.2122-0.00418918 20.9668 2.46556e-05H35.3956C38.1502-0.00418918 40.8785 0.53177 43.4242 1.57718C45.9699 2.6226 48.283 4.15691 50.2308 6.09218C52.1786 8.02745 53.7228 10.3256 54.775 12.855C55.8272 15.3843 56.3666 18.0951 56.3624 20.832V35.168C56.3666 37.9049 55.8272 40.6157 54.775 43.1451C53.7228 45.6744 52.1786 47.9726 50.2308 49.9079C48.283 51.8431 45.9699 53.3775 43.4242 54.4229C40.8785 55.4683 38.1502 56.0042 35.3956 56Z" fill="#020202"/>
                        <path d="M39.4214 26.944H23.9943H16.9409V33.856V45.312H23.9943V33.856H39.4214V26.944Z" fill="white"/>
                        <path d="M19.8718 26.016C19.0952 26.0135 18.3512 25.7058 17.8022 25.1603C17.2531 24.6147 16.9435 23.8755 16.9409 23.104C16.9435 22.3325 17.2531 21.5932 17.8022 21.0477C18.3512 20.5021 19.0952 20.1945 19.8718 20.192C20.6483 20.1945 21.3923 20.5021 21.9414 21.0477C22.4904 21.5932 22.8001 22.3325 22.8026 23.104C22.8039 23.4868 22.7289 23.866 22.5821 24.2199C22.4353 24.5737 22.2194 24.8953 21.947 25.1659C21.6746 25.4366 21.351 25.651 20.9949 25.7969C20.6387 25.9428 20.257 26.0173 19.8718 26.016Z" fill="white"/>
                        <path d="M39.3892 10.688H22.8026V19.264H39.3892V10.688Z" fill="white"/>
                        <path d="M70.5978 39.488H65.4125V18.848H70.5978V39.488Z" fill="black"/>
                        <path d="M87.893 27.616L92.3376 18.912L99.2621 18.88V39.488H94.0768V26.816L89.7932 34.4H85.7674L81.7415 26.816V39.488H76.5562V18.88H83.2874L87.893 27.616Z" fill="black"/>
                        <path d="M110.663 18.88H115.108L124.416 39.488H118.715L117.491 36.832H108.216L106.992 39.488H101.291L110.663 18.88ZM110.277 32.224H115.527L112.918 26.528L110.277 32.224Z" fill="black"/>
                        <path d="M142.452 26.88H143.45V39.488H134.722C132.399 39.5064 130.139 38.739 128.313 37.312C127.443 36.64 126.692 35.8289 126.091 34.912C125.488 34.0026 125.021 33.0108 124.706 31.968C124.413 30.8945 124.283 29.7836 124.319 28.672C124.384 27.5029 124.656 26.3545 125.124 25.28C125.573 24.2 126.205 23.2042 126.992 22.336C127.739 21.5033 128.621 20.8003 129.601 20.256C130.557 19.7285 131.589 19.3507 132.661 19.136C133.742 18.9179 134.851 18.8747 135.946 19.008C137.062 19.1444 138.15 19.4577 139.167 19.936C140.233 20.4372 141.203 21.1194 142.033 21.952L138.361 25.888C137.821 25.1239 137.038 24.5608 136.139 24.288C135.342 24.0654 134.504 24.0325 133.691 24.192C132.881 24.3595 132.121 24.7099 131.469 25.216C130.782 25.7525 130.249 26.4587 129.923 27.264C129.576 28.0704 129.443 28.9519 129.537 29.824C129.627 30.6466 129.914 31.4359 130.373 32.1261C130.832 32.8163 131.451 33.3875 132.178 33.792C132.944 34.2201 133.811 34.4408 134.69 34.432H138.168V31.68H133.112V26.88H142.452Z" fill="black"/>
                        <path d="M148.088 24.032V18.88H164.256V24.032H153.273V26.592H161.84V31.744H153.273V34.304H164.256V39.456H148.088V24.032Z" fill="black"/>
                        <path d="M170.15 24.032V18.88H186.125V24.032H175.335V26.592H184.257V31.744H175.335V39.456H170.15V24.032Z" fill="black"/>
                        <path d="M199.555 18.88C200.938 18.8667 202.309 19.1391 203.581 19.68C206.057 20.7319 208.029 22.6919 209.088 25.152C209.62 26.4195 209.893 27.7789 209.893 29.152C209.893 30.5251 209.62 31.8846 209.088 33.152C208.029 35.6122 206.057 37.5721 203.581 38.624C202.305 39.1521 200.937 39.424 199.555 39.424C198.173 39.424 196.805 39.1521 195.529 38.624C193.053 37.5721 191.08 35.6122 190.022 33.152C189.49 31.8846 189.216 30.5251 189.216 29.152C189.216 27.7789 189.49 26.4195 190.022 25.152C190.81 23.2883 192.136 21.6982 193.833 20.5821C195.529 19.4659 197.52 18.8737 199.555 18.88ZM199.555 34.336C200.24 34.3417 200.919 34.2111 201.552 33.952C202.172 33.6961 202.731 33.3147 203.194 32.832C203.653 32.3491 204.033 31.7986 204.321 31.2C204.837 29.9269 204.837 28.5052 204.321 27.232C204.064 26.6161 203.68 26.0603 203.194 25.6C202.708 25.1447 202.154 24.7669 201.552 24.48C200.27 23.9681 198.839 23.9681 197.558 24.48C196.938 24.7359 196.379 25.1174 195.915 25.6C195.457 26.0829 195.077 26.6335 194.788 27.232C194.273 28.5052 194.273 29.9269 194.788 31.2C195.046 31.8159 195.43 32.3717 195.915 32.832C196.401 33.2874 196.956 33.6652 197.558 33.952C198.191 34.2111 198.87 34.3417 199.555 34.336Z" fill="black"/>
                        <path d="M223.13 18.88C224.514 18.8667 225.885 19.1391 227.156 19.68C229.632 20.7319 231.605 22.6919 232.664 25.152C233.195 26.4195 233.469 27.7789 233.469 29.152C233.469 30.5251 233.195 31.8846 232.664 33.152C231.605 35.6122 229.632 37.5721 227.156 38.624C225.881 39.1521 224.512 39.424 223.13 39.424C221.748 39.424 220.38 39.1521 219.105 38.624C216.628 37.5721 214.656 35.6122 213.597 33.152C213.066 31.8846 212.792 30.5251 212.792 29.152C212.792 27.7789 213.066 26.4195 213.597 25.152C214.386 23.2883 215.712 21.6982 217.408 20.5821C219.105 19.4659 221.096 18.8737 223.13 18.88ZM223.13 34.336C223.815 34.3417 224.494 34.2111 225.127 33.952C225.747 33.6961 226.307 33.3147 226.77 32.832C227.228 32.3491 227.608 31.7986 227.897 31.2C228.412 29.9269 228.412 28.5052 227.897 27.232C227.639 26.6161 227.256 26.0603 226.77 25.6C226.284 25.1447 225.73 24.7669 225.127 24.48C223.846 23.9681 222.415 23.9681 221.134 24.48C220.514 24.7359 219.954 25.1174 219.491 25.6C219.033 26.0829 218.652 26.6335 218.364 27.232C217.849 28.5052 217.849 29.9269 218.364 31.2C218.621 31.8159 219.005 32.3717 219.491 32.832C219.977 33.2874 220.531 33.6652 221.134 33.952C221.767 34.2111 222.446 34.3417 223.13 34.336Z" fill="black"/>
                        <path d="M245.128 18.88H250.764V24.032H245.128V39.488H239.942V24.032H234.274V18.88H245.128Z" fill="black"/>
                        <path d="M256.561 18.88H261.006L270.314 39.488H264.613L263.389 36.832H254.114L252.89 39.488H247.189L256.561 18.88ZM256.175 32.224H261.425L258.816 26.528L256.175 32.224Z" fill="black"/>
                        <path d="M288.35 26.88H289.348V39.488H280.62C278.297 39.5064 276.037 38.739 274.211 37.312C273.341 36.64 272.59 35.8289 271.988 34.912C271.386 34.0026 270.919 33.0108 270.604 31.968C270.311 30.8945 270.181 29.7836 270.217 28.672C270.281 27.5029 270.554 26.3545 271.022 25.28C271.471 24.2 272.103 23.2042 272.89 22.336C273.637 21.5033 274.519 20.8003 275.499 20.256C276.455 19.7285 277.487 19.3507 278.559 19.136C279.64 18.9179 280.749 18.8747 281.844 19.008C282.96 19.1444 284.048 19.4577 285.065 19.936C286.131 20.4372 287.101 21.1194 287.931 21.952L284.259 25.888C283.718 25.1239 282.936 24.5608 282.037 24.288C281.24 24.0654 280.402 24.0325 279.589 24.192C278.779 24.3595 278.019 24.7099 277.367 25.216C276.68 25.7525 276.147 26.4587 275.821 27.264C275.474 28.0704 275.341 28.9519 275.435 29.824C275.525 30.6466 275.812 31.4359 276.271 32.1261C276.73 32.8163 277.349 33.3875 278.076 33.792C278.842 34.2201 279.708 34.4408 280.588 34.432H284.066V31.68H279.01V26.88H288.35Z" fill="black"/>
                        <path d="M293.986 24.032V18.88H310.154V24.032H299.171V26.592H307.738V31.744H299.171V34.304H310.154V39.456H293.986V24.032Z" fill="black"/>
                     </g>
                     <defs><clipPath id="clip0_logo_if"><rect width="310.154" height="56" fill="white"/></clipPath></defs>
                  </svg>
                  <?php } else { ?>
                  <svg width="200" height="38" viewBox="0 0 437.89 82.23" xmlns="http://www.w3.org/2000/svg">
                     <g>
                        <path fill="#3b404a" d="M0,13.89c.12-.6.22-1.2.36-1.79.55-2.28,1.71-4.22,3.23-5.99C9.43-.65,21.74-.51,27.21,8.07c1.83,2.89,2.39,6.07,1.84,9.46-.43,2.64-1.72,4.81-3.39,6.86-5.6,6.87-19.03,6.75-24.18-3.09-.74-1.4-1.15-2.86-1.38-4.4-.01-.09-.01-.17-.09-.23v-2.77Z"/>
                        <path fill="#2bb0d4" d="M423.4,0c0,.21-.02.41-.02.61,0,5.81-.04,11.62.02,17.43.03,2.53.05,5.06.09,7.59.04,2.34.81,4.46,2.13,6.39,2.74,3.99,6.61,5.78,11.36,5.88.19,0,.38.01.57-.01.27-.02.35.11.34.37-.01.82-.02,1.65,0,2.47,0,.3-.11.37-.38.37-6.77-.04-12.07-2.73-15.44-8.73-1.15-2.06-1.76-4.35-1.74-6.74.03-4.17-.15-8.35-.12-12.52.03-4.37,0-8.74,0-13.11h3.19Z"/>
                        <path fill="#3b404a" d="M34.03,22.7c0-3.87.95-7.29,2.78-10.51,1.46-2.56,3.43-4.62,5.74-6.41,4.45-3.45,9.56-4.84,15.09-4.5,7.41.44,13.44,3.62,17.6,9.87,3.16,4.76,4.09,10.04,2.9,15.67-.53,2.52-1.65,4.76-2.95,6.95-1.59,2.69-3.84,4.63-6.38,6.32-4.61,3.08-9.72,4.06-15.16,3.45-5.34-.6-9.94-2.82-13.7-6.68-2.51-2.59-4.17-5.68-5.18-9.15-.5-1.71-.72-3.43-.73-5.01"/>
                        <path fill="#3b404a" d="M21.67,82.23c-6.85-.18-12.87-2.81-17.31-8.53-2.72-3.49-4.06-7.53-4.18-12-.11-3.95.95-7.5,2.96-10.86,1.55-2.58,3.66-4.58,6.08-6.31,4.17-2.98,8.87-4.15,13.91-3.87,6.91.39,12.64,3.25,16.75,8.88,3.4,4.67,4.55,9.95,3.48,15.68-.48,2.54-1.38,4.9-2.78,7.1-1.66,2.59-3.85,4.59-6.38,6.31-3.69,2.51-7.81,3.5-12.53,3.6"/>
                        <path fill="#3b404a" d="M63.92,82.13c-5.06-.18-9.38-2.27-12.32-6.8-1.06-1.63-1.62-3.48-1.94-5.41-.59-3.66.4-6.86,2.53-9.79,2.42-3.34,5.78-5.04,9.78-5.72,2.97-.52,5.82-.15,8.48,1.15,3.67,1.81,6.44,4.55,7.67,8.57.79,2.58.79,5.18.06,7.8-.75,2.69-2.23,4.85-4.32,6.69-2.78,2.43-6.05,3.42-9.94,3.52"/>
                        <path fill="#2bb0d4" d="M278.1,26.52c-.7,0-1.41-.03-2.1.11-2.84.56-5.5,1.5-7.63,3.57-2.11,2.04-3.42,4.49-3.86,7.4-.11.68-.06.72.63.64,3.21-.37,5.98-1.66,8.28-3.93.29-.28.45-.31.73,0,.47.52.97,1.02,1.49,1.49.34.3.27.48-.02.76-1.68,1.67-3.6,2.95-5.81,3.79-6.09,2.35-11.82,1.54-16.94-2.38-3.54-2.71-5.56-6.42-6.02-10.97-.47-4.69,1.07-8.59,4.22-11.96,3.55-3.8,8.01-5.37,13.14-5.29,1.22.02,2.42.09,3.58.44,3,.94,5.79,2.34,7.92,4.71,2.82,3.14,4.38,6.81,4.3,11.11,0,.4-.11.54-.51.51-.46-.04-.92-.01-1.39-.01M263.99,12.93c-4.84.11-7.81,1.47-10.57,4.39-2.89,3.05-3.94,6.68-3,10.82.17.73.34,1.47.65,2.16,1.88,4.26,5.22,6.69,9.66,7.74.29.07.44.05.48-.34.32-3.09,1.57-5.82,3.45-8.25,1.33-1.73,3.08-3,4.96-4.08,1.99-1.14,4.22-1.68,6.5-1.87.42-.04.46-.18.38-.53-.38-1.62-1.05-3.13-2.02-4.46-2.7-3.73-6.49-5.42-10.5-5.58"/>
                        <path fill="#2bb0d4" d="M284.98,48.54c0-4.6.06-9.19-.02-13.78-.05-2.85-.04-5.71-.09-8.57-.06-4.49,1.46-8.32,4.64-11.52,3.2-3.23,7.08-4.74,11.55-4.87,4.69-.14,8.81,1.35,12.23,4.57,3.6,3.4,5.18,7.64,4.79,12.59-.2,2.56-1.12,4.84-2.46,6.99-1.03,1.66-2.38,2.98-3.9,4.17-1.09.86-2.32,1.42-3.55,2.03-2.24,1.12-4.63,1.33-7.07,1.38-.32,0-.46-.06-.45-.43.03-.78.03-1.58,0-2.36-.02-.35.11-.43.44-.43,1.6.03,3.19-.11,4.71-.64,2.24-.78,4.29-1.95,5.85-3.76,3.86-4.48,4.23-10.11,1.41-14.71-2.28-3.71-5.66-5.68-9.89-6.23-3.12-.41-6.12.12-8.77,1.84-3.9,2.52-6.16,6.07-6.26,10.85-.05,2.7-.24,5.41-.17,8.11.07,2.74-.07,5.47-.11,8.2-.06,4.54-.2,9.07-.3,13.61-.06,2.52-.13,5.04-.17,7.55,0,.48-.14.64-.61.6-.37-.04-.76-.05-1.13,0-.56.07-.67-.17-.67-.67.01-4.84,0-9.67,0-14.51h0Z"/>
                        <path fill="#2bb0d4" d="M166.11,25.96c0,3.42-1.09,6.46-3.1,9.23-2.23,3.07-5.26,4.92-8.83,6-4.97,1.5-9.7.82-13.99-1.98-4.33-2.83-6.95-6.86-7.3-12.16-.28-4.18.97-7.85,3.64-11.07,2.72-3.27,6.24-4.98,10.35-5.72,3.62-.65,7.06-.15,10.26,1.51,3.77,1.95,6.61,4.84,8.07,8.92.61,1.7.94,3.46.9,5.29M149.47,38.65c3.83-.13,7.21-1.28,9.86-4.19,1.73-1.88,2.96-4.01,3.35-6.57.59-3.93-.44-7.41-3.07-10.36-5.2-5.84-14.7-5.69-19.72-.51-4.19,4.31-5.05,10.67-1.81,15.58,2.68,4.06,6.6,5.91,11.39,6.05"/>
                        <path fill="#2bb0d4" d="M414.54,32.71c0,2.66-.01,5.31.01,7.97,0,.44-.13.56-.55.53-.67-.03-1.34-.04-2,0-.5.04-.66-.08-.66-.63.03-5.14.03-10.28.01-15.43-.01-3.21-1.15-6.02-3.4-8.3-2.04-2.06-4.52-3.47-7.42-4-2.6-.48-5.18-.35-7.65.63-2.18.87-4.09,2.15-5.55,4.01-3.75,4.74-3.65,10.6-.51,14.97,2.55,3.55,6.05,5.32,10.36,5.6.19.01.38.02.57.02q1.09.04,1.09,1.15c0,.53,0,1.06,0,1.59,0,.26-.05.37-.33.36-6.77-.02-12.14-2.67-15.38-8.71-2.65-4.94-2.46-10.02.37-14.95.98-1.71,2.29-3.09,3.77-4.36.97-.83,2.08-1.42,3.19-2.03,5.52-2.99,13.91-2.14,19.16,2.92.71.68,1.29,1.5,1.91,2.27,1.46,1.82,2.4,3.89,2.78,6.2.17,1.01.24,2.04.25,3.07,0,2.36,0,4.73,0,7.09"/>
                        <path fill="#2bb0d4" d="M204.38,33.14c0,2.69,0,5.38.01,8.07,0,.41-.1.54-.52.52-.73-.03-1.48-.03-2.21,0-.44.02-.58-.08-.57-.56.02-5.13.01-10.25.01-15.37,0-1.83-.4-3.56-1.17-5.22-.43-.92-.91-1.81-1.59-2.57-2.46-2.72-5.45-4.47-9.16-4.87-2.45-.27-4.87-.05-7.07,1.06-4.24,2.15-7.1,5.43-7.67,10.35-.06.58-.08,1.16-.08,1.74,0,4.99,0,9.98.01,14.97,0,.46-.12.58-.57.56-.77-.04-1.54-.02-2.31-.01-.26,0-.42-.03-.42-.35.02-5.4-.03-10.8.05-16.21.06-3.66,1.48-6.81,3.84-9.62,2.85-3.37,6.51-5,10.79-5.6,3.03-.42,5.92-.03,8.65,1.19,3.24,1.44,5.84,3.67,7.76,6.71,1.59,2.51,2.19,5.23,2.21,8.14.02,2.35,0,4.7,0,7.05"/>
                        <path fill="#2bb0d4" d="M343.93,18.35c0-3.18.01-5.79-.01-8.39,0-.41.12-.52.52-.5.75.03,1.51.03,2.26,0,.41-.02.51.11.51.51-.02,3.7-.02,7.4,0,11.11,0,1.77-.07,3.56.06,5.34.15,2.3.95,4.37,2.29,6.23,3.15,4.4,7.53,5.95,12.77,5.44,1.5-.14,2.95-.52,4.26-1.25,2.71-1.48,4.98-3.44,6.28-6.32.7-1.56,1.08-3.21,1.08-4.93,0-4.86,0-9.73,0-14.6,0-.4-.16-.76-.12-1.16.02-.25.05-.37.34-.37.87.02,1.75.02,2.62,0,.29,0,.32.12.33.36.21,5.36.14,10.72.06,16.07-.06,4.41-1.95,8.07-5.2,11.06-3.02,2.78-6.6,4.13-10.64,4.3-4.88.21-9.15-1.31-12.68-4.7-2.93-2.81-4.48-6.29-4.68-10.35-.14-2.81-.01-5.62-.05-7.86"/>
                        <path fill="#2bb0d4" d="M111.84,10.07c3.19.01,6.08.71,8.7,2.3,1.32.81,2.53,1.8,3.62,2.91.13.14.17.23.02.38-.62.61-1.23,1.23-1.84,1.87-.22.24-.31.05-.44-.07-1.19-1.15-2.5-2.16-4.02-2.81-5.17-2.18-10.13-1.77-14.57,1.73-4.62,3.66-5.99,9.3-3.77,14.47,1.82,4.26,5.21,6.67,9.64,7.58,4.13.84,7.95-.03,11.35-2.6.5-.37.87-.86,1.32-1.28.26-.24.38-.2.61.02.62.57,1.1,1.26,1.7,1.84.26.25,0,.35-.12.49-1.76,1.79-3.79,3.14-6.16,3.97-1.93.69-3.9,1.21-5.99,1.15-3.02-.08-5.9-.72-8.48-2.3-3.47-2.1-6.18-4.93-7.38-8.88-1.61-5.29-.75-10.17,2.78-14.53,2.54-3.14,5.81-4.99,9.73-5.86,1.14-.25,2.28-.35,3.31-.4"/>
                        <path fill="#2bb0d4" d="M225.97,38.42c3.57-.03,6.76-1.21,9.45-3.7.14-.12.27-.24.37-.41.17-.3.41-.37.61-.04.42.66,1.03,1.14,1.56,1.69.27.28.27.41,0,.68-1.84,1.84-3.97,3.19-6.42,4.04-5.74,1.99-11.12,1.22-15.96-2.41-2.87-2.15-4.99-4.97-5.87-8.55-.8-3.21-.59-6.36.51-9.49.64-1.84,1.71-3.36,2.96-4.79,3.12-3.58,7.12-5.21,11.78-5.57,2.45-.2,4.79.14,7.03,1.05,2.25.92,4.28,2.26,5.99,4.02.21.21.14.32-.03.5-.57.55-1.12,1.11-1.66,1.68-.21.22-.34.25-.57.02-.86-.84-1.77-1.62-2.84-2.19-5.07-2.73-10.1-2.62-14.93.52-1.75,1.14-3.27,2.66-4.15,4.6-1.35,2.96-1.82,6.06-.79,9.23,1.74,5.29,5.6,8.03,10.91,8.98.64.12,1.29.12,2.03.14"/>
                        <path fill="#2bb0d4" d="M323.84,13.99c0-4,0-7.99,0-11.98,0-.44-.06-.88-.1-1.31-.03-.27.04-.4.35-.4.82.02,1.65.02,2.47,0,.26,0,.34.06.35.34.1,1.53.12,3.07.08,4.61,0,.43.11.54.54.54,4.93-.02,9.87,0,14.81-.02.49,0,.66.09.63.6-.05.69-.03,1.41,0,2.11.01.36-.06.49-.47.5-4.96.17-9.93.07-14.89.07-.51,0-.61.15-.61.63.02,5.2,0,10.39.02,15.58.02,5.14,2.49,8.81,6.9,11.25,2.04,1.12,4.24,1.61,6.56,1.59.93,0,.93,0,.93.95,0,.67,0,1.34,0,2,0,.26-.06.36-.34.36-4.57.06-8.7-1.22-12.06-4.36-3.36-3.13-5.21-7.02-5.18-11.7.02-3.79,0-7.58,0-11.37"/>
                     </g>
                  </svg>
                  <?php } ?>
               </td>
               <td class="invoice-title-cell">
                  <span class="invoice-title-line1">THIS IS YOUR</span>
                  <span class="invoice-title-line2">ESTIMATE</span>
                  <span class="invoice-title-hello" style="color: <?php echo ($quotation[0]['flag'] == 0) ? '#1a7cbf' : '#f7b500'; ?>;">hello</span>
               </td>
            </tr>
         </table>
      </div>
   </header>
   <!-- Header end -->
   <!-- Main content -->
   <main class="main">

      <!-- Invoice Info Section -->
      <table class="invoice-info-table" cellpadding="0" cellspacing="0">
         <tr>
            <td class="label" width="12%">Estimate No.</td>
            <td class="value" width="38%"><?php echo config('constants.INVOICE_PREFIX') . $quotation[0]['invoice_name']; ?></td>
            <td class="label" width="15%">Company Name</td>
            <td class="value" width="35%">Conceptual Pictures Worldwide Pvt. Ltd</td>
         </tr>
         <tr>
            <td class="label">Estimate Date</td>
            <td class="value"><?php echo date("d.m.Y", strtotime($quotation[0]['invicecreted'])); ?></td>
            <td class="label">Company Pan No</td>
            <td class="value"><?php echo config('constants.PAN_VALUE'); ?></td>
         </tr>
         <tr>
            <td class="label">Client Code</td>
            <td class="value"><?php echo $quotation[0]['vendor_code']; ?></td>
            <td class="label">GSTIN</td>
            <td class="value"><?php echo config('constants.GSTIN_VALUE'); ?></td>
         </tr>
         <tr>
            <td class="label"></td>
            <td class="value"></td>
            <td class="label">CIN Number</td>
            <td class="value"><?php echo config('constants.CIN_VALUE') ?? ''; ?></td>
         </tr>
      </table>

      <hr style="border: none; border-top: 1px solid #ddd; margin: 0 0 15px;">

      <!-- Client Details Section -->
      <table class="client-details-section" cellpadding="0" cellspacing="0">
         <tr>
            <td colspan="4" class="client-details-title">Client Details</td>
         </tr>
         <tr>
            <td colspan="2" style="padding: 8px 12px; vertical-align: top; width: 50%;">
               <p style="margin: 0 0 3px; font-weight: 700;">
                  <?php echo !empty($quotation[0]['company']) ? $quotation[0]['company'] : $quotation[0]['first_name'] . ' ' . $quotation[0]['last_name']; ?>
               </p>
               <p style="margin: 0 0 3px;"><?php echo $quotation[0]['address'] ?? ''; ?></p>
               <p style="margin: 0 0 3px;">
                  <?php echo $quotation[0]['cityname'] ?? ''; ?>
                  <?php if (!empty($quotation[0]['postal_code'])) { ?> - <?php echo $quotation[0]['postal_code']; ?><?php } ?>
               </p>
               <p style="margin: 0 0 8px;"><?php echo $quotation[0]['countryname'] ?? ''; ?></p>
               <p style="margin: 0 0 3px;">Pan No &nbsp; <strong><?php echo $quotation[0]['pan'] ?? ''; ?></strong></p>
               <p style="margin: 0 0 3px;">GSTIN &nbsp; <strong><?php echo $quotation[0]['gst'] ?? ''; ?></strong></p>
            </td>
            <td colspan="2" style="padding: 8px 12px; vertical-align: top; width: 50%;">
               <table cellpadding="0" cellspacing="0" style="width: 100%;">
                  <tr>
                     <td class="client-label">Ordered By</td>
                     <td class="client-value"><?php echo $quotation[0]['first_name'] . ' ' . $quotation[0]['last_name']; ?></td>
                  </tr>
                  <tr>
                     <td class="client-label">Mail ID</td>
                     <td class="client-value"><?php echo $quotation[0]['email'] ?? ''; ?></td>
                  </tr>
                  <tr>
                     <td class="client-label">Contact No.</td>
                     <td class="client-value"><?php echo $quotation[0]['mobile'] ?? ''; ?></td>
                  </tr>
                  <tr>
                     <td class="client-label">Sales Person</td>
                     <td class="client-value"><?php echo $quotation[0]['contact_owner'] ?? (Auth::guard('admins')->user()->name ?? ''); ?></td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>

      <!-- Items Table -->
      <table class="items-table" cellpadding="0" cellspacing="0">
         <thead>
            <tr>
               <th class="sno-col">S. No.</th>
               <th>Description</th>
               <th style="text-align: right;">Unit Price</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $amount = 0;
            for ($i = 0; $i < count($quotation); $i++) {
               if (!empty($quotation[$i])) {
                  $amount += $quotation[$i]['total'] - $quotation[$i]['tax'];
                  $itemCode = trim($quotation[$i]['product_id'] ?? '');
                  $itemName = trim($quotation[$i]['name'] ?? '');
                  $itemTitle = $itemCode . (($itemCode !== '' && $itemName !== '') ? ' : ' : '') . $itemName;
                  if ($itemTitle === '') {
                     $itemTitle = 'Asset ' . ($i + 1);
                  }
            ?>
               <tr<?php if ($i > 0 && $i % 5 == 0) { ?> class="page-break"<?php } ?>>
                  <td class="sno-col"><?php echo $i + 1; ?></td>
                  <td>
                     <div class="item-title"><?php echo htmlspecialchars($itemTitle); ?></div>
                     <table cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tr>
                           <td style="width: 130px; vertical-align: top; padding-right: 12px;">
                              <?php if (!empty($quotation[$i]['product_image']) && $quotation[$i]['type'] != 'Music') { ?>
                                 <img src="<?php echo $quotation[$i]['product_image']; ?>" alt="thumbnail" style="width: 120px; height: 80px; object-fit: cover; background-color: #eee; display: block;">
                              <?php } elseif ($quotation[$i]['type'] == 'Music') { ?>
                                 <?php if (!empty($quotation[0]['music_image'])) { ?>
                                    <img src="<?php echo $quotation[0]['music_image']; ?>" alt="thumbnail" style="width: 120px; height: 80px; object-fit: cover; background-color: #eee; display: block;">
                                 <?php } else { ?>
                                 <div style="width: 120px; height: 80px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; text-align: center;">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M9 18V5l12-2v13" stroke="#bbb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                       <circle cx="6" cy="18" r="3" stroke="#bbb" stroke-width="1.5"></circle>
                                       <circle cx="18" cy="16" r="3" stroke="#bbb" stroke-width="1.5"></circle>
                                    </svg>
                                 </div>
                                 <?php } ?>
                              <?php } elseif ($quotation[$i]['type'] == 'Footage') { ?>
                                 <div style="width: 120px; height: 80px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; text-align: center;">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <rect x="2" y="4" width="20" height="16" rx="2" stroke="#bbb" stroke-width="1.5"></rect>
                                       <path d="M2 8h20M2 16h20M7 4v16M17 4v16" stroke="#bbb" stroke-width="1.5" stroke-linecap="round"></path>
                                       <polygon points="10,9 10,15 15,12" fill="#bbb"></polygon>
                                    </svg>
                                 </div>
                              <?php } else { ?>
                                 <div style="width: 120px; height: 80px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; text-align: center;">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <rect x="3" y="3" width="18" height="18" rx="2" stroke="#bbb" stroke-width="1.5"></rect>
                                       <circle cx="8.5" cy="8.5" r="1.5" fill="#bbb"></circle>
                                       <path d="M3 16l5-5 4 4 3-3 6 6" stroke="#bbb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                 </div>
                              <?php } ?>
                           </td>
                           <td style="vertical-align: top; font-size: 13px; line-height: 22px;">
                              <?php if (!empty($quotation[$i]['type'])) { ?>
                                 <div><strong>File Type:</strong> <?php echo htmlspecialchars($quotation[$i]['type']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['licence_type'])) { ?>
                                 <div><strong>License Type:</strong> <?php echo htmlspecialchars(strip_tags($quotation[$i]['licence_type'])); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['product_size'])) { ?>
                                 <div><strong>Size:</strong> <?php echo htmlspecialchars($quotation[$i]['product_size']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['size'])) { ?>
                                 <div><strong>Resolution Type:</strong> <?php echo htmlspecialchars($quotation[$i]['size']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['resolution'])) { ?>
                                 <div><strong>Resolution:</strong> <?php echo htmlspecialchars($quotation[$i]['resolution']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['format'])) { ?>
                                 <div><strong>File Format:</strong> <?php echo htmlspecialchars($quotation[$i]['format']); ?></div>
                              <?php } ?>
                              <?php if (!empty($quotation[$i]['duration'])) { ?>
                                 <div><strong>Duration:</strong> <?php echo htmlspecialchars($quotation[$i]['duration']); ?></div>
                              <?php } ?>
                           </td>
                        </tr>
                     </table>
                  </td>
                  <td class="price-col"><?php echo number_format($quotation[$i]['subtotal'], 2); ?></td>
               </tr>
            <?php
               }
            }
            ?>
         </tbody>
      </table>

      <!-- Total Assets & Summary Section -->
      <?php
         $taxAmount = (float) ($quotation[0]['tax'] ?? 0);
         $totalAmount = (float) ($quotation[0]['total'] ?? 0);
         $subTotal = max($totalAmount - $taxAmount, 0);
         $discountAmount = 0;
         $currencySymbol = ($quotation[0]['currency'] ?? 'INR') === 'USD' ? '$' : '₹';
      ?>
      <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px; margin-bottom: 10px;">
         <tr>
            <td style="vertical-align: top; width: 50%; padding: 10px 0;">
               <p style="font-size: 14px; font-weight: 700;">Total Assets: <?php echo count($quotation); ?></p>
            </td>
            <td style="vertical-align: top; width: 50%;">
               <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <tr>
                     <td style="padding: 8px 12px; font-size: 13px; border-bottom: 1px solid #eee;">Sub Total</td>
                     <td style="padding: 8px 12px; font-size: 13px; text-align: right; border-bottom: 1px solid #eee;"><?php echo $currencySymbol; ?><?php echo number_format($subTotal, 2); ?></td>
                  </tr>
                  <tr>
                     <td style="padding: 8px 12px; font-size: 13px; border-bottom: 1px solid #eee;">Discount</td>
                     <td style="padding: 8px 12px; font-size: 13px; text-align: right; border-bottom: 1px solid #eee;">- <?php echo $currencySymbol; ?><?php echo number_format($discountAmount, 2); ?></td>
                  </tr>
                  <?php if (!empty($taxAmount)) { ?>
                  <tr>
                     <td style="padding: 8px 12px; font-size: 13px; border-bottom: 1px solid #eee;">IGST <?php echo config('constants.GST_VALUE'); ?>%</td>
                     <td style="padding: 8px 12px; font-size: 13px; text-align: right; border-bottom: 1px solid #eee;"><?php echo $currencySymbol; ?><?php echo number_format($taxAmount, 2); ?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td style="padding: 10px 12px; font-size: 14px; font-weight: 700; background-color: #e8e8e8; color: #000;"><strong>Total Due</strong></td>
                     <td style="padding: 10px 12px; font-size: 14px; font-weight: 700; text-align: right; background-color: #e8e8e8; color: #000;"><strong><?php echo $currencySymbol; ?><?php echo number_format($totalAmount, 2); ?></strong></td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>

      <!-- System-generated notice -->
      <div style="border-top: 3px solid #c8a415; padding-top: 10px; margin-bottom: 20px;">
         <p style="font-size: 12px; font-style: italic; color: #555; line-height: 18px;">
            This is a system-generated invoice and does not require any official signature. It reflects our records of the transaction with you. Please inform us immediately if you notice any discrepancies in the details.
         </p>
      </div>

      <!-- Remit To / Bank Transfers Section -->
      <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; border-collapse: collapse; margin-bottom: 0;">
         <tr>
            <hr style="border: none; border-top: 2px solid #0a0a0a; margin: 0 0 15px;">
            <td style="vertical-align: top; width: 45%; padding: 15px 20px; border-right: 1px solid #ddd;">
               <p style="font-size: 14px; font-weight: 700; margin: 0 0 10px;">Remit To</p>
               <p style="font-size: 13px; margin: 0 0 3px;">Conceptual Pictures Worldwide Pvt. Ltd.</p>
               <p style="font-size: 13px; margin: 0 0 3px;">R5 Chambers, 3rd Floor,</p>
               <p style="font-size: 13px; margin: 0 0 3px;">Opp. Pillar No. 02, Mehdipatnam,</p>
               <p style="font-size: 13px; margin: 0 0 8px;">Hyderabad, Telangana 500028</p>
               <p style="font-size: 13px; margin: 0;">Finance: accounts@conceptualpictures.com</p>
            </td>
            <td style="vertical-align: top; width: 55%; padding: 15px 20px;">
               <p style="font-size: 14px; font-weight: 700; margin: 0 0 10px;">Bank Transfers To</p>
               <table cellpadding="0" cellspacing="0" style="width: 100%;">
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Account Name:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">Conceptual Pictures Worldwide Pvt. Ltd.</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Account Type:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">Current</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Bank Name:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">HDFC Bank Ltd</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Bank Address:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">Mallepally, Vijaynagar Colony, Hyderabad 500057</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Bank Account:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">50200000502220</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">Swift Code:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">HDFCINBB</td>
                  </tr>
                  <tr>
                     <td style="font-size: 13px; color: #888; padding: 2px 10px 2px 0; white-space: nowrap;">IFSC Code:</td>
                     <td style="font-size: 13px; font-weight: 700; color: #6c6c6c; padding: 2px 0;">HDFC0001998</td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>

      <!-- Pay Online Button -->
      <?php if (!empty($quotation[0]['payment_url'])) { ?>
      <div style="margin-bottom: 25px; padding: 12px 20px; background-color: #f5f5f5; border-top: 1px solid #ddd;">
         <table cellpadding="0" cellspacing="0">
            <tr>
               <td style="font-size: 14px; padding-right: 15px; vertical-align: middle;">For Online Payment</td>
               <td style="vertical-align: middle;">
                  <a href="<?php echo htmlspecialchars($quotation[0]['payment_url']); ?>" style="display: inline-block; background: <?php echo ($quotation[0]['flag'] == 0) ? '#1a7cbf' : '#e6a817'; ?>; color: #ffffff; text-decoration: none; padding: 10px 24px; border-radius: 4px; font-weight: 700; font-size: 14px;">Pay Online &rarr;</a>
               </td>
            </tr>
         </table>
      </div>
      <?php } ?>

      <!-- Invoice Terms & License Conditions -->
      <div style="margin-bottom: 20px;">
         <h2 style="font-size: 16px; font-weight: 700; margin: 0 0 8px;">Invoice Terms &amp; License Conditions.</h2>
         <hr style="border: none; border-top: 2px solid #0a0a0a; margin: 0 0 15px;">
         <ol style="margin-left: 20px; padding-left: 0; font-size: 13px; line-height: 22px;">
            <li style="margin-bottom: 10px;">This Invoice is valid for 30 days from the date of issue unless stated otherwise. Prices are subject to change after the validity period.</li>
            <li style="margin-bottom: 10px;">All content is subject to availability at the time of licensing. The Company reserves the right to replace unavailable assets with comparable alternatives.</li>
            <li style="margin-bottom: 10px;">
               <strong>License Grant:</strong> Upon receipt of full payment, ImageFootage grants a non-exclusive, non-transferable, royalty-free license to use the licensed content strictly in accordance with the License Type specified on this invoice. Licenses usually include:
               <ol style="list-style-type: upper-alpha; margin-left: 20px; margin-top: 8px;">
                  <li style="margin-bottom: 5px;">Digital/Standard License – Online Commercial or Editorial use (no broadcast / theater / DVD / VOD). Including promotion / marketing / merchandising / endorsement of a brand, product or commercial service.</li>
                  <li style="margin-bottom: 5px;">Commercial License – Indoor / outdoor TV / POP / Online (no broadcast / theater / DVD / VOD). Including promotion / marketing / merchandising / endorsement of a brand, product or commercial service.</li>
                  <li style="margin-bottom: 5px;">Non Commercial License – All Media Non Commercial (Editorial) (including broadcast / theater / DVD / VOD). No promotion / marketing / merchandising / endorsement of a brand, product or commercial service.</li>
                  <li style="margin-bottom: 5px;">All Media License – EXTENDED All Media (including TVC / Broadcast, Theater / DVD / VOD). Including promotion / marketing / merchandising / endorsement of a brand, product or commercial service.</li>
               </ol>
            </li>
            <li style="margin-bottom: 10px;">
               <strong>Usage Restrictions:</strong> Content may not be resold, sublicensed, redistributed, or made available as standalone files. Use in unlawful, misleading, defamatory, or pornographic content is strictly prohibited.
            </li>
            <li style="margin-bottom: 10px;">
               <strong>Ownership:</strong> All intellectual property rights remain the property of ImageFootage and/or its licensors. No ownership rights are transferred to the client.
            </li>
         </ol>
      </div>

   </main>
</body>

</html>