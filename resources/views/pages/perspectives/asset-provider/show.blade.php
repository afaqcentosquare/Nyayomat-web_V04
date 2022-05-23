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
                            Listings
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
                            Notifications
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 mt-4 px-2">
                <div class="mx-0 mx-auto mx-md-3">
                    <div class="">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active fade" id="transactions-today" role="tabpanel" aria-labelledby="transactions-today-tab">
                                <div class="row">
                                    <div class="col-12 text-center mt-5">
                                        <span class="font-weight-bold">
                                            {{__('Ksh.')}}    
                                        </span>
                                        <h1 class="display-1 font-weight-light text-success text-success">
                                            {{number_format(4687,2)}}
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
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="assets" role="tabpanel" aria-labelledby="assets-tab">
                                @include('pages.perspectives.asset-provider.assets.new')
                            </div>
                            <div class="tab-pane fade" id="asset-history" role="tabpanel" aria-labelledby="asset-history-tab">
                                @include('pages.perspectives.asset-provider.assets.history')
                            </div>
                            <div class="tab-pane pt-3 fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                                <div class="row">
                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                New Listings &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Verified Applications &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>
                                    
                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Assets Disbursed &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Payments Receipts &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div class="card-header col-10 mb-3 rounded bg-default py-0" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn mt-0 text-white btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Completed Payments &nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-secondary">{{rand(5,15)}}</span> 
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
                            <div class="tab-pane fade" id="clients" role="tabpanel" aria-labelledby="clients-tab">
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
                                                                        {{__('Name')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Weight')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('B.P')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('S.P')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Qty')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Value')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Value')}}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {{-- @foreach ($collection as $item)     --}}
                                                                    <tr>
                                                                        <td>
                                                                            {{__(' Item Name')}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('500 mg')}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(35,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(40,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(20,0)}}            
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(8000,2)}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="#updateItemModal" data-toggle="modal" class="mr-2   shadow p-1 btn btn-sm btn-primary m-0 rounded mb-3">
                                                                                <i class="bx bx-pencil"></i>
                                                                            </a>
                                                                            <a href="" class="mr-3 shadow p-1 btn btn-sm btn-danger m-0 rounded mb-3">
                                                                                <i class="bx bx-trash text-white"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            {{__(' Item Name')}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('500 mg')}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(35,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(40,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(20,0)}}            
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(8000,2)}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="#updateItemModal" data-toggle="modal" class="mr-2   shadow p-1 btn btn-sm btn-primary m-0 rounded mb-3">
                                                                                <i class="bx bx-pencil"></i>
                                                                            </a>
                                                                            <a href="" class="mr-3 shadow p-1 btn btn-sm btn-danger m-0 rounded mb-3">
                                                                                <i class="bx bx-trash text-white"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            {{__(' Item Name')}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('500 mg')}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(35,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(40,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(20,0)}}            
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(8000,2)}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="#updateItemModal" data-toggle="modal" class="mr-2   shadow p-1 btn btn-sm btn-primary m-0 rounded mb-3">
                                                                                <i class="bx bx-pencil"></i>
                                                                            </a>
                                                                            <a href="" class="mr-3 shadow p-1 btn btn-sm btn-danger m-0 rounded mb-3">
                                                                                <i class="bx bx-trash text-white"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            {{__(' Item Name')}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('500 mg')}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(35,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(40,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(20,0)}}            
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(8000,2)}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="#updateItemModal" data-toggle="modal" class="mr-2   shadow p-1 btn btn-sm btn-primary m-0 rounded mb-3">
                                                                                <i class="bx bx-pencil"></i>
                                                                            </a>
                                                                            <a href="" class="mr-3 shadow p-1 btn btn-sm btn-danger m-0 rounded mb-3">
                                                                                <i class="bx bx-trash text-white"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                {{-- @endforeach --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="outstanding" role="tabpanel" aria-labelledby="outstanding-tab">
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
                                                                        {{__('Name')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Weight')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('B.P')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('S.P')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Qty')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Value')}}
                                                                    </th>
                                                                    <th>
                                                                        {{__('Value')}}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                {{-- @foreach ($collection as $item)     --}}
                                                                    <tr>
                                                                        <td>
                                                                            {{__(' Item Name')}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('500 mg')}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(35,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(40,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(20,0)}}            
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(8000,2)}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="#updateItemModal" data-toggle="modal" class="mr-2   shadow p-1 btn btn-sm btn-primary m-0 rounded mb-3">
                                                                                <i class="bx bx-pencil"></i>
                                                                            </a>
                                                                            <a href="" class="mr-3 shadow p-1 btn btn-sm btn-danger m-0 rounded mb-3">
                                                                                <i class="bx bx-trash text-white"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            {{__(' Item Name')}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('500 mg')}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(35,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(40,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(20,0)}}            
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(8000,2)}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="#updateItemModal" data-toggle="modal" class="mr-2   shadow p-1 btn btn-sm btn-primary m-0 rounded mb-3">
                                                                                <i class="bx bx-pencil"></i>
                                                                            </a>
                                                                            <a href="" class="mr-3 shadow p-1 btn btn-sm btn-danger m-0 rounded mb-3">
                                                                                <i class="bx bx-trash text-white"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            {{__(' Item Name')}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('500 mg')}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(35,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(40,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(20,0)}}            
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(8000,2)}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="#updateItemModal" data-toggle="modal" class="mr-2   shadow p-1 btn btn-sm btn-primary m-0 rounded mb-3">
                                                                                <i class="bx bx-pencil"></i>
                                                                            </a>
                                                                            <a href="" class="mr-3 shadow p-1 btn btn-sm btn-danger m-0 rounded mb-3">
                                                                                <i class="bx bx-trash text-white"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            {{__(' Item Name')}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('500 mg')}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(35,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(40,2)}}
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(20,0)}}            
                                                                        </td>
                                                                        <td>
                                                                            {{number_format(8000,2)}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="#updateItemModal" data-toggle="modal" class="mr-2   shadow p-1 btn btn-sm btn-primary m-0 rounded mb-3">
                                                                                <i class="bx bx-pencil"></i>
                                                                            </a>
                                                                            <a href="" class="mr-3 shadow p-1 btn btn-sm btn-danger m-0 rounded mb-3">
                                                                                <i class="bx bx-trash text-white"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                {{-- @endforeach --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="trasnsaction-history" role="tabpanel" aria-labelledby="trasnsaction-history-tab">
                                <div class="row mt-4">
                                    <p class="col-12">
                                        <a href="#makePaymentmodal" data-toggle="modal" class="ml-md-4 btn btn-sm btn-secondary">
                                            {{__('Make Disbursment')}}
                                        </a>
                                    </p>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
@endsection

@push('js')

@endpush