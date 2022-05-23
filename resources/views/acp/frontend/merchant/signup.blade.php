@include('acp.frontend.headers.header_1')

<!--Begin Form-->
<section>
        <div class="row">
            <div class="col-lg-6">
                <div class="content align-middle">
                    <h4 class="blue-title mb-4">Sign up for a Merchant account</h4>
                    <form>
                        <div class="form-group row">
                            <div class="col-lg-6 mb-4">
                                <label>Applicant Name</label>
                                <div class="input-group">
                                    <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                    <input type="text" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label>Shop Name</label>
                                <div class="input-group">
                                    <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                    <input type="text" class="form-control " placeholder="Enter shop name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-lg-6 mb-4">
                                <label>Phone</label>
                                <div class="input-group">
                                    <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                    <input type="text" class="form-control" placeholder="Enter number">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                    <input type="text" class="form-control" placeholder="Enter email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6  mb-4">
                                <label>County</label>
                                <div class="input-group">
                                    <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                    <input type="text" class="form-control" placeholder="Enter county">
                                </div>
                            </div>
                            <div class="col-lg-6  mb-4">
                                <label>Sub county</label>
                            <div class="input-group">
                                <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                <input type="text" class="form-control" placeholder="Enter subcounty">
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6  mb-4">
                                <label>Location</label>
                            <div class="input-group">
                                <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                <input type="text" class="form-control" placeholder="Enter Location">
                            </div>
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
    
                        <div class="form-group mb-3">

                        </div>
                        <button type="button" class="btn btn-blue text-white fw-bold px-4">Sign Up</button>
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