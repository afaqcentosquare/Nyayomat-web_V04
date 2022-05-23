@component('mail::message')
#{{ trans('notifications.order_paid.greeting', ['customer' => $order->customer->getName()]) }}

{{ trans('notifications.order_paid.message', ['order' => $order->order_number]) }}
<br/>

@component('mail::button', ['url' => $url, 'color' => trans('notifications.order_paid.action.color')])
{{ trans('notifications.order_paid.action.text') }}
@endcomponent

@include('admin.mail.order._order_detail_panel', ['order_detail' => $order])

{{ trans('messages.thanks') }},<br>
{{ $order->shop->name  . ', ' . get_platform_title() }}
@if(Storage::exists('logo.png') )
    <img src="{{url(Storage::url('logo.png')) }}" alt="SAM SERVE" style="width:100px" />
@else
    <img src="https://placehold.it/140x60/eee?text={{ get_platform_title() }}" alt="SAM SERVE" />
@endif
@endcomponent
