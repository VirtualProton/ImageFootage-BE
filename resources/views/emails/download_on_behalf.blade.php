<!DOCTYPE html>
<html>
<head>
    <title>Product Download Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
            border-radius: 0 0 5px 5px;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .info-box {
            background-color: #e8f4f8;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Your Product has been Downloaded</h2>
        </div>

        <div class="content">
            <p>Dear {{ $user_name }},</p>

            <p>We are pleased to inform you that your requested product has been downloaded on your behalf.</p>

            <div class="info-box">
                <strong>Product Details:</strong><br>
                <strong>Product ID:</strong> {{ $product_id }}<br>
                <strong>Product Type:</strong> {{ $product_type }}<br>
                <strong>Downloaded By:</strong> {{ $admin_name }}<br>
                <strong>Date:</strong> {{ date('Y-m-d H:i:s') }}
            </div>

            <p>The product is now available for download:</p>

            @if(!empty($download_url))
            <a href="{{ $download_url }}" class="button">Download Your Product</a>
            @endif

            <p style="margin-top: 30px;">If you have any questions or need further assistance, please don't hesitate to contact us.</p>

            <p>Best regards,<br>
            <strong>ImageFootage Team</strong></p>
        </div>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this email.</p>
            <p>© {{ date('Y') }} ImageFootage. All rights reserved.</p>
        </div>

        <!-- DEBUG: Product Details Array -->
        <div style="background-color: #f0f0f0; padding: 15px; margin-top: 20px; border: 1px solid #ccc; border-radius: 5px; font-family: monospace; font-size: 11px; color: #333;">
            <strong style="display: block; margin-bottom: 10px;">DEBUG - Product Details Array:</strong>
            <pre style="margin: 0; white-space: pre-wrap; word-wrap: break-word;">{{ print_r($product_details, true) }}</pre>
        </div>
    </div>
</body>
</html>
