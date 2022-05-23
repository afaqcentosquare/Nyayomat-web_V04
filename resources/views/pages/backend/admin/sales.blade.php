@extends('layouts.backend.main', 
                        [
                            'title' => __("Sales Overview"),
                            'page_name' => 'Sales Overview',
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>
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
                Sales Overview
            </a>  
        </div>
    </div>
    
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="">
        {{-- Cards --}}
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
                        {{-- Units --}}
                        <tr>
                            <th nowrap class="">
                                Units
                            </th>
                            <td nowrap>
                                <span class="d-none">
                                    {{$units = rand(10000,99999)}}
                                </span>
                                {{number_format($units,0)}}
                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- Value --}}
                        <tr>
                            <th nowrap class="">
                                Value (Ksh)
                            </th>
                            <td nowrap>
                                <span class="d-none">
                                    {{$value = rand(1000000,9999999)}}
                                </span>
                                {{number_format($value,2)}}
                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- Avg Cost --}}
                        <tr>
                            <th nowrap class="">
                                Avg Cost (Ksh)
                            </th>
                            <td nowrap>
                                <span class="d-none">
                                    {{$avg = $value / $units}}
                                </span>
                                {{number_format($avg,2)}}
                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        <tr class="border-0">
                            <th nowrap colspan="13" class="text-center bg-success text-white text-uppercase">
                                Top Performing
                            </th>
                        </tr>
                        {{-- Top Merchant --}}
                        <tr>
                            <th nowrap class="bg-success border-0 text-white">
                                Merchant
                            </th>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- Top location --}}
                        <tr>
                            <th nowrap class="bg-success border-0 text-white">
                                Location
                            </th>
                            <td nowrap>
                                <span class="font-weight-bold">
                                    Location
                                </span>
                                ,
                                <small class="text-muted">
                                    Sub County
                                </small>
                                ,
                                <small class="text-muted">
                                    County
                                </small>
                                <br class="mb-0">
                                <span class="font-weight-bold">
                                    Sub County
                                </span>
                                ,
                                <small class="text-muted">
                                    County
                                </small>
                                <br class="mb-0">
                                <span class="font-weight-bold">
                                    County
                                </span>
                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- T Product --}}
                        <tr>
                            <th nowrap class="bg-success border-0 text-white">
                                Product
                            </th>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- T Category --}}
                        <tr>
                            <th nowrap class="bg-success border-0 text-white">
                                Category
                            </th>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- T Group --}}
                        <tr>
                            <th nowrap class="bg-success border-0 text-white">
                                Group
                            </th>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        <tr class="border-0">
                            <th nowrap colspan="13" class="text-center bg-danger border-0 text-white text-uppercase">
                                Low Performing
                            </th>
                        </tr>
                        {{-- L Merchant --}}
                        <tr>
                            <th nowrap class="bg-danger border-0 text-white">
                                Merchant
                            </th>
                            <td nowrap>
                                <span class="font-weight-bold">
                                    Merchant Name
                                </span>
                                <br class="mb-0">
                                <small>
                                    Location , County
                                </small>
                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- L location --}}
                        <tr>
                            <th nowrap class="bg-danger border-0 text-white">
                                Location
                            </th>
                            <td nowrap>
                                <span class="font-weight-bold">
                                    Location
                                </span>
                                ,
                                <small class="text-muted">
                                    Sub County
                                </small>
                                ,
                                <small class="text-muted">
                                    County
                                </small>
                                <br class="mb-0">
                                <span class="font-weight-bold">
                                    Sub County
                                </span>
                                ,
                                <small class="text-muted">
                                    County
                                </small>
                                <br class="mb-0">
                                <span class="font-weight-bold">
                                    County
                                </span>
                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- L Product --}}
                        <tr>
                            <th nowrap class="bg-danger border-0 text-white">
                                Product
                            </th>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- L Category --}}
                        <tr>
                            <th nowrap class="bg-danger border-0 text-white">
                                Category
                            </th>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- L Group --}}
                        <tr>
                            <th nowrap class="bg-danger border-0 text-white">
                                Group
                            </th>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                        {{-- L MRP --}}
                        <tr>
                            <th nowrap class="bg-danger border-0 text-white">
                                Most Returned Product
                            </th>
                            <td nowrap>
                                <span class="font-weight-bold">
                                    Product Name
                                </span>
                                <br>
                                <small>
                                    Vendor
                                </small>
                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>

                            </td>
                            <td nowrap>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var completed_sales = [...Array(10)].map(() => Math.floor(Math.random() * 750));       
        var failed_sales = [...Array(10)].map(() => Math.floor(Math.random() * 450));
        var returned_sales = [...Array(10)].map(() => Math.floor(Math.random() * 150));
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
                            "Oct"],
                datasets: [{
                    label: 'Completed Sales', // Name the series
                    data: completed_sales, // Specify the data values array
                    fill: false,
                    borderColor: '#2196f3', // Add custom color border (Line)
                    backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                    borderWidth: 3 ,// Specify bar border width
                    tension: 0.2
                },
                {
                    label: 'Failed Sales', // Name the series
                    data: failed_sales, // Specify the data values array
                    fill: false,
                    borderColor: '#4CAF50', // Add custom color border (Line)
                    backgroundColor: '#4CAF50', // Add custom color background (Points and Fill)
                    borderWidth: 3 ,// Specify bar border width
                    tension: 0.2
                },
                {
                    label: 'Returned Sales', // Name the series
                    data: returned_sales, // Specify the data values array
                    fill: false,
                    borderColor: '#ffff00', // Add custom color border (Line)
                    backgroundColor: '#ffff00', // Add custom color background (Points and Fill)
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