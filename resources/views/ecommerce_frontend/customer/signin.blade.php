@include('ecommerce_frontend.headers.header_1')

<!--Begin Form-->
<section>
    <div class="row">
        <div class="col-lg-6">
            <div class="content align-middle">
                <h3 class="blue-title mb-4">Sign in to your Customer Account</h3>
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
                <form method="POST" action="{{ route('customer.login.submit') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label>Email</label>
                        <div class="input-group">
                            <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}">
                            <input type="email" name="email" class="form-control" placeholder="Enter your email">
                        </div>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-4">
                        <label>Password</label>
                        <div class="input-group">
                            <img src="{{ asset('acp/frontend/Images/icons/lock.png') }}">
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
                        <a href="{{ route('customer.forgot.password') }}"
                            class="text-decoration-none text-black">Forgot
                            password?</a>
                    </div>
                    <button type="submit" class="btn btn-orange text-white fw-bold mb-3 px-4 py-2">Login</button>
                </form>
                <p class="text-muted text-center">or</p>
                <div class="d-flex justify-content-between">
                    {{-- <a type="button" class="btn border text-muted  fs-6 fw-bold px-5 py-2">
                        <span class="btn-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                          </svg></span>Facebook</a> --}}
                    <a href="{{route('customer.login.social', 'facebook')}}" class="btn border text-muted  fs-6 fw-bold px-4 py-2"><span class="pe-2"><img src="{{ asset('acp/frontend/Images/icons/fb-icon.png') }}" alt=""></span>Facebook</a>
                    <a href="{{route('customer.login.social', 'twitter')}}" class="btn border text-muted fs-6 fw-bold px-4 py-2"><span class="pe-2"><img src="{{ asset('acp/frontend/Images/icons/twitter.png') }}" alt=""></span>Twitter</a>
                    <a href="{{route('customer.login.social', 'google')}}" class="btn border border text-muted fs-6 fw-bold px-4 py-2"><span class="pe-2"><img src="{{ asset('acp/frontend/Images/icons/google-icon.png') }}" alt=""></span>Google</a>
                </div>
                <p class="text-muted text-center my-3">Don't have any account?</p>
                <div class="text-center">
                    <a href="{{route('customer.signup')}}"  class="btn btn-outline-secondary fs-6 fw-bold">Sign up Here</a>
                </div>
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
