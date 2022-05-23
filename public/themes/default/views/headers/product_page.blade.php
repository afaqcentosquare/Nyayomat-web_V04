<section>
  <div class="container">
    <header class="page-header">
      <div class="row">
        <div class="col-md-6 text-left">
          @php
            $t_category = $item->product->categories->first();
          @endphp
          <ol class="breadcrumb nav-breadcrumb">
            @include('headers.lists.category_grp', ['category' => $t_category->subGroup->group])
            @include('headers.lists.category_subgrp', ['category' => $t_category->subGroup])
            @include('headers.lists.category', ['category' => $t_category])
            <li class="active">{{ $item->title }}</li>
          </ol>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('account', 'wishlist') }}"><i class="fa fa-heart-o fa-fw"></i> @lang('theme.nav.my_wishlist')</a>
        </div>
      </div>
    </header>
  </div>
</section>