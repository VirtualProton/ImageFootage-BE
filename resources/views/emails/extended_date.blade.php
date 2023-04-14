@component('mail::message')
Hello {{ $order['user']['first_name'] }}

Your Subscription Plan Expiry date extended to {{ date('Y-m-d', strtotime($order['extended_date'])) }}

Please check below attechments for more information

Thanks,<br>
{{ config('app.name') }}
@endcomponent
