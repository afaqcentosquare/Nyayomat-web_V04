<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
        {{Str::title($title)}} - 
        {{ config('app.name') }}
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/04a7d4ad56.js" crossorigin="anonymous"></script>
    <link href="{{asset('css/aos.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @stack('stylings')
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
	<div class="container d-flex align-items-center">
		<a href="index.html" class="logo mr-auto" style="font-size: 2.2vh;color:white">
			{{Str::title($title)}}
		</a>
		<nav class="nav-menu d-none d-lg-block">
			<ul>
				<li class="">
					<a href="#hero">
                        <i class='bx bx-home' ></i> 
						{{__('Home')}}
					</a>
				</li>
                
                <li>
                    <a class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-category-alt' ></i> 
						{{__('Categories')}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        @if ($vendor -> categories -> count() == 0)
                            <a class="dropdown-item text-default border-bottom-0">
                                {{__('as')}} 
                            </a>
                        @endif
                        @foreach ($vendor -> categories as $item)
                            <a class="dropdown-item text-default border-bottom-0">
                                <i class='bx bx-exit' ></i> 
                                {{__('Exit')}} 
                            </a>
                        @endforeach
                    </div>
                </li>
                
                @yield('sm')				

				@guest
					<li>
						<a href="{{route('login')}}">
							{{__('Login')}}
						</a>
					</li>
					<li>
						<a href="{{route('register')}}">
							{{__('Register')}}
						</a>
					</li>
				@endguest
				
			</ul>
		</nav>
	</div>
</header>
<!-- ======= Hero Section ======= -->
<main id="main">
    @yield('content')

	<section id="modal">
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
				<div class="modal-content bg-gradient-danger">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="logoutModalLabel">
								Logging Out  . . .
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="py-3 text-center">
								<i class="bx bx-alarm-exclamation alert-icon"></i>
								<h4 class="heading mt-4">
									Are you sure you want to leave ?
								</h4>
								<div>
									<form id="logout-form" action="{{ route('logout') }}" method="POST">
										@csrf
										<button class="btn btn-link text-default" type="submit">
											Yes, Proceed
										</button>
									</form>
									<button type="button" class="ml-4 btn btn-sm btn-default text-white" data-dismiss="modal">No</button> 
								</div>
							</div>
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</main><!-- End #main -->

<a href="#" class="back-to-top">
	<i class='bx bxs-chevron-up' ></i>
</a>
<div id="preloader"></div>
    @stack('js')
<!-- Vendor JS Files -->
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('js/jquery.easing.min.js')}}"></script>
	<script src="{{asset('js/validate.js')}}"></script>
	<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
	<script src="{{asset('js/venobox.min.js')}}"></script>
	<script src="{{asset('js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('js/aos.js')}}"></script>
	
	
	<script src="{{asset('js/main.js')}}"></script>
</body>

</html>