@include('ecommerce_frontend.headers.header_1')

<!--Begin Form-->
<section>
    <div class="row">
        <div class="col-lg-6">
            <div class="content align-middle">
                <h3 class="blue-title mb-4">Sign up for a Partner account</h3>
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
                <form action="{{ route('assetprovider.register.request') }}" method="post">
                    @csrf
                    <div class="form-group row mb-4">
                        <div class="col-lg-6">
                            <label>Applicant Name</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/profile.png') }}" alt="">
                                <input type="text" name="applicant_name" class="form-control" placeholder="Name">
                            </div>
                            @if ($errors->has('applicant_name'))
                                <span class="text-danger">{{ $errors->first('applicant_name') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label>Business Name</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/shop.png') }}" alt="">
                                <input type="text" name="shop_name" class="form-control "
                                    placeholder="Enter business name">
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
                                <img src="{{ asset('acp/frontend/Images/icons/call-calling.jpg') }}" alt="">
                                <input type="text" name="phone" class="form-control" placeholder="Enter number">
                            </div>
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label>Email</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/sms.png') }}" alt="">
                                <input type="text" name="email" class="form-control" placeholder="Enter email">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6">
                            <label>County</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/global.png') }}" alt="">
                                <select class="form-select" name="county">
                                    <option value="">
                                        Select County
                                    </option>
                                    <option value="Mombasa">
                                        Mombasa
                                    </option>
                                    <option value="Kwale">
                                        Kwale
                                    </option>
                                    <option value="Kilifi">
                                        Kilifi
                                    </option>
                                    <option value="Tana River">
                                        Tana River
                                    </option>
                                    <option value="Lamu">
                                        Lamu
                                    </option>
                                    <option value="Taita Taveta">
                                        Taita Taveta
                                    </option>
                                    <option value="Garissa">
                                        Garissa
                                    </option>
                                    <option value="Wajir">
                                        Wajir
                                    </option>
                                    <option value="Mandera">
                                        Mandera
                                    </option>
                                    <option value="Marsabit">
                                        Marsabit
                                    </option>
                                    <option value="Turkana">
                                        Turkana
                                    </option>
                                    <option value="Isiolo">
                                        Isiolo
                                    </option>
                                    <option value="Meru">
                                        Meru
                                    </option>
                                    <option value="Tharaka-Nithi">
                                        Tharaka-Nithi
                                    </option>
                                    <option value="Embu">
                                        Embu
                                    </option>
                                    <option value="Kitui">
                                        Kitui
                                    </option>
                                    <option value="Machakos">
                                        Machakos
                                    </option>
                                    <option value="Makueni">
                                        Makueni
                                    </option>
                                    <option value="Nyandarua">
                                        Nyandarua
                                    </option>
                                    <option value="Nyeri">
                                        Nyeri
                                    </option>
                                    <option value="Kirinyaga">
                                        Kirinyaga
                                    </option>
                                    <option value="Muranga">
                                        Muranga
                                    </option>
                                    <option value="Kiambu">
                                        Kiambu
                                    </option>
                                    <option value="West Pokot">
                                        West Pokot
                                    </option>
                                    <option value="Samburu">
                                        Samburu
                                    </option>
                                    <option value="Trans Nzoia">
                                        Trans Nzoia
                                    </option>
                                    <option value="Usain Gishu">
                                        Usain Gishu
                                    </option>
                                    <option value="Elgeyo Marakwet">
                                        Elgeyo Marakwet
                                    </option>
                                    <option value="Nandi">
                                        Nandi
                                    </option>
                                    <option value="Baringo">
                                        Baringo
                                    </option>
                                    <option value="Laikipia">
                                        Laikipia
                                    </option>
                                    <option value="Nakuru">
                                        Nakuru
                                    </option>
                                    <option value="Narok">
                                        Narok
                                    </option>
                                    <option value="Kajiado">
                                        Kajiado
                                    </option>
                                    <option value="Kericho">
                                        Kericho
                                    </option>
                                    <option value="Bomet">
                                        Bomet
                                    </option>
                                    <option value="Kakamega">
                                        Kakamega
                                    </option>
                                    <option value="Vihiga">
                                        Vihiga
                                    </option>
                                    <option value="Bungoma">
                                        Bungoma
                                    </option>
                                    <option value="Busia">
                                        Busia
                                    </option>
                                    <option value="Siaya">
                                        Siaya
                                    </option>
                                    <option value="Kisumu">
                                        Kisumu
                                    </option>
                                    <option value="Homa Bay">
                                        Homa Bay
                                    </option>
                                    <option value="Migori">
                                        Migori
                                    </option>
                                    <option value="Kisii">
                                        Kisii
                                    </option>
                                    <option value="Nyamira">
                                        Nyamira
                                    </option>
                                    <option value="Nairobi">
                                        Nairobi
                                    </option>
                                </select>
                            </div>
                            @if ($errors->has('county'))
                                <span class="text-danger">{{ $errors->first('county') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <label>Sub county</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/global.png') }}" alt="">
                                <input type="text" name="sub_county" class="form-control"
                                    placeholder="Enter subcounty">
                            </div>
                            @if ($errors->has('sub_county'))
                                <span class="text-danger">{{ $errors->first('sub_county') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-lg-6">
                            <label>Location</label>
                            <div class="input-group">
                                <img src="{{ asset('acp/frontend/Images/icons/location.png') }}" alt="">
                                <input type="text" name="location" class="form-control" placeholder="Enter Location"
                                    value="{{ old('location') }}">
                            </div>
                            @if ($errors->has('location'))
                                <span class="text-danger">{{ $errors->first('location') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label>Operating days</label>
                        <div class="col-lg-12">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="monday"
                                    {{ old('monday') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Monday
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tuesday"
                                    {{ old('tuesday') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Tuesday
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="wednesday"
                                    {{ old('wednesday') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Wednesday
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="thursday"
                                    {{ old('thursday') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Thursday
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="friday"
                                    {{ old('friday') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Friday
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="saturday"
                                    {{ old('saturday') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Saturday
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="sunday"
                                    {{ old('sunday') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    Sunday
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-orange text-white  px-4">Signup</button>
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
