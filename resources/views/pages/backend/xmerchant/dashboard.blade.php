@extends('layouts.backend.main', 
                        [
                            'title' => __("Dashboard"),
                            'page_name' => 'Dashboard',
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
    <a href="{{route('merchant-overview')}}" class="nav_link active"> 
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
  
    <a href="{{route('merchant-disputes')}}" class="nav_link"> 
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
                Dashboard
            </a>  
        </div>
    </div>
    <ul class="nav nav-pills nav-list mb-3" id="pills-tab" role="tablist">
        <li class="nav-item mr-2" role="presentation">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                Shop
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                Asset Manager
            </a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="">
            <br class="my-md-3">
            {{-- Cards --}}
            <div class="row mb-4">
                <div class="col-md-4 col-lg-3 mb-3 d-flex align-items-stretch">
                    <div class="card col-12 px-0 shadow-sm border-0">
                        <div class="card-body">
                            <div class="">
                                <h5 class="text-primary text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                                    <span class="badge shadow-sm text-white bg-success">
                                        Sales 
                                    </span> 
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-success display-5  d-none d-md-inline-flex">
                                        <span class="d-none">{{$sales = rand(100000,300000)}}</span>
                                        <small class="mr-2">Ksh</small> {{number_format($sales,2)}}
                                    </h3>
                                    {{-- Stubborn-Mobile --}}
                                    <h3 class="d-md-none d-sm-inline-flex mt-3 text-success" style="font-size: 4.4vh">
                                        <span class="d-none">{{$sales = rand(10000,30000)}}</span>
                                        <small>Ksh</small> {{number_format($sales,2)}}
                                    </h3>
                                    <p class="mb-0 mt-3 text-muted font-weight-light">
                                        Sales to date
                                    </p>
                                </div>
                                <div class="align-self-center">
                                    <i class="bx bx-money pt-0 text-success icon-size"></i>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <a href="{{route('merchant-transactions')}}" class="btn btn-sm btn-success" style="letter-spacing: .5px">
                                        view transactions<i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
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
                                        Stock Outs
                                    </span> 
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-warning display-5  d-none d-md-inline-flex">
                                        <span class="d-none">{{$stock_out = rand(15,45)}}</span>
                                        {{number_format($stock_out,0)}}
                                    </h3>
                                    {{-- Stubborn-Mobile --}}
                                    <h3 class="d-md-none d-sm-inline-flex mt-3 text-warning" style="font-size: 4.4vh">
                                        <span class="d-none">{{$stock_out}}</span>
                                        {{number_format($stock_out,0)}}
                                    </h3>
                                    <p class="mb-0 mt-3 text-muted font-weight-light" >
                                        These are almost running out
                                    </p>
                                </div>
                                <div class="align-self-center">
                                    <i class="bx bx-coin-stack text-warning icon-size"></i>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <a href="{{route('jamo-category')}}" class="btn btn-sm btn-warning text-white" style="letter-spacing: .5px">
                                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                    {{-- Stock Outs --}}
                <div class="col-md-4 col-lg-3 mb-3 d-flex align-items-stretch">
                    <div class="card col-12 px-0 shadow-sm border-0">
                        <div class="card-body">
                            <div class="">
                                <h5 class="text-teal-400 text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                                    <span class="badge text-white bg-danger">
                                        Disputes   
                                    </span> 
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="bx bx-alarm-exclamation text-danger icon-size"></i>
                                    <p class="mb-0 mt-4 text-muted font-weight-light">
                                        Unresolved issues 
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-danger display-5 d-none d-md-inline-flex">
                                        <span class="d-none">{{$disputes = rand(8,10)}}</span>
                                        {{number_format($disputes,0)}}
                                    </h3>
                                    {{-- Stubborn-Mobile --}}
                                    <h3 class="d-md-none d-sm-inline-flex mt-3 text-danger" style="font-size: 4.4vh">
                                        <span class="d-none">{{$disputes}}</span>
                                        {{number_format($disputes,0)}}
                                    </h3>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <a href="{{route('jamo-promotions')}}" class="btn btn-sm btn-danger" style="letter-spacing: .5px">
                                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
                    {{-- Disputes --}}
                <div class="col-md-4 col-lg-3    mb-3 d-flex align-items-stretch">
                    <div class="card col-12 px-0 shadow-sm border-0">
                        <div class="card-body">
                            <div class="">
                                <h5 class="text-warning text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                                    <span class="badge text-white bg-info">
                                        Rating
                                    </span> 
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="bx bx-star  text-info icon-size"></i>
                                    <p class="mb-0 mt-4 text-muted font-weight-light">
                                        Your rating score as of today
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-info display-5 d-none d-md-inline-flex">
                                        <span class="d-none">{{$rating = rand(1,5)}}</span>
                                        {{number_format($rating,0)}}
                                    </h3>
                                    {{-- Stubborn-Mobile --}}
                                    <h3 class="d-md-none d-sm-inline-flex mt-3 text-info" style="font-size: 4.4vh">
                                        <span class="d-none">{{$rating}}</span>
                                        <small class="ml-2">
                                            @if ($rating < 3)
                                                Poor
                                            @elseif ($rating == 3 )
                                                Average
                                            @elseif ($rating > 3 )
                                                Good
                                            @elseif ($rating == 5 )
                                                Excellent
                                            @endif
                                        </small>
                                        {{number_format($rating,0)}}
                                    </h3>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <a href="{{route('jamo-supplier')}}" class="btn btn-sm btn-info" style="letter-spacing: .5px">
                                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    {{-- Rating --}}
            </div> 
            {{-- Top Performing Products --}}
            <div class="row mt-5 mb-3">
                <h3 class="display-5 col-12 text-success">
                    Top Performing Products
                </h3>
                <h6 class="col-12 text-muted ml-1">
                    <small class="mr-2">From</small> 
                    {{$day = rand(1,28)}} - {{$month = rand(1,7)}} - 2021 
                    <small class="mx-3">To</small> 
                    {{Carbon\Carbon::now()->format('d - m - Y')}}
                </h6>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th class="font-weight-normal" data-card-title>
                                    #
                                </th>
                                <th class="font-weight-normal" data-card-title>
                                    Img
                                </th>
                                <th class="font-weight-normal" data-card-title>
                                    Name
                                </th>
                                <th class="font-weight-normal" data-card-action>
                                    <span class="mr-2">Cost</span>
                                </th>
                                <th class="font-weight-normal" data-card-action>
                                    <span class="mr-2">Qty</span>
                                </th>
                                <th class="font-weight-normal" data-card-action>
                                    <span class="mr-2">Value</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 4 ; $i++)
                                <tr class="accordion" id="accordionExample2">
                                    <td>
                                        {{$i + 1}}
                                    </td>
                                    <td>
                                        <i class="bx bx-landscape"></i>
                                    </td>
                                    <td nowrap>
                                        {{$promo_title = Str::upper(Str::random(10))}}
                                    </td>
        
                                    <td nowrap>
                                        <span class="d-none">
                                            {{$cost = rand(20,100)}}
                                        </span>
                                        <span class="font-weight-light">
                                            <small class="">Ksh.</small>&nbsp;{{number_format($cost,2)}}
                                        </span>
                                    </td>
        
                                    <td nowrap>
                                        <span class="font-weight-light">
                                            {{$qty = rand(100,300)}}
                                        </span>
                                    </td>
        
                                    <td nowrap>
                                        <span class="d-none">
                                            {{$value = $qty * $cost}}
                                        </span>
                                        <span class="font-weight-light">
                                            <small class="">Ksh.</small>&nbsp;{{number_format($value,2)}}
                                        </span>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Least Performing Products --}}
            <div class="row mt-4 mb-3">
                <h3 class="display-5 col-12 text-danger">
                    Least Performing Products
                </h3>
                <h6 class="col-12 text-muted ml-1">
                    <small class="mr-2">From</small> 
                    {{$day}} - {{$month}} - 2021 
                    <small class="mx-3">To</small> 
                    {{Carbon\Carbon::now()->format('d - m - Y')}}
                </h6>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th class="font-weight-normal" data-card-title>
                                    #
                                </th>
                                <th class="font-weight-normal" data-card-title>
                                    Img
                                </th>
                                <th class="font-weight-normal" data-card-title>
                                    Name
                                </th>
                                <th class="font-weight-normal" data-card-action>
                                    <span class="mr-2">Cost</span>
                                </th>
                                <th class="font-weight-normal" data-card-action>
                                    <span class="mr-2">Qty</span>
                                </th>
                                <th class="font-weight-normal" data-card-action>
                                    <span class="mr-2">Value</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 4 ; $i++)
                                <tr class="accordion" id="accordionExample2">
                                    <td>
                                        {{$i + 1}}
                                    </td>
                                    <td>
                                        <i class="bx bx-landscape"></i>
                                    </td>
                                    <td nowrap>
                                        {{$promo_title = Str::upper(Str::random(10))}}
                                    </td>
        
                                    <td nowrap>
                                        <span class="d-none">
                                            {{$cost = rand(20,100)}}
                                        </span>
                                        <span class="font-weight-light">
                                            <small class="">Ksh.</small>&nbsp;{{number_format($cost,2)}}
                                        </span>
                                    </td>
        
                                    <td nowrap>
                                        <span class="font-weight-light">
                                            {{$qty = rand(10,50)}}
                                        </span>
                                    </td>
        
                                    <td nowrap>
                                        <span class="d-none">
                                            {{$value = $qty * $cost}}
                                        </span>
                                        <span class="font-weight-light">
                                            <small class="">Ksh.</small>&nbsp;{{number_format($value,2)}}
                                        </span>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row mb-4">
                <div class="col-md-3 mb-3 d-flex align-items-stretch">
                    <div class="card col-12 px-0 shadow-sm border-0">
                        <div class="card-body">
                            <div class="">
                                <h5 class="text-primary text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                                    <span class="badge shadow-sm text-white bg-success">
                                        Assets 
                                    </span> 
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-success display-5  d-none d-md-inline-flex">
                                        <span class="d-none">{{$sales = rand(100000,300000)}}</span>
                                        <small class="mr-2">Ksh</small> {{number_format($sales,2)}}
                                    </h3>
                                    {{-- Stubborn-Mobile --}}
                                    <h3 class="d-md-none d-sm-inline-flex mt-3 text-success" style="font-size: 4.4vh">
                                        <span class="d-none">{{$sales = rand(10000,30000)}}</span>
                                        <small>Ksh</small> {{number_format($sales,2)}}
                                    </h3>
                                    <p class="mb-0 mt-3 text-muted font-weight-light">
                                        Sales to date
                                    </p>
                                </div>
                                <div class="align-self-center">
                                    <i class="bx bx-money pt-0 text-success icon-size"></i>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <a href="{{route('merchant-transactions')}}" class="btn btn-sm btn-success" style="letter-spacing: .5px">
                                        view transactions<i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    {{-- Sales  --}}
                <div class="col-md-3 mb-3 d-flex align-items-stretch">
                    <div class="card col-12 px-0 shadow-sm border-0">
                        <div class="card-body">
                            <div class="">
                                <h5 class="text-warning text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                                    <span class="badge text-white bg-warning">
                                        Stock Outs
                                    </span> 
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-warning display-5  d-none d-md-inline-flex">
                                        <span class="d-none">{{$stock_out = rand(15,45)}}</span>
                                        {{number_format($stock_out,0)}}
                                    </h3>
                                    {{-- Stubborn-Mobile --}}
                                    <h3 class="d-md-none d-sm-inline-flex mt-3 text-warning" style="font-size: 4.4vh">
                                        <span class="d-none">{{$stock_out}}</span>
                                        {{number_format($stock_out,0)}}
                                    </h3>
                                    <p class="mb-0 mt-3 text-muted font-weight-light" >
                                        These are almost running out
                                    </p>
                                </div>
                                <div class="align-self-center">
                                    <i class="bx bx-coin-stack text-warning icon-size"></i>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <a href="{{route('jamo-category')}}" class="btn btn-sm btn-warning text-white" style="letter-spacing: .5px">
                                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                    {{-- Stock Outs --}}
                <div class="col-md-3 mb-3 d-flex align-items-stretch">
                    <div class="card col-12 px-0 shadow-sm border-0">
                        <div class="card-body">
                            <div class="">
                                <h5 class="text-teal-400 text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                                    <span class="badge text-white bg-danger">
                                        Disputes   
                                    </span> 
                                </h5>
                            </div>
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="bx bx-alarm-exclamation text-danger icon-size"></i>
                                    <p class="mb-0 mt-4 text-muted font-weight-light">
                                        Unresolved issues 
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-danger display-5 d-none d-md-inline-flex">
                                        <span class="d-none">{{$disputes = rand(8,10)}}</span>
                                        {{number_format($disputes,0)}}
                                    </h3>
                                    {{-- Stubborn-Mobile --}}
                                    <h3 class="d-md-none d-sm-inline-flex mt-3 text-danger" style="font-size: 4.4vh">
                                        <span class="d-none">{{$disputes}}</span>
                                        {{number_format($disputes,0)}}
                                    </h3>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <a href="{{route('jamo-promotions')}}" class="btn btn-sm btn-danger" style="letter-spacing: .5px">
                                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </div>
      
@endsection

@push('scripts')
@endpush
