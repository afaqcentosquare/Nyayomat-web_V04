@extends('ecommerce_frontend.headers.ecommerce_master')
@section('search')
    @include('ecommerce_frontend.headers.search_component')
@endsection
@section('basket')
@include('ecommerce_frontend.headers.basket')
@endsection
@section('content')
<!-- Begin Breadcrumb -->
<section class="py-2">
    <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-middle">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Cart</a></li>
                </ol>
            </nav>
    </div>
</section>
<!-- end Breadcrumb -->

<section class="py-5">
    <div class="container">
        <div class="text-center">
            <h3 class="blue-heading-txt lh-lg">Thank you for choosing Nyayomat. Your order is on its way!!</h3>
            <a href="{{route('homepage')}}" class="btn btn-blue text-white fw-bold px-4">Shop again</a>             
        </div>
    </div>
</section>

{{-- <div class="py-4">
    <div class="container">
        <div class="accordion " id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Shop By Category
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-md-3 mb-2">
                                    <h6>
                                    <a href="{{ route('category.products', $category->slug) }}" class="text-decoration-none">
                                        {{ $category->name }}
                                    </a>
                                </h6>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection