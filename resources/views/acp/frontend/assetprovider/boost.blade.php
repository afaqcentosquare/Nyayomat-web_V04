@include('acp.frontend.headers.header_2')

<!--Begin banner-->
<section class="main py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="content">
                    <h1 class="text-white mb-4 fw-bold">Capital To Power Your Business</h1>
                    <p class="text-white mb-3">Fast and flexible capital to help you...</p>
                    <div class="mb-4 text-white lh-lg text-icon-padding">
                        <h6><img src="{{asset('acp/frontend/Images/icons/check-icon.png')}}">Manage cashflow</h6>
                        <h6><img src="{{asset('acp/frontend/Images/icons/check-icon.png')}}">Take on new stock</h6>
                        <h6><img src="{{asset('acp/frontend/Images/icons/check-icon.png')}}">Get a capital asset</h6>
                    </div>
                    <button type="button" class="btn btn-orange text-white fs-6">Download App </button>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('acp/frontend/Images/group-photo.png') }}" class="col-img" alt="">
            </div>
        </div>
    </div>
</section>
<!--end banner-->

<!--How it works section starts-->
<section class="py-15 how-it-work-bg-image">
    <div class="container">
        <div class="pb-5">
            <h1 class="text-center blue-heading-txt">How It Works?</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('acp/frontend/Images/direct-download 1.png') }}" alt="">
                    <h6 class="blue-text mt-3">Download App</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('acp/frontend/Images/add-to-cart 1.png') }}" alt="">
                    <h6 class="blue-text mt-3">Request Product</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('acp/frontend/Images/add-to-cart 2.png') }}" alt="">
                    <h6 class="blue-text mt-3">Flexi Installments</h6>
                </div>
            </div>
        </div>
    </div>
</section>
<!--How it works section ends-->

<!--Benefits section starts-->
<section class="main py-15">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('acp/frontend/Images/Group 127.png') }}" class="col-img" alt="">
            </div>
            <div class="col-md-6">
                <div class="list-content">
                    <h1 class="text-white mb-4">Exclusive Benefits</h1>
                    <div class="text-white lh-lg text-icon-padding">
                        <p><img src="{{asset('acp/frontend/Images/icons/arrow-right.png')}}"><span class="fw-bold">Simple Capital:</span> A no fuss process that can see you access
                            stock or business equipment fast</p>
                        <p><img src="{{asset('acp/frontend/Images/icons/arrow-right.png')}}"><span class="fw-bold">Transparent pricing:</span> No hidden charges. There’s just on price you know up-front & it’s paid down in installments
                        </p>
                        <p><img src="{{asset('acp/frontend/Images/icons/arrow-right.png')}}"><span class="fw-bold">Pay as you trade:</span> Flexible payment periods from daily, weekly and monthly to match your business cycle</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Benefits section starts-->

<!--Cards section starts-->
<section class="py-15 ">
    <div class="container">
        <div class="py-5">
            <h1 class="text-center blue-heading-txt">Why Nyayomat Boost</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-10 pb-3">
                <div class="border border-2 rounded py-4 px-5 h-100">
                    <img src="{{ asset('acp/frontend/Images/Group 1000002801.png') }}" class="centered-img mb-4 "
                        alt="">
                    <div class="text-center">
                        <h5 class="blue-text mb-4">We support small businesses</h5>
                        <p>With hassle free product request, you have access to stock & business equipment. It’s just
                            what we do</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-10 pb-3">
                <div class="border border-2 rounded py-4 px-5 h-100">
                    <img src="{{ asset('acp/frontend/Images/Group 1000002802.png') }}" class="centered-img mb-4 "
                        alt="">
                    <div class="text-center">
                        <h5 class="blue-text mb-4">We keep things simple</h5>
                        <p>Always know what you will pay ahead of time. No hidden fees </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-10 pb-3">
                <div class="border border-2 rounded py-4 px-5 h-100">
                    <img src="{{ asset('acp/frontend/Images/Group 1000002800.png') }}" class="centered-img mb-4 "
                        alt="">
                    <div class="text-center">
                        <h5 class="blue-text mb-4">You come first, always</h5>
                        <p>We help businesses like yours grow & thrive. Nyayomat BOOST starts with your business in mind</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Cards section ends-->

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
                                <form class="d-flex">
                                    <input class="form-control me-2 w-75" placeholder="Email Address">
                                    <button class="btn btn-orange text-white text-wrap w-35"
                                        type="submit">Subscribe</button>
                                </form>
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

@include('acp.frontend.footer')
