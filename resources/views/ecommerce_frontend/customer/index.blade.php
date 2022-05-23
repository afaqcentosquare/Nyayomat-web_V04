@extends('ecommerce_frontend.headers.ecommerce_master')

@section('content')
    <!--Begin banner-->
    <section class="main py-15">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content text-white">
                        <h1 class="mb-4 fw-bold">Time To Order</h1>
                        <p class="mb-3">Now Find Offers in your Area</p>
                        <form method="post" action="{{route('countrywise')}}">
                        @csrf
                            <div class="form-group mb-4">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <img src="{{ asset('acp/frontend/Images/icons/location.png') }}" alt="">
                                        <select class="form-select text-muted" name="country" onchange="this.form.submit()">
                                            <option selected>Select your location</option>
                                            @foreach ($countries as $location)
                                                <option value="{{$location->id}}">
                                                    {{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('acp/frontend/Images/Graphics.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--end banner-->

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="mail-card ">
                        <div class="mail-card-mask p-5">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h1 class="text-white">Get Updates regularly</h1>
                                    <p class="text-white">Promotions, new products and sales direcly to your inbox</p>
                                    {!! Form::open(['route' => 'newsletter.subscribe', 'class' => 'd-flex']) !!}
                                    
                                    <input type="email" name="email" class="form-control me-2 w-75" placeholder="Email Address" style="padding-left:10px !important">
                                    
                                        <button class="btn btn-orange text-white text-wrap w-35"
                                            type="submit">Subscribe</button>
                                            
                                            <div class="help-block with-errors"></div>
                                            {!! Form::close() !!}
                                </div>
                                <div class="col-lg-4">
                                    <img src="{{ asset('acp/frontend/Images/asas 2.png') }}" class="trolley-img"
                                        height="200px" width="200px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
