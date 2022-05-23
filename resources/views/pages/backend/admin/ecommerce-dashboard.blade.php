
@extends('layouts.backend.main', 
                        [
                            'title' => __("Ecommerce Dashboard"),
                            'page_name' => 'Ecommerce Dashboard',
                            'bs_version' => 'bootstrap@4.6.0',
                            'left_nav_color' => '#036CB1',
                            'nav_icon_color' => '#AFA5D9',
                            'active_nav_icon_color' => '#fff',
                            'active_nav_icon_color_border' => 'greenyellow' ,
                            'top_nav_color' => '#F7F6FB',
                            'background_color' => '#F7F6FB',
                        ])

@push('link-css')
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <link href="{{asset('css/graphs.css')}}" rel="stylesheet">

    @verbatim
        <style>
            /* test Graphs */

            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }

            /* // Small devices (landscape phones, 576px and up) */
            @media (min-width: 350px) {
                .big-money {
                    font-size: 3.5vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }
                .icon-size {
                    font-size: 3rem;
                }

                .display-4-mobile{
                    font-size: 3.5vh;
                }
            }

            /* // Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {  }

            /* // Large devices (desktops, 992px and up) */
            @media (min-width: 992px) { }

            /* // Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) { 
                .big-money {
                    font-size: 1vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }

                .icon-size{
                    font-size: 4.0vh;
                }
            }
        </style>
    @endverbatim
@endpush

@push('link-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>
@endpush

@push('navs')
@endpush

@section('content')
    {{-- Breadcrumb --}}    
    <div class="row">
        <div class="col-12 text-right">
            Balance : 
            <span class="mr-3">
                Cash : 15,758.0
            </span>
            <span class="mr-3">
                Account : 15,758.0
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-2 mb-3 font-weight-light">
            <i class='bx bx-subdirectory-right mr-2 text-primary' style="font-size: 2.8vh;"></i>
            <a href="" class="text-muted mr-1">
                {{ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted ml-1">
                Dashboard
            </a>  /
            <a href="" class="text-primary ml-1">
                Ecommerce
            </a>  
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 mb-4">
            <a href="{{route('superadmin.switchtoalternatvecreadit')}}" class="badge badge-pill shadow py-1 px-2 text-white" style="background-color:lightseagreen ">
                Switch to Alternative Credit
            </a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 col-lg-3 mb-3 d-flex align-items-stretch">
            <div class="card col-12 px-0 shadow-sm border-0">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-primary text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                            <span class="badge shadow-sm text-white bg-success">
                                Merchants
                            </span> 
                        </h5>
                    </div>
                    <div class="d-flex justify-content-between px-md-1">
                        <div>
                            <h3 class="text-success display-5  d-none d-md-inline-flex">
                                <span>
                                   {{$merchant_count}}
                                </span>
                            </h3>
                           
                           
                            <p class="mb-0 mt-3 text-muted font-weight-light">
                                Registered to date
                            </p>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-user pt-0 text-success icon-size"></i>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <a href="{{route('actors')}}" class="btn btn-sm btn-success" style="letter-spacing: .5px">
                                View List<i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-3 mb-3 d-flex align-items-stretch">
            <div class="card col-12 px-0 shadow-sm border-0">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-primary text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                            <span class="badge shadow-sm text-white bg-success">
                                Sales Value
                            </span> 
                        </h5>
                    </div>
                    <div class="d-flex justify-content-between px-md-1">
                        <div>
                            <h3 class="text-success display-5  d-none d-md-inline-flex">
                                <small class="mr-2">Ksh</small> {{number_format($all_total_amount,2)}}
                            </h3>
                            {{-- Stubborn-Mobile --}}
                            <h3 class="d-md-none d-sm-inline-flex mt-3 text-success" style="font-size: 4.4vh">
                                <span class="d-none">
                                    {{$sales = rand(10000,30000)}}
                                </span>
                            </h3>
                            <p class="mb-0 mt-3 text-muted font-weight-light">
                                Registered to date
                            </p>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-money pt-0 text-success icon-size"></i>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <a href="{{route('all.merchant-transactions')}}" class="btn btn-sm btn-success" style="letter-spacing: .5px">
                                View List<i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Stock  Outs  --}}
        <div class="col-md-4 col-lg-3 mb-3 d-flex align-items-stretch">
            <div class="card col-12 px-0 shadow-sm border-0">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-warning text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                            <span class="badge text-white bg-warning">
                                Stock Out Shops
                            </span> 
                        </h5>
                    </div>
                    <div class="d-flex justify-content-between px-md-1">
                        <div>
                            <h3 class="text-warning display-5  d-none d-md-inline-flex">
                                
                                {{count($stockout_count)}}
                            </h3>
                            {{-- Stubborn-Mobile --}}
                            <h3 class="d-md-none d-sm-inline-flex mt-3 text-warning" style="font-size: 4.4vh">
                               
                                {{count($stockout_count)}}
                            </h3>
                            <p class="mb-0 mt-3 text-muted font-weight-light" >
                                THese shops have items running out of stock
                            </p>
                        </div>
                        <div class="align-self-center">
                            <i class="bx bx-coin-stack text-warning icon-size"></i>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <a href="{{route("stockouts")}}" class="btn btn-sm btn-warning text-white" style="letter-spacing: .5px">
                                view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        {{-- Disputes --}}
        <div class="col-md-4 col-lg-3 mb-3 d-flex align-items-stretch">
            <div class="card col-12 px-0 shadow-sm border-0">
                <div class="card-body">
                    <div class="">
                        <h5 class="text-warning text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                            <span class="badge text-white bg-info">
                                Locations
                            </span> 
                        </h5>
                    </div>
                    <div class="d-flex justify-content-between px-md-1">
                        <div class="align-self-center">
                            <i class="bx bx-map  text-info icon-size"></i>
                           
                        </div>
                        <div>
                            <h3 class="text-info display-5 d-none d-md-inline-flex">
                                
                                {{$location_count}}
                            </h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <a href="{{route('locations')}}" class="btn btn-sm btn-info" style="letter-spacing: .5px">
                                view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            {{-- Rating --}}
    </div> 
      
@endsection

@push('scripts')
    
@endpush