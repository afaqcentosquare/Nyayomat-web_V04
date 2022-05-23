<section>
  <div class="container full-width">
    <div class="row">


      <div class="col-md-2 col-xs-6 bg-light hidden-xs">

        @include('contents.product_list_sidebar_filters')

      </div><!-- /.col-md-2 -->


      <div class="col-md-2 col-xs-12 text-center">

        <div id="navFilters" class="sidenav hidden-lg hidden-md  hidden-sm text-center" style="
          background-color: rgb(62, 130, 179)

      ">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNavFilters()">&times;</a>
          <div class="card card-body text-center">
            <div class="col-md-2 col-xs-12">
              @include('contents.product_list_sidebar_filters')
            </div>
          </div>
        </div>
<style>


.responsive-menu-icon::after {
    content: "Filters";
    font-style: normal;
    font-size: 1.3em;
    padding-left: 28px;
    position: relative;
    top: -19px;
}
</style>
        <div class="container hidden-lg hidden-md  hidden-sm text-center">
          <nav class="navbar navbar-default navbar-main navbar-light navbar-top">
            <div class="row">
              <div class="col-sm-3 col-md-3  text-center" style="height: 0">
                <div class="navbar-header">
                  <div id="faMenu text-center">
                    <button style="font-size:24px; border: none; margin: 0px 10px; float: none;" onclick="openNavFilters()"><i class="fa fa-filter"></i>Filter </button>
                    <button style="font-size:20px; border: none; margin: 0px 10px; float: none;" data-toggle="collapse" href="#sortBy" role="button" aria-expanded="false"
            aria-controls="sortBy"><i class="fa fa-sort-amount-desc"></i>Sort </button>
                  </div>
                </div>

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
                    <a href="{{ route('account', 'dashboard') }}" data-toggle="dropdown" role="button"
                      aria-haspopup="true" aria-expanded="true">
                      <span>{{ trans('theme.hello') . ', ' . Auth::guard('customer')->user()->getName() }}</span>
                      {{-- <span style="margin-top:5px">Points: XX</span> --}}
                    </a>
                    <ul class="dropdown-menu nav-list">
                      <!--<li><a href="{{ route('account', 'dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> @lang('theme.nav.dashboard')</a></li>-->
                      <li><a href="{{ route('account', 'dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>
                          Overview</a>
                      </li>
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
      </div>
      <div class="col-md-10 col-xs-12" style="padding-left: 37px;
      z-index: 50;">

        @include('contents.product_list')

      </div><!-- /.col-md-10 -->


    </div><!-- /.row -->
  </div><!-- /.container -->
</section>