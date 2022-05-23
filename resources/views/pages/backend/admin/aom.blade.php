@extends('layouts.acp', 
                        [
                            'title' => __("Product Catalog"),
                            'page_name' => 'Product Catalog',
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
                {{Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted mr-1">
                {{Str::ucfirst("Super Admin")}}
            </a> /
            <a href="" class="text-primary ml-1">
                Products
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- Product --}}
        <div class="col-md-12 px-0 mx-auto shadow-sm rounded">
            <div class="accordion" id="product">
                <div id="showproduct" class="collapse px-4 show" aria-labelledby="headingOne" data-parent="#product"> 
                    <div class="header-left px-0">
                        PRODUCTS
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newproduct" aria-expanded="false" aria-controls="newproduct">
                                NEW PRODUCT
                            </a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mb-4 text-left">
                            <span class="mr-2">
                               <i class="bx bx-expand mr-2"></i> Showing
    
                                <select name="" class="mx-1 rounded shadow-sm px-auto border-0" id="">
                                    @for ($w = 0; $w< 10; $w++)
                                        <option value="">
                                            {{(($w + 1 )* 5)}}
                                        </option>
                                    @endfor
                                </select>
    
                                rows
                            </span>
                            <a class="nyayomat-blue ml-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bx bx-link-external mr-2"></i>  Export Information
                            </a>
                        </div>
                        <div class="collapse col-12 mb-4" id="collapseExample">
                            <span class="text-uppercase font-weight-bold">
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
                                            Group
                                        </th>
                                        <th nowrap>
                                            Sub Groups
                                        </th>
                                        <th>
                                            Categories
                                        </th>
                                        <th>
                                            Products
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="accordion" id="groupDescription">
                                    @for ($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td nowrap>
                                                <a  data-toggle="collapse" href="#{{$descr = Str::random(8)}}" aria-expanded="false" aria-controls="{{Str::random(8)}}" class="mr-1 nyayomat-blue">
                                                    <i class="bx bx-info-circle"  style="font-size: 14px"></i>
                                                </a>
                                                GRP.{{$grp_name = Str::random(8)}}
                                            </td>
                                            <td>
                                                <a href="{{route('acp-sub-group')}}" class="nyayomat-blue font-weight-bolder">
                                                    {{$sg = rand(10,50)}}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="nyayomat-blue font-weight-bolder">
                                                    {{$c = rand(100,200)}}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="nyayomat-blue font-weight-bolder">
                                                    {{$p = number_format(rand(1000,2000),0)}}
                                                </a>
                                            </td>
                                            <td nowrap>
                                                <a  data-toggle="collapse" href="#{{$prd = Str::random(8)}}" aria-expanded="false" aria-controls="{{Str::random(8)}}" class="btn btn-sm shadow-sm font-weight-bold btn-outline-success">
                                                    Add Product
                                                </a>
                                            </td>
                                        </tr>
                                        <tr id="{{$descr}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                                            <td colspan="5">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam nulla impedit sunt culpa, fuga ullam possimus voluptatum eum quos, ipsum molestias excepturi omnis dolore voluptatem blanditiis sequi aspernatur suscipit maxime.
                                                <br class="my-2">
                                                <a class="btn btn-sm shadow-sm btn-success mr-2">
                                                    <i class="bx bx-edit mr-1" style="font-size: 14px"></i> Edit
                                                </a>
                                                <a  data-toggle="collapse" href="#{{$trash = Str::random(8)}}" aria-expanded="false" aria-controls="{{Str::random(8)}}" class="mr-1 btn btn-sm shadow-sm btn-outline-danger">
                                                        <i class="bx bx-trash mr-1" style="font-size: 14px"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <tr id="{{$prd}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                                            <td colspan="5">
                                                <div class="row">
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Group
                                                            </h6>
                                                            <span class="col-12">
                                                                GRP {{$grp_name}}
                                                            </span>
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
                                                            Add  <i class="bx ml-1 bx-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
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
