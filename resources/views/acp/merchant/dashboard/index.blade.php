@extends('acp.merchant.master', 
                        [
                            'title' => __("Merchant  Profile"),
                            'page_name' => 'Merchant  Profile',
                            'bs_version' => 'bootstrap@4.6.0',
                            'left_nav_color' => 'lightseagreen',
                            'nav_icon_color' => '#fff',
                            'active_nav_icon_color' => '#fff',
                            'active_nav_icon_color_border' => 'greenyellow' ,
                            'top_nav_color' => '#F7F6FB',
                            'background_color' => '#F7F6FB',
                        ])

@push('link-css')
    {{-- <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <link href="{{asset('css/graphs.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
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

            .height-cap {
                max-height: 15vh;
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
                .chart-height{
                    height: 35vh;
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
@include('acp.merchant.nav') 
@endpush



@section('content')
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-12 mt-2 mb-3 font-weight-light">
            <i class='bx bx-subdirectory-right mr-2 text-primary' style="font-size: 2.8vh;"></i>
            <a href="" class="text-muted mr-1">
                {{\Illuminate\Support\Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted ml-1">
                Dashboard
            </a>  /
            <a href="" class="text-primary ml-1">
                Merchant  Profile
            </a> 
            @if ($errors->any())
			<div class="alert alert-danger">
				@foreach ($errors->all() as $error)
				{{ $error }}
				<br>
				@endforeach
			</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 mb-4">
            <a href="{{route('merchant-dashboard')}}" class="badge badge-pill shadow py-1 px-2 text-white bg-primary">
                Switch to Ecommerce
            </a>
        </div>
    </div>
    <div class="row mt-3">
        {{-- @include('layouts.alerts.success') --}}
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2 class="font-weight-bold col-12">
                {{$merchant->shop_name}}
            </h2>
            {{-- <span class="col-12">
                @if(!empty($merchant->location))
                    {{$merchant->location}}
                @endif
                @if (!empty($merchant->region))
                    , {{$merchant->region}}   
                @endif
                @if (!empty($merchant->city))
                    , {{$merchant->city}}   
                @endif
            </span> --}}
            <p class="col-12 mt-3">
                <span class="text-muted mr-2 font-weight-bold">
                    Contacts :
                </span>
                <a href="tel:+" class="mr-4">
                    <i class="bx bx-phone mr-1"></i> {{$merchant->mobile}}
                </a>
                <a href="mailto:+" class="">
                    <i class="bx bx-at mr-1"></i> {{$merchant->email}}
                </a>
            </p>
            <p class="col-12">
                <span class="font-weight-bold text-muted mr-4">
                    Products Engaged : {{$calculation->asset_engaged}}
                </span>
            </p>
            <br>
        </div>
        <div class="col-md-6 text-md-right row">
            <h3 class="font-weight-bold text-muted col-12 mr-4">
                Account Details
            </h3>
            <div class="dropdown col-12">
       
                {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div> --}}
                <ul class="list-unstyled">
                    <li>
                        Total Assets Value : &nbsp;
                        Ksh.
                        <span class="mr-3">
                            {{number_format($calculation->total_assets_value,2)}}
                        </span>
                    </li>
                    <li>
                        Total Paid : &nbsp;
                        Ksh.
                        <span class="mr-3">
                            {{number_format($calculation->total_assets_value - $calculation->total_out_standing_amount,2)}}
                        </span>
                    </li>
                    <li>
                        Total Outstanding : &nbsp;
                        Ksh.
                        <span class="mr-3">
                            {{number_format($calculation->total_out_standing_amount,2)}}
                        </span>
                    </li>
                    <li>
                        <ul class="list-unstyled">
                            {{-- <li>
                                Next Payment
                                <span class="mr-3">
                                    {{Carbon\Carbon::now("Africa/Nairobi")-> addDays(rand(10,20))->format('D , d - M - Y')}}
                                </span>
                                Ksh.
                                <span class="mr-3">
                                    {{number_format(rand(100,50000),2)}}
                                </span>
                            </li> --}}
                            <li>
                                Account Balance : &nbsp;
                                Ksh.
                                <span class="mr-3">
                                    {{number_format($merchant->account_balance,2)}}
                                </span>
                            </li>
                           
                        </ul>
                        <li>
                            <a data-toggle="modal" href="#deposit_cash" class="btn btn-sm btn-outline-info mr-3 mt-2">
                                <i class="bx bx-money mr-1"></i> Deposit Cash
                            </a>
                        </li>
                    </li>
                    {{-- <li>
                        <a class="btn btn-sm mr-3 btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            View More
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                My Products
            </a>
        </li>
        {{-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                Transactions
            </a>
        </li> --}}
        {{-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                Browse
            </a>
        </li> --}}
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">        
            <div class="row mt-4">
                <div class="col-12 mb-4">
                    <span class="font-weight-bold text-success mr-4">
                        @if($calculation->total_assets_value != null && $calculation->total_assets_value != null)
                        Total Paid : {{number_format(((($calculation->total_assets_value - $calculation->total_out_standing_amount)/$calculation->total_assets_value)) * 100,2)}} %
                        @else
                        Total Paid : 0 %
                        @endif
                    </span>
                    <span class="font-weight-bold text-danger mr-4">
                        Products Defaulted  : {{$product_defaulted}}
                    </span>
                    <span class="font-weight-bold text-primary mr-4">
                        Products Owned  : {{$product_owned}}
                    </span>
                </div>
                <div class="col-12 mb-4">

                    <span class="font-weight-bold text-muted mr-4">
                        <i class="bx bx-star"></i> = Due Today
                    </span>

                    <span class="font-weight-bold text-muted mr-4">
                        D = Daily
                    </span>

                    <span class="font-weight-bold text-muted mr-4">
                        W = Weekly
                    </span>

                    <span class="font-weight-bold text-muted mr-4">
                        M = Monthly
                    </span>

                </div>
                <div class="col-12 table-responsive">
                    <table id="mytableID" class="table">
                        <thead>
                            <tr>
                                <th nowrap>
                                    
                                </th>
                                <th nowrap>
                                    Name
                                </th>
                                <th nowrap>
                                    Units
                                </th>
                                <th nowrap class="">
                                    Holiday Period <br> <sub class="font-weight-normal">End Date</sub>
                                </th>
                                <th nowrap class="">
                                   Unit Cost (Ksh)
                                </th>
                                <th nowrap>
                                    Installment Amount (Ksh)
                                </th>
                                <th nowrap>
                                    Next Payment 
                                </th>
                                <th nowrap>
                                    Status
                                </th>
                                <th nowrap>
                                    Installments
                                </th>
                                <th nowrap>
                                    Total Outstanding
                                    (Ksh)
                                </th>
                                <th nowrap>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody class="accordion" id="groupDescription">
                            @foreach ($orders as $key => $order)
                                <tr class="" style="">
                                    <td nowrap>
                                        @if(isset($order->nextReceipt->due_date))
                                            @if($order->nextReceipt->due_date == Carbon\Carbon::now("Africa/Nairobi")->toDateString())
                                            <i class="bx bx-dot text-danger"></i>
                                            @endif
                                        @endif
                                        {{-- @if ($i % 5 == 0 && $i != 0)
                                            <i class="bx bx-star text-success"></i>
                                        @endif
                                        @if ($i % 7 == 0 && $i != 0)
                                            <i class="bx bx-dot text-danger"></i>
                                        @endif --}}
                                    </td>
                                    <td nowrap>
                                        {{$order->asset_name}}
                                    </td>
                                    <td nowrap>
                                        {{$order->units}}
                                    </td>
                                    <td nowrap>
                                        {{$joined = Carbon\Carbon::now("Africa/Nairobi")->addDays($order->holiday_provision)->format('d - M - Y')}}
                                    </td>
                                    <td nowrap>
                                        {{number_format($order->units * $order->unit_cost,2)}}
                                    </td>
                                    <td nowrap>
                                        {{number_format(($order->units * ($order->unit_cost - $order->deposit_amount)) / ($order->installment),2)}} -
                                         @if ($order->payment_frequency == 'Daily')
                                             D
                                         @endif
                                         @if ($order->payment_frequency == 'Weekly')
                                             W
                                         @endif
                                         @if ($order->payment_frequency == 'Monthly')
                                             M
                                         @endif
                                    </td>
                                    <td nowrap>
                                        @if (isset($order->nextReceipt->due_date))
                                        {{Carbon\Carbon::parse($order->nextReceipt->due_date)->format('D , d - M - Y')}}  
                                        @else
                                        --
                                        @endif
                                        
                                    </td>
                                    <td nowrap>
                                        <div class="progress">
                                            @php
                                                $progress = (((($order->units * $order->unit_cost) - $order->total_out_standing_amount)/($order->units * $order->unit_cost))) * 100;
                                            @endphp
                                            {{-- @if ($progress <= 0)
                                            <div class="progress-bar bg-danger" role="progressbar" style="width:{{$progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                            @elseif ($progress > 0 && $progress <=49)
                                                <div class="progress-bar bg-danger" role="progressbar" style="width:{{$progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            @elseif ($progress >= 50 && $progress <=70) --}}
                                            <div class="progress-bar bg-success" role="progressbar" style="width:{{$progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                            {{-- @elseif ($progress >= 71 && $progress <=100)
                                            <div class="progress-bar bg-priamry" role="progressbar" style="width:{{$progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                            @endif --}}
                                        </div>
                                    </td>
                                    <td nowrap>
                                        {{$order->transactions_count}} /
                                        {{$order->installment}}
                                    </td>
                                    <td nowrap>
                                        {{ number_format($order->total_out_standing_amount,2)}}
                                    </td>
                                    <td nowrap>
                                        @if ($key % 7 == 0 && $key != 0)
                                        <a  data-toggle="collapse" href="#{{$descr = \Illuminate\Support\Str::random(8)}}" aria-expanded="false" aria-controls="{{$descr}}" class="btn btn-sm px-1 rounded btn-outline-danger shadow py-2 text-uppercase ">
                                            <i class="bx bx-hourglass  mr-1"></i> Transactions
                                        </a>
                                        @else
                                        <a  data-toggle="collapse" href="#{{$descr = \Illuminate\Support\Str::random(8)}}" aria-expanded="false" aria-controls="{{$descr}}" class="btn btn-sm px-1 rounded btn-outline-primary shadow py-2 text-uppercase ">
                                            <i class="bx bx-hourglass  mr-1"></i> Transactions
                                        </a>
                                        @endif
                                    </td>
                                </tr>
        
                                <tr id="{{$descr}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                                    <td colspan="11">
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-dark custom-radius">
                                                
                                                <thead class="nyayomat-blue">
                                                    <tr>
                                                        <th>
                                                            Transaction ID
                                                        </th>
                                                        <th>
                                                            Transaction Date
                                                        </th>
                                                        <th>
                                                            Amount  <small>Ksh</small>
                                                        </th>
                                                        <th nowrap>
                                                            Payment Type
                                                        </th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->transactions as $key => $transaction)    
                                                        <tr>
                                                            <td nowrap>
                                                                {{$transaction->id}}
                                                            </td>
                                                            <td nowrap>
                                                                {{Carbon\Carbon::parse($transaction->paid_on)->format('D , d - M - Y')}}
                                                            </td>
                                                            <td nowrap>
                                                                {{number_format($transaction->amount,2)}}
                                                            </td>
                                                            <td nowrap>
                                                               {{ $transaction->type }} ( {{count($order->transactions) - $key}} / {{$order->installment}} )
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                              
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                {{-- <div class="col-12 text-right">
                    <a href="#application" data-toggle="modal" class="badge badge-pill shadow h4 py-1 px-2 badge-primary" style="font-size: .8rem">
                        New Application
                    </a>
                </div> --}}
                <div class="col-12 pt-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">
                            <i class='bx bx-search-alt-2'></i>
                          </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search for asset" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-md-10 text-dark">
                    <div class="row p-2 bg-white border rounded">
                        <div class="col-2 d-flex align-items-center justify-content-center mt-1">
                            <img class="img-fluid img-responsive height-cap rounded product-image" src="https://i.imgur.com/QpjAiHq.jpg">
                        </div>
                        <div class="col-7 mt-1">
                            <h5>
                              Asset Name
                            </h5>
                            <div class="d-flex align-items-end">
                                <div class="ratings mr-2">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span>Rating</span>
                            </div>
                            <p class="text-justify text-truncate para mb-0">
                                <ul class="list-unstyled">
                                    <li>
                                        Holiday : {{rand(15,60)}} Days
                                    </li>
                                    
                                    <li>
                                        Installments : {{rand(20,32)}}
                                    </li>
                                    
                                    <li>
                                        Installment Interval : Weekly
                                    </li>

                                    <li>
                                        Installments Amount: {{number_format(rand(200,3200),0)}}
                                    </li>
                                </ul>
                            </p>
                        </div>
                        <div class="align-items-center align-content-center col-3 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <span class="strike-text mr-1">Ksh</span> <h4 class="mr-1"> {{number_format(rand(2000,50000),2)}}</h4>
                            </div>
                            <h6 class="text-success">No Deposit</h6>
                            <div class="d-flex flex-column mt-4">
                                <button class="btn btn-primary btn-sm" type="button">Request</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row mt-4">
                <div class="col-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th nowrap>
                                    Name
                                </th>
                                <th nowrap>
                                    Contacts
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
                            {{-- @foreach (App\AssetProvider::withTrashed()->whereNotNull('deleted_at')->get() as $provider)
                                <tr>
                                    <td nowrap>
                                        <ul class="list-unstyled">
                                            <li class="font-weight-bold">
                                                {{\Illuminate\Support\Str::title($provider -> name)}}
                                            </li>
                                        </ul>
                                    </td>
                                    <td nowrap>
                                        <a href="tel:{{$provider -> phone}}" target="_blank" class="mr-2">
                                            <i class="bx bx-phone"></i>
                                        </a>
                                        <a href="mailto:{{$provider -> email}}" target="_blank" class="mr-2">
                                            <i class="bx bx-mail-send"></i>
                                        </a>
                                    </td>
                                    <td nowrap>
                                        <a href="{{route('sub-group')}}" class="nyayomat-blue font-weight-bolder">
                                            {{$sg = $provider -> assets -> where('status','approved')-> count()}}
                                        </a>
                                    </td>
                                    <td nowrap>
                                        <a class="text-decoration-none">
                                            {{$provider -> county}}
                                        </a>
                                    </td>
                                    <td nowrap>
                                        <a  class="text-decoration-none">
                                            {{$provider -> sub_county}}
                                        </a>
                                    </td>
                                    <td nowrap>
                                        <a class="text-decoration-none">
                                            {{$provider -> location}}
                                        </a>
                                    </td>
                                    <td nowrap>
                                        {{$provider -> created_at}}
                                    </td>
                                    <td nowrap>
                                        {{$provider -> updated_at}}
                                    </td>
                                    <td nowrap>
                                        <a  href="{{route('restore provider', $provider -> id)}}" class="mr-2 badge badge-pill">
                                            <i class="bx bx-reset"  style="font-size: 14px"></i> Restore
                                        </a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


     {{-- Deposit Cash Start --}}
     <div class="modal fade" id="deposit_cash"  data-keyboard="false"  data-backdrop="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
           
            <div class="modal-content border-0 shadow-lg">
                <form method="post" action="{{route('merchant.deposit.amount')}}">
                    @csrf
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">
                        Deposit Cash
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                   <div class="row">
                        <div class="col-12">
                            <input type="number" name="deposit_amount" class="form-control" placeholder="Enter deposit amount here..."/>
                        </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button  class="btn h5 btn-sm btn-outline-success">
                            Yes, Proceed
                        </button>
                        <a class="btn h5 btn-sm btn-outline-danger">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
            </div>
            
        </div>
    </div>
    {{-- Deposit Cash --}}
@endsection

@push('scripts')

    <script>
        var checkboxes = $("input[type='checkbox']"),
        submitButt = $("button[type='submit']");
        checkboxes.click(function() {
            submitButt.attr("disabled", !checkboxes.is(":checked"));
        });
    </script>
    <script>
        var active_accounts = [...Array(10)].map(() => Math.floor(Math.random() * 950));       
        var applications = [...Array(10)].map(() => Math.floor(Math.random() * 1550));
        var suspended_accounts = [...Array(10)].map(() => Math.floor(Math.random() * 20));
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
                    data: active_accounts, // Specify the data values array
                    fill: false,
                    borderColor: '#4CAF507B', // Add custom color border (Line)
                    backgroundColor: '#4CAF507B', // Add custom color background (Points and Fill)
                    borderWidth: 3 ,// Specify bar border width
                    tension: 0.3
                },
                {
                    label: 'Applications', // Name the series
                    data: applications, // Specify the data values array
                    fill: false,
                    borderColor: '#036CB17B', // Add custom color border (Line)
                    backgroundColor: '#036CB17B', // Add custom color background (Points and Fill)
                    borderWidth: 3 ,// Specify bar border width
                    tension: 0.2
                },
                {
                    label: 'Suspended', // Name the series
                    data: suspended_accounts, // Specify the data values array
                    fill: false,
                    borderColor: '#ff00007B', // Add custom color border (Line)
                    backgroundColor: '#ff00007B', // Add custom color background (Points and Fill)
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
    {{-- Parent Child Selects --}}
    <script>
        function filterChild(){
            var parent =  $(this).val();
            var child = $('#child-select');
        
            child.find('option').each(function(){
                $(this).toggle($(this).hasClass(parent));
            });
           child.val('');
        }

        $(document).ready(filterChild);
        $('#parent-select').on('change', filterChild);
    </script>
    <script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
              
              $(document).ready(function() {
                  $(".sampleTable").fancyTable({
                    /* Column number for initial sorting*/
                     sortColumn:0,
                     /* Setting pagination or enabling */
                     pagination: true,
                     /* Rows per page kept for display */
                     perPage:3,
                     globalSearch:true
                     });
                                
              });
          </script>
    </script>
    <script>
        function filterChild(){
            var child =  $(this).val();
            var grand_child = $('#grand-child-select');
        
            child.find('option').each(function(){
                $(this).toggle($(this).hasClass(child));
            });
           child.val('');
        }

        $(document).ready(filterGrandChild);
        $('#child-select').on('change', filterGrandChild);
    </script>
@endpush
