@include('acp.frontend.headers.ecommerce_header')

<!--Begin banner-->
<section class="main py-15">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content text-white">
                        <h1 class="mb-4 fw-bold">Time To Order</h1>
                        <p class="mb-3">Now Find Offers in your Area</p>
                        <form>
                            <div class="form-group mb-4">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <img src="{{asset('acp/frontend/Images/icons/sms.png')}}" alt="">
                                        <select class="form-select text-muted">
                                            <option selected>Type or Select your location</option>
                                            <option value="1">Nyayo Estate</option>
                                            <option value="2">Taj Villase</option>
                                            <option value="3">Sky Line Apartments</option>
                                            <option value="4">Simba Villa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <button type="button" class="btn btn-orange text-white fs-6">Search Now</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('acp/frontend/Images/Graphics.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--end banner-->

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

@include('acp.frontend.footer')