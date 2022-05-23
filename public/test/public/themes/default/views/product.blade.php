@extends('layouts.main')

@section('content')
    <!-- HEADER SECTION -->
    @include('headers.product_page', ['product' => $item])

    <!-- CONTENT SECTION -->
    @include('contents.product_page')

    <section class="category-banner-img-wrapper" style="margin-bottom: 10px;">
        @include('sliders.browsing_items')
    <!--	<div class="container">-->
    <!--		<div class="row">-->
	   <!-- 		<div class="col-sm-2" style="margin-top:10px;">-->
			 <!--        <div class="banner banner-o-hid" style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;"></div>-->
				<!--</div>	-->
				<!--<div class="col-sm-2" style="margin-top:10px;">-->
			 <!--        <div class="banner banner-o-hid" style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;"></div>-->
				<!--</div>	-->
				<!--<div class="col-sm-2" style="margin-top:10px;">-->
			 <!--        <div class="banner banner-o-hid" style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;"></div>-->
				<!--</div>	-->
				<!--<div class="col-sm-2" style="margin-top:10px;">-->
			 <!--        <div class="banner banner-o-hid" style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;"></div>-->
				<!--</div>	-->
				<!--<div class="col-sm-2" style="margin-top:10px;">-->
			 <!--        <div class="banner banner-o-hid" style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;"></div>-->
				<!--</div>	-->
				<!--<div class="col-sm-2" style="margin-top:10px;">-->
			 <!--        <div class="banner banner-o-hid" style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;"></div>-->
				<!--</div>	-->

	   <!-- 	</div>	-->
    <!--	</div>-->
	</section>



@endsection

@section('scripts')
    @include('scripts.product_page')
@endsection