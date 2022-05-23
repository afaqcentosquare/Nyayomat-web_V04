@include('acp.frontend.headers.header_2')

<!--Begin banner-->
<section class="main py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="content">
                    <h1 class="text-white mb-4 fw-bold">Let's grow together</h1>
                    <p class="text-white mb-3">We work together to make your products more accessible to your
                        clients, And you...</p>
                    <div class="mb-4 text-white lh-lg text-icon-padding">
                        <h6><img src="{{ asset('acp/frontend/Images/icons/check-icon.png') }}">Enjoy simple & seamless
                            onboarding</h6>
                        <h6><img src="{{ asset('acp/frontend/Images/icons/check-icon.png') }}">Get guaranteed payments
                        </h6>
                        <h6><img src="{{ asset('acp/frontend/Images/icons/check-icon.png') }}">Never miss a transaction
                        </h6>
                    </div>
                    <button type="button" class="btn btn-orange text-white fs-6">Become a partner</button>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('acp/frontend/Images/Group 1000002812.png') }}" class="col-img" alt="">
            </div>
        </div>
    </div>
</section>
<!--end banner-->

<!--How it works section starts-->
<section class="how-it-work-bg-image">
    <div class="container">
        <div class="pb-5">
            <h1 class="text-center blue-heading-txt">How It Works?</h1>
        </div>
        <div class="row justify-content-center spacings">
            <div class="col-md-3">
                <div class="text-center">
                    <img src="{{ asset('acp/frontend/Images/downloading.png') }}" alt="">
                    <h6 class="blue-text mt-3">Sign Up </h6>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <img src="{{ asset('acp/frontend/Images/download.png') }}" alt="">
                    <h6 class="blue-text mt-3">Products Uploaded</h6>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <img src="{{ asset('acp/frontend/Images/fulfill-orders.png') }}" alt="">
                    <h6 class="blue-text mt-3">Fulfill Orders</h6>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <img src="{{ asset('acp/frontend/Images/paid-instantly.png') }}" alt="">
                    <h6 class="blue-text mt-3">Get Paid Instantly</h6>
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
                <div>
                    <h1 class="text-white mb-4">Exclusive Benefits</h1>
                    <div class="text-white lh-lg text-icon-padding">
                        <p><img src="{{ asset('acp/frontend/Images/icons/arrow-right.png') }}"><span
                                class="fw-bold">Higher sales:</span> Facilitate higher conversions, increase
                            average
                            order value & repeat purchase behaviour
                        </p>
                        <p><img src="{{ asset('acp/frontend/Images/icons/arrow-right.png') }}"><span
                                class="fw-bold">Achieve Business Growth:</span> Focus on growing your business &
                            leave the collections to us
                        </p>
                        <p><img src="{{ asset('acp/frontend/Images/icons/arrow-right.png') }}"><span
                                class="fw-bold">Frictionless payments:</span> Guaranteed payments to your account
                            which you have access to withdraw from anytime
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Benefits section starts-->

<!--Cards section starts-->
<section class="py-15">
    <div class="container">
        <div class="py-5">
            <h1 class="text-center blue-heading-txt">Why Nyayomat Boost</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-10 pb-3">
                <div class="border border-2 rounded py-4 px-5 h-100">
                    <img src="{{ asset('acp/frontend/Images/Group 1000002805.png') }}" class="centered-img mb-4 "
                        alt="">
                    <div class="text-center">
                        <h5 class="blue-text mb-4">Flexible partnership</h5>
                        <p>We customize the way we work with you to match what’s best for your business and capital
                            needs of your clients</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-10 pb-3">
                <div class="border border-2 rounded py-4 px-5 h-100">
                    <img src="{{ asset('acp/frontend/Images/money-icon-image.png') }}" class="centered-img mb-4 "
                        alt="">
                    <div class="text-center">
                        <h5 class="blue-text mb-4">Accessible capital</h5>
                        <p>We make it simple for your clients to access much needed capital through the products you
                            offer</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-10 pb-3">
                <div class="border border-2 rounded py-4 px-5 h-100">
                    <img src="{{ asset('acp/frontend/Images/support-icon-image.png') }}" class="centered-img mb-4 "
                        alt="">
                    <div class="text-center">
                        <h5 class="blue-text mb-4">Full-service support</h5>
                        <p>We’re committed to help merchants succeed. Our team makes it easy for your clients to get the
                            right guidance to reach their goals</p>
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
