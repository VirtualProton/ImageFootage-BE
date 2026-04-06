<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Complete Your Payment</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f8f8; margin: 0; padding: 0; }
        .container { background: #fff; max-width: 600px; margin: 40px auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px #eee; }
        .btn { display: inline-block; padding: 12px 24px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .footer { margin-top: 30px; font-size: 13px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello {{ $cname }},</h2>
        <p>Thank you for choosing Imagefootage. Please complete your payment by clicking the button below:</p>
        <p style="margin: 30px 0;">
            <a href="{{ $payment_link }}" class="btn" target="_blank">Pay Now</a>
        </p>
        <p>If you have any questions, feel free to reply to this email.</p>
        <div class="footer">
            Regards,<br>
            Imagefootage Team
        </div>
    </div>
</body>
</html>