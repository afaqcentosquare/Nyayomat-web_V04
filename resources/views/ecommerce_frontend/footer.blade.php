@if (Route::currentRouteName() != 'superadmin.login')
    <!--Begin::Footer-->
    <footer class="bg-footer p-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <a href="{{ route('homepage') }}"><img src="{{ asset('acp/frontend/Images/logo.png') }}"
                            alt=""></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white fs-5 mb-4">Make Money With Us</h3>
                    <ul class="footer-list-color lh-lg  list-unstyled">
                        <li><a href="{{ route('merchant.login') }}">Merchant Login</a></li>
                        <li><a href="{{ route('assetprovider.loginview') }}">Partner Login</a></li>
                        <li><a href="{{ route('boost.landing.page') }}">Boost</a></li>
                        <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h3 class="text-white fs-5 mb-4">Contact Us</h3>
                    <ul class="footer-list-color lh-lg list-unstyled icon-padding">
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" style=" fill:#e0e0e0;"
                                class="bi bi-house-door" viewBox="0 0 16 16">
                                <path
                                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                            </svg>P.O Box 79162 -00400 Nairobi</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" style=" fill:#e0e0e0;"
                                class="bi bi-envelope" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                            </svg>info@nyayomat.com</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" style=" fill:#e0e0e0;"
                                class="bi bi-telephone" viewBox="0 0 16 16">
                                <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                            </svg>+254 111 6166 19</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" style=" fill:#e0e0e0;"
                                class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg>+254 111 6166 19</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white fs-5 mb-4">Social media</h3>
                    <ul class="d-flex social-icon list-unstyled">
                        <li>
                            <a href="https://www.facebook.com/nyayomat/" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="#101854"></path>
                                        <g fill="#ffffff">
                                            <path
                                                d="M86,17.2c-37.9948,0 -68.8,30.8052 -68.8,68.8c0,34.49173 25.41013,62.97493 58.5144,67.95147v-49.71947h-17.02227v-18.08293h17.02227v-12.03427c0,-19.92333 9.70653,-28.66667 26.2644,-28.66667c7.9292,0 12.126,0.59053 14.10973,0.85427v15.78387h-11.29467c-7.02907,0 -9.48293,6.66787 -9.48293,14.17853v9.88427h20.59987l-2.79213,18.08293h-17.80773v49.8628c33.58013,-4.55227 59.48907,-33.2648 59.48907,-68.0948c0,-37.9948 -30.8052,-68.8 -68.8,-68.8z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/nyayomat" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="#101854"></path>
                                        <g fill="#ffffff">
                                            <path
                                                d="M160.53333,39.77213c-5.4868,2.43667 -11.38067,4.0764 -17.56693,4.816c6.31813,-3.784 11.1628,-9.77533 13.44467,-16.91907c-5.90533,3.50307 -12.4528,6.04867 -19.42453,7.42467c-5.57853,-5.94547 -13.52493,-9.66067 -22.31987,-9.66067c-16.8904,0 -30.5816,13.69693 -30.5816,30.5816c0,2.39653 0.2752,4.73573 0.7912,6.966c-25.41587,-1.2728 -47.94787,-13.4504 -63.038,-31.9576c-2.62587,4.51787 -4.13373,9.7696 -4.13373,15.38253c0,10.60667 5.39507,19.9692 13.59947,25.45027c-5.01093,-0.16053 -9.72947,-1.53653 -13.85173,-3.82413c0,0.13187 0,0.25227 0,0.38413c0,14.82067 10.53787,27.18173 24.53293,29.98533c-2.5628,0.69947 -5.26893,1.07213 -8.06107,1.07213c-1.96653,0 -3.8872,-0.19493 -5.75053,-0.54467c3.89293,12.14893 15.1876,20.99547 28.5692,21.242c-10.46333,8.2044 -23.65,13.09493 -37.98333,13.09493c-2.46533,0 -4.902,-0.14333 -7.29853,-0.43c13.5364,8.67453 29.60693,13.73707 46.88147,13.73707c56.25547,0 87.00907,-46.60053 87.00907,-87.0148c0,-1.3244 -0.02867,-2.64307 -0.086,-3.956c5.97987,-4.3172 11.16853,-9.7008 15.26787,-15.82973z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0 0 24 24" style=" fill:#f5f5f5;">
                                    <path
                                        d="M 5 3 C 3.895 3 3 3.895 3 5 L 3 19 C 3 20.105 3.895 21 5 21 L 19 21 C 20.105 21 21 20.105 21 19 L 21 5 C 21 3.895 20.105 3 19 3 L 5 3 z M 5 5 L 19 5 L 19 19 L 5 19 L 5 5 z M 7.7792969 6.3164062 C 6.9222969 6.3164062 6.4082031 6.8315781 6.4082031 7.5175781 C 6.4082031 8.2035781 6.9223594 8.7167969 7.6933594 8.7167969 C 8.5503594 8.7167969 9.0644531 8.2035781 9.0644531 7.5175781 C 9.0644531 6.8315781 8.5502969 6.3164062 7.7792969 6.3164062 z M 6.4765625 10 L 6.4765625 17 L 9 17 L 9 10 L 6.4765625 10 z M 11.082031 10 L 11.082031 17 L 13.605469 17 L 13.605469 13.173828 C 13.605469 12.034828 14.418109 11.871094 14.662109 11.871094 C 14.906109 11.871094 15.558594 12.115828 15.558594 13.173828 L 15.558594 17 L 18 17 L 18 13.173828 C 18 10.976828 17.023734 10 15.802734 10 C 14.581734 10 13.930469 10.406562 13.605469 10.976562 L 13.605469 10 L 11.082031 10 z">
                                    </path>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="https://api.whatsapp.com/send?phone=254111616619" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                    viewBox="0 0 172 172" style=" fill:#000000;">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                        stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                        stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,172v-172h172v172z" fill="#101854"></path>
                                        <g fill="#ffffff">
                                            <path
                                                d="M86.08399,14.33333c-39.45967,0 -71.58235,32.09502 -71.59668,71.55469c-0.00717,12.61333 3.29655,24.92701 9.56022,35.77734l-9.71419,36.00131l37.49902,-8.86035c10.45617,5.70467 22.22697,8.69922 34.20963,8.70638h0.028c39.4525,0 71.56118,-32.10219 71.58268,-71.55469c0.01433,-19.12784 -7.42377,-37.11191 -20.9401,-50.64258c-13.51633,-13.5235 -31.47925,-20.97493 -50.62858,-20.9821zM86.06999,28.66667c15.308,0.00717 29.69396,5.97554 40.50846,16.78288c10.8145,10.82167 16.75522,25.2008 16.74089,40.49447c-0.01433,31.56199 -25.68702,57.23535 -57.26335,57.23535c-9.55317,-0.00717 -19.01607,-2.40588 -27.35091,-6.95671l-4.8291,-2.63151l-5.33301,1.25976l-14.10937,3.33138l3.44336,-12.79362l1.55371,-5.73894l-2.96745,-5.15104c-5.00233,-8.65733 -7.64974,-18.55584 -7.64258,-28.61067c0.01433,-31.54767 25.69452,-57.22135 57.24935,-57.22135zM60.7487,52.85417c-1.19683,0 -3.13195,0.44792 -4.77311,2.23958c-1.64117,1.7845 -6.27083,6.10656 -6.27083,14.90723c0,8.80067 6.41081,17.30772 7.30664,18.50455c0.88867,1.18967 12.37448,19.82031 30.55632,26.98698c15.10733,5.9555 18.17568,4.78017 21.45801,4.47917c3.28233,-0.29383 10.58909,-4.31825 12.07975,-8.49641c1.49066,-4.17817 1.49414,-7.77226 1.0498,-8.51042c-0.44433,-0.74533 -1.6377,-1.18978 -3.42936,-2.08561c-1.7845,-0.89583 -10.57856,-5.21409 -12.21973,-5.80892c-1.64117,-0.59483 -2.84158,-0.89583 -4.03125,0.89583c-1.18967,1.79167 -4.60861,5.80903 -5.65494,6.9987c-1.04633,1.19683 -2.08561,1.35775 -3.87728,0.46191c-1.79167,-0.903 -7.55232,-2.79668 -14.38932,-8.88835c-5.31767,-4.73717 -8.90582,-10.58203 -9.95215,-12.37369c-1.03917,-1.7845 -0.09798,-2.76466 0.79785,-3.65332c0.80267,-0.80267 1.77767,-2.08908 2.6735,-3.13542c0.88867,-1.04633 1.19683,-1.79178 1.79167,-2.98145c0.59483,-1.18966 0.29036,-2.23958 -0.15398,-3.13541c-0.44433,-0.89583 -3.92397,-9.7292 -5.51497,-13.26953c-1.34017,-2.97417 -2.75558,-3.04326 -4.03125,-3.09342c-1.03917,-0.043 -2.2257,-0.04199 -3.41536,-0.04199z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="text-white text-center">
                <hr>
                <p>Copyright © 2022 Nyayomat. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endif
<!--end::Footer-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('themes/default/assets/js/vendor.js') }}"></script>
<script src="{{ asset('themes/default/assets/js/jquery.leanModal.min.js') }}"></script>
<script src="{{ asset('themes/default/assets/js/jquery.simplecolorpicker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
@include('ecommerce_frontend.scripts.appjs')
@include('ecommerce_frontend.popup')
@yield('scripts')
<script>
    $('.select2').select2({});
    $('.pagination li').addClass('page-item');
    $('.pagination li a').addClass('page-link');
    $('.pagination span').addClass('page-link');
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#city").on('change', function() {

            var city = $("#city").val();

            $.ajax({
                url: '/customer/region',
                type: 'POST',
                data: {
                    'city': city,
                    '_token': '{{ csrf_token() }}'
                },
                complete: function(text) {
                    $("#region").html(text.responseText);
                    var region = $("#region").val();
                    $.ajax({
                        url: '/customer/location',
                        type: 'POST',
                        data: {
                            'region': region,
                            '_token': '{{ csrf_token() }}'
                        },
                        complete: function(text) {
                            $("#location").html(text.responseText);

                        },
                    });
                },
            });

        });

        $("#region").on('change', function() {

            var region = $("#region").val();
            $.ajax({
                url: '/customer/location',
                type: 'POST',
                data: {
                    'region': region,
                    '_token': '{{ csrf_token() }}'
                },
                complete: function(text) {
                    $("#location").html(text.responseText);

                },
            });


        });

    });
</script>
 

</body>

</html>
