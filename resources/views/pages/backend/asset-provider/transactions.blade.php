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
        <h3 class="col-12 display-5 pl-4 my-4 text-muted">
            Assets Transactions
        </h3>
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
          
        <span class="d-none">
            {{$trans = rand(45,100)}}
        </span>
        <div class="accordion mt-3" id="accordionExample">
            @for ($iz = 0; $iz < $trans; $iz++)
                <div class="card mb-2 rounded shadow-sm border-0">
                    <div class="card-header border-0 my-0" id="headingOne">
                        <div class="row">
                            <h2 class="col-7 mb-0">
                                <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset = Str::random(10)}}" aria-expanded="false" aria-controls="collapseOne">
                                    AST {{Str::upper(Str::random(10))}}  
                                </a>
                            </h2>
                            <p class="col-5 text-right">
                                {{$transactions = rand(8,20)}} Trans
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

                                    <span class="text-primary font-weight-light mx-2 small-text">
                                        Installments: <span class="d-none">{{$trans = rand(450,700)}}</span> {{number_format($trans,0)}}
                                    </span>
                                    <span class="text-primary font-weight-light mx-2 small-text">
                                        Units: <span class="d-none">{{$trans = rand(45,70)}}</span> {{number_format($trans,0)}}
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
                                                    {{__('Merchant ID   ')}}
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
                                                    <td>
                                                        ASSET.{{Str::upper(Str::random(10))}}
                                                    </td>
                                                    <td>
                                                        MERCH.{{Str::upper(Str::random(10))}}
                                                    </td>
                                                    <td>
                                                       <small>Ksh</small> {{number_format(rand(500,700),2)}}
                                                    </td>
                                                    <td>
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
            @endfor
        </div>
    </div>
@endsection

@push('scripts')
@endpush
