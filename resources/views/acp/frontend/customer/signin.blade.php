@include('acp.frontend.headers.header_1')

<!--Begin Form-->
<section>
        <div class="row">
            <div class="col-lg-6">
                <div class="content align-middle">
                    <h3 class="blue-title mb-4">Sign in to your Customer Account</h3>
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
                    <form method="POST" action="{{url('/login')}}">
                        @csrf
                        <div class="mb-4">
                        <label>Email</label>
                        <div class="input-group">
                                <img src="{{asset('acp/frontend/Images/icons/sms.png')}}">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                        </div>
                        @if ($errors->has('email'))                             
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif                    
                    </div>
                        <div class="mb-4">
                            <label>Password</label>
                            <div class="input-group">
                                <img src="{{asset('acp/frontend/Images/icons/sms.png')}}">
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
                            <a href="{{route('customer.forgot.password')}}" class="text-decoration-none text-black">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-orange text-white fw-bold mb-3 px-4 py-2">Login</button>
                    </form>
                    <p class="text-muted text-center">or</p>
                    <div class="d-flex justify-content-between">
                        <button class="btn border text-muted  fs-6 fw-bold px-5 py-2">Facebook</button>
                        <a class="btn border text-muted fs-6 fw-bold px-5 py-2">Twitter</a>
                        <a class="btn border border text-muted fs-6 fw-bold px-5 py-2">Google</a>
                    </div>
                    <p class="text-muted text-center my-3">Don't have any account?</p>
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-secondary fs-6 fw-bold">Sign up Here</button>
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