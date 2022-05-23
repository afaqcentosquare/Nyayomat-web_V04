@php
$shipping_country_id = get_id_of_model('countries', 'iso_3166_2', $geoip->iso_code);
$shipping_state_id = $geoip->state;

$shipping_zone = get_shipping_zone_of($item->shop_id, $shipping_country_id, $shipping_state_id);
$shipping_options = isset($shipping_zone->id) ? getShippingRates($shipping_zone->id) : 'NaN';
@endphp

<style>
	.table-responsive-stack tr {
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: horizontal;
		-webkit-box-direction: normal;
		-ms-flex-direction: row;
		flex-direction: row;
	}


	.table-responsive-stack td,
	.table-responsive-stack th {
		display: block;
		/*
   flex-grow | flex-shrink | flex-basis   */
		-ms-flex: 1 1 auto;
		flex: 1 1 auto;
	}

	.table-responsive-stack .table-responsive-stack-thead {
		font-weight: bold;
	}

	@media screen and (max-width: 768px) {
		.table-responsive-stack tr {
			-webkit-box-orient: vertical;
			-webkit-box-direction: normal;
			-ms-flex-direction: column;
			flex-direction: column;
			/* border-bottom: 3px solid #ccc; */
			display: block;

		}

		/*  IE9 FIX   */
		.table-responsive-stack td {
			float: left\9;
			width: 100%;
		}
	}
</style>


<!-- /.container -->


<!--<section style="margin-top:30px;margin-bottom: 30px; padding:10px;">-->
<!--	<div class="container">-->
<!--		<div class="row">-->
<!--			<div class="col-md-12 nopadding">-->
<!--				<section class="category-banner-img-wrapper" style="margin-bottom: 10px;">-->
<!--					<div class="container">-->
<!--						<div class="row">-->
<!--							<div class="col-sm-12">-->
<!--								<div class="banner banner-o-hid"-->
<!--									style="background-color: #333;height:200px;background-size: cover; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/add.jpg );">-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</section>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</section>-->
<section>
	<div class="container">
		<div class="row sc-product-item" id="single-product-wrapper">
			<div class="col-sm-12 col-xs-12">
				<span class="info-label">
					<h3>{{$item->title}}</h3>
				</span>
			</div>
			<div class="col-md-5 col-sm-12">
				@include('layouts.jqzoom', ['item' => $item])
			</div><!-- /.col-md-5 col-sm-6 -->

			<div class="col-md-7 col-sm-12">
				<div class="row" style="margin-top:20px;">
					<!--<div class="col-sm-4 col-xs-12 col-md-4">-->
					<!--    <p>Product Name : Product Name</p>-->
					<!--    <p>Start Rating : <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;<i class="fa  fa-star" style="color:#f5c004;"></i></p>-->
					<!--    <p>Product Name : Product Name</p>-->
					<!--    <p>Product Name : Product Name</p>-->
					<!--    <p>Product Name : Product Name</p>-->
					<!--    <p>Product Name : Product Name</p>-->
					<!--</div>-->
					<div class="col-sm-12 col-xs-12 col-md-12">

						<table class="table table-striped table-responsive-stack"  id="tableOne">
							<thead class="thead-dark">
								<tr>
									<th>Name</th>
									<th>Price</th>
									<th>Shop</th>
									<th>Rating</th>
									<th>Buy Now</th>
								</tr>
							</thead>
							<tbody>
								@foreach($final_products as $fp)
								<tr>
									<td>{{ $fp['name'] }} {{ $fp['slug'] }}</td>
									<td>{{ $fp['price'] }} KSh</td>
									<td>{{ $fp['shop'] }}</td>
									<td>
										@if($fp['rating']=="0")
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>
										@elseif($fp['rating']=="1")
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>
										@elseif($fp['rating']=="2")
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>
										@elseif($fp['rating']=="3")
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star"></i>&nbsp;
										<i class="fa  fa-star"></i>
										@elseif($fp['rating']=="4")
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star"></i>
										@elseif($fp['rating']=="5")
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
										<i class="fa  fa-star" style="color:#f5c004;"></i>
										@endif

									</td>
									<td class="text-left">
										<a class="btn btn-success btn-sm flat space10 sc-add-to-cart nyayom-btn"
											href="{{ route('cart.addItem', $fp['slug']) }}">
											<i class="fa fa-shopping-cart"></i> @lang('theme.button.add_to_cart')
										</a>
									</br>
										<a class="flat" href="{{ route('wishlist.add', $fp['id']) }}">
											<i class="fa fa-heart-o" data-toggle="tooltip"
												title="@lang('theme.button.add_to_wishlist')"></i>
										</a>
									</td>
								</tr>
								@endforeach

								<tr>
									<td colspan="5" class="text-right">
										<a href="{{ route('cart.index') }}" class="btn btn-success flat space10 nyayom-btn">
											Checkout
										</a>


										<form method="POST" action="{{route('countrywise')}}" style="margin-left:2px">
											@csrf
											<button type="submit"
												class="btn btn-success flat nyayom-btn">{{ trans('theme.button.continue_shopping') }}</button>
										</form>

									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="space20"></div>
			</div>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>

<div class="clearfix space20"></div>



<div class="clearfix space20"></div>