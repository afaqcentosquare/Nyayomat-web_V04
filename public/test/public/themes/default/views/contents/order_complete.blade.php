<section class="category-banner-img-wrapper" style="margin-bottom: 10px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-2" style="margin-top:10px;">
				<div class="banner banner-o-hid"
					style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;">
				</div>
			</div>
			<div class="col-sm-2" style="margin-top:10px;">
				<div class="banner banner-o-hid"
					style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;">
				</div>
			</div>
			<div class="col-sm-2" style="margin-top:10px;">
				<div class="banner banner-o-hid"
					style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;">
				</div>
			</div>
			<div class="col-sm-2" style="margin-top:10px;">
				<div class="banner banner-o-hid"
					style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;">
				</div>
			</div>
			<div class="col-sm-2" style="margin-top:10px;">
				<div class="banner banner-o-hid"
					style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;">
				</div>
			</div>
			<div class="col-sm-2" style="margin-top:10px;">
				<div class="banner banner-o-hid"
					style="background-color: #333;background-size: contain; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/deal.jpg );width:100%;height:150px;">
				</div>
			</div>

		</div>
	</div>
</section>
<section class="category-banner-img-wrapper" style="margin-bottom: 10px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="banner banner-o-hid"
					style="background-color: #333;background-size: cover; background-image:url( https://multivendor.atithiinfosoft.com/images/placeholders/add.jpg );height:200px;">
				</div>
			</div>
		</div>
	</div>
</section>'
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<p class="lead">Thank you for your order. Delivery will be fulfilled in less than an hour</p>


				<p class="small space30"><i class="fa fa-info-circle"></i>
					<!--{{-- trans('theme.notify.order_will_ship_to') }}: <em>"{{ $order->shipping_address --}}"</em>-->
					We appreciate your feedback
				</p>
				<form method="post" action="{{route('countrywise')}}">

					<p class="lead text-center space50">
						@csrf
						<button type="submit"
							class="btn btn-success flat">{{ trans('theme.button.continue_shopping') }}</button>

						@if(\Auth::guard('customer')->check() && isset($order))
						<a class="btn btn-success flat"
							href="{{ route('order.detail', $order) }}">@lang('theme.button.order_detail')</a>
						@endif
					</p>
				</form>

			</div><!-- /.col-md-8 -->
		</div><!-- /.row -->
	</div> <!-- /.container -->
</section>