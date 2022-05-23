@extends('ecommerce_frontend.headers.ecommerce_master')

@section('search')
    @include('ecommerce_frontend.headers.search_component')
@endsection
@section('basket')
    @include('ecommerce_frontend.headers.basket')
@endsection
@section('content')
    <!-- Begin Breadcrumb -->
    <div class="container">
        <nav aria-label="breadcrumb" class="py-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Categories</a></li>
                {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('categoryGrp.browse', $category->subGroup->group->slug) }}">{{$category->subGroup->group->name}}</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('categories.browse', $category->subGroup->slug) }}">{{$category->subGroup->name}}</a></li> --}}
                <li class="breadcrumb-item active">{{ (!empty($category)) ? $category->name : (!empty($categories)) ? $categories[0]['name'] : ''}}</li>
            </ol>
        </nav>
    </div>
    <!-- end Breadcrumb -->

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="p-4 custom-border-radius sidebar" style="background-color: #eeeff5">
                    <h3 class="text-uppercase">Category</h3>
                    <h5>{{ (!empty($category)) ? $category->name : (!empty($categories)) ? $categories[0]['name'] : ''}}</h5>
                    <hr style="color: #939393">
                    <h3 class="text-uppercase">Price</h3>
                    <ul class="list-unstyled">
                        {{-- <li>Under 50 KSH</li>
                        <li>50 KSH To 100 KSH</li>
                        <li>50 KSH To 100 KSH</li>
                        <li>50 KSH To 100 KSH</li>
                        <li>100 KSH and Above</li> --}}
                        @foreach (generate_ranges($priceRange['min'], $priceRange['max'], 5) as $ranges)
                            <li>
                                <a href="#" data-name="price" data-value="{{ $ranges['lower'] . '-' . $ranges['upper'] }}"
                                    class="link-filter-opt {{ Request::get('price') == $ranges['lower'] . '-' . $ranges['upper'] ? 'active' : '' }}">
                                    @if ($loop->first)
                                        {{-- trans('theme.price_under', ['value' => get_formated_currency($ranges['upper'])]) --}}
                                        Under {{ $ranges['upper'] }} KSh
                                    @elseif($loop->last)
                                        {{ $ranges['lower'] }} KSh & Above
                                    @else
                                        <span class="text-lowercase">
                                            {{ $ranges['lower'] . ' KSh ' . trans('theme.to') . ' ' . $ranges['upper'] . ' KSh' }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <input type="text" id="price-slider" />
                </div>
            </div>
            <div class="col-md-9">
                <div style="background-color: #eeeff5" class="p-3 custom-border-radius">
                    <div class="dropdown">
                        <button class="btn bg-white dropdown-toggle custom-border-radius" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort By: <span class="text-primary">Best Match</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
                <div class="py-4">
                    <div class="row">

                        @foreach ($inventories as $product)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ get_product_img_src($product, 'medium') }}"
                                        class="card-img-top custom-border-radius shadow" alt="...">
                                    <div class="py-3 d-flex justify-content-between">
                                        <div>
                                            <h5 class="product-title"> <a class="text-decoration-none"
                                                    href="{{ route('show.product', $product->sku) }}">{{ $product->title }}</a>
                                            </h5>
                                            <h6 class="price">{{ number_format($product->sale_price, 2) }} KSH
                                            </h6>
                                        </div>
                                        <div class="overflow-visible py-2">
                                            <a href="{{ route('cart.addItem', $product->sku) }}"
                                                class="px-3 py-2 border custom-border-radius bg-white add_to_cart sc-add-to-cart ">
                                                <img src="{{ asset('acp/frontend/Images/icons/shopping-cart.png') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $inventories->links('layouts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('ecommerce_frontend.scripts.appjs')
@endsection
