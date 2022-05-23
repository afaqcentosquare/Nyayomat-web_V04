@extends('ecommerce_frontend.headers.ecommerce_master')
@section('search')
    @include('ecommerce_frontend.headers.search_component')
@endsection
@section('basket')
@include('ecommerce_frontend.headers.basket')
@endsection

@section('content')
    <!--Begin Accordion -->
    <section class="py-4">
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Shop By Category
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <div class="col-md-3 mb-2">
                                            <h6>
                                                <a href="{{ route('category.browse', $category->slug) }}"
                                                    class="text-decoration-none">
                                                    {{ $category->name }}
                                                </a>
                                            </h6>
                                        </div>
                                    @endforeach
                                @else
                                    <h6>No category found in selected location</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--End Accordion -->

    <!--Begin slider -->
    <section class="py-5">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators justify-content-start">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex">
                            <div class="col-md-8" style="background-color: #f2a900">
                                <div class="py-5 px-5 text-white">
                                    <h1 class="fw-bolder">Fresh Pineapple!</h1>
                                    {{-- <p>Lorem ipsum dolor sit amet, consectetur<br> adipisicing elit. Nobis?</p> --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('acp/frontend/Images/pineapple-slider.png') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex">
                            <div class="col-md-8" style="background-color: #f2a900">
                                <div class="py-5 px-5 text-white">
                                    <h1 class="fw-bolder">Fresh Pineapple!</h1>
                                    {{-- <p>Lorem ipsum dolor sit amet, consectetur<br> adipisicing elit. Nobis?</p> --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('acp/frontend/Images/pineapple-slider.png') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex">
                            <div class="col-md-8" style="background-color: #f2a900">
                                <div class="py-5 px-5 text-white">
                                    <h1 class="fw-bolder">Fresh Pineapple!</h1>
                                    {{-- <p>Lorem ipsum dolor sit amet, consectetur<br> adipisicing elit. Nobis?</p> --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('acp/frontend/Images/pineapple-slider.png') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End slider -->

@endsection

@section('scripts')
@include('ecommerce_frontend.scripts.search_script')
@endsection
