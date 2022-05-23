 <!--Begin::Header-->
    <header>
        <nav class="navbar navbar-light py-3">
            <div class="container">
                <div class="col-md-5">
                    <a href="{{route('homepage')}}"><img src="{{ asset('acp/frontend/Images/logo.png') }}"></a>
                </div>
                <div class="col-md-7">
                    
                    <div class="d-flex justify-content-end search">
                        @yield('search')
                        @yield('basket')
                        <a href="{{route('customer.signin')}}" class="btn btn-lg btn-blue text-white fs-6 rounded">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!--end::Header-->


