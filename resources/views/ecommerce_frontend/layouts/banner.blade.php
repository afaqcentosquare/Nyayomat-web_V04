@php
	if(isset($banner['featured_image']['path']) && Storage::exists($banner['featured_image']['path']))
		$bg_img = asset('storage/' . $banner['featured_image']['path']);
	else
		$bg_img = '';
@endphp

<div class="col-md-{{ $banner['columns'] }}">
	<div class="banner banner-o-hid outline-effect animated zoomIn bbox">
		
    		<!--<div class="banner-caption">-->
    		<!--	<h5 class="banner-title">{{ $banner['title'] }}</h5>-->
    		<!--	<p class="banner-desc">{{ $banner['description'] }}</p>-->
    		<!--	<p class="banner-link-btn">{!! $banner['link_label'] ? $banner['link_label'] . ' <i class="fa fa-caret-right"></i>' : '' !!}</p>-->
    		<!--</div>-->
    		
    	    @if(Storage::exists($banner['featured_image']['path']))
    	    <a href="{{ $banner['link'] }}">
    		    <img class="banner-img" src="{{ asset('storage/' . $banner['featured_image']['path']) }}" alt="{{ $banner['title'] }}" title="{{ $banner['title'] }}" hoverable>
    		    </a>
        	@endif
    	
	</div>
</div>