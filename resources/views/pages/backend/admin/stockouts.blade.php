@extends('layouts.backend.main', 
                        [
                            'title' => __("Stockouts"),
                            'page_name' => 'Stockouts',
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
            
            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }
            .header-center {
                font-size: 2rem;
                display: grid;
                grid-template-columns: 1fr max-content 1fr;
                grid-column-gap: 1.2rem;
                align-items: center;
                opacity: 0.8;
                
            }
            .header-left {
                font-size: 2rem;
                display: grid;
                grid-template-columns: 0fr max-content 1fr;
                grid-column-gap: 1.2rem;
                align-items: center;
                opacity: 0.8;
                margin-left: -20px;
            }
            .header-right {
                font-size: 2rem;
                display: grid;
                grid-template-columns: 1fr max-content 0fr;
                grid-column-gap: 1.2rem;
                align-items: center;
                opacity: 0.8;
                
            }

            .header-right::before,
            .header-right::after {
                content: "";
                display: block;
                height: 1px;
                background-color: #000;
            }
            .header-left::before,
            .header-left::after {
                content: "";
                display: block;
                height: 1px;
                background-color: #000;
            }
            .header-center::before,
            .header-center::after {
                content: "";
                display: block;
                height: 1px;
                background-color: #000;
            }
            .card{
                border-top: 0 !important;
                margin-top: 15px !important;
            }
            .collapse{
                width: 100%
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
@endpush


@section('content')
    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-12 mt-2 mb-3 font-weight-light">
            <i class='bx bx-subdirectory-right mr-2 text-primary' style="font-size: 2.8vh;"></i>
            <a href="" class="text-muted mr-1">
                {{config('app.name')}}
            </a> /
            <a href="" class="text-muted mr-1">
                asdasd
            </a> 
            <a href="" class="text-primary ml-1">
                Stockouts
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- <div class="dropdown col-md-12 mx-auto px-0  mb-4">
            <a class="btn bg-nyayomat-blue text-white shadow " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categories <i class="bx bxs-chevron-right" style="font-size: 12px"></i>
            </a>
            <ul class="dropdown-menu multi-level border-0" role="menu" aria-labelledby="dropdownMenu">
                
                <li class="dropdown-divider"></li>
                <li class="dropdown-submenu">
                    <a class="dropdown-item" tabindex="-1" href="#">
                        Existing Groups
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm">

                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="#">
                                Existing Sub-group
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg">
                                <li class="dropdown-item">
                                    <a href="" >
                                        Existing Categories
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a class="btn btn-sm btn-success" style="border-radius: 8px" href="#">
                                        <i class="bx bx-plus" style="font-size: 12px"></i> New Category
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-item">
                            <a class="btn btn-sm btn-success" style="border-radius: 8px" href="#">
                                <i class="bx bx-plus" style="font-size: 12px"></i> New Sub Group
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-item">
                    <a class="btn btn-sm btn-success" style="border-radius: 8px" href="#">
                        <i class="bx bx-plus" style="font-size: 12px"></i> New Group
                    </a>
                </li>
            </ul>
        </div> --}}
        {{-- Product --}}
        <div class="col-md-12 px-0 mx-auto shadow-sm rounded">
            <div class="accordion" id="product">
                <div id="showproduct" class="collapse px-4 show" aria-labelledby="headingOne" data-parent="#product"> 
                    <div class="header-left text-uppercase px-0">
                        Stockouts
                    </div>                     
                    <div class="row">
                        <div class="col mb-4 text-left">
                            <a class="nyayomat-blue ml-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bx bx-link-external mr-2"></i>  Export Information
                            </a>
                        </div>
                        <div class="collapse col-12 mb-4" id="collapseExample">
                            <span class="text-uppercase ml-3 text-muted font-weight-bold">
                                Select Method :
                            </span>
                            <br class="mb-2">
                            <a nowrap href="" class="mr-2  nyayomat-blue mx-3">
                                <i class="bx bxs-file-pdf"></i> Portable Document Format <code>(PDF)</code>
                            </a>
                            <a nowrap href="" class="mr-2 nyayomat-blue mx-3">
                                <i class="bx bx-spreadsheet"></i> Excel
                            </a>

                            <a nowrap href="" class="mr-2 nyayomat-blue mx-3">
                                <i class="bx bx-spreadsheet"></i> Comma Separated Values <code>(CSV)</code>
                            </a>

                            <a nowrap href="" class="mr-2 nyayomat-blue mx-3">
                                <i class="bx bx-printer"></i> Print
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th nowrap>
                                            Shop
                                        </th>
                                        <th nowrap>
                                            Items
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($data as $key => $shop_info)
                                <tbody class="accordion" id="groupDescription{{$key}}">
                                   
                                    <tr>
                                        <td nowrap>
                                            <a  data-toggle="collapse"  aria-expanded="false" aria-controls="" class="mr-1 nyayomat-blue">
                                                <i class="bx bx-info-circle"  style="font-size: 14px"></i>
                                            </a>
                                            {{$shop_info->name}}
                                        </td>
                                        <td>
                                            <a class="nyayomat-blue font-weight-bolder">
                                                {{$shop_info->item_count}}
                                            </a>
                                        </td>
                                        <td nowrap>
                                            <a  data-toggle="collapse" data-target="#stockcollapse{{$key}}" aria-expanded="false" aria-controls="" class="btn btn-sm shadow-sm font-weight-bold btn-info"> 
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                   
                                       @foreach ($product_details as $product_detail)
                                            @if ($product_detail->shop_id == $shop_info->shop_id)
                                            <tr id="stockcollapse{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription{{$key}}">    
                                            <td colspan="3">
                                                    
                                                <div class="row">
                                                    <div class="col-6">
                                                            {{$product_detail->title}}
                                                    </div>
                                                    <div class="col-6">
                                                            {{$product_detail->stock_quantity}}
                                                    </div>
                                                </div>
                                            </td> 
                                        </tr>
                                       @endif
                                       @endforeach
                                        
                                    
                            </tbody>
                                @endforeach
                               
                            </table>
                            {{$data->links()}}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div id="newproduct" class="collapse" aria-labelledby="headingTwo" data-parent="#product">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showproduct" aria-expanded="true" aria-controls="showproduct">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW PRODUCT
                                </h5>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3 px-4">
                                    <div class="row">
                                        <h6 class="col-12">
                                            Group
                                        </h6>
                                        <select name="" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                            <option value="">
                                               -- Select Group -- 
                                            </option>
                                            <option value="">
                                                Group Name
                                            </option>
                                            <option value="">
                                                Group Name
                                            </option>
                                            <option value="">
                                                Group Name
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 px-4">
                                    <div class="row">
                                        <h6 class="col-12">
                                            Sub Group
                                        </h6>
                                        <select name="" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                            <option value="">
                                                -- Select Sub Group --
                                            </option>
                                            <option value="">
                                                Sub Group Name
                                            </option>
                                            <option value="">
                                                Sub Group Name
                                            </option>
                                            <option value="">
                                                Sub Group Name
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 px-4">
                                    <div class="row">
                                        <h6 class="col-12">
                                            Category
                                        </h6>
                                        <select name="" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                            <option value="">
                                                -- Select Category --
                                            </option>
                                            <option value="">
                                                Category Name
                                            </option>
                                            <option value="">
                                                Category Name
                                            </option>
                                            <option value="">
                                                Category Name
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 px-4">
                                    <div class="row">
                                        <h6 class="col-12">
                                            Product Name
                                        </h6>
                                        <input type="text" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" placeholder="Product Name" autocomplete="off" id="">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 px-4">
                                    <div class="row">
                                        <h6 class="col-12">
                                            Product Img
                                        </h6>
                                        <input type="file" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" placeholder="" autocomplete="off" id="">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <a href="" class="btn btn-success btn-sm shadow-sm">
                                        Add Product <i class="bx ml-1 bx-paper-plane"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script> 
    function onlyNumberKey(evt) { 
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
</script>
@endpush