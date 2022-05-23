@extends('ecommerce_frontend.headers.ecommerce_master')
@section('css')
    <link rel="stylesheet" href="{{ asset('acp/frontend/checkout.css') }}">
@endsection
@section('search')
@include('ecommerce_frontend.headers.search_component')
@endsection
@section('basket')
@include('ecommerce_frontend.headers.basket')
@endsection
@section('content')
    <!-- Begin Breadcrumb -->
    <section class="pt-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-middle">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Checkout</a></li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- end Breadcrumb -->

    <section class="py-5">
        {!! Form::open(['route' => ['order.all'], 'id' => 'checkoutForm', 'class' => 'checkout', 'data-toggle' => 'validator', 'novalidate']) !!}
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="checkout-title mb-4">
                        <h4 class="blue-heading-txt">Total Amount: <b class="famount"></b></h4>
                    </div>
                    @php
                        $allTotal = 0;
                    @endphp
                    @foreach ($carts as $cart)
                        @php
                            $shop = App\Shop::where('id', $cart->shop_id)->first();
                            
                        @endphp

                        @if (Session::has('error'))
                            <div class="notice notice-danger notice-sm">
                                <strong>{{ trans('theme.error') }}</strong> {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="notice notice-warning notice-sm space20" id="checkout-notice"
                            style="display: {{ $cart->shipping_rate_id || $cart->is_free_shipping() ? 'none' : 'block' }};">
                            <strong>{{ trans('theme.warning') }}</strong>
                            <span id="checkout-notice-msg">@lang('theme.notify.seller_doesnt_ship')</span>
                        </div>
                        <div class="cart-card border mb-3">
                            <div class="card-header">
                                @if ($shop != null || count($shop) > 0)
                                    <img src="{{ get_storage_file_url(optional($shop->image)->path, 'tiny') }}"
                                        class="seller-info-logo img-sm img-circle" alt="{{ trans('theme.logo') }}">

                                    <a href="{{ route('show.store', $shop->slug) }}" class="seller-info-name">
                                        {{ $shop->name }}
                                    </a>
                                @else
                                    <img src="" class="seller-info-logo img-sm img-circle"
                                        alt="{{ trans('theme.logo') }}">

                                    <a href="#" class="seller-info-name">

                                    </a>
                                @endif
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <!-- <td class="w-25">
                                                                                                <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/vans.png" class="img-fluid img-thumbnail" alt="">
                                                                                            </td> -->
                                            <td>
                                                <div class="text-muted">SubTotal</div>
                                                <span>{{ round($cart->total, 2) }} KSh</span>
                                            </td>
                                            <td>
                                                <div class="text-muted">Shipping</div>
                                                <span>
                                                    @if ($cart->get_shipping_cost() > 0)
                                                        {{ round($cart->get_shipping_cost(), 2) }} KSh
                                                    @else
                                                        {{ trans('theme.free_shipping') }}
                                                    @endif
                                                </span>
                                            </td>
                                            @if ($cart->packaging > 0)
                                                <td>
                                                    <div>{{ trans('theme.packaging') }}</div>
                                                    <span>{{ round($cart->packaging, 2) }} KSh</span>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="text-muted">Discount</div>
                                                <span>-{{ round($cart->discount, 2) }} KSh</span>
                                            </td>
                                            @if ($cart->taxes > 0)
                                                <td>
                                                    <div>{{ trans('theme.taxes') }}</div>
                                                    <span>{{ round($cart->taxes, 2) }} KSh</span>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="text-muted">Total</div>
                                                <span>{{ round($cart->grand_total(), 2) }} KSh</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex mb-3 checkout-button">
                            <a href="{{route('cart.index')}}" class="btn btn-blue text-white fs-6 me-5">Update cart</a>
                            <a href="{{route('homepage')}}" class="btn btn-blue text-white fs-6">Continue Shopping</a>
                        </div>
                        @php
                            $allTotal += round($cart->grand_total(), 2);
                        @endphp
                    @endforeach
                    <h3 class="d-none" style="display:none;">Orders total: <b
                            class="amount">{{ $allTotal }} KSh</b></h3>
                </div>

                
                <div class="col-md-4">

                    <div class="mb-3">
                        <h4 class="blue-heading-txt">Ship To</h4>
                    </div>
                    @if (isset($customer))
                        <div class="row customer-address-list">
                            @php
                                $pre_select = null;
                            @endphp
                            @foreach ($customer->addresses as $address)
                            @endforeach
                        </div>

                        <small id="ship-to-error-block" class="text-danger pull-right"></small>

                        <div class="space20"></div>
                        <a href="#" data-toggle="modal" data-target="#createAddressModal"
                            class="btn btn-success btn-sm flat space20">
                            <i class="fa fa-address-card-o"></i> @lang('theme.button.add_new_address')
                        </a>
                    @else
                        @include('forms.address')

                        <div class="form-group mb-2">
                            <div class="input-group">
                                {!! Form::email('email', null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.email'), 'maxlength' => '100', 'required']) !!}
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                        {{-- <div class="checkbox form-check mb-2">
                                    <input class="form-check-input i-check" type="checkbox" name="create-account" id="create-account-checkbox">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Create an account
                                    </label>
                                </div> --}}
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('create-account', null, null, ['id' => 'create-account-checkbox', 'class' => 'i-check']) !!} {!! trans('theme.create_account') !!}
                            </label>
                        </div>

                        <div id="create-account" class="space30" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 nopadding-right">
                                    <div class="form-group">
                                        <div class="input-group">
                                            {!! Form::password('password', ['class' => 'form-control flat', 'id' => 'acc-password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6']) !!}
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 nopadding-left">
                                    <div class="form-group">
                                        <div class="input-group">
                                            {!! Form::password('password_confirmation', ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.confirm_password'), 'data-match' => '#acc-password']) !!}
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            @if (config('system_settings.ask_customer_for_email_subscription'))
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('subscribe', null, null, ['class' => 'i-check']) !!} {!! trans('theme.input_label.subscribe_to_the_newsletter') !!}
                                    </label>
                                </div>
                            @endif

                            <p class="text-info small">
                                <i class="fa fa-info-circle"></i>
                                {!! trans('theme.help.create_account_on_checkout', ['link' => get_page_url(\App\Page::PAGE_TNC_FOR_CUSTOMER)]) !!}
                            </p>
                        </div>

                        {{-- <small class="help-block text-muted pull-right">* {{ trans('theme.help.required_fields') }}</small> --}}
                    @endif
                    {{-- <div class="form-group mb-3">
                                <div class="col-md-12">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Nyayo estate</option>
                                        <option value="1">Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                        <option value="6">Saturday</option>
                                        <option value="7">Sunday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Appartment/House">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Nairobi</option>
                                        <option value="1">Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                        <option value="6">Saturday</option>
                                        <option value="7">Sunday</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Embakasi</option>
                                        <option value="1">Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                        <option value="6">Saturday</option>
                                        <option value="7">Sunday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Contact number">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Create an account
                                </label>
                            </div> --}}
                    {{-- <div class="form-floating">
                                    <textarea class="form-control" placeholder="Message for the seller" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Message for the seller</label>
                                </div> --}}
                    <div style="border: 1px solid #ced4da; border-radius: 16px;">
                        {!! Form::textarea('buyer_note', null, ['class' => 'form-control', 'placeholder' => trans('theme.placeholder.message_to_seller'), 'rows' => '2', 'maxlength' => '250']) !!}
                        <div class="help-block with-errors"></div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class=" mb-3">
                        <h4 class="blue-heading-txt">Payment options</h4>
                    </div>
                    {{-- <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Mpesa
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Cash on delivery
                                </label>
                            </div>
                            <button type="submit" class="btn btn-blue text-white fw-bold px-4">Checkout</button> --}}
                    @php
                        if ($shop != null || count($shop) > 0) {
                            $activeManualPaymentMethods = $shop->manualPaymentMethods;
                        } else {
                            $activeManualPaymentMethods = '';
                        }
                    @endphp


                    <div class="space30">
                        <div class="form-group">
                            <label class="">
                                <div class="iradio" style="position: relative;"><input name="payment_method"
                                        value="1" data-code="stripe" class="i-radio-blue payment-option" type="radio"
                                        data-info="For users whose Contact or Registered Account number is Safaricom."
                                        data-type="3" required="required" style="position: absolute; opacity: 0;"><ins
                                        class="iCheck-helper"
                                        style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                    MPESA
                                </div>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="hover">
                                <div class="iradio hover" style="position: relative;"><input name="payment_method"
                                        value="6" data-code="cod" class="i-radio-blue payment-option" type="radio"
                                        data-info="" data-type="3" required="required"
                                        style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                        style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                    Cash On Delivery
                                </div>
                            </label>
                        </div>

                    </div>

                    <p id="payment-instructions" class="text-info small space30">
                        <i class="fa fa-info-circle"></i>
                        <span>@lang('theme.placeholder.select_payment_option')</span>
                    </p>

                    <div id="submit-btn-block" class="clearfix space30" style="display: none;">
                                <button id="" class="btn btn-blue text-white fw-bold px-4" type="submit">
                                    <small><i class="fa fa-shield"></i> <span
                                            id="pay-now-btn-txt">@lang('theme.button.checkout')</span></small>
                                </button>
        
                            </div>
                    {{-- <div id="submit-btn-block" class="clearfix space30" style="">
                        <button id="" class="btn btn-blue btn-lg btn-block nyayom-btn" type="submit">
                            <small><i class="fa fa-shield"></i> <span id="pay-now-btn-txt">Checkout</span></small>
                        </button>
                    </div> --}}

                </div>
                


            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection

@section('scripts')
    @include('ecommerce_frontend.scripts.appjs')
    @include('scripts.checkout_all')
@endsection
