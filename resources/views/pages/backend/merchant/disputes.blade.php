@extends('layouts.backend.main', 
                        [
                            'title' => __("Disputes"),
                            'page_name' => 'Disputes',
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

            .small-icon{
                font-size:2vh;
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

    <a href="{{route('merchant-product')}}" class="nav_link">
        <i class='bx bx-package nav_icon'></i>
        <span class="nav_name">
            Products
        </span>
    </a>

    <a href="{{route('merchant-stats')}}" class="nav_link"> 
        <i class='bx bx-doughnut-chart nav_icon'></i>   
        <span class="nav_name">
            Statistics 
            <span class="d-md-inline-flex badge nav)n badge-circle mr-2 bg-white nyayomat-blue d-none">
                {{rand(1,10)}}
            </span>
        </span> 
    </a> 

    <a href="{{route('merchant-disputs')}}" class="nav_link active"> 
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
                {{Illuminate\Support\Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-primary ml-1">
                Disputes
            </a>  
        </div>
    </div>
    {{-- Table --}}
    <div class="row mt-4">
        <div class="col-12 p-0">
            <div class="accordion" id="accordionExample">
                {{-- Failed Delivery --}}
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block nyayomat-blue text-left" type="button" data-toggle="collapse" data-target="#collapseToday" aria-expanded="false" aria-controls="collapseToday">
                        <i class="bx bxs-truck mr-3"></i> Failed Deliveries
                    </button>
                </h2>
                <div id="collapseToday" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row">
                            @for ($i = 0; $i < rand(5,10); $i++)
                                <div class="col-12 mb-3 p-0">
                                    <div class="media">
                                        <i class="bx bx-user-circle align-self-start mr-3"></i>
                                        <div class="media-body">
                                            <div class="row">
                                                <h5 class="mt-0 col-6">
                                                    User{{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(8))}}
                                                </h5>
                                                <small class="mt-0 col-6 text-right">
                                                    <span class="d-none">{{$duration = rand(1,70)}}</span> 
                                                        @if ($duration > 7)
                                                            <span class="d-none">{{$wks_counter = $duration / 7}}</span>
                                                            @if ($wks_counter > 4)
                                                                <span class="d-none">{{$mth_counter = $wks_counter / 4}}</span>
                                                                {{number_format($mth_counter,0)}}
                                                                @if ($mth_counter < 2)
                                                                    month
                                                                @else
                                                                    months 
                                                                @endif
                                                            @else
                                                            {{number_format($wks_counter,0)}}
                                                                @if (number_format($wks_counter,0) < 2)
                                                                    week
                                                                @else 
                                                                    weeks
                                                                @endif
                                                            @endif
                                                        @else
                                                            {{$duration}}
                                                            @if ($duration < 2)
                                                                day
                                                            @else
                                                                days
                                                            @endif
                                                        @endif
                                                    ago
                                                </small>
                                                <p class="col-12 pt-0 mb-3">
                                                    <a href="tel:+" class="small-icon nyayomat-blue mr-2"> 
                                                        <i class="bx bx-phone"></i>
                                                    </a>

                                                    <a href="tel:+" class="small-icon nyayomat-blue mr-2"> 
                                                        <i class="bx bx-at"></i>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="row text-muted">
                                                
                                                <p class="col-12 pl-4">
                                                    Order ID : 
                                                    <span class="font-weight-bold">
                                                        {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                    </span>
                                                </p>
                                                <p class="col-12 pl-4">
                                                    Order Date : 
                                                    <span class="font-weight-bold">
                                                        {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d- M - Y @ H:i:s A')}}
                                                    </span>
                                                </p>
                                                <p class="col-12 pl-4">
                                                    <span class="font-weight-bold">
                                                        Destination <br>
                                                    </span>
                                                    
                                                    Estate Name, Langata , Nairobi    
                                                </p>
                                                <p class="col-12 pl-4">
                                                    Order Summary
                                                </p>
                                                <div class="col-12 pl-4">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        {{__('Product')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Cost')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Qty')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Value')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Promo')}}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @for ($t = 0; $t < $amt = rand(4,10) ; $t++)
                                                                    <tr>
                                                                        <td>
                                                                            {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                                        </td>
                                                                        <td>
                                                                            <span class="d-none">
                                                                                {{$prod_cost = rand(1000,2500)}}
                                                                            </span>
                                                                            {{number_format($prod_cost,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{$prod_qty = rand(5,10)}}
                                                                        </td>
                                                                        <td>
                                                                            <span class="mr-2">ksh</span>
                                                                            <span class="d-none">
                                                                                {{$val = $prod_cost * $prod_qty}}
                                                                            </span>
                                                                            {{number_format($val,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                                        </td>
                                                                    </tr>
                                                                @endfor
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <p class="col-12 pl-4">
                                                    Total Value
                                                    <span class="font-weight-bold">
                                                        <small class="mr-2">Ksh</small>
                                                        {{number_format(($total = $val * $amt),2) }}
                                                    </span>
                                                </p>
                                                
                                                <div class="col-12 pl-4">
                                                    Status : 
                                                    @if ($i %2 == 0)
                                                        <span class="font-weight-bold text-success">Resolved</span>
                                                    @else
                                                        <span class="font-weight-bold text-danger">Unresolved</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                {{-- Defective Products --}}
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block nyayomat-blue text-left" type="button" data-toggle="collapse" data-target="#collapseDefective" aria-expanded="false" aria-controls="collapseDefective">
                        <i class="bx bx-task-x mr-3"></i> Defective Products
                    </button>
                </h2>
                <div id="collapseDefective" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row">
                            @for ($i = 0; $i < rand(5,10); $i++)
                                <div class="col-12 mb-3 p-0">
                                    <div class="media">
                                        <i class="bx bx-user-circle align-self-start mr-3"></i>
                                        <div class="media-body">
                                            <div class="row">
                                                <h5 class="mt-0 col-6">
                                                    User{{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(8))}}
                                                </h5>
                                                <small class="mt-0 col-6 text-right">
                                                    <span class="d-none">{{$duration = rand(1,70)}}</span> 
                                                        @if ($duration > 7)
                                                            <span class="d-none">{{$wks_counter = $duration / 7}}</span>
                                                            @if ($wks_counter > 4)
                                                                <span class="d-none">{{$mth_counter = $wks_counter / 4}}</span>
                                                                {{number_format($mth_counter,0)}}
                                                                @if ($mth_counter < 2)
                                                                    month
                                                                @else
                                                                    months 
                                                                @endif
                                                            @else
                                                            {{number_format($wks_counter,0)}}
                                                                @if (number_format($wks_counter,0) < 2)
                                                                    week
                                                                @else 
                                                                    weeks
                                                                @endif
                                                            @endif
                                                        @else
                                                            {{$duration}}
                                                            @if ($duration < 2)
                                                                day
                                                            @else
                                                                days
                                                            @endif
                                                        @endif
                                                    ago
                                                </small>
                                                <p class="col-12 pt-0 mb-3">
                                                    <a href="tel:+" class="small-icon nyayomat-blue mr-2"> 
                                                        <i class="bx bx-phone"></i>
                                                    </a>

                                                    <a href="tel:+" class="small-icon nyayomat-blue mr-2"> 
                                                        <i class="bx bx-at"></i>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="row text-muted">
                                                
                                                <p class="col-12 pl-4">
                                                    Order ID : 
                                                    <span class="font-weight-bold">
                                                        {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                    </span>
                                                </p>
                                                <p class="col-12 pl-4">
                                                    Order Date : 
                                                    <span class="font-weight-bold">
                                                        {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d- M - Y @ H:i:s A')}}
                                                    </span>
                                                </p>
                                                <p class="col-12 pl-4">
                                                    <span class="font-weight-bold">
                                                        Destination <br>
                                                    </span>
                                                    
                                                    Estate Name, Langata , Nairobi    
                                                </p>
                                                <p class="col-12 pl-4">
                                                    Order Summary
                                                </p>
                                                <div class="col-12 pl-4">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        {{__('Product')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Cost')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Qty')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Value')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Promo')}}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @for ($t = 0; $t < $amt = rand(1,3) ; $t++)
                                                                    <tr>
                                                                        <td>
                                                                            {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                                        </td>
                                                                        <td>
                                                                            <span class="d-none">
                                                                                {{$prod_cost = rand(1000,2500)}}
                                                                            </span>
                                                                            {{number_format($prod_cost,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{$prod_qty = rand(5,10)}}
                                                                        </td>
                                                                        <td>
                                                                            <span class="mr-2">ksh</span>
                                                                            <span class="d-none">
                                                                                {{$val = $prod_cost * $prod_qty}}
                                                                            </span>
                                                                            {{number_format($val,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                                        </td>
                                                                    </tr>
                                                                @endfor
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <p class="col-12 pl-4">
                                                    Total Value
                                                    <span class="font-weight-bold">
                                                        <small class="mr-2">Ksh</small>
                                                        {{number_format(($total = $val * $amt),2) }}
                                                    </span>
                                                </p>
                                                
                                                <div class="col-12 pl-4">
                                                    Status : 
                                                    @if ($i %2 == 0)
                                                        <span class="font-weight-bold text-success">Resolved</span>
                                                    @else
                                                        <span class="font-weight-bold text-danger">Unresolved</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                {{-- Wrong Product --}}
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block nyayomat-blue text-left" type="button" data-toggle="collapse" data-target="#collapseWrong" aria-expanded="true" aria-controls="collapseWrong">
                        <i class="bx bx-question-mark mr-3"></i> Wrong Product
                    </button>
                </h2>
                <div id="collapseWrong" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row">
                            @for ($i = 0; $i < rand(5,10); $i++)
                                <div class="col-12 mb-3 p-0">
                                    <div class="media">
                                        <i class="bx bx-user-circle align-self-start mr-3"></i>
                                        <div class="media-body">
                                            <div class="row">
                                                <h5 class="mt-0 col-6">
                                                    User{{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(8))}}
                                                </h5>
                                                <small class="mt-0 col-6 text-right">
                                                    <span class="d-none">{{$duration = rand(1,70)}}</span> 
                                                        @if ($duration > 7)
                                                            <span class="d-none">{{$wks_counter = $duration / 7}}</span>
                                                            @if ($wks_counter > 4)
                                                                <span class="d-none">{{$mth_counter = $wks_counter / 4}}</span>
                                                                {{number_format($mth_counter,0)}}
                                                                @if ($mth_counter < 2)
                                                                    month
                                                                @else
                                                                    months 
                                                                @endif
                                                            @else
                                                            {{number_format($wks_counter,0)}}
                                                                @if (number_format($wks_counter,0) < 2)
                                                                    week
                                                                @else 
                                                                    weeks
                                                                @endif
                                                            @endif
                                                        @else
                                                            {{$duration}}
                                                            @if ($duration < 2)
                                                                day
                                                            @else
                                                                days
                                                            @endif
                                                        @endif
                                                    ago
                                                </small>
                                                <p class="col-12 pt-0 mb-3">
                                                    <a href="tel:+" class="small-icon nyayomat-blue mr-2"> 
                                                        <i class="bx bx-phone"></i>
                                                    </a>

                                                    <a href="tel:+" class="small-icon nyayomat-blue mr-2"> 
                                                        <i class="bx bx-at"></i>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="row text-muted">
                                                
                                                <p class="col-12 pl-4">
                                                    Order ID : 
                                                    <span class="font-weight-bold">
                                                        {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                    </span>
                                                </p>
                                                <p class="col-12 pl-4">
                                                    Order Date : 
                                                    <span class="font-weight-bold">
                                                        {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d- M - Y @ H:i:s A')}}
                                                    </span>
                                                </p>
                                                <p class="col-12 pl-4">
                                                    <span class="font-weight-bold">
                                                        Destination <br>
                                                    </span>
                                                    
                                                    Estate Name, Langata , Nairobi    
                                                </p>
                                                <p class="col-12 pl-4">
                                                    Order Summary
                                                </p>
                                                <div class="col-12 pl-4">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        {{__('Product')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Cost')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Qty')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Value')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Promo')}}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @for ($t = 0; $t < $amt = rand(1,3) ; $t++)
                                                                    <tr>
                                                                        <td>
                                                                            {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                                        </td>
                                                                        <td>
                                                                            <span class="d-none">
                                                                                {{$prod_cost = rand(1000,2500)}}
                                                                            </span>
                                                                            {{number_format($prod_cost,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{$prod_qty = rand(5,10)}}
                                                                        </td>
                                                                        <td>
                                                                            <span class="mr-2">ksh</span>
                                                                            <span class="d-none">
                                                                                {{$val = $prod_cost * $prod_qty}}
                                                                            </span>
                                                                            {{number_format($val,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{Illuminate\Support\Str::upper(Illuminate\Support\Str::random(10))}}
                                                                        </td>
                                                                    </tr>
                                                                @endfor
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <p class="col-12 pl-4">
                                                    Total Value
                                                    <span class="font-weight-bold">
                                                        <small class="mr-2">Ksh</small>
                                                        {{number_format(($total = $val * $amt),2) }}
                                                    </span>
                                                </p>
                                                
                                                <div class="col-12 pl-4">
                                                    Status : 
                                                    @if ($i %2 == 0)
                                                        <span class="font-weight-bold text-success">Resolved</span>
                                                    @else
                                                        <span class="font-weight-bold text-danger">Unresolved</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
