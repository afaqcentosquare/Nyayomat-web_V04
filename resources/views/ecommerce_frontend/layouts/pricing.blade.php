<style> 
.fa-cart-plus {
  color: #0abf0a;
}

.fa-cart-plus:hover {
  color: red;
}


</style>
<div class="product-info-price">
    <span class="old-price" style="display: {{$item->hasOffer() ? '' : 'none'}}">{!! round($item->currnt_sale_price(), 2) !!} KSh</span>
    <span class="product-info-price-new">{!! round($item->currnt_sale_price(), 2) !!} KSh<a class="add_to_cart sc-add-to-cart " href="{{ route('cart.addItem', $item->slug) }}">
											<i class="fa fa-cart-plus fa-lg" title="Add to cart"></i>
										</a></span>
	

    <ul class="product-info-feature-labels hidden">
	    @if($item->free_shipping == 1)
	        <li class="">@lang('theme.free_shipping')</li>
	    @endif
	    @if($item->hasOffer())
	        <li class="">@lang('theme.percent_off', ['value' => get_percentage_of($item->sale_price, $item->offer_price)])</li>
	    @endif
	    @if($item->stuff_pick == 1)
	        <li class="">@lang('theme.stuff_pick')</li>
	    @endif
	    @if($item->orders_count >= config('system.popular.hot_item.sell_count', 3))
	        <li class="">@lang('theme.hot_item')</li>
	    @endif
	</ul>
</div>