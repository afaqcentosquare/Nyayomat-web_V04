@include('ecommerce_frontend.headers.header_1')

<!--Begin Form-->
<section>
    <div class="row">
        <div class="col-lg-6">
            <div class="content align-middle">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif             
                <h4 class="blue-title mb-4">Sign up for a Customer account</h4>
                <form action="{{route('customer.register.submit')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="col-lg-12 mb-4">
                            <label>Full Name</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/shop.png') }}" alt="">
                                <input type="text" name="name" class="form-control" name="shop_name" placeholder="Enter full name"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-lg-6 mb-4">
                            <label>Phone</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/call-calling.jpg') }}" alt="">
                                <input type="text" name="stripe_id" class="form-control" name="mobile" placeholder="Enter number"
                                    required>
                            </div>
                            @if ($errors->has('mobile'))
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label>Email</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="email" name="email" class="form-control" name="email" placeholder="Enter email"
                                    required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 mb-4">
                            <label>Password</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/lock.png') }}" alt="">
                                <input type="text" name="password" class="form-control" name="password" placeholder="Enter password"
                                    required>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label>Confirm password</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/lock.png') }}" alt="">
                                <input type="text" placeholder="Confirm Password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm password" required>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="service_merchant">
                                <label class="form-check-label">
                                    Subscribe to our newsletter
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="agree">
                                <label class="form-check-label">
                                    Accept terms and conditions
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-blue text-white fw-bold px-4">Sign Up</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="custom-column-img" style="background-color: #E8F5FD; height: 100%; padding: 7em 2em 3em 10em;">
                <img src="{{asset('acp/frontend/Images/form-image.png')}}" class="form-img" alt="">
            </div>
        </div>
    </div>
</section>
<!--end Form-->

@include('ecommerce_frontend.footer')
