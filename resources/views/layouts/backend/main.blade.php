<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{Illuminate\Support\Str::title($title)}}
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/{{$bs_version}}/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{asset('css/sidenav.css')}}" rel="stylesheet">
    @stack('link-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    {{-- Navigation Script --}}
    <script defer>
        document.addEventListener("DOMContentLoaded", function(event) {
        const showNavbar = (toggleId, navId, bodyId, headerId) =>{
        const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
        // show navbar
        nav.classList.toggle('show')
        // change icon
        toggle.classList.toggle('bx-x')
        // add padding to body
        bodypd.classList.toggle('body-pd')
        // add padding to header
        headerpd.classList.toggle('body-pd')
        })
        }
        }

        showNavbar('header-toggle','nav-bar','body-pd','header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink(){
        if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
        }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
        });
    </script>
    @stack('link-js')
    <style>
        .custom-radius{
            border-radius: 15px;
        }
        .dropdown-submenu {
            position: relative;
        }
        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: inline-start;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }
        .nav_link{
            color : {{$nav_icon_color}}
        }
        
        .active {
            color: {{$active_nav_icon_color}}
        }

        .active::before {
            background-color: {{$active_nav_icon_color_border}}
        }

        .header_toggle{
            color: {{$left_nav_color}}
        }
        .tab-pane{
                width: 100%
            }

        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            color: #fff;
            background-color: #17a2b8;
        }

        .nav-pills .nav-link {
            border-radius: .25rem;
            border:1px solid #17a2b8;
        }

        .nav-list {
            height: 100%;
            display: flex;
            flex-direction: row;
            justify-content: start;
            overflow: hidden;
        }   

        .nav_logo-icon{
            color: {{$nav_icon_color}}
        }
    </style>

</head>
<body id="body-pd" style="background-color: {{$background_color}}">
    <header class="header" id="header" style="background-color: {{$top_nav_color}}">
        <div class="header_toggle">
            <i class='bx bx-menu mr-2' id="header-toggle"></i>  
            {{-- {{Illuminate\Support\Str::title(config('app.name'))}} --}}
            {{Illuminate\Support\Str::title($page_name)}}
        </div>
        <div class="header_img">
            <span class="rounded-circle p-2">
                {{__('JM')}}
            </span>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar" style="background-color: {{$left_nav_color}}">
        <nav class="nav">
            @if (Auth::user()->email == "odundosamwel@gmail.com" &&  !Route::is('merchant-dashboard') && !Route::is('merchant-transactions') && !Route::is('merchant-disputes') && !Route::is('merchant-notifications') && !Route::is('merchant-stocks')&& !Route::is('merchant-products')&& !Route::is('merchant-stats') )    
                <div>
                    <a href="#" class="nav_logo">
                        <i class='bx bx-store-alt nav_logo-icon'></i>
                        <span class="nav_logo-name">
                            {{-- {{Illuminate\Support\Str::title(config('app.name'))}} --}}
                            {{Illuminate\Support\Str::ucfirst(config('app.name'))}}
                        </span>
                    </a>
                    <div class="nav_list">                    
                        <a href="{{route('ecommerce-dashboard')}}" class="nav_link"> 
                            <i class='bx bx-grid-alt nav_icon'></i> 
                            <span class="nav_name">
                                Dashboard
                            </span>
                        </a>

                        <a href="{{route('group')}}" class="nav_link">
                            <i class='bx bx-server nav_icon'></i>
                            <span class="nav_name">
                                Categories
                            </span>
                        </a>
                        
                        <a href="{{route('inventory')}}" class="nav_link">
                            <i class='bx bx-list-check nav_icon'></i>
                            <span class="nav_name">
                                Products
                            </span>
                        </a>

                        <a href="{{route('roles')}}" class="nav_link">
                            <i class='bx bx-key nav_icon'></i>
                            <span class="nav_name">
                                Roles
                            </span>
                        </a>

                        <a href="{{route('actors')}}" class="nav_link">
                            <i class='bx bx-user nav_icon'></i>
                            <span class="nav_name">
                                System Users
                            </span>
                        </a>

                        <a href="{{route('pages')}}" class="nav_link">
                            <i class='bx bx-palette nav_icon'></i>
                            <span class="nav_name">
                                Appearance
                            </span>
                        </a>

                        <a class="nav_link" data-toggle="collapse" href="#menuCollapse" role="button" aria-expanded="false" aria-controls="menuCollapse">
                            <i class='bx bx-dots-horizontal nav_icon'></i>
                            <span class="nav_name">
                                More
                            </span>
                        </a>

                        <div class="collapse" id="menuCollapse">
                            <div class="">
                                <a href="{{route('county')}}" class="nav_link">
                                    <i class='bx bx-map nav_icon'></i>
                                    <span class="nav_name">
                                        Locations
                                    </span>
                                </a>
                                <a href="{{route('faqs')}}" class="nav_link">
                                    <i class='bx bx-question-mark nav_icon'></i>
                                    <span class="nav_name">
                                        FAQ's
                                    </span>
                                </a>
                                <a href="{{route('announcements')}}" class="nav_link">
                                    <i class='bx bx-user-voice nav_icon'></i>
                                    <span class="nav_name">
                                        Announcements
                                    </span>
                                </a>
                                <a href="{{route('email')}}" class="nav_link">
                                    <i class='bx bx-at nav_icon'></i>
                                    <span class="nav_name">
                                        Email Templates
                                    </span>
                                </a>
                            </div>
                        </div>

                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav_link"> 
                            <i class='bx bx-log-out nav_icon'></i> 
                            <span class="nav_name">
                                Sign Out
                            </span> 
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div> 
            @else
                <div>
                    <a href="#" class="nav_logo">
                        <i class='bx bx-store-alt nav_logo-icon'></i>
                        <span class="nav_logo-name">
                            {{-- {{Illuminate\Support\Str::title(config('app.name'))}} --}}
                            {{Illuminate\Support\Str::ucfirst(config('app.name'))}}
                        </span>
                    </a>
                    <div class="nav_list"> 
                        @if (Auth::user()->id == 1)
                            <a href="{{route('ecommerce-dashboard')}}" class="nav_link"> 
                                <i class='bx bx-grid-alt nav_icon'></i> 
                                <span class="nav_name">
                                    Admin
                                </span>
                            </a>
                        @endif

                        <a href="{{route('merchant-dashboard')}}" class="nav_link"> 
                            <i class='bx bx-grid-alt nav_icon'></i> 
                            <span class="nav_name">
                                Dashboard
                            </span>
                        </a>
                        
                        <a href="{{route('merchant-products')}}" class="nav_link">
                            <i class='bx bx-list-check nav_icon'></i>
                            <span class="nav_name">
                                Products
                            </span>
                        </a>

                        <a href="{{route('merchant-transactions')}}" class="nav_link">
                            <i class='bx bx-transfer nav_icon'></i>
                            <span class="nav_name">
                                Transactions
                            </span>
                        </a>

                        <a href="{{route('merchant-stocks')}}" class="nav_link">
                            <i class='bx bx-coin-stack nav_icon'></i>
                            <span class="nav_name">
                                Stock
                            </span>
                        </a>
                        
                        @if (Auth::user()->id != 1)
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav_link"> 
                                <i class='bx bx-log-out nav_icon'></i> 
                                <span class="nav_name">
                                    Sign Out
                                </span> 
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </div>
                </div> 
            @endif
        </nav>
    </div>
    <!--Container Main start-->
    <section class="container-fluid">
        <div id="app">
            @yield('content')
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/{{$bs_version}}/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>
    <script>
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
        $('.pagination span').addClass('page-link');
    
    </script>
    @stack('scripts')
</body>
</html>