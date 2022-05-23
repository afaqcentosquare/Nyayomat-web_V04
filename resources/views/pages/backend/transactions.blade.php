@extends('layouts.backend.main', 
                        [
                            'title' => __("My Transactions"),
                            'page_name' => 'Transactions',
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
            .collapse{
                width: 100%
            }

            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }       
            /* // Small devices (landscape phones, 576px and up) */
            @media (min-width: 350px) {
                .big-money {
                    font-size: 4vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }
                .icon-size {
                    font-size: 3rem;
                }
            }

            /* // Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {  }

            /* // Large devices (desktops, 992px and up) */
            @media (min-width: 992px) { }

            /* // Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) { 
                .big-money {
                    font-size: 2vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }
                .icon-size {
                    font-size: 3rem;
                }
                .icon-size{
                    font-size: 7.0vh;
                }
            }
        </style>
    @endverbatim
@endpush

@push('link-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endpush


@push('navs')
    <a href="{{route('merchant-overview')}}" class="nav_link"> 
        <i class='bx bx-grid-alt nav_icon'></i> 
        <span class="nav_name">
            Dashboard
        </span>
    </a>

    <a href="{{route('merchant-transactions')}}" class="nav_link active">
        <i class='bx bx-money nav_icon'></i>
        <span class="nav_name">
            Transactions    
        </span> 
    </a> 

    <a href="{{route('merchant-stock')}}" class="nav_link"> 
        <i class='bx bx-coin-stack nav_icon'></i> 
        <span class="nav_name">
            Open Assets
        </span>
    </a>

    <a href="{{route('merchant-product')}}" class="nav_link">
        <i class='bx bx-recycle nav_icon'></i>
        <span class="nav_name">
            Engaged Assets
        </span>
    </a>
  
    <a href="{{route('merchant-disputes')}}" class="nav_link"> 
        <i class='bx bx-alarm-exclamation nav_icon'></i> 
        <span class="nav_name">
            Complaints
        </span>
    </a>
    
    <a href="{{route('merchant-stats')}}" class="nav_link"> 
        <i class='bx bx-doughnut-chart nav_icon'></i>   
        <span class="nav_name">
            Statistics 
        </span> 
    </a> 

    <a href="{{route('merchant-notifications')}}" class="nav_link">
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
                {{Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-primary ml-1">
                Transactions
            </a>  
        </div>
    </div>
    
    <ul class="nav nav-pills nav-list mb-3" id="pills-tab" role="tablist">
        <li class="nav-item mr-2" role="presentation">
            <a class="nav-link active" id="pills-merchants-tab" data-toggle="pill" href="#pills-merchants" role="tab" aria-controls="pills-merchants" aria-selected="true">
                Merchants
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-asset_providers-tab" data-toggle="pill" href="#pills-asset_providers" role="tab" aria-controls="pills-asset_providers" aria-selected="false">
                Asset Providers
            </a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-merchants" role="tabpanel" aria-labelledby="pills-merchants-tab" style="">
            <ul class="nav pl-4  nav-pills nav-list mb-3" id="pills-tab" role="tablist">
                <li class="nav-item mr-2" role="presentation">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" style="padding: 2px 6px 2px 6px ">
                        Shop
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="padding: 2px 6px 2px 6px ">
                        Asset Manager
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="flex-direction: row;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Today</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Yesterday</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">This Week</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">This Month</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="alls-tab" data-toggle="tab" href="#alls" role="tab" aria-controls="alls" aria-selected="false">All</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-md-2">
                                        <i class="bx bx-recycle mr-2"></i> Transactions  
                                    </span>
                                    <span class="nyayomat-blue">
                                        {{number_format(((rand(40,80) * rand(40,80))),0)}}
                                    </span>
                                </h6>
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="row">
                                    @for ($i = 0; $i < 10; $i++)
                                        <div class="col-12">
                                            <div class="card mb-2 rounded shadow-sm border-0">
                                                <div class="card-header border-0 my-0" id="headingOne">
                                                    <div class="row">
                                                        <h2 class="col-7 mb-0">
                                                            <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                                                MERCHANT.{{Str::upper(Str::random(10))}}  
                                                            </a>
                                                        </h2>
                                                        <p class="col-5 text-right nyayomat-blue">
                                                            {{$transactions = rand(100,200)}} Trans
                                                        </p>
                                                    </div>
                                                </div>
                                                <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 mb-2">
                                                                <span class="small-text nyayomat-blue font-weight-light mr-3">
                                                                    Total 
                                                                </span> 
                                                                
                                                                <span class="text-muted mr-3">
                                                                    <span class="d-none">
                                                                        {{$total_trans = rand(100000,1000000)}}
                                                                    </span>
                                                                    <sub>Ksh.</sub> 
                                                                    {{number_format($total_trans,2)}}  <i class="bx bx-minus"></i>
                                                                </span>
                                                            </div>
                                                            <div class="col-12 table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                {{__('Transaction ID')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Amount')}}
                                                                            </th>   
                                                                        
                                                                            <th>
                                                                                {{__('Timestamp')}}
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @for ($t = 0; $t < $transactions ; $t++)
                                                                            <tr>
                                                                                <td nowrap>
                                                                                    TRANSACTION.{{Str::upper(Str::random(10))}}
                                                                                </td>
                                                                                <td nowrap>
                                                                                    <small>Ksh</small> {{number_format(rand(5000,10000),2)}}
                                                                                </td>
                                                                                <td nowrap>
                                                                                    {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d-m-Y - H:i:s A')}}
                                                                                </td>
                                                                            </tr>
                                                                        @endfor
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="alls" role="tabpanel" aria-labelledby="alls-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="flex-direction: row;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Today</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Yesterday</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">This Week</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">This Month</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="alls-tab" data-toggle="tab" href="#alls" role="tab" aria-controls="alls" aria-selected="false">All</a>
                        </li>
                    </ul>
        
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="my-1 d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="my-1 d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-check-circle mr-2"></i> Fulfiled Payments <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="my-1">
                                    <span class="text-danger">
                                        <i class="bx bx-x-circle mr-2"></i> Covered Payments <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="alls" role="tabpanel" aria-labelledby="alls-tab">
                            <div class="row justify-content-center text-black-50 mt-4">
                                <span class="d-none">
                                    {{$total = rand(100000,300000)}}
                                    {{$inflow = rand(20,75)/100 * $total}}
                                    {{$outflow = $total - $inflow}}
                                </span>
                                <h5 class="col-12">
                                    Amount Received  <small class="ml-3">Ksh</small> 
                                    @if ($inflow > $outflow)
                                        <span class="text-success">
                                    @else
                                        <span class="text-danger">
                                    @endif
                                        {{number_format($total,2)}}
                                    </span>
                                </h5>
                                <h6 class="col-12">
                                    <span class="mr-3 text-success">
                                        <i class="bx bx-up-arrow-alt mr-2"></i> Inflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($inflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="text-danger">
                                        <i class="bx bx-down-arrow-alt mr-2"></i> Outflow <small class="ml-3">Ksh</small> 
                                        <span class="">{{number_format($outflow,2)}}</span>
                                    </span>
                                    <br class="d-md-none">
                                    <span class="ml-md-4">
                                        <span class="mr-md-2">
                                            <i class="bx bx-recycle mr-2"></i> Transactions  
                                        </span>
                                        {{number_format((($frac = 0.0001 * $total) + $frac),0)}}
                                    </span>
                                </h6>
                                
                            </div>
                        </div>
                    </div>
                    
                
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="" class="btn btn-sm btn-info">
                                        <i class="bx bx-printer mr-2"></i> 
                                        Print All           
                                    </a>
                                </div>

                                <div class="col-12 mt-3 nyayomat-blue">
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <span class=" mr-4 nyayomat-blue">
                                                Filter By Payment :
                                            </span>
                                        </div>
                                        <div class="col-6 text-right">
                                            <select id="filter-company" class="filter mr-2">
                                                <option value="0">
                                                    -- View All -- 
                                                </option>
                                                <option value="Fulfiled">
                                                    Fulfiled
                                                </option>
                                                <option value="Covered">
                                                    Covered
                                                </option>
                                            </select> 
                                             
                                            <div class="d-none">
                                                <select id="filter-range" class="filter mr-2">
                                                    <option value="0" data-min="1" data-max="1" >
                                                        No value
                                                    </option>
                                                    <option value="0 - 2" data-min="0" data-max="2" >
                                                        0 - 2
                                                    </option>
                                                    <option value="2 - 3" data-min="2" data-max="3" >
                                                        2 - 3
                                                    </option>
                                                    <option value="4 - 5" data-min="4" data-max="5" >
                                                        4 - 5
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion" id="accordionExample">
                                <div class="row">
                                    @for ($i = 0; $i < 10; $i++)
                                    <div class="col-12">
                                            
                                            <div class="card mb-2 rounded shadow-sm border-0">
                                                <div class="card-header border-0 my-0" id="headingOne">
                                                    <div class="row">
                                                        <h2 class="col-7 mb-0">
                                                            <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                                                ASSET.{{Str::upper(Str::random(10))}}  
                                                            </a>
                                                        </h2>
                                                        <p class="col-5 text-right nyayomat-blue">
                                                            {{$transactions = rand(100,200)}} Trans
                                                        </p>
                                                        <div class="col-9 mt-1 ml-3">
                                                            <div class="progress">
                                                                <span class="d-none">
                                                                    {{$progress = rand(10,100)}}
                                                                    {{$total = 100}}
                                                                    {{$half = rand(1,50)}}
                                                                    {{$other_half = 100 - $half}}
                                                                </span>
                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$half}}%" aria-valuenow="{{$half}}" aria-valuemin="0" aria-valuemax="100"><small>{{$half}} %</small></div>
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$other_half}}%" aria-valuenow="{{$other_half}}" aria-valuemin="0" aria-valuemax="100" style="background-color: greenyellow"><small>{{$other_half}} %</small></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 text-right">
                                                                <a href="" class="btn shadow-sm btn-sm btn-outline-info">
                                                                    <i class="bx bx-printer mr-2"></i> 
                                                                    Print
                                                                </a>
                                                            </div>
                                                            <div class="col-12 mb-2">
                                                                <span class="small-text nyayomat-blue font-weight-light mr-3">
                                                                    Total 
                                                                </span> 
                                                                
                                                                <span class="text-muted mr-3">
                                                                    <span class="d-none">
                                                                        {{$total_trans = rand(100000,1000000)}}
                                                                    </span>
                                                                    <sub>Ksh.</sub> 
                                                                    {{number_format($total_trans,2)}}  <i class="bx bx-minus"></i>
                                                                </span>
                                                            </div>
                                                            
                                                            <div class="col-12 table-responsive">
                                                                <table class="table" id="myTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">
                                                                                {{__('Transaction ID')}}
                                                                            </th>
                                                                            <th class="text-center">
                                                                                {{__('Amount')}}
                                                                            </th>   
                                                                            <th nowrap class="text-center">
                                                                                {{__('Merchant ID')}}
                                                                            </th>   
                                                                            <th nowrap class="text-center">
                                                                                {{__('Merchant Inflow')}}
                                                                                <small>
                                                                                    (Total)
                                                                                </small>
                                                                            </th>   
                                                                            <th nowrap class="text-center">
                                                                                {{__('Merchant Outflow   ')}}
                                                                                <small>
                                                                                    (Total)
                                                                                </small>
                                                                            </th>   
                                                                            <th nowrap class="text-center">
                                                                                {{__('Merchant Outstanding  Balance   ')}}
                                                                                <small>
                                                                                    (Total)
                                                                                </small>
                                                                            </th>  
                                                                            <th nowrap class="text-center">
                                                                                {{__('Merchant Rating')}}
                                                                            </th> 
                                                                            <th nowrap class="text-center">
                                                                                {{__('Payment Status')}}
                                                                            </th> 
                                                                            <th class="text-center">
                                                                                {{__('Timestamp')}}
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @for ($t = 0; $t < $transactions ; $t++)
                                                                        <span class="d-none">
                                                                            {{
                                                                                $rating =  number_format((rand(3,15)/3),1)
                                                                              }}
                                                                        </span>
                                                                            <tr>
                                                                                <td nowrap>
                                                                                    TRANSACTION.{{Str::upper(Str::random(10))}}
                                                                                </td>
                                                                                <td nowrap>
                                                                                    <small>Ksh</small> {{number_format(rand(5000,10000),2)}}
                                                                                </td>
                                                                                <td nowrap>
                                                                                    MERCHANT.{{Str::upper(Str::random(10))}}
                                                                                </td>
                                                                                <td nowrap>
                                                                                    <small>Ksh</small> {{number_format(rand(5000,10000),2)}}
                                                                                </td>
                                                                                <td nowrap>
                                                                                    <small>Ksh</small> {{number_format(rand(5000,10000),2)}}
                                                                                </td> 
                                                                                <td nowrap>
                                                                                    <small>Ksh</small> {{number_format(rand(5000,10000),2)}}
                                                                                </td>
                                                                                <td nowrap data-min="{{$rating}}" data-max="{{$rating}}">
                                                                                    {{$rating}}
                                                                                </td>
                                                                                @if ($t %2 == 0)    
                                                                                    <td nowrap class="company" data-company="Fulfiled">
                                                                                        <span class="text-success">
                                                                                            {{__("Fulfiled")}}    
                                                                                        </span>                                                                                        
                                                                                    </td>   
                                                                                @else
                                                                                    <td nowrap data-company="Covered">
                                                                                        <span class="text-danger">
                                                                                            {{__("Covered")}}    
                                                                                        </span>                                                                                        
                                                                                    </td>   
                                                                                @endif
                                                                                <td nowrap>
                                                                                    {{Carbon\Carbon::today()->format('d-m-Y - H:i:s A')}}
                                                                                </td>
                                                                            </tr>
                                                                        @endfor
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-asset_providers" role="tabpanel" aria-labelledby="pills-asset_providers-tab">
            <div class="accordion" id="accordionExample">
                <div class="row">
                    <h5 class="col-12 nyayomat-blue">
                        Current Position  <small class="ml-3">Ksh</small> 
                        @if ($inflow > $outflow)
                            <span class="text-success">
                        @else
                            <span class="text-danger">
                        @endif
                            {{number_format($total*(rand(1000,2000)),2)}}
                        </span>
                    </h5>

                    <h6 class="col-12 nyayomat-blue">
                        Acquisition Cost  <small class="ml-3">Ksh</small>
                            <span class="text-success">
                            {{number_format($srt = $total*(rand(1000,2000)),2)}}
                        </span>
                    </h6>

                    <h6 class="col-12 nyayomat-blue">
                        Projected Returns  <small class="ml-3">Ksh</small> 
                        <span class="text-success">
                            {{number_format($srt + $total*(rand(1000,2000)),2)}}
                        </span>
                    </h6>

                    <h6 class="col-12 mb-4 nyayomat-blue">
                        Locations 
                        <span class="text-muted">
                            {{number_format(rand(10,500),0)}}
                        </span>
                    </h6>
                    @for ($i = 0; $i < 10; $i++)
                        <div class="col-12">
                            <div class="card mb-2 rounded shadow-sm border-0">
                                <div class="card-header border-0 my-0" id="headingOne">
                                    <div class="row">
                                        <h2 class="col-7 mb-0">
                                            <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                                PROVIDER.{{Str::upper(Str::random(10))}}  
                                            </a>
                                        </h2>
                                        <p class="col-5 text-right nyayomat-blue">
                                            {{$transactions = rand(100,200)}} Trans
                                        </p>
                                    </div>
                                </div>
                                <div id="asset{{$asset}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="row">
                                            <span class="d-none">
                                                {{
                                                    $rating =  number_format((rand(3,15)/3),1)
                                                  }}
                                            </span>
                                            <h2 class="col-12">
                                                <i class="bx bx-landscape"></i> 
                                                <small>
                                                    // Provider Logo / Image
                                                </small>
                                            </h2>
                                            <h3 class="col-12">
                                                {{$rating}}
                                            </h3>
                                            <div class="col-12 text-right">
                                                <a href="" class="btn btn-sm btn-info">
                                                    <i class="bx bx-printer mr-2"></i> 
                                                    Print
                                                </a>
                                            </div>
                                            
                                            <div class="col-12 mb-2">
                                                <span class="small-text nyayomat-blue font-weight-light mr-3">
                                                    Total 
                                                </span> 
                                                
                                                <span class="text-muted mr-3">
                                                    <span class="d-none">
                                                        {{$total_trans = rand(100000,1000000)}}
                                                    </span>
                                                    <sub>Ksh.</sub> 
                                                    {{number_format($total_trans,2)}}  <i class="bx bx-minus"></i>
                                                </span>
                                            </div>
                                            <div class="col-12 table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                {{__('Transaction ID')}}
                                                            </th>
                                                            <th>
                                                                {{__('Asset ID')}}
                                                            </th>  
                                                            <th>
                                                                {{__('Amount')}}
                                                            </th>
                                                            <th>
                                                                {{__('QTY')}}
                                                            </th>
                                                            <th>
                                                                {{__('Deposit Amount')}}
                                                            </th>
                                                            <th>
                                                                {{__('Installment Amount')}}
                                                            </th>
                                                            <th>
                                                                {{__('Payment Frequency')}}
                                                            </th>
                                                            <th>
                                                                {{__('Holiday')}} <small>Days</small>
                                                            </th>   
                                                            <th>
                                                                {{__('Timestamp')}}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($t = 0; $t < $transactions ; $t++)
                                                        
                                                            <tr>
                                                                <td nowrap>
                                                                    TRANSACTION.{{Str::upper(Str::random(10))}}
                                                                </td>
                                                                <td nowrap>
                                                                    <a href="#" class="text-decoration-none">
                                                                        ASSET.{{Str::upper(Str::random(10))}}
                                                                    </a>
                                                                </td> 
                                                                <td nowrap>
                                                                    <small>Ksh</small> {{number_format(rand(50000,100000),2)}}
                                                                </td>
                                                                <td nowrap>
                                                                    {{number_format(rand(50,100),0)}}
                                                                </td>
                                                                <td nowrap>
                                                                    <small>Ksh</small> {{number_format(rand(5000,10000),2)}}
                                                                </td>
                                                                <td nowrap>
                                                                    <small>Ksh</small> {{number_format(rand(5000,10000),2)}}
                                                                </td>
                                                                <td nowrap>
                                                                    @if ($t %2 == 0)
                                                                    Weekly
                                                                    @else
                                                                    Monthly
                                                                    @endif
                                                                </td>
                                                                <td nowrap>
                                                                    {{number_format(rand(10,90),0)}}
                                                                </td>
                                                                <td nowrap>
                                                                    {{Carbon\Carbon::today()->format('d-m-Y - H:i:s A')}}
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>      
                        </div>
                    @endfor
                </div>
            </div>

        </div>
    </div>

        
        
    </div>
@endsection

@push('scripts')
<script>
    $('.filter').change(function() {
        filter_function();
        //calling filter function each select box value change
    });
    $('table tbody tr').show(); //intially all rows will be shown
        function filter_function() {
            $('table tbody tr').hide(); //hide all rows
            var companyFlag = 0;
            var companyValue = $('#filter-company').val();
            var contactFlag = 0;
            var contactValue = $('#filter-contact').val();
            var rangeFlag = 0;
            var rangeValue = $('#filter-range').val();
            var rangeminValue = $('#filter-range').find(':selected').attr('data-min');
            var rangemaxValue = $('#filter-range').find(':selected').attr('data-max');
            //setting intial values and flags needed
            //traversing each row one by one
            $('table tr').each(function() {  
                if(companyValue == 0) {   //if no value then display row
                    companyFlag = 1;
                }
                else if(companyValue == $(this).find('td.company').data('company')) { 
                    companyFlag = 1;       //if value is same display row
                }
                else {
                    companyFlag = 0;
                }
                if(contactValue == 0){
                    contactFlag = 1;
                }
                else if(contactValue == $(this).find('td.contact').data('contact')){
                    contactFlag = 1;
                }
                else{
                    contactFlag = 0;
                }
                if(rangeValue == 0){
                    rangeFlag = 1;
                }
                //condition to display rows for a range
                else if((rangeminValue <= $(this).find('td.range').data('min') && rangemaxValue >  $(this).find('td.range').data('min')) ||  (
                    rangeminValue < $(this).find('td.range').data('max') &&
                    rangemaxValue >= $(this).find('td.range').data('max'))){
                    rangeFlag = 1;
                }
                else{
                    rangeFlag = 0;
                }
                console.log(rangeminValue +' '+rangemaxValue);
                console.log($(this).find('td.range').data('min') +' '+$(this).find('td.range').data('max'));
                if(companyFlag && contactFlag && rangeFlag){
                    $(this).show();  //displaying row which satisfies all conditions
                }
            }
        );
    }
</script>
@endpush
