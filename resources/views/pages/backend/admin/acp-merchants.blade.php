@extends('layouts.acp', 
                        [
                            'title' => __("Merchants"),
                            'page_name' => 'Merchants',
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
            .collapse{
                width: 100%;
            }

            .acp-text{
                color: lightseagreen;
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
            <a href="" class="text-muted ml-1">
                Dashboard
            </a>  /
            <a href="" class="text-primary ml-1">
                Merchants
            </a>  
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class=" shadow custom-radius p-2 py-4">
                <canvas id="myChart" class="chart-height" ></canvas>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 mb-3">
            <b class="mr-2">Rating Index :</b> 
            <span class="text-success mr-3">
                <i class="bx bxs-circle"></i>  Low Risk  <small> > 3.8 </small>
            </span>
            <span class="text-warning mr-3">
                <i class="bx bxs-circle"></i>  Medium Risk <small> < 3.8 </small>
            </span>
            <span class="text-danger">
                <i class="bx bxs-circle"></i>  High Risk  <small> < 2.0 </small>
            </span>
        </div>
        <div class="col-12 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th nowrap>
                            Name
                        </th>
                        <th nowrap>
                            Contact
                        </th>
                        <th nowrap>
                            Assets
                        </th>
                        <th nowrap>
                            County 
                        </th>
                        <th nowrap>
                            Sub County
                        </th>
                        <th nowrap>
                            Location
                        </th>
                        <th nowrap>
                            Rating
                        </th>
                        <th nowrap>
                            Joined
                        </th>
                        <th nowrap>
                            Last Modified
                        </th>
                        <th nowrap>
                            
                        </th>
                    </tr>
                </thead>
                <tbody class="accordion" id="groupDescription">
                    @for ($i = 0; $i < 10; $i++)
                        <tr>
                            <td nowrap>
                                <ul class="list-unstyled">
                                    <li class="font-weight-bold">
                                        AST.PRV.NME.{{Str::upper(Str::random(5))}}
                                    </li>
                                    <li>
                                        @if ($i %5 != 0)
                                            <span class="text-success border-0">
                                                <small style="font-size: 10px">
                                                    <i class="bx bxs-circle mr-1"></i> 
                                                    Active
                                                </small>
                                            </span>
                                        @else     
                                            <span class="text-muted border-0">
                                                <small style="font-size: 10px">
                                                    <i class="bx bxs-circle mr-1"></i> 
                                                    Inactive
                                                </small>
                                            </span>
                                        @endif
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <a href="tel:" target="_blank" class="mr-2">
                                    <i class="bx bx-phone"></i>
                                </a>
                                <a href="mailto:" target="_blank" class="mr-2">
                                    <i class="bx bx-mail-send"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('sub-group')}}" class="nyayomat-blue font-weight-bolder">
                                    {{$sg = rand(10,20)}}
                                </a>
                            </td>
                            <td>
                                <a href="{{route('category')}}" class="nyayomat-blue font-weight-bolder">
                                    {{Str::random(5)}}
                                </a>
                            </td>
                            <td>
                                <a href="{{route('specific-product')}}" class="nyayomat-blue font-weight-bolder">
                                    {{Str::random(5)}}
                                </a>
                            </td>
                            <td>
                                <a href="{{route('specific-product')}}" class="nyayomat-blue font-weight-bolder">
                                    {{Str::random(5)}}
                                </a>
                            </td>
                            <td nowrap class="">
                                <span class="d-none">
                                    {{$rating = (rand(3,15)/3)}}
                                </span>
                                @if ($rating <= 2.5)
                                    <span class="text-danger">
                                @elseif($rating <= 3.8)
                                    <span class="text-warning">
                                @elseif($rating > 3.8)
                                    <span class="text-success">
                                @endif
                                    <i class="bx bxs-circle"></i>
                                </span>
                            </td>
                            <td nowrap>
                                {{rand(1,30)}} /
                                {{rand(7,12)}} /
                                2020
                            </td>
                            <td nowrap>
                                {{rand(1,30)}} /
                                {{rand(7,12)}} /
                                2021
                            </td>
                            <td>
                                <a  data-toggle="collapse" href="#{{$descr = Str::random(8)}}" aria-expanded="false" aria-controls="{{Str::random(8)}}" class="mr-1 badge badge-pill">
                                    <i class="bx bx-info-circle"  style="font-size: 14px"></i> Info
                                </a>
                                <a  data-toggle="collapse" href="#{{$pres = Str::random(8)}}" aria-expanded="false" aria-controls="{{$pres}}" class="mr-1 badge badge-pill">
                                    <i class="bx bx-minus-circle"  style="font-size: 14px"></i> Suspend 
                                </a>
                            </td>
                        </tr>
                        <tr id="{{$descr}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                            <td colspan="10">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-dark custom-radius">
                                        
                                        <thead class="nyayomat-blue">
                                            <tr>
                                                <th colspan="9">
                                                    <div class="row">
                                                        <div class="col-12 font-weight-bold">
                                                            <span class="text-info mr-4" style="opacity: .7">
                                                                Total Outstanding Amount : <small class="ml-2">Ksh</small> {{number_format(rand(50000,100000),2)}}
                                                            </span>

                                                            <span class="text-warning mr-4" style="opacity: .7">
                                                                Total Pending Amount : <small class="ml-2">Ksh</small> {{number_format(rand(50000,100000),2)}}
                                                            </span>

                                                            <span class="text-danger mr-4" style="opacity: .7">
                                                                Total Defaulted Amount : <small class="ml-2">Ksh</small> {{number_format(rand(50000,100000),2)}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th nowrap>
                                                    Asset Name
                                                </th>
                                                <th>
                                                    Last Payment
                                                </th>
                                                <th>
                                                    Units
                                                </th>
                                                <th nowrap>
                                                   Unit Cost <small>Ksh</small>
                                                </th>
                                                <th nowrap>
                                                    Installments <small>Ksh</small>
                                                </th>
                                                <th nowrap>
                                                    Frequency
                                                </th>
                                                <th nowrap>
                                                    Total Cost <small>Ksh</small>
                                                </th>
                                                <th nowrap>
                                                    Total Paid <small>Ksh</small>
                                                </th>
                                                <th nowrap>
                                                    Total Outstanding <small>Ksh</small>
                                                </th>
                                                <th nowrap>
                                                    First Payment 
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($w = 0; $w < 3 ; $w++)    
                                                <tr>
                                                    <td>
                                                        <ul class="list-unstyled">
                                                            <li class="font-weight-bold">
                                                                AST.NME.{{Str::upper(Str::random(5))}}
                                                            </li>
                                                            <li>
                                                                @if ($w + 1 == 1)
                                                                    <span class="text-success border-0">
                                                                        <small style="font-size: 10px">
                                                                            <i class="bx bxs-circle mr-1"></i> 
                                                                            Next Due : {{rand(1,28)}} / {{rand(11,12)}} / 2021
                                                                        </small>
                                                                    </span>
                                                                @endif
                                                                @if ($w + 1 == 2)
                                                                    <span class="text-warning border-0">
                                                                        <small style="font-size: 10px">
                                                                            <i class="bx bxs-circle mr-1"></i> 
                                                                            Pending
                                                                        </small>
                                                                    </span>
                                                                @endif
                                                                @if ($w + 1 == 3)
                                                                    <span class="text-danger border-0">
                                                                        <small style="font-size: 10px">
                                                                            <i class="bx bxs-circle mr-1"></i> 
                                                                            Defaulted
                                                                        </small>
                                                                    </span>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td nowrap>
                                                        {{rand(1,30)}} /
                                                        {{rand(3,10)}} /
                                                        2021
                                                    </td>
                                                    <td nowrap>
                                                        {{$units = rand(1,5)}}
                                                    </td>
                                                    <td nowrap>
                                                        <span class="d-none">
                                                            {{$cost = rand(1000,10000)}}
                                                        </span>
                                                        {{number_format($cost,2)}}
                                                    </td>
                                                    <td nowrap>
                                                        {{$installments = rand(10,90)}}
                                                    </td>
                                                    <td nowrap>
                                                    @if ($w %4 == 0)
                                                        Weekly
                                                    @else
                                                        Month;y
                                                    @endif
                                                    </td>
                                                    <td nowrap>
                                                        <span class="d-none">
                                                            {{$total_cost = $cost * $units }}
                                                        </span>
                                                        {{number_format($total_cost,2)}}
                                                    </td>
                                                    <td nowrap>
                                                        <span class="d-none">
                                                            {{$total_paid = $total_cost * 0.4}}
                                                        </span>
                                                        {{number_format($total_paid,2)}}
                                                    </td>
                                                    <td nowrap>
                                                        <span class="d-none">
                                                            {{$total_outstanding = $total_cost - $total_paid}}
                                                        </span>
                                                        {{number_format($total_outstanding,2)}}
                                                    </td>
                                                    <td nowrap>
                                                        {{rand(1,30)}} /
                                                        {{rand(3,10)}} /
                                                        2020
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr id="{{$pres}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                            <td colspan="9">
                                <p class="">
                                    You are about to suspend this account, proceed ?
                                </p>
                                <a href="" class="btn btn-sm btn-outline-success">
                                    Yes
                                </a>

                                <a href="" class="btn btn-sm btn-outline-danger">
                                    No
                                </a>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
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
                    label: 'Active', // Name the series
                    data: completed_sales, // Specify the data values array
                    fill: false,
                    borderColor: '#4CAF50', // Add custom color border (Line)
                    backgroundColor: '#4CAF50', // Add custom color background (Points and Fill)
                    borderWidth: 3 ,// Specify bar border width
                    tension: 0.2
                },
                {
                    label: 'Inactive', // Name the series
                    data: failed_sales, // Specify the data values array
                    fill: false,
                    borderColor: '#6c757d', // Add custom color border (Line)
                    backgroundColor: '#6c757d', // Add custom color background (Points and Fill)
                    borderWidth: 3 ,// Specify bar border width
                    tension: 0.2
                },]
            },
            options: {
            responsive: true, // Instruct chart js to respond nicely.
            maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
            }
        });
    </script>
@endpush
