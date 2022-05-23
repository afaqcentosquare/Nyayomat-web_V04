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

@section('content')
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-12 mt-2 mb-3 font-weight-light">
            <i class='bx bx-subdirectory-right mr-2 text-primary' style="font-size: 2.8vh;"></i>
            <a href="" class="text-muted mr-1">
                {{config('app.name')}}
            </a> /
            <a href="" class="text-primary ml-1">
                Transactions
            </a>  
        </div>
    </div>
  
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-merchants" role="tabpanel" aria-labelledby="pills-merchants-tab" style="">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="flex-direction: row;">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true">Today</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="yesterday-tab" data-toggle="tab" href="#yesterday" role="tab" aria-controls="yesterday" aria-selected="false">Yesterday</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="this_week-tab" data-toggle="tab" href="#this_week" role="tab" aria-controls="this_week" aria-selected="false">This Week</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">This Month</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">All</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
                    <div class="row justify-content-center text-black-50 mt-4">
                        <span class="d-none">
                        </span>
                        <h5 class="col-12">
                            Sales value  <small class="ml-3">Ksh</small> 
                            @if ($today_total_amount > 0)
                                <span class="text-success">
                            @else
                                <span class="text-danger">
                            @endif
                                {{number_format($today_total_amount,2)}}
                            </span>
                        </h5>
                        <h6 class="col-12">
                            <span class="mr-md-2">
                                <i class="bx bx-recycle mr-2"></i> Transactions  
                            </span>
                            <span class="nyayomat-blue">
                                {{$today_total_transaction}}
                            </span>
                        </h6>
                    </div>
                    @foreach ($today_merchant_transactions as $key => $today_merchant_transaction)
                    <div class="accordion" id="todayaccordion{{$key}}">
                        <div class="row">
                                <div class="col-12">
                                    <div class="card mb-2 rounded shadow-sm border-0">
                                        <div class="card-header border-0 my-0">
                                            <div class="row">
                                                <h2 class="col-7 mb-0">
                                                    <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-target="#todaycollapse{{$key}}" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="collapseOne">
                                                       {{ $today_merchant_transaction->name}}
                                                    </a>
                                                </h2>
                                                <p class="col-5 text-right nyayomat-blue">
                                                    {{$today_merchant_transaction->transaction_count}} Trans
                                                </p>
                                            </div>
                                        </div>
                                        <div id="todaycollapse{{$key}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#todayaccordion{{$key}}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        @php
                                                        $total_order_amount = 0;
                                                        foreach ($merchant_orders as $today_merchant_order)
                                                            if ($today_merchant_order->user_id ==  $today_merchant_transaction->user_id)
                                                                $total_order_amount = $total_order_amount + $today_merchant_order->amount
                                                          
                                                        @endphp
                                                        
                                                       
                                                       
                                                        <span class="small-text nyayomat-blue font-weight-light mr-3">
                                                            Total 
                                                        </span> 
                                                        
                                                        <span class="text-muted mr-3">
                                                            <sub>Ksh.</sub> 
                                                            {{number_format($total_order_amount,2)}}  <i class="bx bx-minus"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-12 table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        {{__('Order ID')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Transaction Date')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Amount')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Payment Method')}}
                                                                    </th>   
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($merchant_orders as $today_merchant_order)
                                                                @if ($today_merchant_order->user_id ==  $today_merchant_transaction->user_id)
                                                                <tr>
                                                                    <td>{{$today_merchant_order->order_id}}</td>
                                                                    <td>{{$today_merchant_order->created_at}}</td>
                                                                    <td>{{number_format($today_merchant_order->amount,2)}}</td>
                                                                    <td>{{$today_merchant_order->payment_method_name}}</td>
                                                                </tr>
                                                                @endif
                                                               
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                        </div>
                    </div>
                    @endforeach
                    
                   
                    
                   
                </div>
                
                <div class="tab-pane fade show" id="yesterday" role="tabpanel" aria-labelledby="yesterday-tab">
                    <div class="row justify-content-center text-black-50 mt-4">
                        <span class="d-none">
                        </span>
                        <h5 class="col-12">
                            Sales value  <small class="ml-3">Ksh</small> 
                            @if ($yesterday_total_amount > 0)
                                <span class="text-success">
                            @else
                                <span class="text-danger">
                            @endif
                                {{number_format($yesterday_total_amount,2)}}
                            </span>
                        </h5>
                        <h6 class="col-12">
                            <span class="mr-md-2">
                                <i class="bx bx-recycle mr-2"></i> Transactions  
                            </span>
                            <span class="nyayomat-blue">
                                {{$yesterday_total_transaction}}
                            </span>
                        </h6>
                    </div>
                    @foreach ($yesterday_merchant_transactions as $key => $yesterday_merchant_transaction)
                    <div class="accordion" id="yesterdayaccordion{{$key}}">
                        <div class="row">
                                <div class="col-12">
                                    <div class="card mb-2 rounded shadow-sm border-0">
                                        <div class="card-header border-0 my-0">
                                            <div class="row">
                                                <h2 class="col-7 mb-0">
                                                    <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-target="#yesterdaycollapse{{$key}}" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="collapseOne">
                                                       {{ $yesterday_merchant_transaction->name}}
                                                    </a>
                                                </h2>
                                                <p class="col-5 text-right nyayomat-blue">
                                                    {{$yesterday_merchant_transaction->transaction_count}} Trans
                                                </p>
                                            </div>
                                        </div>
                                        <div id="yesterdaycollapse{{$key}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#yesterdayaccordion{{$key}}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        @php
                                                        $total_order_amount = 0;
                                                        foreach ($merchant_orders as $yesterday_merchant_order)
                                                            if ($yesterday_merchant_order->user_id ==  $yesterday_merchant_transaction->user_id)
                                                                $total_order_amount = $total_order_amount + $yesterday_merchant_order->amount
                                                          
                                                        @endphp
                                                        
                                                       
                                                       
                                                        <span class="small-text nyayomat-blue font-weight-light mr-3">
                                                            Total 
                                                        </span> 
                                                        
                                                        <span class="text-muted mr-3">
                                                            <sub>Ksh.</sub> 
                                                            {{number_format($total_order_amount,2)}}  <i class="bx bx-minus"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-12 table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        {{__('Order ID')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Transaction Date')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Amount')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Payment Method')}}
                                                                    </th>   
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($merchant_orders as $yesterday_merchant_order)
                                                                @if ($yesterday_merchant_order->user_id ==  $yesterday_merchant_transaction->user_id)
                                                                <tr>
                                                                    <td>{{$yesterday_merchant_order->order_id}}</td>
                                                                    <td>{{$yesterday_merchant_order->created_at}}</td>
                                                                    <td>{{number_format($yesterday_merchant_order->amount,2)}}</td>
                                                                    <td>{{$yesterday_merchant_order->payment_method_name}}</td>
                                                                </tr>
                                                                @endif
                                                               
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                        </div>
                    </div>
                    @endforeach
                    
                   
                    
                   
                </div>

                <div class="tab-pane fade show" id="this_week" role="tabpanel" aria-labelledby="this_week-tab">
                    <div class="row justify-content-center text-black-50 mt-4">
                        <span class="d-none">
                        </span>
                        <h5 class="col-12">
                            Sales value  <small class="ml-3">Ksh</small> 
                            @if ($this_week_total_amount > 0)
                                <span class="text-success">
                            @else
                                <span class="text-danger">
                            @endif
                                {{number_format($this_week_total_amount,2)}}
                            </span>
                        </h5>
                        <h6 class="col-12">
                            <span class="mr-md-2">
                                <i class="bx bx-recycle mr-2"></i> Transactions  
                            </span>
                            <span class="nyayomat-blue">
                                {{$this_week_total_transaction}}
                            </span>
                        </h6>
                    </div>
                    @foreach ($this_week_merchant_transactions as $key => $this_week_merchant_transaction)
                    <div class="accordion" id="this_weekaccordion{{$key}}">
                        <div class="row">
                                <div class="col-12">
                                    <div class="card mb-2 rounded shadow-sm border-0">
                                        <div class="card-header border-0 my-0">
                                            <div class="row">
                                                <h2 class="col-7 mb-0">
                                                    <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-target="#this_weekcollapse{{$key}}" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="collapseOne">
                                                       {{ $this_week_merchant_transaction->name}}
                                                    </a>
                                                </h2>
                                                <p class="col-5 text-right nyayomat-blue">
                                                    {{$this_week_merchant_transaction->transaction_count}} Trans
                                                </p>
                                            </div>
                                        </div>
                                        <div id="this_weekcollapse{{$key}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#this_weekaccordion{{$key}}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        @php
                                                        $total_order_amount = 0;
                                                        foreach ($merchant_orders as $this_week_merchant_order)
                                                            if ($this_week_merchant_order->user_id ==  $this_week_merchant_transaction->user_id)
                                                                $total_order_amount = $total_order_amount + $this_week_merchant_order->amount
                                                          
                                                        @endphp
                                                        
                                                       
                                                       
                                                        <span class="small-text nyayomat-blue font-weight-light mr-3">
                                                            Total 
                                                        </span> 
                                                        
                                                        <span class="text-muted mr-3">
                                                            <sub>Ksh.</sub> 
                                                            {{number_format($total_order_amount,2)}}  <i class="bx bx-minus"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-12 table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        {{__('Order ID')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Transaction Date')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Amount')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Payment Method')}}
                                                                    </th>   
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($merchant_orders as $this_week_merchant_order)
                                                                @if ($this_week_merchant_order->user_id ==  $this_week_merchant_transaction->user_id)
                                                                <tr>
                                                                    <td>{{$this_week_merchant_order->order_id}}</td>
                                                                    <td>{{$this_week_merchant_order->created_at}}</td>
                                                                    <td>{{number_format($this_week_merchant_order->amount,2)}}</td>
                                                                    <td>{{$this_week_merchant_order->payment_method_name}}</td>
                                                                </tr>
                                                                @endif
                                                               
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                        </div>
                    </div>
                    @endforeach
                    
                   
                    
                   
                </div>

                <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month-tab">
                    <div class="row justify-content-center text-black-50 mt-4">
                        <span class="d-none">
                        </span>
                        <h5 class="col-12">
                            Sales value  <small class="ml-3">Ksh</small> 
                            @if ($month_total_amount > 0)
                                <span class="text-success">
                            @else
                                <span class="text-danger">
                            @endif
                                {{number_format($month_total_amount,2)}}
                            </span>
                        </h5>
                        <h6 class="col-12">
                            <span class="mr-md-2">
                                <i class="bx bx-recycle mr-2"></i> Transactions  
                            </span>
                            <span class="nyayomat-blue">
                                {{$month_total_transaction}}
                            </span>
                        </h6>
                    </div>
                    @foreach ($month_merchant_transactions as $key => $month_merchant_transaction)
                    <div class="accordion" id="monthaccordion{{$key}}">
                        <div class="row">
                                <div class="col-12">
                                    <div class="card mb-2 rounded shadow-sm border-0">
                                        <div class="card-header border-0 my-0">
                                            <div class="row">
                                                <h2 class="col-7 mb-0">
                                                    <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-target="#monthcollapse{{$key}}" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="collapseOne">
                                                       {{ $month_merchant_transaction->name}}
                                                    </a>
                                                </h2>
                                                <p class="col-5 text-right nyayomat-blue">
                                                    {{$month_merchant_transaction->transaction_count}} Trans
                                                </p>
                                            </div>
                                        </div>
                                        <div id="monthcollapse{{$key}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#monthaccordion{{$key}}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        @php
                                                        $total_order_amount = 0;
                                                        foreach ($merchant_orders as $month_merchant_order)
                                                            if ($month_merchant_order->user_id ==  $month_merchant_transaction->user_id)
                                                                $total_order_amount = $total_order_amount + $month_merchant_order->amount
                                                          
                                                        @endphp
                                                        
                                                       
                                                       
                                                        <span class="small-text nyayomat-blue font-weight-light mr-3">
                                                            Total 
                                                        </span> 
                                                        
                                                        <span class="text-muted mr-3">
                                                            <sub>Ksh.</sub> 
                                                            {{number_format($total_order_amount,2)}}  <i class="bx bx-minus"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-12 table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        {{__('Order ID')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Transaction Date')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Amount')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Payment Method')}}
                                                                    </th>   
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($merchant_orders as $month_merchant_order)
                                                                @if ($month_merchant_order->user_id ==  $month_merchant_transaction->user_id)
                                                                <tr>
                                                                    <td>{{$month_merchant_order->order_id}}</td>
                                                                    <td>{{$month_merchant_order->created_at}}</td>
                                                                    <td>{{number_format($month_merchant_order->amount,2)}}</td>
                                                                    <td>{{$month_merchant_order->payment_method_name}}</td>
                                                                </tr>
                                                                @endif
                                                               
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                        </div>
                    </div>
                    @endforeach
                    
                   
                    
                   
                </div>

                <div class="tab-pane fade show" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row justify-content-center text-black-50 mt-4">
                        <span class="d-none">
                        </span>
                        <h5 class="col-12">
                            Sales value  <small class="ml-3">Ksh</small> 
                            @if ($all_total_amount > 0)
                                <span class="text-success">
                            @else
                                <span class="text-danger">
                            @endif
                                {{number_format($all_total_amount,2)}}
                            </span>
                        </h5>
                        <h6 class="col-12">
                            <span class="mr-md-2">
                                <i class="bx bx-recycle mr-2"></i> Transactions  
                            </span>
                            <span class="nyayomat-blue">
                                {{$all_total_transaction}}
                            </span>
                        </h6>
                    </div>
                    @foreach ($all_merchant_transactions as $key => $all_merchant_transaction)
                    <div class="accordion" id="allaccordion{{$key}}">
                        <div class="row">
                                <div class="col-12">
                                    <div class="card mb-2 rounded shadow-sm border-0">
                                        <div class="card-header border-0 my-0">
                                            <div class="row">
                                                <h2 class="col-7 mb-0">
                                                    <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-target="#allcollapse{{$key}}" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="collapseOne">
                                                       {{ $all_merchant_transaction->name}}
                                                    </a>
                                                </h2>
                                                <p class="col-5 text-right nyayomat-blue">
                                                    {{$all_merchant_transaction->transaction_count}} Trans
                                                </p>
                                            </div>
                                        </div>
                                        <div id="allcollapse{{$key}}" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#allaccordion{{$key}}">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        @php
                                                        $total_order_amount = 0;
                                                        foreach ($merchant_orders as $all_merchant_order)
                                                            if ($all_merchant_order->user_id ==  $all_merchant_transaction->user_id)
                                                                $total_order_amount = $total_order_amount + $all_merchant_order->amount
                                                          
                                                        @endphp
                                                        
                                                       
                                                       
                                                        <span class="small-text nyayomat-blue font-weight-light mr-3">
                                                            Total 
                                                        </span> 
                                                        
                                                        <span class="text-muted mr-3">
                                                            <sub>Ksh.</sub> 
                                                            {{number_format($total_order_amount,2)}}  <i class="bx bx-minus"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-12 table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        {{__('Order ID')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Transaction Date')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Amount')}}
                                                                    </th>   
                                                                    <th>
                                                                        {{__('Payment Method')}}
                                                                    </th>   
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($merchant_orders as $all_merchant_order)
                                                                @if ($all_merchant_order->user_id ==  $all_merchant_transaction->user_id)
                                                                <tr>
                                                                    <td>{{$all_merchant_order->order_id}}</td>
                                                                    <td>{{$all_merchant_order->created_at}}</td>
                                                                    <td>{{number_format($all_merchant_order->amount,2)}}</td>
                                                                    <td>{{$all_merchant_order->payment_method_name}}</td>
                                                                </tr>
                                                                @endif
                                                               
                                                                @endforeach
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                        </div>
                    </div>
                    @endforeach
                    
                   
                    
                   
                </div>
            </div>
        </div>
        {{-- <div class="tab-pane fade" id="pills-asset_providers" role="tabpanel" aria-labelledby="pills-asset_providers-tab">
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
                                            <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="collapseOne">
                                                PROVIDER.{{Str::upper(Str::random(10))}}  
                                            </a>
                                        </h2>
                                        <p class="col-5 text-right nyayomat-blue">
                                            {{$transactions = rand(100,200)}} Trans
                                        </p>
                                    </div>
                                </div>
                                <div id="asset" class="collapse border-0 text-black-50" aria-labelledby="headingOne" data-parent="#accordionExample">
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

        </div> --}}
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