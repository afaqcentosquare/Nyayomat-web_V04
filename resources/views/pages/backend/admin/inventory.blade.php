@extends('layouts.backend.main', 
                        [
                            'title' => __("Products"),
                            'page_name' => 'Products',
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
            </a> /
            <a href="" class="text-primary ml-1">
                Products
            </a>  
        </div>
    </div>
      
    <div class="row">
      
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
                            <table id="inventorytable" class="table display nowrap" >
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
                                            Image
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>




                                <tbody class="accordion" id="groupDescription">

                                    @foreach( getProductsByPaginate() as $product )
                                    @foreach( $product->categories as $category )
                                        <span style="display: none;">
                                        {{ $descr = Illuminate\Support\Str::random(8)}}
                                        {{ $prd = Illuminate\Support\Str::random(8)}}
                                        </span>
                                    
                                        <tr>
                                            <td>
                                                <a   href="{{route('sub-group',$category->subgroup->group->name)}}" class="mr-1 nyayomat-blue">
                                                 
                                                {{ $category->subgroup->group->name}}
                                                </a>
                                                
                                            </td>
                                            <td>
                                                <a href="{{route('category' , $category->subgroup->name )}}" class="nyayomat-blue font-weight-bolder">
                                                {{ $category->subgroup->name}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('category-products', $category->name)}}" class="nyayomat-blue font-weight-bolder">
                                                {{ $category->name}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('specific-product',$product->name)}}" class="nyayomat-blue font-weight-bolder">
                                                {{ $product->name }}
                                                </a>
                                            </td>
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
                                          
                                            <td nowrap>
                                                <a  data-toggle="collapse" href="#{{$prd = Illuminate\Support\Str::random(8)}}" aria-expanded="false" aria-controls="{{Illuminate\Support\Str::random(8)}}" class="btn btn-sm shadow-sm font-weight-bold btn-info">
                                                    Edit
                                                </a>
                                                <a  data-toggle="collapse" href="#{{$descr = Illuminate\Support\Str::random(8)}}" aria-expanded="false" aria-controls="{{Illuminate\Support\Str::random(8)}}" class="btn btn-sm shadow-sm font-weight-bold btn-warning">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <div id="{{$descr}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                                           
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam nulla impedit sunt culpa, fuga ullam possimus voluptatum eum quos, ipsum molestias excepturi omnis dolore voluptatem blanditiis sequi aspernatur suscipit maxime.
                                                <br class="my-2">
                                                <a class="btn btn-sm shadow-sm btn-success mr-2">
                                                    <i class="bx bx-edit mr-1" style="font-size: 14px"></i> Edit
                                                </a>
                                                <a  data-toggle="collapse"  aria-expanded="false" aria-controls="{{$product->name}}" class="mr-1 btn btn-sm shadow-sm btn-outline-danger"  onclick="event.preventDefault();
                                                     document.getElementById('{{$prd}}').submit();">
                                                        <i class="bx bx-trash mr-1" style="font-size: 14px"></i> Delete {{$product->id}}
                                                </a>
                                                <form id="{{$prd}}" action="{{ route('deleteproduct',[ $product->id , $product->name ] ) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                 
                                                </form>

                                           
                                            
                                        </div>

                                        <div id="{{$prd}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">

                
                                                <form method="post" action="{{ route('product.upload')  }}" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Group
                                                            </h6>
                                                            <span class="col-12">
                                                            
                                                            </span>
                                                            <select name="group" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                                                <option value="{{ $category->subgroup->group->name}}">
                                                                {{ $category->subgroup->group->name}}
                                                                </option>
                                            
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12">
                                                                Sub Group
                                                            </h6>
                                                            <select name="subgroup" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="">
                                                                <option value="">
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
                                                                <option value="">
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
                                                                <option value="">
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
                                                        Add  <i class="bx ml-1 bx-plus"></i>
                                                    </button>
                                                    </div>
                                                </div>
                                            </form>
                                           
                                            
                                        

                                        </div>
                                    @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th nowrap>
                                            Parent Group
                                        </th>
                                        <th nowrap>
                                            Sub Groups
                                        </th>
                                        <th>
                                            Categories
                                        </th>
                                        <th>
                                            Product
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            {!! getProductsByPaginate()->links() !!}
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
                            <form method="post" action="{{ route('product.upload')  }}" enctype="multipart/form-data">
                                {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-4 mb-3 px-4">
                                    <div class="row">
                                        <h6 class="col-12">
                                            Group
                                        </h6>
                                        <select name="group" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="group">
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
                                        <select name="subgroup" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="sub_group">
                                            {{-- <option value="" disabled selected>
                                                    -- Select Sub Group --
                                                </option>
                                                @foreach ( getAllSubGroups() as $subgroup )
                                                    <option value="{{$subgroup->name}}">
                                                         {{ $subgroup->name }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 px-4">
                                    <div class="row">
                                        <h6 class="col-12">
                                            Category
                                        </h6>
                                        <select name="category" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="category">
                                            {{-- <option value="" disabled selected>
                                                    -- Select Category --
                                                </option>
                                                @foreach ( getAllCategories() as $category )
                                                    <option value="{{$category->name}}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach --}}
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
                                            Product Img
                                        </h6>
                                        <input type="file" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" placeholder="" autocomplete="off" id="">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 px-4">
                                    <div class="row">
                                        <h6 class="col-12">
                                            Status
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
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                        Add Product  <i class="bx ml-1 bx-plus"></i>
                                    </button>
                                </div>
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

<script> 
    function onlyNumberKey(evt) { 
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 

    $(document).ready(function() {
    $('#inventorytable').DataTable( {
        dom: 'Brt',
        buttons: [
            {
            extend: 'csv',
            text: 'Comma Separated Values (CSV)'
            },
            {
            extend: 'excel',
            text: 'Excel'
            },
            {
            extend: 'pdf',
            text: 'Portable Document Format (PDF)'
            },
            {
            extend: 'print',
            text: 'Print'
            }
             
        ]
        
    } );
} );


</script>

<script>

    $(document).ready(function() {
        $('#group').on('change', function() {
        var group_id = this.value;
        $("#sub_group").html('');
        $.ajax({
        url:"{{url('get-subgroups')}}",
        type: "GET",
        data: {
            group_id: group_id
        },
        dataType : 'json',
        success: function(result){
        $('#sub_group').html('<option value="">Select Sub Group</option>');
        $.each(result,function(key,value){
        $("#sub_group").append('<option value="'+value.name+'">'+value.name+'</option>');
        });
        }
        });
        }); 


        $('#sub_group').on('change', function() {
        var sub_group_id = this.value;
        $("#category").html('');
        $.ajax({
        url:"{{url('get-category-by-subgroups')}}",
        type: "GET",
        data: {
            sub_group_id: sub_group_id
        },
        dataType : 'json',
        success: function(result){
        $('#category').html('<option value="">Select Category</option>');
        $.each(result,function(key,value){
        $("#category").append('<option value="'+value.name+'">'+value.name+'</option>');
        });
        }
        });
        }); 
    });

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
@endpush