<section>
  <div class="container">
    <header class="page-header">
      <div class="row">
        <div class="col-md-6 text-left">
          <ol class="breadcrumb nav-breadcrumb">
            @include('headers.lists.home')
            <li class="active">{{ trans('theme.Shopping_cart') }}</li>
          </ol>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('account', 'wishlist') }}"><i class="fa fa-heart-o fa-fw"></i> @lang('theme.nav.my_wishlist')</a>
        </div>
      </div>
    </header>
  </div>
</section>