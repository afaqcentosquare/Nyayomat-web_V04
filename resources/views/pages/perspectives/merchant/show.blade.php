@extends('layouts.main')
@push('header_items')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
            color: #fff;
            border: 1px solid #5e72e4;
            border-radius: 5px;
            background-color: #5e72e4;
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        }
        body{
            scroll-behavior: smooth
        }
    </style>
@endpush
@section('content')
    <div style="z-index: -1" class="header bg-default pb-6 pt-2 pt-5">
        <div class="container">
            <div class="header-body">
                <!-- Card stats -->
                @include('layouts.alerts.error')
                @include('layouts.alerts.success')
                <div class="row">
                    <h2 class="col-12 display-2 text-white">
                        {{Str::title($service_provider -> name)}}
                    </h2>
                    <p class="col-12">
                        <a href="tel:{{$service_provider -> tel}}" class="text-white mr-3 font-weight-light small-text">
                            <span class="mr-2">
                                Phone : 
                            </span>
                            {{$service_provider -> phone}}
                        </a>
                        
                        <a href="mailto:{{$service_provider -> email}}" class="small-text text-white font-weight-light">
                            <span class="mr-2">
                                E - Mail : 
                            </span>
                            {{$service_provider -> email}}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt--6" style="z-index: 1">
        <div class="row">
            <div class="nav-wrappern">
                <ul class="nav nav-pills ml-4 nav-fill flex-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active mb-sm-3 mb-md-0" id="transactions-today-tab" data-toggle="tab" href="#transactions-today" role="tab" aria-controls="transactions-today" aria-selected="true">
                            <i class="bx bx-history mr-2"></i>
                             Today
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link mb-sm-3  mb-md-0" id="assets-tab" data-toggle="tab" href="#assets" role="tab" aria-controls="assets" aria-selected="false">
                            <i class="bx bx-package mr-2"></i>
                            Assets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="trasnsaction-history-tab" data-toggle="tab" href="#trasnsaction-history" role="tab" aria-controls="trasnsaction-history" aria-selected="false">
                            <i class='bx bx-sort-alt-2 mr-2' ></i>
                            Transactions
                        </a>
                    </li>
                    {{--                     
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="clients-tab" data-toggle="tab" href="#clients" role="tab" aria-controls="clients" aria-selected="false">
                            <i class="bx bx-history mr-2"></i>
                            Clients
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">
                            <i class="bx bx-bell mr-2"></i>
                            notifictions
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 mt-4 px-2">
                <div class="mx-0 mx-auto mx-md-3">
                    <div class="">
                        <div class="tab-content" id="myT    abContent">
                            <div class="tab-pane show active fade" id="transactions-today" role="tabpanel" aria-labelledby="transactions-today-tab">
                                <div class="row">
                                    <div class="col-12 text-center mt-5">
                                        <span class="font-weight-bold">
                                            {{__('Ksh.')}}    
                                        </span>
                                        <h1 class="display-1 font-weight-light text-success text-success">
                                            {{number_format(rand(1000,30000),0)}}
                                        </h1>
                                    </div>
                                    <p class="col-12 text-center">
                                        {{__('Transactions Today')}}
                                    </p>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        {{__('Transaction ID')}}
                                                    </th>
                                                    <th>
                                                        {{__('To')}}
                                                    </th>
                                                    <th>
                                                        {{__('From')}}
                                                    </th>
                                                    <th>
                                                        {{__('Amount')}}
                                                    </th>
                                                    <th>
                                                        {{__('Category')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <span class="d-none">
                                                    {{$tvar = rand(4,10)}}
                                                </span>
                                                @for ($i = 0; $i < $tvar; $i++)
                                                    <tr>
                                                        <td>
                                                            {{Str::upper(Str::random(10))}}
                                                        </td>
                                                        @if ($i%2 == 0)
                                                            <td>
                                                                {{__('You')}}
                                                            </td>
                                                            <td>
                                                                07{{rand(0,9)}}{{rand(0,9)}}{{rand(0,9)}}{{rand(0,9)}}{{rand(0,9)}}{{rand(0,9)}}{{rand(0,9)}}{{rand(0,9)}}{{rand(0,9)}}
                                                            </td>
                                                            <td>
                                                                <span class="mr-2">ksh</span>{{number_format(rand(500,10000),2)}}
                                                            </td>
                                                            <td class="text-success">
                                                                {{__('In - flow')}}
                                                            </td>
                                                        @else
                                                            <td>
                                                                07
                                                                {{rand(0,9)}}{{rand(0,9)}}
                                                                {{rand(0,9)}}{{rand(0,9)}}
                                                                {{rand(0,9)}}{{rand(0,9)}}
                                                                {{rand(0,9)}}{{rand(0,9)}}  
                                                            </td>
                                                            <td>
                                                                {{__('You')}}
                                                            </td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                                                            <td>
                                                                <span class="mr-2">ksh</span>{{number_format(2500,2)}}
                                                            </td>
                                                            <td class="text-warning">
                                                                {{__('Out - flow')}}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="assets" role="tabpanel" aria-labelledby="assets-tab">
                                <div id="ongoing" class="row pt-4 mt-5">
                                    <div class="col-12 px-0">
                                        <div class="row px-0 text-success">
                                            <h2 class="col-10 text-success mx-auto display-3">
                                                Ongoing Assets
                                            </h2> 
                                            <h4 class="col-10 text-success mx-auto">
                                                Outstanding Balance : 
                                                <b>
                                                    <small>
                                                        Ksh
                                                    </small> 
                                                    <span class="d-none">
                                                        {{$iij = rand(15000,40000)}}
                                                    </span>
                                                    {{number_format($iij,2)}}                                                    
                                                </b>
                                            </h4>    
                                            <p class="my-0 font-weight-normal col-10 mx-auto">
                                                Next Payment : <b></b> {{rand(1,30)}}-{{rand(1,12)}}-{{rand(2021,2022)}}
                                            </p>    
                                            <p class="my-0 col-10 mx-auto">
                                                Assets : <b>{{rand(1,9)}}</b>
                                            </p>
                                            <p class="my-0 col-10 mx-auto text-black-50 py-0" style="font-size: 1.7vh">
                                                Others
                                            </p>
                                            <p class="my-0 col-10 mx-auto">
                                               
                                                <a href="#defaulted" class="text-danger">
                                                    &bull; Defaulted Assets
                                                </a>
                                                <a href="#completed" class="">
                                                    &bull; Completed Assets
                                                </a>
                                            </p>
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="row pt-3">
                                    <div class="input-group mb-3 col-10 offset-1 pl-0 mt-4">
                                        <input type="text" class="form-control" placeholder="Enter Asset Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <a class="input-group-text text-default" href="{{route('prods')}}" id="basic-addon2">
                                               <i class="bx bx-search-alt mr-2"></i> Find
                                            </a>
                                        </div>
                                      </div>
                                    <div class="col-12 px-0">
                                        @foreach(App\Asset::get() as $asset)
                                            <div class="accordion mt-3" id="accordionExample">
                                                <div class="card mb-2 rounded">
                                                    <div class="card-header my-0" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset -> id}}" aria-expanded="false" aria-controls="collapseOne">
                                                                AST.<span class="text-uppercase">{{Str::random(10)}}</span>  
                                                            </a>
                                                            
                                                        </h2>
                                                    </div>
                                                    <div id="asset{{$asset -> id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="row justify-content-between">
                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                <span class="d-none">
                                                                
                                                                </span> 
                                                                <span class="d-none">

                                                                    {{
                                                                        $ucv = 754
                                                                    }}

                                                                    {{
                                                                        $riv = 5
                                                                    }}

                                                                    {{
                                                                        $div = 14080
                                                                    }}

                                                                    {{  
                                                                        $uc =  number_format($ucv,2)
                                                                    }}
                                                                    
                                                                    {{  
                                                                        $ri =  number_format($riv,2)
                                                                    }}
                                                                </span>  
                                                                <span class="d-none">
                                                                    {{  
                                                                        $av =  number_format($div,2)
                                                                    }} 
                                                                    {{$tp = 7040}}, {{$ia = number_format(880,2) }} 
                                                                </span> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Asset Value
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{$av}} 
                                                            </p>

                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Unit Cost
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{$uc}} 
                                                            </p>

                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Installment Amount
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{$ia}} 
                                                            </p>
                                                      
                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Payment Interval
                                                                </span>
                                                                <br>
                                                                Weekly
                                                            </p>

                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Outstanding Balance
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{$tp}} 
                                                            </p>

                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Remaining Installments
                                                                </span>
                                                                <br>
                                                                8 
                                                            </p>

                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    QTY
                                                                </span>
                                                                <br>
                                                                {{-- <input type="text" class="form-control" type="n"> --}}
                                                                <a href="" class="mr-2 btn-sm btn-secondary">
                                                                    Add Qty
                                                                </a>
                                                            </p>
                                                            <div class="col-3 text-right pl-4 mb-2">
                                                                <span class="text-right">
                                                                    
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-3 pl-4 mb-2">
                                                                <span class="">
                                                                    <a href="" class="mr-2 btn-md btn mt-0 font-weight-bold btn-success">
                                                                        Make Payment <small class="font-weight-bold">Ksh. 880.00</small>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <input type="number" name="" class="form-control-alternative bg-white   " placeholder="Enter Quantity" id="">
                                                        </div>
                                                        <div class="col-12 text-center">
                                                            <a href="" class="btn btn-success btn-sm">
                                                                Add Asset
                                                            </a>
                                                        </div>
                                                        <div class="px-0 table-responsive mt-3">
                                                            <table class="table ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            {{__("Transaction ID")}}
                                                                        </th>
                                                                        <th>
                                                                            {{__("Transaction Date")}}
                                                                        </th>
                                                                        <th>
                                                                            {{__("Amount")}}
                                                                        </th>
                                                                        {{-- :if
                                                                            <th>
                                                                                {{__("Nyayomat Status")}}
                                                                            </th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="px-0 table-borderless">
                                                                    @foreach (App\Asset::get() as $asset)
                                                                        <tr class="">
                                                                            <td>
                                                                                {{Str::upper(Str::random(8))}}
                                                                            </td>
                                                                            
                                                                            <td class="text-muted">
                                                                                {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d-M-Y')}}
                                                                            </td>

                                                                            <td>
                                                                                {{number_format(rand(2000,5000),2)}}
                                                                            </td>
                                                                            {{--           
                                                                                @if ($loop -> last)
                                                                                    <td>
                                                                                        <a href="{{route('login')}}" class="btn shadow my-0 mr-2 shadow btn-sm btn-default text-white font-weight-light">
                                                                                            {{__('Defaulted')}}
                                                                                        </a>
                                                                                    </td>
                                                                                    @else
                                                                                    @if ($loop -> odd)
                                                                                        <td>
                                                                                            <a href="{{route('login')}}" class="btn shadow my-0 mr-2 shadow btn-sm btn-warning text-white font-weight-light">
                                                                                                {{__('Pending')}}
                                                                                            </a>
                                                                                        </td>
                                                                                    @endif
                                                                                    @if ($loop -> even)
                                                                                        <td>
                                                                                            <a href="{{route('login')}}" class="btn shadow my-0 mr-2 shadow btn-sm btn-success text-white font-weight-light">
                                                                                                {{__('Paid')}}
                                                                                            </a>
                                                                                        </td>
                                                                                    @endif --}}
                                                                            {{-- @endif --}}
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div id="defaulted" class="row pt-4 mt-5">
                                    <div  class="col-12 px-0 mt-3">
                                        <div class="row px-0 text-warning">
                                            <h2 class="col-10 text-warning mx-auto display-3">
                                                Defaulted Assets
                                            </h2>
                                            <h4 class="col-10 text-warning mx-auto">
                                                Total Defaulted : <b> <small>Ksh</small> <span class="d-none">{{$tdf = rand(15000,40000)}}</span> {{number_format($tdf,2)}}</b>
                                            </h4>    
                                            <p class="my-0 font-weight-normal col-10 mx-auto">
                                                Missed Payments : <b>{{rand(15,30)}}</b> 
                                            </p>    
                                            <p class="my-0 col-10 mx-auto">
                                                Assets : <b>{{rand(1,9)}}</b>
                                            </p>
                                            <p class="my-0 col-10 mx-auto text-black-50 py-0" style="font-size: 1.7vh">
                                                Others
                                            </p>
                                            <p class="my-0 col-10 mx-auto">
                                               
                                                <a href="#ongoing" class="text-success">
                                                    &bull; Ongoing Assets
                                                </a>
                                                <a href="#completed" class="text-primary">
                                                    &bull; Completed Assets
                                                </a>
                                            </p>
                                        </div>                                        
                                    </div>
                                </div>
                               
                                <div class="row ">
                                    <div class="input-group mb-3 col-10 offset-1 pl-0 mt-4">
                                        <input type="text" class="form-control" placeholder="Enter Asset Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <a class="input-group-text text-default" href="{{route('prods')}}" id="basic-addon2">
                                               <i class="bx bx-search-alt mr-2"></i> Find
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 px-0">
                                        @foreach(App\Asset::get() as $asset)
                                            <div class="accordion mt-3" id="accordionExample">
                                                <div class="card mb-2 rounded">
                                                    <div class="card-header my-0" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset -> id}}" aria-expanded="false" aria-controls="collapseOne">
                                                                AST.<span class="text-uppercase">{{Str::random(10)}}</span>  
                                                            </a>
                                                            
                                                        </h2>
                                                    </div>
                                                    <div id="asset{{$asset -> id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="row justify-content-between">
                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                <span class="d-none">
                                                                
                                                                </span> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Asset Value
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{number_format(14080,2)}} 
                                                            </p>
                        
                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Unit Cost
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{number_format(754,2)}} 
                                                            </p>
                        
                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Installment Amount
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{number_format(880,2)}} 
                                                            </p>
                                                      
                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Payment Interval
                                                                </span>
                                                                <br>
                                                                Weekly
                                                            </p>
                        
                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Missed Payments
                                                                </span>
                                                                <br>
                                                                8 
                                                            </p>
                                                            
                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Total Defauleted 
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{number_format(7040,2)}}
                                                            </p>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col pl-4 mb-2">
                                                                <span class="">
                                                                    <a href="" class="mr-2 btn-md font-weight-bold btn-success">
                                                                        Make Payment <small class="font-weight-bold">Ksh. 7,080.00</small>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="px-0 table-responsive mt-3">
                                                            <table class="table ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            {{__("Transaction ID")}}
                                                                        </th>
                                                                        <th>
                                                                            {{__("Transaction Date")}}
                                                                        </th>
                                                                        <th>
                                                                            {{__("Amount")}}
                                                                        </th>
                                                                        {{-- :if
                                                                            <th>
                                                                                {{__("Nyayomat Status")}}
                                                                            </th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="px-0 table-borderless">
                                                                    @foreach (App\Asset::get() as $asset)
                                                                        <tr class="">
                                                                            <td>
                                                                                {{Str::upper(Str::random(8))}}
                                                                            </td>
                                                                            
                                                                            <td class="text-muted">
                                                                                {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d-M-Y')}}
                                                                            </td>

                                                                            <td>
                                                                                {{number_format(rand(2000,5000),2)}}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                                <div id="completed" class="row mt-5 pt-4">
                                    <div class="col-12 mt-3 px-0">
                                        <div class="row px-0 text-primary">
                                            <h2 class="col-10 text-primary mx-auto display-3">
                                                Completed Assets
                                            </h2>
                                            <h4 class="col-10 text-primary mx-auto">
                                                Total Paid : <b> <span class="d-none">{{$tp = rand(15000,40000)}}</span> {{number_format($tp,2)}}</b>
                                            </h4>    
                                            <p class="my-0 font-weight-normal col-10 mx-auto">
                                                Total Payments : <b>{{rand(150,400)}}</b> 
                                            </p>    
                                            <p class="my-0 col-10 mx-auto">
                                                Assets : <b>{{rand(1,9)}}</b>
                                            </p>
                                            <p class="my-0 col-10 mx-auto text-black-50 py-0" style="font-size: 1.7vh">
                                                Others
                                            </p>
                                            <p class="my-0 col-10 mx-auto">
                                               
                                                <a href="#ongoing" class="">
                                                    &bull; Ongoing Assets
                                                </a>
                                                <a href="#defaulted" class="text-danger">
                                                    &bull; Defaulted Assets
                                                </a>
                                            </p>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="input-group mb-3 col-10 offset-1 pl-0 mt-4">
                                        <input type="text" class="form-control" placeholder="Enter Asset Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <a class="input-group-text text-default" href="{{route('prods')}}" id="basic-addon2">
                                               <i class="bx bx-search-alt mr-2"></i> Find
                                            </a>
                                        </div>
                                      </div>
                                    <div class="col-12 px-0">
                                        @foreach(App\Asset::get() as $asset)
                                            <div class="accordion mt-3" id="accordionExample">
                                                <div class="card mb-2 rounded">
                                                    <div class="card-header my-0" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <a class="btn text-primary btn-link btn-block mt-0 text-left" type="button" data-toggle="collapse" href="#asset{{$asset -> id}}" aria-expanded="false" aria-controls="collapseOne">
                                                                AST.<span class="text-uppercase">{{Str::random(10)}}</span>  
                                                            </a>
                                                            
                                                        </h2>
                                                    </div>
                                                    <div id="asset{{$asset -> id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="row justify-content-between">
                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                <span class="d-none">
                                                                
                                                                </span> 
                                                                <span class="d-none">
                                                                    {{  
                                                                        $uc =  number_format(754,2)
                                                                    }}   
                                                                </span>  
                                                                <span class="d-none">
                                                                    {{  
                                                                        $av =  number_format(14080,2)
                                                                    }} 
                                                                    {{$tp = 16}}, {{$ia = number_format(880,2) }} 
                                                                </span> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Asset Value
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{$av}} 
                                                            </p>

                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Unit Cost
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{$uc}} 
                                                            </p>

                                                            <p class="col-auto text-left my-0 mx-auto">
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Installment Amount
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{$ia}} 
                                                            </p>

                                                         
                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Payment Interval
                                                                </span>
                                                                <br>
                                                                Weekly
                                                            </p>

                                                            <p class="col-auto text-left my-0 mx-auto"> 
                                                                <span class="text-uppercase font-weight-bold" style="font-size: 1.2vh">
                                                                    Total Payments
                                                                </span>
                                                                <br>
                                                                <small>Ksh.</small> {{$tp}} 
                                                            </p>

                                                            
                                                            <div class="col-3 text-right pl-4 mb-2">
                                                                <span class="text-right">
                                                                    
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="px-0 table-responsive mt-3">
                                                            <table class="table ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            {{__("Transaction ID")}}
                                                                        </th>
                                                                        <th>
                                                                            {{__("Transaction Date")}}
                                                                        </th>
                                                                        <th>
                                                                            {{__("Amount")}}
                                                                        </th>
                                                                        {{-- :if
                                                                            <th>
                                                                                {{__("Nyayomat Status")}}
                                                                            </th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="px-0 table-borderless">
                                                                    @foreach (App\Asset::get() as $asset)
                                                                        <tr class="">
                                                                            <td>
                                                                                {{Str::upper(Str::random(8))}}
                                                                            </td>
                                                                            
                                                                            <td class="text-muted">
                                                                                {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d-M-Y')}}
                                                                            </td>

                                                                            <td>
                                                                                {{number_format(rand(2000,5000),2)}}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="trasnsaction-history" role="tabpanel" aria-labelledby="trasnsaction-history-tab">
                                
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="accordion" id="accordionExample">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-primary text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="bx bx-calendar mr-3"></i>Yesterday
                                                </button>
                                            </h2>
            
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 shadow py-3">
                                                            <div class="row">
                                                                <div class="col-12 mb-2">
                                                                    <span class="small-text font-weight-light mr-3">
                                                                        Totals
                                                                    </span> 
                                                                    
                                                                    <span class="text-muted mr-3">
                                                                        <sub>Ksh.</sub> {{number_format(0,2)}}  <i class="bx bx-minus"></i>
                                                                    </span>

                                                                    <span class="text-success mx-2 small-text">
                                                                        <sub>Ksh.</sub> {{number_format(2500,2)}}  <i class="bx bxs-up-arrow"></i>
                                                                    </span>
                                                                    
                                                                    <span class="text-danger mx-2 small-text">
                                                                        <sub>Ksh.</sub> {{number_format(2500,2)}}  <i class="bx bxs-down-arrow"></i>                                                                              
                                                                    </span>

                                                                    <span class="text-primary font-weight-light mx-2 small-text">
                                                                        Transactions: {{number_format(800,0)}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                {{__('Transaction ID')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('To')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('From')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Amount')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Category')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Timestamp')}}
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {{-- @foreach ($collection as $item)     --}}
                                                                            <tr>
                                                                                <td>
                                                                                    {{__('AVH09812JKL')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('You')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('0712 345 678')}}
                                                                                </td>
                                                                                <td>
                                                                                    <span class="mr-2">ksh</span>{{number_format(2500,2)}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('In - flow')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d-m-Y - H:i A')}}
                                                                                </td>
                                                                            </tr>
                                                                        {{-- @endforeach --}}
                        
                                                                        <tr>
                                                                            <td>
                                                                                {{__('JIK12JW1')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('0700 000 000')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('You')}}
                                                                            </td>
                                                                            <td>
                                                                                <span class="mr-2">ksh</span>{{number_format(750,2)}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('Out - flow')}}
                                                                            </td>
                                                                            <td>
                                                                                {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d-m-Y - H:i A')}}
                                                                            </td>
                                                                        </tr>
                        
                                                                        <tr>
                                                                            <td>
                                                                                {{__('AVH09812JKL')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('0711 222 333')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('You')}}
                                                                            </td>
                                                                            <td>
                                                                                <span class="mr-2">ksh</span>{{number_format(300,2)}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('Out - flow')}}
                                                                            </td>
                                                                            <td>
                                                                                {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d-m-Y - H:i A')}}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-primary text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="bx bx-calendar mr-3"></i>This Week
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 shadow py-3">
                                                            <div class="row">
                                                                <div class="col-12 mb-2">
                                                                    <span class="small-text font-weight-light mr-3">
                                                                        Totals
                                                                    </span> 
                                                                    
                                                                    <span class="text-success mr-3">
                                                                        <sub>Ksh.</sub> {{number_format(2000,2)}}  <i class="bx bxs-up-arrow"></i>
                                                                    </span>

                                                                    <span class="text-success font-weight-light mx-2 small-text">
                                                                        In-flow <sub>Ksh.</sub>{{number_format(2500,2)}}  <i class="bx bxs-up-arrow"></i>
                                                                    </span>
                                                                    
                                                                    <span class="text-danger font-weight-light mx-2 small-text">
                                                                        Out-flow <sub>Ksh.</sub> {{number_format(500,2)}}  <i class="bx bxs-down-arrow"></i>                                                                              
                                                                    </span>

                                                                    <span class="text-primary font-weight-light mx-2 small-text">
                                                                        Transactions: {{number_format(800,0)}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                {{__('Transaction ID')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('To')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('From')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Amount')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Category')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Timestamp')}}
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {{-- @foreach ($collection as $item)     --}}
                                                                            <tr>
                                                                                <td>
                                                                                    {{__('AVH09812JKL')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('You')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('0712 345 678')}}
                                                                                </td>
                                                                                <td>
                                                                                    <span class="mr-2">ksh</span>{{number_format(2500,2)}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('In - flow')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{Carbon\Carbon::parse('20-02-20', 'Africa/Nairobi')->format('d-m-Y - H:i A')}}
                                                                                </td>
                                                                            </tr>
                                                                        {{-- @endforeach --}}
                        
                                                                        <tr>
                                                                            <td>
                                                                                {{__('JIK12JW1')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('0700 000 000')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('You')}}
                                                                            </td>
                                                                            <td>
                                                                                <span class="mr-2">ksh</span>{{number_format(750,2)}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('Out - flow')}}
                                                                            </td>
                                                                            <td>
                                                                                {{Carbon\Carbon::parse('20-02-20', 'Africa/Nairobi')->format('d-m-Y - H:i A')}}
                                                                            </td>
                                                                        </tr>
                        
                                                                        <tr>
                                                                            <td>
                                                                                {{__('AVH09812JKL')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('0711 222 333')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('You')}}
                                                                            </td>
                                                                            <td>
                                                                                <span class="mr-2">ksh</span>{{number_format(300,2)}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('Out - flow')}}
                                                                            </td>
                                                                            <td>
                                                                                {{Carbon\Carbon::parse('20-02-20', 'Africa/Nairobi')->format('d-m-Y - H:i A')}}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-primary text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <i class="bx bx-calendar mr-3"></i>This Month
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 shadow py-3">
                                                            <div class="row">
                                                                <div class="col-12 mb-2">
                                                                    <span class="small-text font-weight-light mr-3">
                                                                        Totals
                                                                    </span> 
                                                                    
                                                                    <span class="text-danger mr-3">
                                                                        <sub>Ksh.</sub> {{number_format(5000,2)}}  <i class="bx bxs-down-arrow"></i>
                                                                    </span>

                                                                    <span class="text-success font-weight-light mx-2 small-text">
                                                                        In-flow <sub>Ksh.</sub>{{number_format(50000,2)}}  <i class="bx bxs-up-arrow"></i>
                                                                    </span>
                                                                    
                                                                    <span class="text-danger font-weight-light mx-2 small-text">
                                                                        Out-flow <sub>Ksh.</sub> {{number_format(55000,2)}}  <i class="bx bxs-down-arrow"></i>                                                                              
                                                                    </span>

                                                                    <span class="text-primary font-weight-light mx-2 small-text">
                                                                        Transactions: {{number_format(8000,0)}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                {{__('Transaction ID')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('To')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('From')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Amount')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Category')}}
                                                                            </th>
                                                                            <th>
                                                                                {{__('Timestamp')}}
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {{-- @foreach ($collection as $item)     --}}
                                                                            <tr>
                                                                                <td>
                                                                                    {{__('AVH09812JKL')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('You')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('0712 345 678')}}
                                                                                </td>
                                                                                <td>
                                                                                    <span class="mr-2">ksh</span>{{number_format(2500,2)}}
                                                                                </td>
                                                                                <td>
                                                                                    {{__('In - flow')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{Carbon\Carbon::parse('20-02-20', 'Africa/Nairobi')->format('d-m-Y - H:i A')}}
                                                                                </td>
                                                                            </tr>
                                                                        {{-- @endforeach --}}
                        
                                                                        <tr>
                                                                            <td>
                                                                                {{__('JIK12JW1')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('0700 000 000')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('You')}}
                                                                            </td>
                                                                            <td>
                                                                                <span class="mr-2">ksh</span>{{number_format(750,2)}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('Out - flow')}}
                                                                            </td>
                                                                            <td>
                                                                                {{Carbon\Carbon::parse('20-02-20', 'Africa/Nairobi')->format('d-m-Y - H:i A')}}
                                                                            </td>
                                                                        </tr>
                        
                                                                        <tr>
                                                                            <td>
                                                                                {{__('AVH09812JKL')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('0711 222 333')}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('You')}}
                                                                            </td>
                                                                            <td>
                                                                                <span class="mr-2">ksh</span>{{number_format(300,2)}}
                                                                            </td>
                                                                            <td>
                                                                                {{__('Out - flow')}}
                                                                            </td>
                                                                            <td>
                                                                                {{Carbon\Carbon::parse('20-02-20', 'Africa/Nairobi')->format('d-m-Y - H:i A')}}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-primary text-left collapsed" type="button" data-toggle="collapse" data-target="#longerList" aria-expanded="false" aria-controls="longerList">
                                                    <i class="bx bx-calendar mr-3"></i>Longer than this
                                                </button>
                                            </h2>
                                            <div id="longerList" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 shadow">
                                                            <div class="row">
                                                                <div class="col-12 shadow py-3">
                                                                   
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>
                                                                                        {{__('Month - Year')}}
                                                                                    </th>
                                                                                    <th>
                                                                                        {{__('Status')}}
                                                                                    </th>
                                                                                    <th>
                                                                                        {{__('Transactions')}}
                                                                                    </th>
                                                                                    <th>
                                                                                        {{__('Amount')}}
                                                                                    </th>
                                                                                    <th>
                                                                                        {{__('Action')}}
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                {{-- @foreach ($collection as $item)     --}}
                                                                                    <tr>
                                                                                        <td>
                                                                                            {{__('Jan - 2020')}}
                                                                                        </td>
                                                                                        <td>
                                                                                            <span class="text-danger mr-3">
                                                                                                <sub>Ksh.</sub> {{number_format(5000,2)}}  <i class="bx bxs-down-arrow"></i>
                                                                                            </span>
                                                                                        </td>
                                                                                        <td>
                                                                                            {{number_format(5000,0)}}
                                                                                        </td>
                                                                                        <td>
                                                                                            <span class="mr-2">ksh</span>{{number_format(70000,2)}}
                                                                                        </td>

                                                                                        <td>
                                                                                            <a href="" class="text-primary">
                                                                                                {{__('Download pdf')}}
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                {{-- @endforeach --}}
                                                                                <tr>
                                                                                    <td>
                                                                                        {{__('Feb - 2020')}}
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="text-success mr-3">
                                                                                            <sub>Ksh.</sub> {{number_format(13000,2)}}  <i class="bx bxs-up-arrow"></i>
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        {{number_format(12893,0)}}
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="mr-2">ksh</span>{{number_format(83000,2)}}
                                                                                    </td>

                                                                                    <td>
                                                                                        <a href="" class="text-primary">
                                                                                            {{__('Download pdf')}}
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        {{__('Mar - 2020')}}
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="text-success mr-3">
                                                                                            <sub>Ksh.</sub> {{number_format(17000,2)}}  <i class="bx bxs-up-arrow"></i>
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        {{number_format(13425,0)}}
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="mr-2">ksh</span>{{number_format(104000,2)}}
                                                                                    </td>

                                                                                    <td>
                                                                                        <a href="" class="text-primary">
                                                                                            {{__('Download pdf')}}
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
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
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pt-3 fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                                <div class="row">
                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Successful Applications &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Declined Applications &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>
                                    
                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Assets Received &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Payments Made &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>
                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                 Pending Payments &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Overdue  Payments  &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span> 
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Defaulted Payments  &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span> 
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Completed Payments  &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span> 
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Asset Transfer &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush