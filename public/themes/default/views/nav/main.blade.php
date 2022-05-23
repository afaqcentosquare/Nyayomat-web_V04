<style>
  .ui-autocomplete {
    z-index: 9999 !important;
  }

  @media screen and (max-width: 768px) {

    /* #title_message {
        visibility: hidden;
        clear: both;
        float: left;
        margin: 10px auto 5px 20px;
        width: 28%;
        display: none;
      } */
    #profileDetails {
      visibility: hidden;
      display: none;
    }

    #faMenu {
      visibility: visible;
      display: block;
      float: right;
    }
  }

  @media screen and (min-width: 768px) {

    /* #title_message {
        visibility: hidden;
        clear: both;
        float: left;
        margin: 10px auto 5px 20px;
        width: 28%;
        display: none;
      } */
    #profileDetails {
      visibility: visible;
      display: block;
    }

    #faMenu {
      visibility: hidden;
      display: none;
      float: right;
    }

    .sidenav {
      visibility: hidden;
      display: none;
    }
  }

  .mytoggle {
    margin-right: 0px !important;
    border: none !important;
  }

  .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 99 !important;
    top: 0;
    left: 0;
    background-color: rgb(68, 114, 196);
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }

  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 18px;
    color: #fff !important;
    display: block;
    transition: 0.3s;
  }

  .sidenav a:hover {
    color: #818181 !important;
  }

  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }

  @media screen and (max-height: 450px) {
    .sidenav {
      padding-top: 15px;
    }

    .sidenav a {
      font-size: 18px;
    }
  }

  .navbar-toggle2 {
    position: relative;
    margin-right: 15px;
    padding: 9px 10px;
    margin-top: 8px;
    margin-bottom: 8px;
    background-color: transparent;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
  }
</style>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  @if(Request::segment(1)!="")
  <a href="{{ route('cart.index') }}" title="Cart Item(s) {{ cart_item_count() }}">
    <!-- <span>{{ trans('theme.your_cart') }}</span> -->
    <i class="fa fa-opencart"></i>
    <div id="globalCartItemCount" class="badge">{{ cart_item_count() }}</div>
  </a>
  @endif

  @auth('customer')

  <a href="{{ route('account', 'dashboard') }}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
    <span>{{ trans('theme.hello') . ', ' . Auth::guard('customer')->user()->getName() }}</span>
    {{-- <span style="margin-top:5px">Points: XX</span> --}}
  </a>

  <a href="{{ route('account', 'dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Overview</a>
  <a href="{{ route('account', 'orders') }}"><i class="fa fa-shopping-cart fa-fw"></i>@lang('theme.nav.my_orders')</a>
  <a href="{{ route('account', 'pendingreviews') }}"><i class="fa fa-warning fa-fw"></i> Pending Review</a>
  <a href="{{ route('account', 'wishlist') }}"><i class="fa fa-heart-o fa-fw"></i>@lang('theme.nav.my_wishlist')</a>
  <span class="sep"></span>
  <a href="{{ route('account', 'account') }}"><i class="fa fa-user fa-fw"></i>@lang('theme.nav.my_account')</a>
  <a href="{{ route('customer.logout') }}"><i class="fa fa-power-off fa-fw"></i>{{ trans('theme.logout') }}</a>
  @else
  <li>
    <a id="modal_trigger_m" href="#modal" title="{{ trans('theme.sing_in') }}">
      <i class="fa fa-user"></i>Log In
    </a>
  </li>
  @endauth
</div>
<div class="container">
  <nav class="navbar navbar-default navbar-main navbar-light navbar-top">
    <div class="row">
      <div class="col-sm-3 col-md-3">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ url('/') }}">
            @if(Storage::exists('logo.png') )
            <img src="{{url(Storage::url('logo.png')) }}" alt="SAM SERVE" style="margin-top:10px" />
            @else
            <img src="https://placehold.it/140x60/eee?text={{ get_platform_title() }}" alt="SAM SERVE" />
            @endif
          </a>

          <div id="faMenu" style="vertical-align: middle !important;">
          <div style="float: left; vertical-align: middle; padding-top: 5px;">
            @if(Request::segment(1)!="")
              <a href="{{ route('cart.index') }}" title="Cart Item(s) {{ cart_item_count() }}">
                <!-- <span>{{ trans('theme.your_cart') }}</span> -->
                <i class="fa fa-opencart"></i>
                <div id="globalCartItemCount" class="badge">{{ cart_item_count() }}</div>
              </a>
            @endif
          </div>
          <div style="float: right;">
            <button type="button" class="navbar-toggle mytoggle" onclick="openNav()" style="padding-top: 3px !important;">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
            
            
          </div>
        </div>

      </div>

      <div class="col-sm-6 col-xs-12 col-md-6">
        @if(Request::segment(1)!="")
        {!! Form::open(['route' => 'inCategoriesSearch', 'method' => 'GET', 'id' => 'search-categories-form', 'class' =>
        'navbar-left navbar-form navbar-search cus-form', 'role' => 'search', 'style' => 'width:100% !important;']) !!}

        {{-- <select name="in" class="search-category-select" id="search-category-select">
            <option value="all_categories">{{ trans('theme.all_categories') }}</option>
        @foreach($categories ?? App\Category::get() as $category)
        <option value="{{ $category['slug'] }}" @if(Request::segment(2)) {{ Request::get('in') == $category['slug'] ? ' selected' : '' }} @endif>{{ $category['name'] }}
        </option>
        @endforeach
        </select> --}}
        <div class="form-group">
          {!! Form::text('search', null, ['class' => 'form-control availableProducts', 'automplete' =>
          'true', 'id' =>'searchPhrase','placeholder' => trans('theme.main_searchbox_placeholder')]) !!}
        </div>
        <a class="fa fa-search navbar-search-submit" onclick="document.getElementById('search-categories-form').submit()"></a>
        {!! Form::close() !!}
        @endif
      </div>
      <div class="col-sm-3 col-md-3" id="profileDetails">

        <ul class="nav navbar-nav navbar-right navbar-mob-left">
          @if(Request::segment(1)!="")
          <li>
            <a href="{{ route('cart.index') }}" title="Cart Item(s) {{ cart_item_count() }}">
              <!-- <span>{{ trans('theme.your_cart') }}</span> -->
              <i class="fa fa-opencart"></i>
              <div id="globalCartItemCount" class="badge">{{ cart_item_count() }}</div>
            </a>
          </li>
          @endif

          @auth('customer')
          <li class="dropdown">
            <a href="{{ route('account', 'dashboard') }}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
              <span>{{ trans('theme.hello') . ', ' . Auth::guard('customer')->user()->getName() }}</span>
              {{-- <span style="margin-top:5px">Points: XX</span> --}}
            </a>
            <ul class="dropdown-menu nav-list">
              <!--<li><a href="{{ route('account', 'dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> @lang('theme.nav.dashboard')</a></li>-->
              <li><a href="{{ route('account', 'dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Overview</a></li>
              <li><a href="{{ route('account', 'orders') }}"><i class="fa fa-shopping-cart fa-fw"></i>
                  @lang('theme.nav.my_orders')</a></li>
              <li><a href="{{ route('account', 'pendingreviews') }}"><i class="fa fa-warning fa-fw"></i> Pending
                  Review</a></li>
              <li><a href="{{ route('account', 'wishlist') }}"><i class="fa fa-heart-o fa-fw"></i>
                  @lang('theme.nav.my_wishlist')</a></li>
              <!--<li><a href="{{ route('account', 'disputes') }}"><i class="fa fa-rocket fa-fw"></i> @lang('theme.nav.refunds_disputes')</a></li>-->
              <!--<li><a href="{{ route('account', 'coupons') }}"><i class="fa fa-tags fa-fw"></i> @lang('theme.nav.my_coupons')</a></li>-->
              {{-- <li><a href="{{ route('account', 'gift_cards') }}"><i class="fa fa-gift fa-fw"></i>
              @lang('theme.nav.gift_cards')</a>
          </li> --}}

          <li class="sep"></li>
          <li><a href="{{ route('account', 'account') }}"><i class="fa fa-user fa-fw"></i>
              @lang('theme.nav.my_account')</a></li>
          <li><a href="{{ route('customer.logout') }}"><i class="fa fa-power-off fa-fw"></i>
              {{ trans('theme.logout') }}</a></li>
        </ul>
        </li>
        @else

        <li>
          <a id="modal_trigger" href="#modal" title="{{ trans('theme.sing_in') }}">
            <i class="fa fa-user"></i>
          </a>
        </li>
        @endauth
        </ul>
      </div>
    </div>
  </nav>
</div>

<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  function openNavFilters(params) {
    document.getElementById("navFilters").style.width = "250px";
  }

  function closeNavFilters() {
    document.getElementById("navFilters").style.width = "0";
  }
</script>