@extends('layouts.backend.main', 
                        [
                            'title' => __("PRODUCTS"),
                            'page_name' => 'PRODUCTS',
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
                {{Illuminate\Support\Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted mr-1">
                {{Illuminate\Support\Str::ucfirst("Super Admin")}}
            </a>/
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
                        
                        <span class="ml-1 font-weight-bold mr-2"> Product </span>  :  
                        <a href="{{route('group')}}">
                           
                        </a>
                    </span>
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
                        <input type="text" id="myInput" class="form-control col-11 ml-4 border-0 mb-3 shadow-sm" onkeyup="myFunction()" placeholder="Find By Name ..." title="Type in a name">
                        <div class="col-12 table-responsive">
                            <table class="table"  id="myTable">
                                <thead>
                                    <tr>
                                        <th>
                                            Image  
                                        </th>
                                        <th>
                                            Name  
                                        </th>
                                        <th>
                                            Group / Sub-group / Category 
                                        </th>
                        
                                        <th nowrap>
                                            Min-Price
                                        </th>
                                        <th nowrap>
                                            Max-Price
                                        </th>
                                        <th>
                                       Status
                                        </th>
                                        <th>
                                       Owner Shop
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="accordion" id="groupDescription">
                                    @foreach ($products as $product )
                                    @foreach ($product->categories as $category )
                                        <tr>
                                            <td>
                                                @if(!empty($product->image['path']))
                                                @php
                                                $path = $product->image['path'];
                                                @endphp
                                          
                                                <img src="{{asset('image/'.$path.'?p=tiny')}}" />
                                               
                                                @else
                                                No Image
                                                @endif
                                            </td>
                                            <td>
                                            {{$product->name}} 
                                            </td>
                                            <td>
                                            {{ $category->subgroup->group->name }} / {{ $category->subgroup->name }} / {{ $category->name }} 
                                            </td>
                                            <td>
                                            {{ $product->min_price}} 
                                            </td>
                                            <td>
                                            {{ $product->max_price }}
                                            </td>
                                            <td>
                                            @if($product->active===1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                            </td>
                                        
                                            <td>
                                            {{ $product->shop->name?? 'No shop'}}
                                            </td>
                                            
                                            <td>
                                                <a href="{{ route('edit-product-form',[ 'product_id' => $product->id ] ) }}" class="mr-2">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                                <a  data-toggle="collapse" href="#{{$descr = Illuminate\Support\Str::random(8)}}" aria-expanded="false" aria-controls="{{Illuminate\Support\Str::random(8)}}" class="mr-1 btn btn-sm shadow-sm font-weight-bold btn-outline-danger">
                                                    Remove
                                                </a>
                                            </td>
                                        </tr>
                                        <tr id="{{$descr}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                                            <td colspan="5">
                                                Are you sure
                                                <br class="my-2">
                               
                                                <a  data-toggle="collapse"  aria-expanded="false" aria-controls="{{$product->name}}" class="mr-1 btn btn-sm shadow-sm btn-outline-danger"  onclick="event.preventDefault();
                                                     document.getElementById('{{$product->name}}').submit();">
                                                        <i class="bx bx-trash mr-1" style="font-size: 14px"></i> Yes
                                                </a>

                                                <a  data-toggle="collapse" href="#{{$trash = Illuminate\Support\Str::random(8)}}" aria-expanded="false" aria-controls="{{Illuminate\Support\Str::random(8)}}" class="mr-1 btn btn-sm shadow-sm btn-outline-danger">
                                                        <i class="bx bx-x mr-1" style="font-size: 14px"></i> Ignore
                                                </a>

                                                <form id="{{$product->name}}" action="{{ route('deleteproduct',[ $product->id , $product->name ] ) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                 
                                                </form>

                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
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

                                        <form method="post" action="{{ route('product.upload')  }}" enctype="multipart/form-data">
                                         {{csrf_field()}}
                                         <td colspan="5">
                                                <div class="row">
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Group
                                                            </h6>
                                                            <span class="col-12">
                                                            
                                                            </span>
                                                            <select name="group" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                                            <option value="" disabled selected>
                                                                    -- Select Group --
                                                                </option>
                                                    
                                                            @foreach ( getAllGroups() as $group )
                                                                    <option value="{{$group->name}}">
                                                                         {{ $group->name }}
                                                                    </option>
                                                                @endforeach
                                            
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Sub Group
                                                            </h6>
                                                            <select name="subgroup" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                                            <option value="" disabled selected>
                                                                    -- Select Sub Group --
                                                                </option>
                                                                @foreach ( getAllSubGroups() as $subgroup )
                                                                    <option value="{{$subgroup->name}}">
                                                                         {{ $subgroup->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Category
                                                            </h6>
                                                            <select name="category" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                                            <option value="" disabled selected>
                                                                    -- Select Category --
                                                                </option>
                                                                @foreach ( getAllCategories() as $category )
                                                                    <option value="{{$category->name}}">
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Shop
                                                            </h6>
                                                            <select name="shop" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                                            <option value="" disabled selected>
                                                                    -- Select Shop --
                                                                </option>
                                                                @foreach ( getShops() as $shop )
                                                                    <option value="{{$shop->name}}">
                                                                        {{ $shop->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Product Name
                                                            </h6>
                                                            <input type="text" name="name" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" placeholder="Product Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Minimun Price
                                                            </h6>
                                                            <input type="number" name="min_price" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" placeholder="Min Price" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                               Maximum Price
                                                            </h6>
                                                            <input type="number" name="max_price" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" placeholder="Max Price" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Product Status
                                                            </h6>
                                                            <select name="status" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                                            <option value="1">
                                                                    Active
                                                                </option>
                                                               
                                                                    <option value="0" selected>
                                                                        Inactive
                                                                    </option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Product Img
                                                            </h6>
                                                            <input type="file" name="image_link" class="col-12 bg-white shadow-sm rounded border-0 mx-auto"  autocomplete="off" >
                                                        </div>
                                                    </div>
                    
                                                    <div class="col-12">
                                                       
                                                    <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                                        Add Product  <i class="bx ml-1 bx-plus"></i>
                                                    </button>
                                                    </div>
                                                </div>
                                            </td>
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