@include('ecommerce_frontend.headers.ecommerce_header')

<main class="container">
    <div class="my-5 shop-banner">
        <div class="text-center">
            <h1 class="text-white banner-title">Shop name</h1>
        </div>
    </div>
</main>

<div class="container">
        <div class="col-md-12">
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
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{ asset('acp/frontend/Images/product-1.jpg') }}"
                                class="card-img-top custom-border-radius" alt="...">
                            <div class="py-3 d-flex justify-content-between">
                                <div>
                                    <h5 class="product-title">Product Name</h5>
                                    <h6 class="price">12KSH</h6>
                                </div>
                                <button type="button" class=" px-3 border custom-border-radius bg-white">
                                    <img src="{{ asset('acp/frontend/Images/icons/shopping-cart.png') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{ asset('acp/frontend/Images/product-1.jpg') }}"
                                class="card-img-top custom-border-radius" alt="...">
                            <div class="py-3 d-flex justify-content-between">
                                <div>
                                    <h5 class="product-title">Product Name</h5>
                                    <h6 class="price">12KSH</h6>
                                </div>
                                <button type="button" class=" px-3 border custom-border-radius bg-white">
                                    <img src="{{ asset('acp/frontend/Images/icons/shopping-cart.png') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{ asset('acp/frontend/Images/product-1.jpg') }}"
                                class="card-img-top custom-border-radius" alt="...">
                            <div class="py-3 d-flex justify-content-between">
                                <div>
                                    <h5 class="product-title">Product Name</h5>
                                    <h6 class="price">12KSH</h6>
                                </div>
                                <button type="button" class=" px-3 border custom-border-radius bg-white">
                                    <img src="{{ asset('acp/frontend/Images/icons/shopping-cart.png') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{ asset('acp/frontend/Images/product-1.jpg') }}"
                                class="card-img-top custom-border-radius" alt="...">
                            <div class="py-3 d-flex justify-content-between">
                                <div>
                                    <h5 class="product-title">Product Name</h5>
                                    <h6 class="price">12KSH</h6>
                                </div>
                                <button type="button" class=" px-3 border custom-border-radius bg-white">
                                    <img src="{{ asset('acp/frontend/Images/icons/shopping-cart.png') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@include('ecommerce_frontend.footer')