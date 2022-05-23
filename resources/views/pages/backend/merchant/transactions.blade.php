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

    <a href="{{route('merchant-stocks')}}" class="nav_link"> 
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
  
    <a href="{{route('merchant-disputs')}}" class="nav_link"> 
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
                {{Illuminate\Support\Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-primary ml-1">
                Transactions
            </a>  
        </div>
    </div>
    {{-- Table --}}
    {{-- <ul class="nav nav-pills nav-list mb-3" id="pills-tab" role="tablist">
        <li class="nav-item mr-2" role="presentation">
            <a class="nav-link active" id="pills-shop-tab" data-toggle="pill" href="#pills-shop" role="tab" aria-controls="pills-shop" aria-selected="true">
                Shop
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-acp-tab" data-toggle="pill" href="#pills-acp" role="tab" aria-controls="pills-acp" aria-selected="false">
                Asset Manager
            </a>
        </li>
    </ul> --}}
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-shop" role="tabpanel" aria-labelledby="pills-shop-tab" style="">
            <h3 class="col-12 display-5 text-muted">
                My Shop
            </h3>
            <div class="col-12 mb-3 text-right">
                <a href="" class="btn btn-md btn-success">
                    CSV Import
                </a>
            </div>
            <div class="col-12 mb-3">
                <span class="nyayomat-blue">
                    <i class="bx bx-download mr-2"></i> Download All in
                </span>
                <a href="" class="btn btn-sm bg-nyayomat-blue text-white shadow-sm mx-2">
                    csv <i class="ml-2 bx bx-file-blank"></i>
                </a>
                <a href="" class="btn btn-sm bg-nyayomat-blue text-white shadow-sm mr-2">
                    Excel <i class="ml-2 bx bx-spreadsheet"></i>
                </a>
                <a href="" class="btn btn-sm bg-nyayomat-blue text-white shadow-sm mr-2">
                    Pdf <i class="ml-2 bx bxs-file-pdf"></i>
                </a>
                <a href="" class="btn btn-sm bg-nyayomat-blue text-white shadow-sm mr-2">
                    Print <i class="ml-2 bx bx-printer"></i>
                </a>
            </div>
            <div class="col-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 shadow py-3">
                            <div class="row">
                               <div class="col-12 mb-2">
                                    <span class="small-text nyayomat-blue font-weight-light mr-3">
                                        Totals
                                    </span> 
                                    
                                    <span class="text-muted mr-3">
                                        <span class="d-none">
                                            {{$total_trans = 0}}
                                        </span>
                                        <sub>Ksh.</sub> 
                                        {{number_format($total_trans,2)}}  <i class="bx bx-minus"></i>
                                    </span>

                                    <span class="text-success mx-2 small-text">
                                        <span class="d-none">
                                            {{$in_flow = $total_trans / 2 }}
                                        </span>
                                        <sub>Ksh.</sub> {{number_format($in_flow,2)}}  <i class="bx bxs-up-arrow"></i>
                                    </span>
                                    
                                    <span class="text-danger mx-2 small-text">
                                        <sub>Ksh.</sub>
                                        {{number_format($out_flow = $total_trans - $in_flow,2)}}  <i class="bx bxs-up-arrow"></i>
                                    </span>

                                    <span class="text-primary font-weight-light mx-2 small-text">
                                        Transactions: <span class="d-none">{{$trans = 0}}</span> {{0}}
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                {{__('Order ID')}}
                                            </th>
                                            <th>
                                                {{__('Prodcut')}}
                                            </th>
                                            <th>
                                                {{__('Qty')}}
                                            </th>
                                            <th>
                                                {{__('Timestamp')}}
                                            </th>
                                            <th>
                                                {{__('Transaction Date')}}
                                            </th>
                                            <th>
                                                {{__('Customer Name')}}
                                            </th>
                                            <th>
                                                {{__('Customer Mobile')}}
                                            </th>
                                            <th>
                                                {{__('Amount')}}
                                            </th>
                                            <th>
                                                {{__('Payment Mathod')}}
                                            </th>
                                            <th>
                                                {{__('Status')}}
                                            </th>
                                            <th>
                                                
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach(transactions() as $transaction)
                                            <tr>
                                                <td>
                                                    {{$transaction->order_number}}
                                                </td>
                                                <td>
                                                    @foreach($transaction->inventories as $products)
                                                    {{$products->title}}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{$transaction->quantity}}{{$transaction->quantity}}

                                                </td>
                                                <td>
                                                    {{$transaction->created_at->format('d-m-Y - H:i:s A')}}
                                                </td>
                                                <td>
                                                    {{$transaction->created_at->format('D , M d , Y ')}}
                                                </td>
                                                <td>
                                                    {{$transaction->customer->name}}
                                                </td>
                                                <td>
                                                    0{{$transaction->customer->mobile}}
                                                </td>
                                                <td>
                                                    <span class="mr-2">ksh</span>
                                                  
                                                    {{number_format($transaction->grand_total,2)}}
                                                </td>
                                                <td>
                                                    {{$transaction->paymentmethod->name}}
                                                   
                                                </td>
                                                <td>
                                                    @if ($transaction->payment_status === 1)
                                                    <span class="text-success">
                                                        Confirmed
                                                    </span>
                                                    @else
                                                    <span class="text-danger">
                                                        Un-processed
                                                    </span> 
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    <i class="bx bxs-archive nyayomat-blue"></i>
                                                </td>
                                                
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        {{-- Asset Manager Tab Comment Start --}}
        {{-- <div class="tab-pane fade" id="pills-acp" role="tabpanel" aria-labelledby="pills-acp-tab"> --}}
            {{-- ACP --}}
            {{-- <h3 class="col-12 display-5 pl-4 my-4 text-muted">
                Assets Transactions
            </h3>
            <div class="col-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 shadow py-3">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <span class="small-text nyayomat-blue font-weight-light mr-3">
                                        Totals
                                    </span> 
                                    
                                    <span class="text-muted mr-3">
                                        <span class="d-none">
                                            {{$total_trans = rand(100000,1000000)}}
                                        </span>
                                        <sub>Ksh.</sub> 
                                        {{number_format($total_trans,2)}}  <i class="bx bx-minus"></i>
                                    </span>

                                    <span class="text-success mx-2 small-text">
                                        <span class="d-none">
                                            {{$in_flow = rand(($total_trans / 2 ),$total_trans)}}
                                        </span>
                                        <sub>Ksh.</sub> {{number_format($in_flow,2)}}  <i class="bx bxs-up-arrow"></i>
                                    </span>
                                    
                                    <span class="text-danger mx-2 small-text">
                                        <sub>Ksh.</sub>
                                        {{number_format($out_flow = $total_trans - $in_flow,2)}}  <i class="bx bxs-up-arrow"></i>
                                    </span>

                                    <span class="text-primary font-weight-light mx-2 small-text">
                                        Transactions: <span class="d-none">{{$trans = rand(450,700)}}</span> {{number_format($trans,0)}}
                                    </span>
                                </div>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                {{__('Asset')}}
                                            </th>
                                            <th>
                                                {{__('Transaction ID')}}
                                            </th>
                                            <th colspan="2">
                                                {{__('status')}}
                                            </th>   
                                            <th>
                                                {{__('Amount')}}
                                            </th>
                                            @if (Auth::user()->id == 1)    
                                                <th>
                                                    {{__('Category')}}
                                                </th>
                                            @endif
                                            <th>
                                                {{__('Timestamp')}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($t = 0; $t < rand(80,150) ; $t++)
                                            <tr>
                                                <span class="" style="visibility: hidden">
                                                {{$rand = rand(25,95)}}</span>
                                                <td>
                                                    ASSET.{{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                </td>
                                                <td>
                                                    {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                </td>
                                                <td colspan="2">
                                                    @if ($t %5 != 0)
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width:{{$rand}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$rand}}%</div>
                                                        </div>
                                                    @else
                                                        @if ($t % 2 == 0)
                                                            <div class="progress">
                                                                <div class="progress-bar bg-warning" role="progressbar" style="width:{{$rand}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$rand}}%</div>
                                                            </div>
                                                        @else
                                                            <div class="progress">
                                                                <div class="progress-bar bg-danger" role="progressbar" style="width:{{$rand}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$rand}}%</div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="mr-2">ksh</span>
                                                    <span class="d-none">
                                                        {{$amt = rand(4000,60000)}}
                                                    </span>
                                                    {{number_format($amt,2)}}
                                                </td>
                                                @if (Auth::user()->id == 1)    
                                                    <td>
                                                        @if ($t %5 != 0)
                                                            <span class="text-success">
                                                                Fulfilled
                                                            </span>
                                                        @else
                                                            <span class="text-danger">
                                                                Covered
                                                            </span>
                                                        @endif
                                                    </td>
                                                @endif
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
        </div> --}}
        {{-- Asset Manager Tab Comment End --}}
    </div>
@endsection

@push('scripts')
@endpush
