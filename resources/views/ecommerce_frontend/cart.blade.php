@extends('ecommerce_frontend.headers.ecommerce_master')
@section('search')
@include('ecommerce_frontend.headers.search_component')
@endsection
@section('basket')
@include('ecommerce_frontend.headers.basket')
@endsection
@section('content')
    <!-- Begin Breadcrumb -->
    <section class="py-2">
        <div class="container">
            <div class="d-flex justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb align-middle">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Cart</a></li>
                    </ol>
                </nav>
                <a href="{{ route('emptycart') }}" class="btn btn-blue text-white btn-lg">Empty cart</a>
            </div>
        </div>
    </section>
    <!-- end Breadcrumb -->

    <!-- Begin table -->
    <section class="py-5">
        @if ($carts->count() > 0)
            @php
                if (Auth::guard('customer')->check()) {
                    $customer = Auth::guard('customer')->user();
                    $shipping_address = $customer->shippingAddress ? $customer->shippingAddress : $customer->primaryAddress;
                    $shipping_country_id = $shipping_address ? $shipping_address->country_id : config('system_settings.address_default_country');
                    $shipping_state_id = $shipping_address ? $shipping_address->state_id : config('system_settings.address_default_state');
                } else {
                    $geoip = geoip(request()->ip());
                    $shipping_country_id = get_id_of_model('countries', 'iso_3166_2', $geoip->iso_code);
                    $shipping_state_id = $geoip->state;
                }
                
                $country_dropdown = '';
                foreach ($countries as $country_id => $country_name) {
                    $country_dropdown .= '<option value="' . $country_id . '" ';
                    $country_dropdown .= $country_id == $shipping_country_id ? ' selected' : '';
                    $country_dropdown .= '>' . $country_name . '</option>';
                }
            @endphp
            <div class="container">
                @foreach ($carts as $cart)
                    @php
                        $shop_id = $cart->shop_id;
                        $cart_total = 0;
                        if ($cart->shop) {
                            $default_packaging =
                                $cart->shippingPackage ??
                                (optional($cart->shop->packagings)
                                    ->where('default', 1)
                                    ->first() ??
                                    $platformDefaultPackaging);
                        } else {
                            $default_packaging = $cart->shippingPackage ?? $platformDefaultPackaging;
                        }
                        
                        $shipping_zone = get_shipping_zone_of($shop_id, $shipping_country_id, $shipping_state_id);
                        
                        $shipping_options = isset($shipping_zone->id) ? getShippingRates($shipping_zone->id) : 'NaN';
                        
                        $packaging_options = optional($cart->shop)->packagings;
                        
                        $shop_name = DB::table('shops')
                            ->where('id', $shop_id)
                            ->first();
                    @endphp
                    <div class="row shopping-cart-table-wrap mb-4" {{ $expressId == $cart->id ? 'selected' : '' }}"
                        id="cartId{{ $cart->id }}" data-cart="{{ $cart->id }}">
                        <div class="col-md-8">
                            {!! Form::model($cart, ['method' => 'PUT', 'route' => ['cart.update', $cart->id], 'id' => 'formId' . $cart->id]) !!}
                            {{ Form::hidden('cart_id', $cart->id, ['id' => 'cart-id' . $cart->id]) }}
                            {{ Form::hidden('shop_id', $cart->shop->id, ['id' => 'shop-id' . $cart->id]) }}
                            {{ Form::hidden('zone_id', isset($shipping_zone->id) ? $shipping_zone->id : null, ['id' => 'zone-id' . $cart->id]) }}
                            {{ Form::hidden('tax_id', isset($shipping_zone->id) ? $shipping_zone->tax_id : null, ['id' => 'tax-id' . $cart->id]) }}
                            {{ Form::hidden('taxrate', null, ['id' => 'cart-taxrate' . $cart->id]) }}
                            {{ Form::hidden('packaging_id', $default_packaging ? $default_packaging->id : null, ['id' => 'packaging-id' . $cart->id]) }}
                            {{ Form::hidden('shipping_rate_id', $cart->shipping_rate_id, ['id' => 'shipping-rate-id' . $cart->id]) }}
                            {{-- {{ Form::hidden('shipping_rate_id', Null, ['id' => 'shipping-rate-id'.$cart->id]) }} --}}
                            {{ Form::hidden('discount_id', $cart->coupon_id, ['id' => 'discount-id' . $cart->id]) }}
                            {{ Form::hidden('handling_cost', optional($cart->shop->config)->order_handling_cost, ['id' => 'handling-cost' . $cart->id]) }}
                            <div class="border cart-card">
                                <div class="card-header">
                                    Store: {{ $shop_name->name }}
                                </div>
                                <div class="card-body">
                                    <table class="table table shopping-cart-item-table" id="table{{ $cart->id }}">
                                        <tbody>
                                            @foreach ($cart->inventories as $item)
                                                @php
                                                    $unit_price = $item->currnt_sale_price();
                                                    $item_total = $unit_price * $item->pivot->quantity;
                                                    $cart_total += $item_total;
                                                @endphp
                                                <tr class="cart-item-tr">
                                                    <td>
                                                        <input type="hidden" class="freeShipping{{ $cart->id }}"
                                                            value="{{ $item->free_shipping }}">
                                                        <input type="hidden" id="unitWeight{{ $item->id }}"
                                                            value="{{ $item->shipping_weight }}">
                                                        {{ Form::hidden('shipping_weight[' . $item->id . ']', $item->shipping_weight * $item->pivot->quantity, ['id' => 'itemWeight' . $item->id, 'class' => 'itemWeight' . $cart->id]) }}
                                                        <img src="{{ get_storage_file_url(optional($item->image)->path, 'mini') }}"
                                                            class="cart-img" alt="{{ $item->slug }}"
                                                            title="{{ $item->slug }}">
                                                    </td>
                                                    <td>
                                                        <div class="text-muted">Name</div>
                                                        <div>{{ $item->title }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="text-muted">Price</div>
                                                        <span>
                                                            <span id="item-price{{ $cart->id }}-{{ $item->id }}"
                                                                data-value="{{ $unit_price }}">KSh
                                                                {{ number_format($unit_price, 2, '.', '') }}</span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="text-muted">Quantity</div>
                                                        <div class="btn-group btn-group-sm quantity-border" role="group"
                                                            aria-label="Basic outlined example">
                                                            <button type="button" class="btn product-info-qty-minus"
                                                                data-cart="{{ $cart->id }}"
                                                                data-item="{{ $item->id }}">-</button>
                                                            <input name="quantity[{{ $item->id }}]"
                                                                id="itemQtt{{ $item->id }}"
                                                                class="product-info-qty product-info-qty-input"
                                                                data-cart="{{ $cart->id }}"
                                                                data-item="{{ $item->id }}"
                                                                data-min="{{ $item->min_order_quantity }}"
                                                                data-max="{{ $item->stock_quantity }}" type="text"
                                                                value="{{ $item->pivot->quantity }}">
                                                            <button type="button" class="btn product-info-qty-plus"
                                                                data-cart="{{ $cart->id }}"
                                                                data-item="{{ $item->id }}">+</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-muted">Total Price</div>
                                                        <span>KSh
                                                            <span id="item-total{{ $cart->id }}-{{ $item->id }}"
                                                                class="item-total{{ $cart->id }}">{{ number_format($item_total, 2, '.', '') }}</span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a class="cart-item-remove btn-close" href="javascript:void(0)"
                                                            data-cart="{{ $cart->id }}"
                                                            data-item="{{ $item->id }}" data-toggle="tooltip"
                                                            title="Remove Item" aria-label="Close"></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border cart-card">
                                <div class="card-header">
                                    Cart Summary
                                </div>
                                <div class="card-body id=" cart-summary{{ $cart->id }}"">
                                    <table class="table">
                                        <tbody>
                                            <tr class="shopping-cart-summary">
                                                <!-- <td class="w-25">
                                                                <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/vans.png" class="img-fluid img-thumbnail" alt="">
                                                            </td> -->
                                                <td>
                                                    <div class="text-muted">SubTotal</div>
                                                    <span>KSh
                                                        <span
                                                            id="summary-total{{ $cart->id }}">{{ number_format($cart_total, 2, '.', '') }}</span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a class="dynamic-shipping-rates" data-toggle="popover"
                                                            data-cart="{{ $cart->id }}"
                                                            data-options="{{ $shipping_options }}"
                                                            id="shipping-options{{ $cart->id }}"
                                                            title="{{ trans('theme.shipping') }}">
                                                            <div class="text-muted">Shipping</div>
                                                        </a>
                                                        <em id="summary-shipping-name{{ $cart->id }}"
                                                            class="small text-muted"></em>
                                                    </span>
                                                    <span>KSh
                                                        <span
                                                            id="summary-shipping{{ $cart->id }}">{{ number_format(0, 2, '.', '') }}</span>
                                                    </span>
                                                </td>
                                                @unless(empty(json_decode($packaging_options)))
                                                    <td>
                                                        <span>
                                                            <a class="packaging-options" data-toggle="popover"
                                                                data-cart="{{ $cart->id }}"
                                                                data-options="{{ $packaging_options }}"
                                                                title="{{ trans('theme.packaging') }}">
                                                                <u>{{ trans('theme.packaging') }}</u>
                                                            </a>
                                                            <em class="small text-muted"
                                                                id="summary-packaging-name{{ $cart->id }}">
                                                                {{ $default_packaging ? $default_packaging->name : '' }}
                                                            </em>
                                                        </span>
                                                        <span>KSh
                                                            <span id="summary-packaging{{ $cart->id }}">
                                                                {{ number_format($default_packaging ? $default_packaging->cost : 0, 2, '.', '') }}
                                                            </span>
                                                        </span>
                                                    </td>
                                                @endunless
                                                <td id="discount-section-li{{ $cart->id }}"
                                                    style="display: {{ $cart->coupon ? 'block' : 'none' }};">
                                                    <span>{{ trans('theme.discount') }}
                                                        <em id="summary-discount-name{{ $cart->id }}"
                                                            class="small text-muted">{{ $cart->coupon ? $cart->coupon->name : '' }}</em>
                                                    </span>
                                                    <span>-KSh
                                                        <span
                                                            id="summary-discount{{ $cart->id }}">{{ $cart->coupon ? number_format($cart->discount, 2, '.', '') : number_format(0, 2, '.', '') }}</span>
                                                    </span>
                                                </td>
                                                <td id="tax-section-li{{ $cart->id }}" style="display: none;">
                                                    <span>{{ trans('theme.taxes') }}</span>
                                                    <span>KSh
                                                        <span
                                                            id="summary-taxes{{ $cart->id }}">{{ number_format(0, 2, '.', '') }}</span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-muted">Total</div>
                                                    <span>KSh
                                                        <span
                                                            id="summary-grand-total{{ $cart->id }}">{{ number_format(0, 2, '.', '') }}</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                @endforeach
                
                <div class="mt-4">
                    <form id="checkout_all_form" method="post" action="{{route('cart.checkout_all')}}">
                        @csrf      
                        <button type="submit"class="btn btn-blue text-white btn-lg">Checkout all</button>
                      </form>
                </div>
                <div class="accordion pt-5" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Shop By Category
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    @foreach ($categories as $category)
                                        <div class="col-md-3 mb-2">
                                            <h6>
                                                <a href="{{ route('category.browse', $category->slug) }}"
                                                    class="text-decoration-none">
                                                    {{ $category->name }}
                                                </a>
                                            </h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="text-center">
                    <h3 class="blue-heading-txt lh-lg">Your cart is empty. Let's go shopping!</h3>
                    <a href="{{ route('categories') }}" class="btn btn-blue text-white fw-bold px-4">Shop now</a>
                </div>
            </div>
        @endif
    </section>

    <!-- end table -->
@endsection
@section('scripts')
    @include('ecommerce_frontend.scripts.appjs')
    @include('ecommerce_frontend.scripts.cart')
@endsection
