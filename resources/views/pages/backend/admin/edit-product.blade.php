@extends('layouts.backend.main', 
                        [
                            'title' => __("Edit-Product"),
                            'page_name' => 'Edit-Product',
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
                {{Illuminate\Support\Str::ucfirst(Auth::user()->getRoleNames())}}
               
            </a> /
            <a href="" class="text-primary ml-1">
                Edit Product
            </a>  
        </div>
    </div>
      
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ $message }}
        </div>
        @endif

    <div class="row">
        <div class="card border-0 mx-0">
            <div id="newproduct"  >
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="nyayomat-blue font-weight-bold" href="{{ url('/inventory')  }}"  >
                                Back
                            </a>
                        </div>

                        <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                            Edit Product
                        </h5>
                    </div>

                                <form method="post" action="{{ route('product-update')  }}" enctype="multipart/form-data">
                                 {{csrf_field()}}
                                 <td colspan="5">
                                     <div class="row">
                                        <div class="col-md-4 mb-3 px-4">
                                            <div class="row">
                                                <h6 class="col-12">
                                                    Product Name
                                                </h6>
                                                <input type="text" name="name" value="{{$product->name}}" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" >
                                            </div>
                                        </div>
                                     </div>
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
                                                Update Product  <i class="bx ml-1 bx-plus"></i>
                                            </button>
                                            </div>
                                        </div>
                                    </td>
                                </form>
                </div>
            </div>
        </div>

        {{-- end edit product --}}
    </div>
@endsection

@push('scripts')
@endpush
