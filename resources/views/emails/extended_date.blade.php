@component('mail::message')
Hello {{ $order['user']['first_name'] }}

Your plan expiry date has been extended to {{ date('Y-m-d', strtotime($order['package_extended_expiry_data'] ?? $order['extended_date'])) }}

Please check below attechments for more information

Thanks,<br>
{{ config('app.name') }}
@endcomponent
