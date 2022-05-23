@include('acp.frontend.headers.header_1')

<!--Begin Form-->
<section>
        <div class="row">
            <div class="col-lg-6">
                <div class="content align-middle">
                    <h2 class="blue-heading-txt mb-4">Partner Forgot Password?</h2>
                    <p class="text-muted fw-normal my-3">Please enter your email below and get a reset link</p>
                    <form>
                        <div class="form-group mb-4">
                            <label class="fw-normal">Email</label>
                            <div class="input-group">
                                <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                <input type="text" class="form-control" placeholder="Enter Email">
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-blue text-white px-4">Reset Password</button>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="signin-img" class="custom-column-img"></div>
            </div>
        </div>
    </section>
    <!--end Form-->

@include('acp.frontend.footer')