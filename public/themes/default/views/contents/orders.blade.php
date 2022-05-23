@if($orders->count() > 0)
  <table class="table" id="buyer-order-table">
      <thead>
          <tr>
            <th colspan="7">@lang('theme.your_order_history')</th>
          </tr>
          <tr>
              <th>Order ID</th>
              <th>Date & Time</th>
              <th>Merchant / Shop</th>
              <th>Mobile</th>
              <th>Amount</th>
              <th>Payment Method</th>
              <th>STATUS</th>
          </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)

        @php $pm = DB::table('payment_methods')->where('id',$order->payment_method_id)->get();
            $pmn = '';
            if($pm[0]->type == 1){
                $pmn = 'MPESA';
            }else{
                $pmn = 'Cash On Delivery';
            }
        @endphp
        @php $pm2 = DB::table('shops')->where('id',$order->shop_id)->get(); @endphp
        @php $pm3 = DB::table('users')->where('id',$pm2[0]->owner_id)->get(); @endphp
            <tr class="text-center">
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->created_at->toDayDateTimeString() }}</td>
                <td>
                    @if($order->shop->name)
                    <a href="{{ route('show.store', $order->shop->slug) }}"> {{ $order->shop->name }}</a>
                  @else
                    @lang('theme.store_not_available')
                  @endif
                </td>
                <td>{{ $pm3[0]->mobile }}</td>
                <td>{{ round($order->grand_total) }} KSh</td>
                <td>{{ $pmn }}</td>
                <td>{{ optional($order->status)->name }}</td>
            </tr>

          @if($order->message_to_customer)
            <tr class="message_from_seller">
              <td colspan="6">
                <p>
                  <strong>@lang('theme.message_from_seller'): </strong> {{ $order->message_to_customer }}
                </p>
              </td>
            </tr>
          @endif

          @if($order->buyer_note)
            <tr class="order-info-footer">
              <td colspan="6">
                <p class="order-detail-buyer-note">
                  <span>@lang('theme.note'): </span> {{ $order->buyer_note }}
                </p>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
  </table>
  <div class="sep"></div>
@else
  <div class="clearfix space50"></div>
  <p class="lead text-center space50">
    @lang('theme.no_order_history')
    <a href="{{ url('/') }}" class="btn btn-success btn-sm flat">@lang('theme.button.shop_now')</a>
  </p>
@endif

<div class="row pagenav-wrapper">
  {{ $orders->links('layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->
<div class="clearfix space20"></div>