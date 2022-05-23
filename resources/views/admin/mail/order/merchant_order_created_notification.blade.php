@component('mail::message')
#{{ trans('notifications.merchant_order_created_notification.greeting', ['merchant' => $order->shop->name]) }}

{{ trans('notifications.merchant_order_created_notification.message', ['order' => $order->order_number]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.merchant_order_created_notification.action.color')])
{{ trans('notifications.merchant_order_created_notification.action.text') }}
@endcomponent

@include('admin.mail.order.merchant_order_detail_panel', ['order_detail' => $order])

{{ trans('messages.thanks') }},<br>
{{ $order->shop->name  . ', ' . get_platform_title() }}
    @if(Storage::exists('logo.png') )
        <img src="{{url(Storage::url('logo.png')) }}" alt="SAM SERVE" style="width:100px" />
    @else
        <img src="https://placehold.it/140x60/eee?text={{ get_platform_title() }}" alt="SAM SERVE" />
    @endif
@endcomponent
