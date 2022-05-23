@extends('layouts.backend.main', 
                        [
                            'title' => __("Statistics"),
                            'page_name' => 'Statistics',
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
            .card-columns-2 {
                -webkit-column-count: 2;
                -moz-column-count: 2;
                column-count:2;
                -webkit-column-gap: 1.25rem;
                -moz-column-gap: 1.25rem;
                column-gap: 1.25rem;
                orphans: 1;
                widows: 1;
            }
            .nyayomat-blue{
                color: rgb(3, 108, 177)
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }
            
            /* // Small devices (landscape phones, 576px and up) */
            @media (min-width: 350px) {
            
            }

            /* // Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {  }

            /* // Large devices (desktops, 992px and up) */
            @media (min-width: 992px) { }

            /* // Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) { 
                
            }
        </style>
    @endverbatim
@endpush

@push('link-js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <link href="{{asset('js/filler.js')}}" rel="stylesheet">
@endpush

@push('navs')
    <a href="{{route('merchant-overview')}}" class="nav_link"> 
        <i class='bx bx-grid-alt nav_icon'></i> 
        <span class="nav_name">
            Dashboard
        </span>
    </a>

    <a href="{{route('merchant-product')}}" class="nav_link">
        <i class='bx bx-package nav_icon'></i>
        <span class="nav_name">
            Products
        </span>
    </a>

    <a href="{{route('merchant-stats')}}" class="nav_link active"> 
        <i class='bx bx-doughnut-chart nav_icon'></i>   
        <span class="nav_name">
            Statistics 
            
        </span> 
    </a> 

    <a href="{{route('merchant-disputes')}}" class="nav_link"> 
        <i class='bx bx-alarm-exclamation nav_icon'></i> 
        <span class="nav_name">
            Disputes
        </span>
    </a>

    <a href="{{route('merchant-stock')}}" class="nav_link"> 
        <i class='bx bx-coin-stack nav_icon'></i> 
        <span class="nav_name">
            Stock
        </span>
    </a>

    <a href="{{route('merchant-transactions')}}" class="nav_link">
        <i class='bx bx-money nav_icon'></i>
        <span class="nav_name">
            Transactions    
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
                Statistics
            </a>  
        </div>
    </div>
    <div class="row">
        {{-- Variables --}}
            <span class="d-none">
                {{$r = rand(0,100)}}
                {{$s = rand(0,100)}}
                {{$jan = rand(5000,40000)}}
                {{$feb = rand(35000,40000)}}
                {{$mar = rand(5000,40000)}}
                {{$apr = rand(5000,40000)}}
                {{$may = rand(5000,40000)}}
                {{$jun = rand(5000,40000)}}
                {{$jul = rand(5000,40000)}}
                
                {{$t = ($r/($r + $s))*5}}
            </span>
        {{-- End Vars  --}}
        <div class="col-12 ">
            <span class="display-2">{{number_format($t,1)}}</span> <small class="font-weight-bold">RATING</small> 
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 p-0">
            <canvas id="avgChart" height="100" class=""></canvas>
        </div>
        <p class="col-12 mt-3">
            Best Month : <b class="ml-1">February</b> <span class="ml-3 mr-2"> Units Sold</span> {{number_format($feb,0)}}
            <br>
            Worst Month : <b class="ml-1"> Jun </b> <span class="ml-3 mr-2"> Units Sold</span> {{number_format($jun,0)}}
        </p>
    </div>
    <div class="row mb-4">    
        <div class="col-md-4 mb-3 d-flex align-items-stretch">
            <div class="card shadow-sm col-12 border-0 p-0">
                <div class="card-header border-0">
                    <h5 class="text-uppercase nyayomat-blue">
                        <i class="bx bx-money mr-2"></i> Cash Balance
                    </h5>
                </div>
                <div class="card-body">
                    {{--Card Variables Start --}}
                        <span class="d-none">
                            {{$inflo = rand(100000,500000)}}
                        </span>
                        <span class="d-none">
                            {{$outflo = rand(100000,500000)}}
                        </span>
                        <span class="d-none">
                            {{$this_wk = rand(10000,50000)}}
                        </span>
                        <span class="d-none">
                            {{$outstandin = rand(10000,50000)}}
                        </span>
                        <span class="d-none">
                            {{$pendin = rand(10000,50000)}}
                        </span>
                        <span class="d-none">
                            {{$defaulted = rand(10000,50000)}}
                        </span>
                    {{--Card Variables End --}}
                    <div class="row">
                        <p class="col-12">
                            <span class="font-weight-bold">Cash Balance = </span> <span class="d-none">{{$cash_balance = $inflo - $outflo}}</span> 
                            @if ($inflo > $outflo)
                                <span class="text-success ml-1 font-weight-bold">
                            @else
                                <span class="text-daner ml-1 font-weight-bold">
                            @endif
                                {{number_format($cash_balance,2)}}
                            </span>
                        </p>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            Total In-flow    :
                            <span class="text-success">
                                <span class="ml-1 font-weight-bold">
                                    <small class="ml-2">Ksh</small>
                                    {{number_format($inflo,2)}}
                                </span>
                            </span>
                        </li>

                        <li class="mb-2">
                            Total Out-flow    :
                            <span class="text-warning">
                                <span class="ml-1 font-weight-bold">
                                    <small class="ml-2">Ksh</small>
                                    {{number_format($outflo,2)}}
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- Financies --}}
        <div class="col-md-4 mb-3 d-flex align-items-stretch">
            <div class="card shadow-sm col-12 border-0 p-0">
                <div class="card-header border-0">
                    <h5 class="text-uppercase nyayomat-blue">
                        <i class="bx bx-money mr-2"></i> Payments
                    </h5>
                </div>
                <div class="card-body">
                    {{--Card Variables Start --}}
                        <span class="d-none">
                            {{$inflo = rand(100000,500000)}}
                        </span>
                        <span class="d-none">
                            {{$outflo = rand(100000,500000)}}
                        </span>
                        <span class="d-none">
                            {{$this_wk = rand(10000,50000)}}
                        </span>
                        <span class="d-none">
                            {{$outstandin = rand(10000,50000)}}
                        </span>
                        <span class="d-none">
                            {{$pendin = rand(10000,50000)}}
                        </span>
                        <span class="d-none">
                            {{$defaulted = rand(10000,50000)}}
                        </span>
                    {{--Card Variables End --}}
                    
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            Due This Week  :
                            <span class="">
                                <span class="ml-1 font-weight-bold">
                                    <small class="ml-2">Ksh</small>
                                    {{number_format($this_wk,2)}} 
                                </span>
                                ( {{rand(3,10)}} Products )
                            </span>
                        </li>

                        <li class="mb-2">
                            Total Outstaning  :
                            <span class="">
                                <span class="ml-1 font-weight-bold">
                                    <small class="ml-2">Ksh</small>
                                    {{number_format($outstandin,2)}}
                                </span>
                            </span>
                        </li>

                        <li class="mb-2">
                            Total Pending    :
                            <span class="">
                                <span class="ml-1 text-warning font-weight-bold">
                                    <small class="ml-2">Ksh</small>
                                    {{number_format($pendin,2)}}
                                </span>
                            </span>
                        </li>

                        <li class="mb-2">
                            Total Defaulted :
                            <span class="">
                                <span class="ml-1 text-danger font-weight-bold">
                                    <small class="ml-2">Ksh</small>
                                    {{number_format($defaulted,2)}}
                                </span>
                            </span>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        {{-- Average --}}
        <div class="col-md-4 mb-3 d-flex align-items-stretch">
            <div class="card shadow-sm col-12 border-0 p-0">
                <div class="card-header border-0">
                    <h5 class="text-uppercase nyayomat-blue">
                        <i class="bx bx-calculator mr-2"></i> Averages
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            Best Product :
                            <span class="ml-2 font-weight-bold">
                                Product.{{Str::title(Str::random(10))}}
                            </span>
                        </li>
                        <li class="mb-2">
                            Best Day :
                            <span class="ml-2 font-weight-bold">
                                Monday
                            </span>
                        </li>
                        
                        <li class="mb-2">
                            Units Sold     :
                            <span class="">
                                <span class="d-none">
                                    {{$unts = rand(10000,50000)}}
                                </span>
                                <span class="ml-2 font-weight-bold">
                                    {{number_format($unts,0)}}
                                </span>
                            </span>
                        </li>
                        
                        <li class="mb-2">
                            Conversion Rate :
                            <span class="ml-2 font-weight-bold">
                                {{rand(80,98)}} %
                            </span>
                        </li>

                        <li class="mb-2">
                            Sale Cost :
                            <span class="">
                                <span class="d-none">
                                    {{$sale = rand(1000,5000)}}
                                </span>
                                <span class="ml-2 font-weight-bold">
                                    <small class="mr-1">
                                        Ksh
                                    </small>
                                    {{number_format($sale,2)}}
                                </span>
                            </span>
                        </li>

                        <li class="mb-2">
                            Dropped Carts :
                            <span class="">
                                <span class="d-none">
                                    {{$sale = rand(50,70)}}
                                </span>
                                <span class="ml-2 font-weight-bold">
                                    {{number_format($sale,0)}}
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@push('scripts')
    <script>
        // barchart
        var barchart = document.getElementById('avgChart').getContext('2d');
        var salesChart = new Chart(barchart, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June','July'],
                datasets: [{
                    label: 'Sales Performance',
                    data: [{!! json_encode($jan) !!}, {!! json_encode($feb) !!}, {!! json_encode($mar) !!}, {!! json_encode($apr) !!}, {!! json_encode($may) !!}, {!! json_encode($jun) !!}, {!! json_encode($jul) !!}],
                    tension: 0.1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(187, 92, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(187,92, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                },]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                
            }
        });

        var doughnutchart = document.getElementById('salesChart').getContext('2d');
        // doughnutchart.height = 300;
        var salesChart = new Chart(doughnutchart, {
            type: 'doughnut',
            data: {
                labels: ['','Your Rating'],
                datasets: [{
                    label: 'Your Score',
                    data: [
                            {!! json_encode($s) !!}
                            ,{!! json_encode($r) !!}  ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.0)',
                        'rgba(  3, 108, 177, 0.8)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 0)',
                        'rgba(3, 108, 177)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        visibility: 'hidden'
                    }
                }
            }
        });

    </script>
@endpush
