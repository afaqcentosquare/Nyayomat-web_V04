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
            <a href="{{route('group')}}" class="text-muted mr-1">
                {{Str::ucfirst("GRP-NME")}}
            </a> /
            <a href="{{route('sub-group')}}" class="text-muted mr-1">
                {{Str::ucfirst("SUB-GRP-NME")}}
            </a> /
            <a href="{{route('sub-group')}}" class="text-muted mr-1">
                {{Str::ucfirst("CTG-NME")}}
            </a> /
            <a href="" class="text-primary ml-1">
                PRODUCTS
            </a>  
        </div>
        {{-- PRODUCTS --}}
        <div class="col mx-auto px-0 shadow-sm rounded">
            <div class="accordion" id="products">
                <div id="showproducts" class="collapse px-4 show" aria-labelledby="headingOne" data-parent="#products"> 
                    <div class="header-left px-0">
                        PRODUCTS
                    </div> 
                    <span class="">
                        <a href="" class="text-muted mr-1">
                            GRP-{{Str::random(8)}} 
                        </a>
                        /
                        <a href="" class="text-muted mr-1">
                            SUB-GRP-{{Str::random(8)}} 
                        </a>
                        /
                        <span class="ml-1 font-weight-bold mr-2"> CTG </span>  :
                        <a href="{{route('group')}}">
                            {{Str::random(8)}}
                        </a>
                    </span>
                    <div class="row">
                        <div class="col-12 my-3 text-right">
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
                        <input type="text" id="myInput" class="form-control col-11 ml-4 border-0 mb-3 shadow-sm" onkeyup="myFunction()" placeholder="Find By Name ..." title="Type in a name">
                        <div class="col-12 table-responsive">
                            <table class="table ">          
                                <thead class="nyayomat-blue">   
                                    <tr>
                                        <th>Img</th>
                                        <th nowrap>
                                            Asset Name
                                        </th>
                                        <th nowrap>
                                            Asset Provider Name
                                        </th>
                                        <th>
                                            Code
                                        </th>
                                        <th>
                                            Units
                                        </th>
                                        <th nowrap>
                                            Price <small>Ksh</small>
                                        </th>
                                        <th nowrap>
                                            Payment Duration <small>Days</small>
                                        </th>
                                        <th nowrap>
                                            Deposit <small>Ksh</small>
                                        </th>
                                        <th nowrap>
                                            Payment Holiday <small>Days</small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($w = 0; $w < 10 ; $w++)    
                                        <tr>
                                            <td>
                                                <i class="bx bx-landscape"></i>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    <li class="font-weight-bold">
                                                        AST.NME.{{Str::upper(Str::random(5))}}
                                                    </li>
                                                    <li>
                                                        @if ($w %5 != 0)
                                                            <span class="text-success border-0">
                                                                <small style="font-size: 10px">
                                                                    <i class="bx bxs-circle mr-1"></i> 
                                                                    Engaged
                                                                </small>
                                                            </span>
                                                            @else     
                                                            <span class="text-muted border-0">
                                                                <small style="font-size: 10px">
                                                                    <i class="bx bxs-circle mr-1"></i> 
                                                                    Idle
                                                                </small>
                                                            </span>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </td>
                                            <td nowrap>
                                                PRVDR.{{Str::upper(Str::random(8))}}
                                            </td>
                                            </td>
                                            <td nowrap>
                                                {{Str::random(8)}}
                                            </td>
                                            <td nowrap>
                                                {{number_format(rand(1000,10000),2)}}
                                            </td>
                                            <td nowrap>
                                                {{rand(10,90)}}
                                            </td>
                                            <td nowrap>
                                                {{rand(10,90)}}
                                            </td>
                                            <td nowrap>
                                                {{number_format(rand(1000,10000),2)}}
                                            </td>
                                            <td nowrap>
                                                {{rand(10,90)}}
                                            </td>
                                            
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0 mx-0">
                    <div id="newproduct" class="collapse" aria-labelledby="headingTwo" data-parent="#products">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showproducts" aria-expanded="true" aria-controls="showproducts">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW PRODUCT
                                </h5>
                            </div>

                            <form action="" class="row">
                               
                                <div class="col-md-4 mb-4">
                                    <p class="col-12 px-0">
                                        Product Image :
                                    </p>
                                    <input type="file"  class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <p class="col-12 px-0">
                                        Asset Provider :
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <p class="col-12 px-0">
                                        Holiday Provision :
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-md-4 col-6 mb-4">
                                    <p class="col-12 px-0">
                                        Deposit Amount  :
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-md-4 col-6 mb-4">
                                    <p class="col-12 px-0">
                                        Payment Duration :
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-md-4 col-6 mb-4">
                                    <p class="col-12 px-0">
                                        Installment Amount :
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-md-6 col-6 mb-4">
                                    <p class="col-12 px-0">
                                        Payment Frequency :
                                    </p>
                                    <select name="" class="col-12 bg-white shadow-sm py-2 rounded border-0 mx-auto" autocomplete="off" id="">
                                        <option value="">
                                           -- Set Frequency -- 
                                        </option>
                                        <option value="">
                                            Weekly
                                        </option>
                                        <option value="">
                                            Monthly
                                        </option>
                                    </select>
                                </div>                        
                                <div class="col-12 text-center">
                                    <a href="" class="btn btn-sm shadow-sm bg-nyayomat-blue text-white">
                                        <i class="bx bx-plus mr-1"></i>Add
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush