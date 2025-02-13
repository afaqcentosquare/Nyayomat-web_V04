@include('acp.frontend.headers.header_1')

<!--Begin Form-->
<section>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="content align-middle">
                    <h2 class="blue-title mb-4">Sign in to your Partner account</h2>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{route('assetprovider.checklogin')}}">
                        @csrf
                        <div class="form-group mb-4">
                            <label>Email</label>
                                <div class="input-group">
                                    <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                </div>
                                @if ($errors->has('email'))                             
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label>Password</label>
                                <div class="input-group">
                                    <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                                </div>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>
                            <a href="{{route('partner.forgot.password')}}" class="text-decoration-none text-black">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-blue text-white fw-bold px-4">Login</button>
                    </form>
                    <p class="text-muted text-center my-3">Don't have any account?</p>
                    <div class="text-center">
                        <a href="{{route('merchant.signup')}}" class="btn text-muted border border-2 rounded py-2 px-4 fw-bold">Signup as Merchant</a>
                        <a href="{{route('partner.signup')}}" class="btn text-muted border border-2 rounded py-2 px-4 fw-bold">Signup as Partner</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="signin-img" class="custom-column-img"></div>
            </div>
        </div>
    </section>
    <!--end Form-->

@include('acp.frontend.footer')