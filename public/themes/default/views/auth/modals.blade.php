
    <div id="modal" class="popupContainer wrap-login100" style="display:none;">
        <header class="popupHeader">
            <span class="header_title"><strong>{{ trans('theme.account_login') }}</strong></span>
            <span class="modal_close"><i class="fa fa-times"></i></span>
        </header>

        <section class="popupBody">
            <!-- Social Login -->
            <div class="social_login">
                <div class="centeredText">
                    <span>Connect to Nyayomat Using</span>
                </div>
                <div class="flex-c-m">
                    <a href="{{ route('customer.login.social', 'facebook') }}" class="login100-social-item bg1">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="{{ route('customer.login.social', 'twitter') }}" class="login100-social-item bg2">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="{{ route('customer.login.social', 'google') }}" class="login100-social-item bg3">
                        <i class="fa fa-google"></i>
                    </a>
                </div>

                <div class="centeredText">
                    <span>Or use your Email address</span>
                </div>

                <div class="action_btns">
                    <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
                    <div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
                </div>

            </div>

            <!-- Username & Password Login form -->
            <div class="user_login">
                {!! Form::open(['route' => 'customer.login.submit', 'id' => 'loginForm', 'data-toggle' => 'validator',
                'novalidate']) !!}
                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                    <input class="input100" name="email" id="email" type="email" placeholder="Email / Username" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <!-- <span class="label-input100">Password</span> -->
                    <input class="input100" name="password" id="password" type="password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                </div>
                <br />


                <div class="inner">
                    <input name="remeber" id="remeber" type="checkbox" />
                    <label for="remember">Remember me</label>
                </div>

                <br />


                <div class="action_btns">
                    <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                    <!-- <div class="one_half last"><a href="#" id="emailLogin" class="btn btn_red">{{ trans('theme.button.login') }}</a></div> -->
                    <div class="one_half last">
                        <a href="#" id="register_form" class="btn" onclick='document.getElementById("loginForm").submit();'>Log In</a>
                    </div>
                </div>
                {!! Form::close() !!}

                <a id = "passwordRecovery" href="#" class="forgot_password">Forgot password?</a>
            </div>

            <!-- Password Recovery Form -->
            <div class="password_recovery">
                {!! Form::open(['route' => 'customer.password.email', 'id' => 'psswordRecoverForm', 'data-toggle' =>
                    'validator', 'novalidate']) !!}
                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                    <!-- <span class="label-input100">Email / Username</span> -->
                    <input class="input100" name="rec_email" id="rec_email" type="email" placeholder="Email / Username" required>
                    <span class="focus-input100"></span>
                </div>
                <br />
                
                <div class="action_btns">
                    <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                    <div class="one_half last">
                        <a href="#" id="register_form" class="btn" onclick='document.getElementById("psswordRecoverForm").submit();'>Recover</a>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

            <!-- Register Form -->
            <div class="user_register">
                {!! Form::open(['style' => 'color: #757575;','class' => 'text-center', 'route' => 'customer.register', 'id' => 'registerForm' , 'data-toggle' => 'validator','novalidate']) !!}
                    <div class="form-group error" style="color:red;display:none"></div>    
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Full name is required">
                        <!-- <span class="label-input100">Full Name</span> -->
                        <input class="input100" type="text" name="reg_name" id="reg_name" required placeholder="{{ trans('theme.placeholder.full_name') }}">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Phone required">
                        <input class="input100" type="text" name="stripe_id" id="mobile_number_r" required placeholder="Phone Number">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Full name is required">
                        <input class="input100" type="email" name="reg_email" id="email_r" required placeholder="Email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" id="pass_r" required placeholder="{{ trans('theme.placeholder.password') }}">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" placeholder="{{ trans('theme.placeholder.confirm_password') }}" name="password_confirmation" id="conf_pass" required>
                        <span class="focus-input100"></span>
                    </div>
                    <br />

                    <div class="checkboxes">
                        <label for="materialRegisterFormNewsletter">
                            <input type="checkbox"  id="materialRegisterFormNewsletter" />
                            <span>Subscribe to our newsletter</span>
                        </label>
                    </div>
                    <div class="checkboxes">
                        <label for="tnc">
                            <input type="checkbox"  id="tnc" />
                            <span>Accept terms & conditions</span>
                        </label>
                    </div>
                    
                    <br />

                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                        <div class="one_half last">
                            <button id="send_otp" class="btn" type="button">
                                Register
                            </button>
                        </div>
                    </div>

                    <div class="otp_form" style="display:none;">
                        <div class="md-form">
                            <input type="text" name="otp" id="otp" class="form-control" required>
                            <label for="otp">Enter OTP</label>
                        </div>
                        <div class="md-form">
                            <button class="btn btn-block btn-lg flat btn_blue" type="button" id="check_otp" style="border-radius: 10px !important;">Submit</button>
                        </div>
                    </div>
                    
                {!! Form::close() !!}
            </div>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#mobile_number").on("keypress keyup blur", function(event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $("#send_otp").on('click', function(e) {
                var name = $("#reg_name").val();
                var mobile = $("#mobile_number_r").val();
                var email = $("#email_r").val();
                var pass = $("#pass_r").val();
                var cpass = $("#conf_pass").val();
                var tnc = $("#tnc").prop('checked');

                if (name == "" || name == undefined) {
                    $(".error").css("display", "block");
                    $(".error").text("please enter name");
                } else {
                    $(".error").css("display", "none");
                }

                if (mobile == "" || mobile == undefined) {
                    console.log('hi');
                    $(".error").css("display", "block");
                    $(".error").text("please enter mobile number");
                } else {
                    $(".error").css("display", "none");
                }

                if (email == "" || email == undefined) {
                    $(".error").css("display", "block");
                    $(".error").text("please enter email");
                } else {
                    $(".error").css("display", "none");
                }

                if (pass == "" || pass == undefined) {
                    $(".error").css("display", "block");
                    $(".error").text("please enter password");
                } else {
                    $(".error").css("display", "none");
                }

                if (cpass == "" || cpass == undefined) {
                    $(".error").css("display", "block");
                    $(".error").text("please enter confirm password");
                } else {
                    $(".error").css("display", "none");
                }

                if (pass != cpass) {
                    $(".error").css("display", "block");
                    $(".error").text("password doesn't matched");
                } else {
                    $(".error").css("display", "none");
                }

                if (!tnc) {
                    $(".error").css("display", "block");
                    $(".error").text("Accept the Terms & Conditions");
                    return;
                } else {
                    $(".error").css("display", "none");
                }

                if (mobile != "") {
                    $("#send_otp").html("Wait...");
                    $("#send_otp").prop('disabled', true);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("customer.otp.send") }}',
                        type: 'POST',
                        data: {
                            mobile: mobile
                        },
                        complete: function(data) {
                            if (data.responseText == "success") {
                                $(".otp_form").css("display", "block");
                                $(".action_btns").hide();
                                // $("#send_otp").css("display", "none");
                            }

                        },
                    });
                } else {

                }

                //   $(e.target.form).submit();
            });

            $("#check_otp").on('click', function() {
                var otp = $("#otp").val();
                var mobile = $("#mobile_number_r").val();

                console.log(otp,mobile);

                if (otp != "" || otp != undefined) {
                    $.ajax({
                        url: '{{ route('customer.otp.check') }}',
                        type: 'POST',
                        data: {
                            otp: otp,
                            mobile: mobile
                        },

                        complete: function(data) {
                            console.log(data.responseText);
                            if (data.responseText == "success") {
                                $(".otp_form").css("display", "none");
                                $(".reg").css("display", "block");
                            } else {
                                $(".error").css("display", "block");
                                $(".error").text("otp is wrong");
                                return false;
                            }

                        },
                    });
                } else {

                }
            });

        });
    </script>