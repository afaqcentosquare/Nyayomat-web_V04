@include('contents.product_list_top_filter')
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 240px;
        margin: 10px;
        text-align: center;
        font-family: arial;
    }

    .card img {
        width: 240px;
        height: 240px;
    }

    .price {
        color: grey;
        font-size: 22px;
    }

    .card button {
        border: none;
        outline: 0;
        padding: 12px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .card button:hover {
        opacity: 0.7;
    }

    .card a:hover {
        color: #4472c4;
    }
</style>
<div class="row product-list">
    @foreach($inventories as $item)
    @php $shop = DB::table('shops')->where('id',$item->shop_id)->get(); @endphp
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="card">
            <a class="product-link" href="{{ route('show.product', $item->slug) }}">
                <img class="product-img-primary img-thumbnail" style="width:100%" src="{{ get_product_img_src($item, 'medium') }}" alt="{{ $item->title }}" title="{{ $item->title }}" />
                <p style="font-size:15px;">{{ $item->title }}</p>

            </a>

            <h1>
                <ul class="product-info-labels">
                    @if($item->orders_count >= config('system.popular.hot_item.sell_count', 3))
                    <li>@lang('theme.hot_item')</li>
                    @endif
                    @if($item->free_shipping == 1)
                    <li>@lang('theme.free_shipping')</li>
                    @endif
                    @if($item->stuff_pick == 1)
                    <li>@lang('theme.stuff_pick')</li>
                    @endif
                    @if($item->hasOffer())
                    <li>@lang('theme.percent_off', ['value' => get_percentage_of($item->sale_price,
                        $item->offer_price)])
                    </li>
                    @endif
                </ul>
            </h1>
            <span class="price" style="margin-bottom: 10px">
                @include('layouts.pricing', ['item' => $item])
            </span>
        </div>
    </div><!-- /.col-md-* -->
    @endforeach

</div><!-- /.row .product-list -->

<div class="sep"></div>

<div class="row pagenav-wrapper">
    {{ $inventories->links('layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->