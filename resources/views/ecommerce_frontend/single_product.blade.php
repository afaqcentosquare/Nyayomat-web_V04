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
    <nav aria-label="breadcrumb" class="pt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Search Result</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Fresh milk 500ml</a></li>
        </ol>
    </nav>
</div>
<!-- end Breadcrumb -->

<!-- Begin product -->
<section class="py-10">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ get_product_img_src($item, 'large') }}" alt="" height="70%">
            </div>
            <div class="col-md-9">
                <div class="ps-4">
                    <h1 class="single-product-title">{{$item->title}}</h1>
                    <div class="table-responsive py-3">
                        <table class="table">
                            <tbody>
                                @foreach ( $final_products as $product )
                                <tr>
                                    <td style="width:20%;">
                                        <h5>Name</h5>
                                        <h6>{{$product['name']}}</h6>
                                    </td>
                                    <td style="width:10%;">
                                        <h5>Price</h5>
                                        <h6>{{$product['price']}} KSH</h6>
                                    </td>
                                    <td style="width:20%;">
                                        <h5>Shop</h5>
                                        <h6>{{$product['shop']}}</h6>
                                    </td>
                                    <td style="width:20%;">
                                        <h5>Rating</h5>
                                        @if($product['rating']=="0")
                                        <div class="rate">
                                            <input type="radio" id="star{{$product['shop']}}1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            <input type="radio" id="star{{$product['shop']}}2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}3" name="rate" value="3"/>
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}4" name="rate" value="4"/>
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}5" name="rate" value="5"/>
                                            <label for="star5" title="text">5 stars</label>
                                          </div>
                                        @elseif($product['rating']=="1")
                                        <div class="rate">
                                            <input type="radio" id="star{{$product['shop']}}1" name="rate" value="1" checked/>
                                            <label for="star1" title="text">1 star</label>
                                            <input type="radio" id="star{{$product['shop']}}2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}3" name="rate" value="3"/>
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}4" name="rate" value="4"/>
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}5" name="rate" value="5"/>
                                            <label for="star5" title="text">5 stars</label>
                                          </div>
                                        @elseif($product['rating']=="2")
                                        <div class="rate">
                                            <input type="radio" id="star{{$product['shop']}}1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            <input type="radio" id="star{{$product['shop']}}2" name="rate" value="2" checked/>
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}3" name="rate" value="3"/>
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}4" name="rate" value="4"/>
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}5" name="rate" value="5"/>
                                            <label for="star5" title="text">5 stars</label>
                                          </div>
                                        @elseif($product['rating']=="3")
                                        <div class="rate">
                                            <input type="radio" id="star{{$product['shop']}}1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            <input type="radio" id="star{{$product['shop']}}2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}3" name="rate" value="3" checked/>
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}4" name="rate" value="4"/>
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}5" name="rate" value="5"/>
                                            <label for="star5" title="text">5 stars</label>
                                          </div>
                                        @elseif($product['rating']=="4")
                                        <div class="rate">
                                            <input type="radio" id="star{{$product['shop']}}1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            <input type="radio" id="star{{$product['shop']}}2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}4" name="rate" value="4" checked/>
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}5" name="rate" value="5"/>
                                            <label for="star5" title="text">5 stars</label>
                                          </div>
                                        @elseif($product['rating']=="5")
                                        <div class="rate">
                                            <input type="radio" id="star{{$product['shop']}}1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                            <input type="radio" id="star{{$product['shop']}}2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star{{$product['shop']}}5" name="rate" value="5" checked/>
                                            <label for="star5" title="text">5 stars</label>
                                          </div>
                                        @endif
                                        
                                    </td>
                                    <td style="width:10%;">
                                        <div class="py-2">
                                            <img src="{{ asset('acp/frontend/Images/heart 1.png') }}" alt="">
                                        </div>
                                    </td>
                                    <td style="width:40%;">
                                        <a href="{{ route('cart.addItem', $product['slug']) }}"
                                            class="py-2 px-3 border bg-white custom-border-radius text-primary add_to_cart sc-add-to-cart">Add
                                            <img src="{{ asset('acp/frontend/Images/icons/shopping-cart.png') }}" alt="">
                                    </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{route('cart.index')}}" class="btn btn-blue text-white fs-6 me-2">Cart Details</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end product -->

@endsection
@section('scripts')
    @include('ecommerce_frontend.scripts.appjs')
@endsection