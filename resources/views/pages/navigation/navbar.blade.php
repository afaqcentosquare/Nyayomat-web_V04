<nav id="navbar-main" style="z-index: 1" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
    <div class="container">
        <a class="mr-lg-5" href="{{route('landing')}}" aria-expanded="true" aria-controls="main">
            <img class="content-image" src="{{asset('uploads/logo-de.png')}}" style="object-fit:fit;height:3.5vh">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="" clas>
                            <img src="{{asset('uploads/logo-de.png')}}" class="content-image" style="object-fit: cover; width:80vw">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
            </ul>
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                @auth
                    @if (Auth::user()-> username == 'superadmin')
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon" href="{{route('admin')}}">
                                <i class='bx bx-user-circle mr-2'></i> Admin
                            </a>
                        </li>
                    @endif
                @endauth
                @if (Route::is('landing'))
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="{{route('coverage')}}">
                            <i class='bx bx-map-pin mr-2'></i> Coverage
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" data-toggle="modal" href="#servicesModal">
                            <i class='bx bx-briefcase mr-2'></i>
                            Services 
                        </a>
                    </li>
                @endif

                @if (Route::is('shopping'))
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" data-toggle="modal" href="#filterModal">
                            <i class='bx bx-filter-alt mr-2'></i> Filter
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" data-toggle="modal" href="#myCart">
                            <i class='bx bx-cart mr-2'></i> 
                            <span class="">
                                Cart 
                            </span>
                            <span class="badge badge-default total-count"></span>
                        </a>
                    </li>
                @endif

                @if (Route::is('vendor'))
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" data-toggle="modal" href="#servicesModal">
                            <i class='bx bxs-package mr-2'></i>
                            Asset 
                        </a>
                    </li>
                @endif

                @guest
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="{{route('login')}}">
                            <i class='bx bx-user-check mr-2'></i> Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="{{route('register')}}">
                            <i class='bx bx-user-plus mr-2' ></i> Sign Up
                        </a>
                    </li>
                @endguest
                @auth
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{route('register')}}">
                        <i class='bx bx-user-plus mr-2' ></i> Hi, {{Auth::user()->username}}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link nav-link-icon" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>