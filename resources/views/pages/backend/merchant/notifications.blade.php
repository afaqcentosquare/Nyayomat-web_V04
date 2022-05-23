@extends('layouts.backend.main', 
                        [
                            'title' => __("Notifications"),
                            'page_name' => 'Notifications',
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
    @verbatim
        <style>
            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }
            .collapse{
                width: 100%
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
@endpush

@push('navs')
    <a href="{{route('merchant-overview')}}" class="nav_link"> 
        <i class='bx bx-grid-alt nav_icon'></i> 
        <span class="nav_name">
            Dashboard
        </span>
    </a>

    <a href="{{route('merchant-transactions')}}" class="nav_link">
        <i class='bx bx-money nav_icon'></i>
        <span class="nav_name">
            Transactions    
        </span> 
    </a> 

    <a href="{{route('merchant-stock')}}" class="nav_link"> 
        <i class='bx bx-coin-stack nav_icon'></i> 
        <span class="nav_name">
            Stock
        </span>
    </a>

    <a href="{{route('merchant-product')}}" class="nav_link">
        <i class='bx bx-package nav_icon'></i>
        <span class="nav_name">
            Products &amp; Assets
        </span>
    </a>
  
    <a href="" class="nav_link"> 
        <i class='bx bx-alarm-exclamation nav_icon'></i> 
        <span class="nav_name">
            Disputes
        </span>
    </a>
    
    <a href="{{route('merchant-stats')}}" class="nav_link"> 
        <i class='bx bx-doughnut-chart nav_icon'></i>   
        <span class="nav_name">
            Statistics 
        </span> 
    </a> 

    <a href="{{route('merchant-notifications')}}" class="nav_link active">
        <i class='bx bx-chat nav_icon'></i>
        <span class="nav_name">
            Notifications 
            <span class="d-md-inline-flex badge nav)n badge-circle mr-2 bg-white nyayomat-blue d-none">
                {{rand(1,10)}}
            </span>   
        </span> 
    </a> 
@endpush

@section('content')
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-12 mt-2 mb-3 font-weight-light">
            <i class='bx bx-subdirectory-right mr-2 text-primary' style="font-size: 2.8vh;"></i>
            <a href="" class="text-muted mr-1">
                {{Illuminate\Support\Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-primary ml-1">
                Notifications
            </a>  
        </div>
    </div>
    <ul class="nav nav-pills nav-list mb-3" id="pills-tab" role="tablist">
        {{-- <li class="nav-item mr-2" role="presentation">
            <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                Shop
            </a>
        </li> --}}
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                Asset Manager
            </a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        {{-- <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="">

        </div> --}}
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="accordion mt-3" id="accordionExample">
                {{-- 
                    
                    --}}
                <div class="card mb-2 rounded shadow-sm border-0">
                    <div class="card-header border-0 my-0" id="headingOne">
                        <div class="row">
                            <h2 class="col-12 mb-0">
                                <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Illuminate\Support\Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                    Successful Applications <span class="text-uppercase badge bg-primary text-white ml-2">{{rand(10,30)}}</span>    
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Provident voluptate maxime cumque possimus dolorem harum, 
                        ducimus minus quam consequatur eum architecto, laudantium 
                        nihil totam ab voluptates modi! Temporibus, provident nemo.
                    </div>
                </div>

                    {{-- 
                    
                    --}}
                <div class="card mb-2 rounded shadow-sm border-0">
                    <div class="card-header border-0 my-0" id="headingOne">
                        <div class="row">
                            <h2 class="col-12 mb-0">
                                <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Illuminate\Support\Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                    Declined Applications <span class="text-uppercase badge bg-primary text-white ml-2">{{rand(10,30)}}</span>    
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Provident voluptate maxime cumque possimus dolorem harum, 
                        ducimus minus quam consequatur eum architecto, laudantium 
                        nihil totam ab voluptates modi! Temporibus, provident nemo.
                    </div>
                </div>

                {{-- 
                    
                    --}}
                    <div class="card mb-2 rounded shadow-sm border-0">
                        <div class="card-header border-0 my-0" id="headingOne">
                            <div class="row">
                                <h2 class="col-12 mb-0">
                                    <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Illuminate\Support\Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                        Assets Disbursed <span class="text-uppercase badge bg-primary text-white ml-2">{{rand(10,30)}}</span>    
                                    </a>
                                </h2>
                            </div>
                        </div>
                        <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Provident voluptate maxime cumque possimus dolorem harum, 
                            ducimus minus quam consequatur eum architecto, laudantium 
                            nihil totam ab voluptates modi! Temporibus, provident nemo.
                        </div>
                    </div>

                    {{-- 
                    
                    --}}
                <div class="card mb-2 rounded shadow-sm border-0">
                    <div class="card-header border-0 my-0" id="headingOne">
                        <div class="row">
                            <h2 class="col-12 mb-0">
                                <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Illuminate\Support\Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                    Payments Received <span class="text-uppercase badge bg-primary text-white ml-2">{{rand(10,30)}}</span>    
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Provident voluptate maxime cumque possimus dolorem harum, 
                        ducimus minus quam consequatur eum architecto, laudantium 
                        nihil totam ab voluptates modi! Temporibus, provident nemo.
                    </div>
                </div>

                {{-- 
                    
                    --}}
                    <div class="card mb-2 rounded shadow-sm border-0">
                        <div class="card-header border-0 my-0" id="headingOne">
                            <div class="row">
                                <h2 class="col-12 mb-0">
                                    <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Illuminate\Support\Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                        Payments Overdue <span class="text-uppercase badge bg-primary text-white ml-2">{{rand(10,30)}}</span>    
                                    </a>
                                </h2>
                            </div>
                        </div>
                        <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Provident voluptate maxime cumque possimus dolorem harum, 
                            ducimus minus quam consequatur eum architecto, laudantium 
                            nihil totam ab voluptates modi! Temporibus, provident nemo.
                        </div>
                    </div>

                    {{-- 
                    
                    --}}
                <div class="card mb-2 rounded shadow-sm border-0">
                    <div class="card-header border-0 my-0" id="headingOne">
                        <div class="row">
                            <h2 class="col-12 mb-0">
                                <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Illuminate\Support\Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                    Completed Payments <span class="text-uppercase badge bg-primary text-white ml-2">{{rand(10,30)}}</span>    
                                </a>
                            </h2>
                        </div>
                    </div>
                    <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Provident voluptate maxime cumque possimus dolorem harum, 
                        ducimus minus quam consequatur eum architecto, laudantium 
                        nihil totam ab voluptates modi! Temporibus, provident nemo.
                    </div>
                </div>

                {{-- 
                    
                    --}}
                    <div class="card mb-2 rounded shadow-sm border-0">
                        <div class="card-header border-0 my-0" id="headingOne">
                            <div class="row">
                                <h2 class="col-6 mb-0">
                                    <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Illuminate\Support\Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                        Asset Transfer <span class="text-uppercase badge bg-primary text-white ml-2">{{rand(10,30)}}</span>    
                                    </a>
                                </h2>
                            </div>
                        </div>
                        <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Provident voluptate maxime cumque possimus dolorem harum, 
                            ducimus minus quam consequatur eum architecto, laudantium 
                            nihil totam ab voluptates modi! Temporibus, provident nemo.
                        </div>
                    </div>

                    
            </div>
        </div>
    </div>
      
@endsection

@push('scripts')
@endpush
