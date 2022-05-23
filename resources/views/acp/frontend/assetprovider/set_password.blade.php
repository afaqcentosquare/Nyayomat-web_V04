@include('acp.frontend.headers.header_1')

<!--Begin Form-->
<section>
    <div class="row">
        <div class="col-lg-6">
            <div class="content align-middle">
                <h3 class="blue-title mb-4">Set password for your account</h3>
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
                <form action="{{ route('assetprovider.set.password', encrypt($asset_provider->id)) }}" method="post">
                    @csrf
                    <div class="form-group row mb-4">
                        <div class="col-lg-6">
                            <label>Applicant Name</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="text" name="applicant_name" class="form-control" placeholder="Name" value="{{old("applicant_name", $asset_provider->applicant_name)}}" disabled>
                            </div>
                            @if ($errors->has('applicant_name'))
                                <span class="text-danger">{{ $errors->first('applicant_name') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label>Business Name</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="text" name="shop_name" class="form-control"
                                    placeholder="Enter shop name" value="{{old("shop_name", $asset_provider->shop_name)}}" disabled>
                            </div>
                            @if ($errors->has('shop_name'))
                                <span class="text-danger">{{ $errors->first('shop_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6">
                            <label>Phone</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="text" name="phone" class="form-control" placeholder="Enter number" value="{{old("phone", $asset_provider->phone)}}" disabled>
                            </div>
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label>Email</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="text" name="email" class="form-control" placeholder="Enter email" value="{{old("email", $asset_provider->email)}}" disabled>
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6">
                            <label>Password</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter password">
                            </div>
                            @if ($errors->has('password'))
                                <span class="form-text">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label>Confirm Password</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm password">
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="form-text">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-orange text-white  px-4">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div id="signin-img" class="custom-column-img"></div>
        </div>
    </div>
</section>
<!--end Form-->


@include('acp.frontend.footer')
