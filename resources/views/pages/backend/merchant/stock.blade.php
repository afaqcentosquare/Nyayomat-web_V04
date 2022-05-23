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
            
            .modal{
                width: 100vw;
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

    <a href="{{route('merchant-stocks')}}" class="nav_link active"> 
        <i class='bx bx-coin-stack nav_icon'></i> 
        <span class="nav_name">
            Stock
        </span>
    </a>

    <a href="{{route('merchant-product')}}" class="nav_link">
        <i class='bx bx-package nav_icon'></i>
        <span class="nav_name">
            Products &amp; Assets
        </span>
    </a>
  
    <a href="" class="nav_link"> 
        <i class='bx bx-alarm-exclamation nav_icon'></i> 
        <span class="nav_name">
            Disputes
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
                {{Illuminate\Support\Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-primary ml-1">
                Stock Manager
            </a>  
        </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="row mb-4">
            <div class="col-7 flex col-0 d-none d-md-block">
                <input type="text" id="myInput" class="form-control col-12" onkeyup="myFunction()" placeholder=" Find Product . . . " title="Type in a name">
            </div>
            <div class="col-3">
                <button class="btn-sm btn btn-success py-2">
                    <i class="bx bx-plus mr-2 "></i>Add Inventory
                </button>
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
                                <span class="mr-2">Price</span>
                            </th>
                            <th class="font-weight-normal" data-card-action>
                                <span class="mr-2">Qty</span>
                            </th>
                            
                            <th class="font-weight-normal" data-card-action>
                                <span class="mr-2">Value</span>
                            </th>
                            <th class="font-weight-normal" data-card-footer>
                                Stock
                            </th>
                            <th class="font-weight-normal" data-card-footer>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(stocklist() as $stock)
                            <tr class="accordion" id="accordionExample2">
                                <td>

                                    @if(!empty($stock->image['path']))
                                    @php
                                    $path = $stock->image['path'];
                                    @endphp
                              
                                    <img src="{{asset('image/'.$path.'?p=tiny')}}" />
                                   
                                    @else
                                    No Image
                                    @endif

                                </td>
                                <td nowrap>
                                   {{$stock->title}}
                                </td>
    
                                <td nowrap>
                                   
                                    <span class="font-weight-light">
                                        <small class="">Ksh.</small>&nbsp;{{number_format($stock->sale_price,2)}}
                                    </span>
                                </td>
    
                                <td nowrap>
                                    <span class="font-weight-light">
                                        {{$stock->stock_quantity}}
                                    </span>
                                </td>
    
    
                                <td nowrap>
                                    
                                    <span class="font-weight-light">
                                        <small class="">Ksh.</small>&nbsp;{{number_format($stock->stock_quantity*$stock->sale_price,2)}}
                                    </span>
                                </td>
    
                                <td nowrap class="font-weight-light">
                                    <span class="d-none">
                                        {{$i = 9}}
                                    </span>
                                    @if ($stock->stock_quantity >= 5)
                                        <span class="text-info">
                                            Available
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            Out of stock
                                        </span>
                                    @endif
                                </td>
                                
                                <td nowrap class="font-weight-light">
                                    <a href="#restock{{$i}}" data-toggle="modal" class="mb-3 collapsed btn font-weight-light btn-sm btn-success mr-2">
                                        Restock &nbsp;<i class="bx bx-up-arrow-alt ms-2"></i>
                                    </a>  
                                    
                                    <a href="#discontinue{{$i}}" data-toggle="modal"  class="mb-3 collapsed btn font-weight-light btn-sm btn-danger mr-2">
                                        Discontinue &nbsp;<i class="bx bx-no-entry ms-2"></i>
                                    </a>
                                </td>

                                
                                <div class="col-12 modal text-muted" id="restock{{$i}}"  data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Restock Product {{$i}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label for="exampleInputEmail1" style="font-size: .8rem">
                                                                Price  (ksh)
                                                            </label>
                                                            <input type="text" class="form-control" placeholder=" {{$stock->purchase_price}}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="exampleInputEmail1" style="font-size: .8rem">
                                                                Quantity (units)
                                                            </label>
                                                            <input type="text" class="form-control" placeholder=" {{$stock->stock_quantity}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-12 text-center">
                                                            <button type="submit" class="btn btn-primary">
                                                                Restock
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 modal text-muted" id="discontinue{{$i}}" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Discontinue Product {{$i}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-row">
                                                        <h4 class="col-12 text-center">
                                                            {{__("Are you sure")}}
                                                        </h4>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-6 text-center">
                                                            <button type="submit" class="btn btn-block btn-danger">
                                                                Yes
                                                            </button>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <button type="submit" class="btn btn-block btn-primary">
                                                                No
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>       
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  

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