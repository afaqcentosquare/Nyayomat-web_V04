@extends('layouts.backend.main', 
                        [
                            'title' => __("My Stock"),
                            'page_name' => 'Stock Manager',
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

    <a href="{{route('faqs')}}" class="nav_link">
        <i class='bx bx-question-mark nav_icon'></i>
        <span class="nav_name">
            Faqs
        </span>
    </a>
    <a href="{{route('actors')}}" class="nav_link">
        <i class='bx bx-user nav_icon'></i>
        <span class="nav_name">
            System Actors
        </span>
    </a>

    <a href="{{route('subscriptions')}}" class="nav_link">
        <i class='bx bx-recycle nav_icon'></i>
        <span class="nav_name">
            Subscriptions
        </span>
    </a>

    <a href="{{route('roles')}}" class="nav_link">
        <i class='bx bx-user nav_icon'></i>
        <span class="nav_name">
            Roles
        </span>
    </a>
    <a href="{{route('sliders')}}" class="nav_link">
        <i class='bx bx-gift nav_icon'></i>
        <span class="nav_name">
            Products
        </span>
    </a>
    <a href="{{route('sliders')}}" class="nav_link">
        <i class='bx bx-expand nav_icon'></i>
        <span class="nav_name">
            Sliders
        </span>
    </a>

    <a href="{{route('banners')}}" class="nav_link">
        <i class='bx bx-expand nav_icon'></i>
        <span class="nav_name">
            Banners
        </span>
    </a>
    <a href="{{route('pages')}}" class="nav_link">
        <i class='bx bx-book-open nav_icon'></i>
        <span class="nav_name">
            Pages
        </span>
    </a>

    <a href="{{route('announcements')}}" class="nav_link">
        <i class='bx bx-book-open nav_icon'></i>
        <span class="nav_name">
            Announcements
        </span>
    </a>

    <a href="{{route('announcements')}}" class="nav_link">
        <i class='bx bx-book-open nav_icon'></i>
        <span class="nav_name">
            Announcements
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
                Stock Manager
            </a>  
        </div>
    </div>
     {{-- Search Table and New Promotion --}}
     <div class="row mb-4">
        <div class="col-md-7 col-0 d-none d-md-block">
            <input type="text" id="myInput" class="form-control col-12" onkeyup="myFunction()" placeholder="Search Inventory.." title="Type in a name">
        </div>
    </div>
    <ul class="nav nav-pills nav-list mb-3" id="pills-tab" role="tablist">
        <li class="nav-item mr-2" role="presentation">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                Assets
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                <i class="bx bx-plus-circle mr-2"></i>New
            </a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th class="font-weight-normal">
                                    Img
                                </th>
                                <th class="font-weight-normal">
                                    Name
                                </th>
                                <th class="font-weight-normal">
                                    <span class="mr-2">
                                        Category
                                    </span>
                                </th>
                                <th nowrap class="font-weight-normal">
                                    <span class="mr-2">
                                        Sub Category
                                    </span>
                                </th>
                                <th nowrap class="font-weight-normal">
                                    <span class="mr-2">
                                        Unit Cost
                                    </span>
                                </th>
                                <th class="font-weight-normal">
                                    <span class="mr-2">
                                        Qty
                                    </span>
                                </th>
                                <th nowrap class="font-weight-normal">
                                    <span class="mr-2">
                                        Installment Amount
                                    </span>
                                </th>
                                <th class="font-weight-normal">
                                    <span class="mr-2">
                                        Installments
                                    </span>
                                </th>
                                <th class="font-weight-normal">
                                    <span class="mr-2">
                                        Holiday
                                    </span>
                                </th>
                                <th nowrap class="font-weight-normal">
                                    <span class="mr-2">
                                        Payment Frequency
                                    </span>
                                </th>
                                <th nowrap class="font-weight-normal">
                                    <span class="mr-2">
                                        Asset Provider
                                    </span>
                                </th>
                                <th class="font-weight-normal">
                                    <span class="mr-2">
                                        Status
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10 ; $i++)
                                <tr class="accordion" id="accordionExample2">
                                    <td>
                                        <i class="bx bx-landscape"></i>
                                    </td>
                                    <td nowrap class="text-uppercase">
                                        {{str::random(10)}}
                                    </td>
                                    <td nowrap>
                                        <span class="text-muted">
                                            -- null --
                                        </span>
                                    </td>
                                    <td nowrap>
                                        <span class="text-muted">
                                            -- null --
                                        </span>
                                    </td>
                                    
                                    <td nowrap>
                                        <span class="d-none">
                                            {{$cost = rand(50000,100000)}}
                                            {{$installment = rand(20,49)}}
                                        </span>
                                        <small class="">Ksh </small>{{number_format($cost, 2)}}
                                    </td>
        
                                    <td nowrap>
                                        {{number_format($qty = rand(50,100),0)}}
                                    </td>
        
                                    <td nowrap>
                                        <small>Ksh</small>
                                        {{number_format($installment_amount = ($cost / $installment),2)}}
                                    </td>
        
                                    <td nowrap>
                                        {{number_format($installment,0)}}
                                    </td>
        
                                    <td nowrap class="font-weight-light">
                                        {{number_format($qty = rand(30,90),0)}}
                                    </td>
                                    <td nowrap class="font-weight-light">
                                        @if ($i %2 == 0)
                                            Weekly
                                        @else
                                            Monthly
                                        @endif
                                    </td>
                                    <td nowrap class="text-uppercase">
                                        <a href="" class="">
                                            provider.{{str::random(10)}}
                                        </a>
                                    </td>
                                    <td nowrap class="font-weight-light font-weight-bold">
                                        @if ($i %2 == 0)
                                            <span class="text-success">
                                                Engaged
                                            </span>
                                        @else
                                            <span class="text-muted">
                                                Open
                                            </span>
                                        @endif
                                    </td>
                                   
                                </tr>       
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row my-4 nyayomat-blue">
                <h4 class="col-12 mb-0">
                    Product Specifications
                </h4>
                <small class="col-12">
                    Kindly Fill in  all the fields below
                </small>
            </div>
            <form action="" class="row">
                <div class="col-md-4 mb-3">
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="bx bx-tag"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Asset Type">
                    </div>
                </div>
                

                <div class="col-md-4 mb-3">
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="bx bx-hash"></i>
                            </div>
                        </div>
                        <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Payment Holiday Duration   ">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="bx bx-hash"></i>
                            </div>
                        </div>
                        <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Deposit Amount">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="bx bx-hash"></i>
                            </div>
                        </div>
                        <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Balance Repayment">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="bx bx-hash"></i>
                            </div>
                        </div>
                        <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Installment Amount">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="bx bx-recycle"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Payment Frequency">
                    </div>
                </div>

                <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" autocomplete="off" id="customCheckRegister" type="checkbox">
                        <label class="custom-control-label" for="customCheckRegister">
                            <span class="text-muted">
                                {{ __('I agree with the') }} 
                                <a href="#!">
                                    {{Str::title(config('app.name'))}} 
                                    {{ __('Terms of Service') }}
                                </a>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" disabled class="btn text-white bg-nyayomat-blue mt-4">
                        {{ __('Submit') }}
                    </button>
                </div>
                
            </form>
        </div>
    </div>
    {{-- Table --}}
    

    {{-- Modals --}}
    
    {{-- @include('jamo.components.bs-4.modal') --}}
    
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
        function onlyNumberKey(evt) { 
            // Only ASCII charactar in that range allowed 
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
                return false; 
            return true; 
        } 
    </script>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
@endpush