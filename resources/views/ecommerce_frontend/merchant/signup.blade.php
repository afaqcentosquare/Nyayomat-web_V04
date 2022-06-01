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
                <h4 class="blue-title mb-4">Sign up for a Merchant account</h4>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    {{-- <div class="form-group mb-4">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/global.png') }}" alt="">
                                @php
                                    $plan2 = DB::table('subscription_plans')
                                        ->where('deleted_at', null)
                                        ->get();
                                @endphp
                                <select class="form-select" name="plan" aria-label="Default select example">
                                    @foreach ($plan2 as $pl)
                                        <option value="{{ $pl->plan_id }}">{{ $pl->name }} ( {{ $pl->cost }}
                                            KSh
                                            /day )</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <small id="emailHelp" class="form-text text-muted">Will be changed for each location which
                                have you select.</small>
                        </div>
                    </div> --}}
                    <div class="form-group row ">
                        {{-- <div class="col-lg-6 mb-4">
                            <label>Applicant Name</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="text" class="form-control" name="name" placeholder="Enter name here.."
                                    required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div> --}}
                        <div class="col-lg-6 mb-4">
                            <input name="plan" value="individual" hidden/>
                            <label>Email</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="email" class="form-control" name="email" placeholder="Enter email"
                                    required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label>Phone</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/call-calling.jpg') }}" alt="">
                                <input type="text" class="form-control" name="mobile" placeholder="Enter number"
                                    required>
                            </div>
                            @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 mb-4">
                            <label>Password</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/lock.png') }}" alt="">
                                <input type="password" class="form-control" name="password" placeholder="Enter password"
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
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirm password" required>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-lg-6 mb-4">
                            <label>Applicant Name</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/shop.png') }}" alt="">
                                <input type="text" class="form-control" name="name" placeholder="Enter applicant name"
                                    required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label>Shop Name</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/shop.png') }}" alt="">
                                <input type="text" class="form-control" name="shop_name" placeholder="Enter shop name"
                                    required>
                            </div>
                            @if ($errors->has('shop_name'))
                                <span class="text-danger">{{ $errors->first('shop_name') }}</span>
                            @endif
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6  mb-4">
                            <label>City</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/global.png') }}" alt="">
                                @php
                                    $city = DB::table('in_cities')
                                        ->where('deleted_at', null)
                                        ->get();
                                @endphp
                                <select class="form-select" name="city" id="city" aria-label="Default select example"
                                    required>
                                    <option selected>Select City</option>
                                    @foreach ($city as $ct)
                                        <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label>Region</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/global.png') }}" alt="">
                                <select class="form-select" name="region" id="region"
                                    aria-label="Default select example" required>
                                    <option selected>Select Region</option>
                                </select>
                                @if ($errors->has('region'))
                                    <span class="text-danger">{{ $errors->first('region') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12  mb-4">
                            <label>Location</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/location.png') }}" alt="">
                                <select class="form-select" name="locations[]" id="location"
                                    aria-label="Default select example" required>
                                    <option selected>Select location</option>
                                </select>
                                @if ($errors->has('locations'))
                                    <span class="text-danger">{{ $errors->first('locations') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <div class="col-lg-12">
                            {{-- <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="service_merchant">
                                <label class="form-check-label">
                                    Merchant Service account type
                                </label>
                            </div> --}}
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="agree">
                                <label class="form-check-label">
                                    I agree to the <a href="{{route('privacy.policy')}}">terms and conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-blue text-white fw-bold px-4">Sign Up</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            {{-- <div id="signin-img" class="custom-column-img"></div> --}}
            <div class="custom-column-img" style="background-color: #E8F5FD; height: 100%; padding: 7em 2em 3em 10em;">
                <img src="{{asset('acp/frontend/Images/form-image.png')}}" class="form-img" alt="">
            </div>
        </div>
    </div>
</section>
<!--end Form-->

@include('ecommerce_frontend.footer')
