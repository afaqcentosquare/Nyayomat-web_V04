@extends('layouts.main')

@section('content')
    <!-- breadcrumb -->
    @include('headers.cart_page')
    
  
    <!-- CONTENT SECTION -->
    @include('contents.cart_page')

    <div class="space30"></div>
    <section style="margin-top:30px;margin-bottom: 30px; padding:10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 nopadding">
                    
                    @include('sliders.category', ['categories' => $all_categories])

              </div>
            </div>
        </div>
    </section>

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')

    <!-- bottom Banner -->
    @include('banners.bottom')
@endsection

@section('scripts')
    @include('scripts.cart')
@endsection