@extends('layouts.acp', 
                        [
                            'title' => __("Payment Manager"),
                            'page_name' => 'Payment Manager',
                            'bs_version' => 'bootstrap@4.6.0',
                            'left_nav_color' => 'lightseagreen',
                            'nav_icon_color' => '#fff',
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
            .nav {
                height: 100%;
                display: flex;
                flex-direction: row;
                justify-content: start;
                overflow: hidden;
            }
            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }

            .bg-danger{
                background-color: #dc3546 !important;             
            }

            .bg-success{
                background-color: #28a746e2 !important;                  
            }
            @media (max-width: 768px) { 
                .chart-height{
                    min-height: 25vh ;
                }
            }
            @media (min-width: 768px) { 
                .chart-height{
                    min-height: 35vh ;
                }
            }
        </style>
    @endverbatim
@endpush

@push('link-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endpush

@push('navs')
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
                Payment Manager
            </a>  
        </div>
    </div>
    
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="">
        {{-- Cards --}}
        <div class="row mb-4">
            <div class="col-12">
                <span class="d-none">
                    {{$half = rand(20,80)}}
                    {{$other_half = 100 - $half}}
                </span>
                <div class="progress ">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$half}}%" aria-valuenow="{{$half}}" aria-valuemin="0" aria-valuemax="100">
                        Covered Payments
                    </div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$other_half}}%" aria-valuenow="{{$other_half}}" aria-valuemin="0" aria-valuemax="100">
                        Fulfilled Payments
                    </div>
                </div>
            </div>
            <div class="col-6 text-center text-danger mt-3">
                <div class="row">
                    <h6 class="col-12" style="font-size: 15px">
                        Covered Payments
                    </h6>
                    <h3 class="col-12">
                        {{number_format(($half * 333.32),2)}}
                    </h3>
                </div>
            </div>
            <div class="col-6 text-center text-success mt-3 ">
                <div class="row">
                    <h6 class="col-12" style="font-size: 15px">
                        Fulfilled  Payments
                    </h6>
                    <h3 class="col-12">
                        {{number_format(($other_half * 333.32),2)}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class=" shadow custom-radius p-2 py-4">
                    <canvas id="myChart" class="chart-height" ></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-3">
            <div class="col-12 table-responsive">
                <table class="table custom-radius">
                    <thead>
                        <tr>
                            <th nowrap>
                                
                            </th>
                            <th nowrap>
                                Jan
                            </th>
                            <th nowrap>
                                Feb 
                            </th>
                            <th nowrap>
                                Mar
                            </th>
                            <th nowrap>
                                Apr
                            </th>
                            <th nowrap>
                                May
                            </th>
                            <th nowrap>
                                Jun
                            </th>
                            <th nowrap>
                                Jul
                            </th>
                            <th nowrap>
                                Aug
                            </th>
                            <th nowrap>
                                Sep
                            </th>
                            <th nowrap>
                                Oct
                            </th>
                            <th nowrap>
                                Nov
                            </th>
                            <th nowrap>
                                Dec
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <tr style="color: #3daf59">
                            <td nowrap>
                                <span>
                                    Fulfilled
                                </span>
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                        </tr>
                        <tr style="color: #dc3546">
                            <td nowrap>
                                <span>
                                    Covered
                                </span>
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                            <td nowrap>
                                {{number_format((rand(100,999)),2)}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row mt-4">  
            <h5 class="col-12 nyayomat-blue">
                Payments
            </h5>
        </div>
        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                    Fulfilled Payments
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    Covered Payments
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row mt-4">
                    <div class="col-12 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th nowrap>
                                        Merchant ID
                                    </th>
                                    <th nowrap >
                                        Transaction ID
                                    </th>
                                    <th nowrap>
                                        Date
                                    </th>
                                    <th nowrap>
                                        Product ID
                                    </th>
                                    <th nowrap>
                                        Amount <small>Ksh</small>
                                    </th>
                                    <th nowrap>
                                        Outstanding Balance
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td nowrap>
                                        <ul class="list-unstyled">
                                            <li class="font-weight-bold">
                                                MCHT.NME.{{Str::upper(Str::random(5))}}
                                            </li>
                                            {{-- <li>
                                                <span class="text-muted border-0">
                                                    <small style="font-size: 10px">
                                                        <i class="bx bxs-circle mr-1"></i> 
                                                        AST.ID
                                                    </small>
                                                </span>
                                            </li> --}}
                                        </ul>
                                    </td>
                                    <td nowrap>
                                        TRANS.ID.{{Str::upper(Str::random(5))}}
                                    </td>
                                    <td nowrap>
                                        {{rand(1,28)}} /
                                        {{rand(1,12)}} / 2021
                                    </td>
                                    <td nowrap>
                                        PROD.ID.{{Str::upper(Str::random(5))}}
                                    </td>
                                    <td nowrap>
                                        <span class="d-none">
                                            {{$sp = (($bp = (rand(1000,9999))*0.18)+$bp )}}
                                        </span>
                                        {{number_format($sp,2)}}
                                    </td>
                                    <td nowrap>
                                        <span class="d-none">
                                            {{$sp = (($bp ?? ''*0.18)+$bp ?? '')}}
                                        </span>
                                        {{number_format($sp,2)}}
                                    </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mt-4">
                    <div class="col-6 nyayomat-blue">
                        Due Today : <small class="ml-3">Ksh</small> <span class="h5">{{number_format((rand(10000,50000)),2)}}</span>
                    </div>
                    <div class="col-6 mb-4 text-right">
                        <a href="" class="btn btn-sm shadow bg-nyayomat-blue text-white">
                            Make Payment
                        </a>
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th nowrap>
                                        Merchant ID
                                    </th>
                                    <th nowrap >
                                        Transaction ID
                                    </th>
                                    <th nowrap>
                                        Date
                                    </th>
                                    <th nowrap>
                                        Assets
                                    </th>
                                    <th nowrap>
                                        Total Defaulted <small>Ksh</small>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td nowrap>
                                        <ul class="list-unstyled">
                                            <li class="font-weight-bold">
                                                MCHT.NME.{{Str::upper(Str::random(5))}}
                                            </li>
                                            {{-- <li>
                                                <span class="text-muted border-0">
                                                    <small style="font-size: 10px">
                                                        <i class="bx bxs-circle mr-1"></i> 
                                                        AST.ID
                                                    </small>
                                                </span>
                                            </li> --}}
                                        </ul>
                                    </td>
                                    <td nowrap>
                                        TRANS.ID.{{Str::upper(Str::random(5))}}
                                    </td>
                                    <td nowrap>
                                        {{rand(1,28)}} /
                                        {{rand(1,12)}} / 2021
                                    </td>
                                    <td nowrap>
                                        {{rand(3,9)}}
                                    </td>
                                    <td nowrap>
                                        <span class="d-none">
                                            {{$sp = (($bp ?? ''*0.18)+$bp ?? '')}}
                                        </span>
                                        {{number_format($sp,2)}}
                                    </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
          

    </div>
@endsection

@push('scripts')
    <script>
        var completed_sales = [...Array(12)].map(() => Math.floor(Math.random() * 750));       
        var failed_sales = [...Array(12)].map(() => Math.floor(Math.random() * 450));
        var returned_sales = [...Array(12)].map(() => Math.floor(Math.random() * 150));
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sept",
                            "Oct",
                            "Nov",
                            "Dec"],
                datasets: [
                {
                    label: 'Fulfilled', // Name the series
                    data: failed_sales, // Specify the data values array
                    fill: false,
                    borderColor: '#3daf59', // Add custom color border (Line)
                    backgroundColor: '#3daf59', // Add custom color background (Points and Fill)
                    borderWidth: 3 ,// Specify bar border width
                    tension: 0.2
                },
                {
                    label: 'Covered', // Name the series
                    data: returned_sales, // Specify the data values array
                    fill: false,
                    borderColor: '#dc3546', // Add custom color border (Line)
                    backgroundColor: '#dc3546', // Add custom color background (Points and Fill)
                    borderWidth: 3 ,// Specify bar border width
                    tension: 0.2
                }]
            },
            options: {
            responsive: true, // Instruct chart js to respond nicely.
            maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
            }
        });
    </script>
    
@endpush