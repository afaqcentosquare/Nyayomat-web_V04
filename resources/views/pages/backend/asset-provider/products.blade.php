@extends('layouts.backend.main', 
                        [
                            'title' => __("Engaged Assets"),
                            'page_name' => 'Engaged Assets',
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

    <a href="{{route('merchant-transactions')}}" class="nav_link">
        <i class='bx bx-money nav_icon'></i>
        <span class="nav_name">
            Transactions    
        </span> 
    </a> 

    <a href="{{route('merchant-stock')}}" class="nav_link"> 
        <i class='bx bx-coin-stack nav_icon'></i> 
        <span class="nav_name">
            Open Assets
        </span>
    </a>

    <a href="{{route('merchant-product')}}" class="nav_link active">
        <i class='bx bx-recycle nav_icon'></i>
        <span class="nav_name">
            Engaged Assets
        </span>
    </a>
  
    <a href="{{route('merchant-disputes')}}" class="nav_link"> 
        <i class='bx bx-alarm-exclamation nav_icon'></i> 
        <span class="nav_name">
            Complaints
        </span>
    </a>
    
    <a href="{{route('merchant-stats')}}" class="nav_link"> 
        <i class='bx bx-doughnut-chart nav_icon'></i>   
        <span class="nav_name">
            Statistics 
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
                Engaged Assets
            </a>  
        </div>
    </div>
     {{-- Search Table and New Promotion --}}
     <div class="row mb-4">
        <div class="col-md-7 col-0 d-none d-md-block">
            <input type="text" id="myInput" class="form-control col-12" onkeyup="myFunction()" placeholder="Search Inventory.." title="Type in a name">
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th class="font-weight-normal" data-card-title>
                            Img
                        </th>
                        <th class="font-weight-normal" data-card-title>
                            Name
                        </th>
                        <th class="font-weight-normal" data-card-action>
                            <span class="mr-2">Unit Cost</span>
                        </th>
                        <th class="font-weight-normal" data-card-action>
                            <span class="mr-2">Qty</span>
                        </th>
                        <th class="font-weight-normal" data-card-action>
                            <span class="mr-2">Total Value</span>
                        </th>
                        <th nowrap class="font-weight-normal" data-card-action>
                            <span class="mr-2">Installment Amount</span>
                        </th>
                        <th class="font-weight-normal" data-card-action>
                            <span class="mr-2">Installments</span>
                        </th>
                        <th class="font-weight-normal" data-card-action>
                            <span class="mr-2">Holiday</span>
                        </th>
                        <th nowrap class="font-weight-normal" data-card-action>
                            <span class="mr-2">Payment Frequency</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10 ; $i++)
                        <tr class="accordion" id="accordionExample2">
                            <span class="d-none">
                                {{$cost = rand(50000,100000)}}
                                {{$installment = rand(20,49)}}
                            </span>
                            <td>
                                <i class="bx bx-landscape"></i>
                            </td>
                            <td nowrap class="text-uppercase">
                                {{str::random(10)}}
                            </td>

                            <td nowrap>
                                <small class="">Ksh </small>{{number_format($cost, 2)}}
                            </td>

                            <td nowrap>
                                {{number_format($qty = rand(50,100),0)}}
                            </td>

                            <td nowrap>
                                <small>Ksh</small> {{number_format(($cost * $qty))}}
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
                        </tr>       
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    {{-- Table --}}
    

    {{-- Modals --}}
    
    {{-- @include('jamo.components.bs-4.modal') --}}
    
@endsection

@push('scripts')
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