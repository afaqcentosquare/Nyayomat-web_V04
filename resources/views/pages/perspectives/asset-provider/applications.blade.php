@extends('layouts.main')

@push('header_items')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/css/tether.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        #wrapper {
            padding-left: 0;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        #wrapper.toggled {
            padding-left: 220px;
        }

        #sidebar-wrapper {
            z-index: 1000;
            left: 220px;
            width: 0;
            height: 100%;
            margin-left: -220px;
            overflow-y: auto;
            overflow-x: hidden;
            background: #1a1a1a;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        #sidebar-wrapper::-webkit-scrollbar {
        display: none;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 220px;
        }

        #page-content-wrapper {
            width: 100%;
            padding-top: 70px;
        }

        #wrapper.toggled #page-content-wrapper {
            position: absolute;
            margin-right: -220px;
        }

        /*-------------------------------*/
        /*     Sidebar nav styles        */
        /*-------------------------------*/
        .navbar {
        padding: 0;
        }

        .sidebar-nav {
            position: absolute;
            top: 0;
            width: 220px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .sidebar-nav li {
            position: relative; 
            line-height: 20px;
            display: inline-block;
            width: 100%;
        }

        .sidebar-nav li:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            height: 100%;
            width: 3px;
            background-color: #1c1c1c;
            -webkit-transition: width .2s ease-in;
            -moz-transition:  width .2s ease-in;
            -ms-transition:  width .2s ease-in;
                    transition: width .2s ease-in;

        }
        .sidebar-nav li:first-child a {
            color: #fff;
            background-color: #1a1a1a;
        }
        .sidebar-nav li:nth-child(5n+1):before {
            background-color: #ec1b5a;   
        }
        .sidebar-nav li:nth-child(5n+2):before {
            background-color: #79aefe;   
        }
        .sidebar-nav li:nth-child(5n+3):before {
            background-color: #314190;   
        }
        .sidebar-nav li:nth-child(5n+4):before {
            background-color: #279636;   
        }
        .sidebar-nav li:nth-child(5n+5):before {
            background-color: #7d5d81;   
        }

        .sidebar-nav li:hover:before,
        .sidebar-nav li.open:hover:before {
            width: 100%;
            -webkit-transition: width .2s ease-in;
            -moz-transition:  width .2s ease-in;
            -ms-transition:  width .2s ease-in;
                    transition: width .2s ease-in;

        }

        .sidebar-nav li a {
            display: block;
            color: #ddd;
            text-decoration: none;
            padding: 10px 15px 10px 30px;    
        }

        .sidebar-nav li a:hover,
        .sidebar-nav li a:active,
        .sidebar-nav li a:focus,
        .sidebar-nav li.open a:hover,
        .sidebar-nav li.open a:active,
        .sidebar-nav li.open a:focus{
            color: #fff;
            text-decoration: none;
            background-color: transparent;
        }
        .sidebar-header {
            text-align: center;
            font-size: 20px;
            position: relative;
            width: 100%;
            display: inline-block;
        }
        .sidebar-brand {
            height: 65px;
            position: relative;
            background:#212531;
            background: linear-gradient(to right bottom, #2f3441 50%, #212531 50%);
        padding-top: 1em;
        }
        .sidebar-brand a {
            color: #ddd;
        }
        .sidebar-brand a:hover {
            color: #fff;
            text-decoration: none;
        }
        .dropdown-header {
            text-align: center;
            font-size: 1em;
            color: #ddd;
            background:#212531;
            background: linear-gradient(to right bottom, #2f3441 50%, #212531 50%);
        }
        .sidebar-nav .dropdown-menu {
            position: relative;
            width: 100%;
            padding: 0;
            margin: 0;
            border-radius: 0;
            border: none;
            background-color: #222;
            box-shadow: none;
        }
        .dropdown-menu.show {
            top: 0;
        }
        /*Fontawesome icons*/
        .nav.sidebar-nav li a::before {
            font-family: fontawesome;
            content: "\f12e";
            vertical-align: baseline;
            display: inline-block;
            padding-right: 5px;
        }
        a[href*="#home"]::before {
        content: "\f015" !important;
        }
        a[href*="#about"]::before {
        content: "\f129" !important;
        }
        a[href*="#events"]::before {
        content: "\f073" !important;
        }
        a[href*="#events"]::before {
        content: "\f073" !important;
        }
        a[href*="#team"]::before {
        content: "\f0c0" !important;
        }
        a[href*="#works"]::before {
        content: "\f0b1" !important;
        }
        a[href*="#pictures"]::before {
        content: "\f03e" !important;
        }
        a[href*="#videos"]::before {
        content: "\f03d" !important;
        }
        a[href*="#books"]::before {
        content: "\f02d" !important;
        }
        a[href*="#art"]::before {
        content: "\f1fc" !important;
        }
        a[href*="#awards"]::before {
        content: "\f02e" !important;
        }
        a[href*="#services"]::before {
        content: "\f013" !important;
        }
        a[href*="#contact"]::before {
        content: "\f086" !important;
        }
        a[href*="#followme"]::before {
        content: "\f099" !important;
        color: #0084b4;
        }
        /*-------------------------------*/
        /*       Hamburger-Cross         */
        /*-------------------------------*/

        .hamburger {
        position: fixed;
        top: 20px;  
        z-index: 999;
        display: block;
        width: 32px;
        height: 32px;
        margin-left: 15px;
        background: transparent;
        border: none;
        }
        .hamburger:hover,
        .hamburger:focus,
        .hamburger:active {
        outline: none;
        }
        .hamburger.is-closed:before {
        content: '';
        display: block;
        width: 100px;
        font-size: 14px;
        color: #fff;
        line-height: 32px;
        text-align: center;
        opacity: 0;
        -webkit-transform: translate3d(0,0,0);
        -webkit-transition: all .35s ease-in-out;
        }
        .hamburger.is-closed:hover:before {
        opacity: 1;
        display: block;
        -webkit-transform: translate3d(-100px,0,0);
        -webkit-transition: all .35s ease-in-out;
        }

        .hamburger.is-closed .hamb-top,
        .hamburger.is-closed .hamb-middle,
        .hamburger.is-closed .hamb-bottom,
        .hamburger.is-open .hamb-top,
        .hamburger.is-open .hamb-middle,
        .hamburger.is-open .hamb-bottom {
        position: absolute;
        left: 0;
        height: 4px;
        width: 100%;
        }
        .hamburger.is-closed .hamb-top,
        .hamburger.is-closed .hamb-middle,
        .hamburger.is-closed .hamb-bottom {
        background-color: #1a1a1a;
        }
        .hamburger.is-closed .hamb-top { 
        top: 5px; 
        -webkit-transition: all .35s ease-in-out;
        }
        .hamburger.is-closed .hamb-middle {
        top: 50%;
        margin-top: -2px;
        }
        .hamburger.is-closed .hamb-bottom {
        bottom: 5px;  
        -webkit-transition: all .35s ease-in-out;
        }

        .hamburger.is-closed:hover .hamb-top {
        top: 0;
        -webkit-transition: all .35s ease-in-out;
        }
        .hamburger.is-closed:hover .hamb-bottom {
        bottom: 0;
        -webkit-transition: all .35s ease-in-out;
        }
        .hamburger.is-open .hamb-top,
        .hamburger.is-open .hamb-middle,
        .hamburger.is-open .hamb-bottom {
        background-color: #1a1a1a;
        }
        .hamburger.is-open .hamb-top,
        .hamburger.is-open .hamb-bottom {
        top: 50%;
        margin-top: -2px;  
        }
        .hamburger.is-open .hamb-top { 
        -webkit-transform: rotate(45deg);
        -webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
        }
        .hamburger.is-open .hamb-middle { display: none; }
        .hamburger.is-open .hamb-bottom {
        -webkit-transform: rotate(-45deg);
        -webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
        }
        .hamburger.is-open:before {
        content: '';
        display: block;
        width: 100px;
        font-size: 14px;
        color: #fff;
        line-height: 32px;
        text-align: center;
        opacity: 0;
        -webkit-transform: translate3d(0,0,0);
        -webkit-transition: all .35s ease-in-out;
        }
        .hamburger.is-open:hover:before {
        opacity: 1;
        display: block;
        -webkit-transform: translate3d(-100px,0,0);
        -webkit-transition: all .35s ease-in-out;
        }

        /*-------------------------------*/
        /*            Overlay            */
        /*-------------------------------*/

        .overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(250,250,250,.8);
            z-index: 1;
        }
    
        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
            color: #fff;
            border: 1px solid #5e72e4;
            border-radius: 5px;
            background-color: #5e72e4;
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        }
    </style>
@endpush
@section('content')
    <div class="container pt-4">
        <div class="col-md-4 col-11  text-right shadow-sm rounded mb-4  align-items-stretch">
            <div class="card border-0 p-1 pt-0">
                <div class="card-header shadow mt-0 pt-2 pb-0 bg-default text-white" style="border-radius: 5px">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4 class="font-weight-light text-white text-center">
                                {{__('Asset Provider Application')}}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0 px-1">
                    <div class="row">
                        <p class="col-12 text-left mb-0" style="font-size: 2vh">
                            <ul class="list-unstyled row ml-0">
                                <li class="col-12 text-left font-weight-light">
                                    <span class="font-weight-bold">Biz : </span>
                                    Sample Business Name
                                </li>
                                <li class="col-12 text-left mt-2 font-weight-light">
                                    <span class="font-weight-bold">Location : </span>
                                    Location
                                    
                                </li>
                                <li class="col-12 text-left mt-2 font-weight-light">
                                    <span class="font-weight-bold">Name : </span>
                                    John Doe    
                                </li>
                                <li class="col-12 text-left mt-2 font-weight-light">
                                    <span class="font-weight-bold">Contact : </span>
                                    <a href="" class="">
                                        Call 
                                    </a>
                                </li>
                                <li class="col-12 text-left mt-2 font-weight-light">
                                    <span class="font-weight-bold">Date : </span>
                                    <span style="font-size: 2vh">
                                        25 - 07 - 2022
                                    </span>
                                </li>
                            </ul>
                        </p>

                        <p class="col-12 text-right mt-1">
                            <span class="d-none">
                                {{$biz = 'Business Name'}}
                            </span>
                            <a href="   mailto:ap@assetprovider.com?subject=Your expression of interest - Nyayomat &body=Dear Customer,%0D%0A%0D%0AThank you for your expression of interest to nyayomat. It has been valuable learning about your business and service offering. %0D%0A%0D%0AUnfortunately, given our current merchant needs, we are unable to progress further. We had to consider the merchants’ needs while balancing between the most critical and most urgent. %0D%0A%0D%0AWe hope that this is not the end, but the beginning of a greater conversation on your product offerings.%0D%0A%0D%0AThank you so much for the support of merchants.%0D%0A%0D%0AWarm regards%0D%0A%0D%0AThe Nyayomat Team.%0D%0AWith you, Every Step" class="mr-3 btn btn-danger shadow btn-sm">
                                Decline
                            </a>
                            <a  href=" mailto:ap@assetprovider.com?subject=Your expression of interest - Nyayomat &body=Dear {{$biz}},%0D%0A%0D%0A We are excited to have you as part of the nyayomat asset provider community.%0D%0A%0D%0ATo get started, kindly click here to create an account.%0D%0A%0D%0AWarm regards,The Nyayomat Team.%0D%0A%0D%0A With you, Every Step" class="btn btn-success shadow btn-sm">
                                {{__('Approve')}}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection