@include('acp.frontend.headers.header_1')



<!--Begin::Banner-->
<section class="img-fluid banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-4 mb-3">
                    <div class="card p-4">
                        <img src="{{asset('acp/frontend/Images/Group 1000002735.png')}}" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="text-muted text-uppercase fs-6">Nyayomat</h5>
                            <h5 class="card-title">Ecommerce</h5>
                            <a href="{{route('homepage')}}"><img src="{{asset('acp/frontend/Images/Group 1000002714.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 pb-3">
                    <div class="card p-4 ">
                        <img src="{{asset('acp/frontend/Images/Group (1).png')}}" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="text-muted text-uppercase fs-6">Nyayomat</h5>
                            <h5 class="card-title">Boost</h5>
                            <a href="{{route('boost.landing.page')}}"><img src="{{asset('acp/frontend/Images/Group 1000002714.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end::Banner-->

    <!--Begin::Card-->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="mail-card ">
                      <div class="mail-card-mask p-5">
                        <div class="row">
                          <div class="col-lg-8">
                              <h1 class="text-white">Get Updates regularly</h1>
                              <p class="text-white">Promotions, new products and sales direcly to your inbox</p>
                              <form class="d-flex">
                                  <input class="form-control me-2 w-75" placeholder="Email Address">
                                  <button class="btn btn-orange text-white text-wrap w-35"
                                      type="submit">Subscribe</button>
                              </form>
                          </div>
                          <div class="col-lg-4">
                              <img src="{{asset('acp/frontend/Images/asas 2.png')}}" class="trolley-img" height="200px" width="200px">
                          </div>
                      </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Card-->

@include('acp.frontend.footer')