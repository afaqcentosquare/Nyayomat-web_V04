@extends('layouts.backend.main', 
                        [
                            'title' => __("Sub-groups"),
                            'page_name' => 'Sub-groups',
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
                Sub-groups
            </a>  
        </div>
        {{-- Sub-groups --}}
        <div class="col px-0 mx-auto shadow-sm rounded">
            <div class="accordion" id="sub-groups">
                <div id="showsub-groups" class="collapse px-4 show" aria-labelledby="headingOne" data-parent="#sub-groups"> 
                    <div class="header-left px-0">
                        SUB-GROUPS
                    </div> 
                    <span class="">
                        <span class="ml-1 font-weight-bold mr-2">Group</span> 
                        <a href="{{route('group')}}">
                            {{$group}}
                        </a>
                    </span>
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newsub-group" aria-expanded="false" aria-controls="newsub-group">
                                NEW SUB-GROUP
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
                                           Subgroup Name  
                                        </th>
                                        <th nowrap>
                                            Slug
                                        </th>
                                        <th nowrap>
                                            Categories
                                        </th>
                                        <th nowrap>
                                            Products
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="accordion" id="groupDescription">
                                    @foreach ( $categoryGroups as $group )
                                    @foreach ( $group->subgroups as $subgroup )
                                        <tr>
                                            <td>
                                                <a  data-toggle="collapse" href="#{{$descr = Illuminate\Support\Str::random(8)}}" aria-expanded="false" aria-controls="{{Illuminate\Support\Str::random(8)}}" class="mr-1 nyayomat-blue">
                                                    <i class="bx bx-info-circle"  style="font-size: 14px"></i>
                                                </a>
                                                {{  $subgroup->name }}
                                            </td>
                                            <td>
                                            {{  $subgroup->slug }}
                                            </td>
                                            <td>
                                                {{  $subgroup->categories->count() }}
                                                
                                            </td>
                                            <td>
                                            @php
                                                $psum = array();  
                                                foreach($subgroup->categories as $productsincat)
                                                {
                                                    array_push( $psum , $productsincat->products_count );
                                                }
                                            @endphp
                                                 
                                                    {{ array_sum($psum)}}

                                            </td>
                                            <td>
                                                <a data-toggle="collapse" href="#{{$cat = Illuminate\Support\Str::random(8)}}" class="btn btn-sm mr-3 shadow-sm font-weight-bold btn-outline-success">
                                                    Add Category
                                                </a>
                                                <a data-toggle="collapse" href="#{{$prod = Illuminate\Support\Str::random(8)}}" class="btn btn-sm btn-outline-primary font-weight-bold shadow-sm">
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
                                                <a  data-toggle="collapse" href="#{{$trash = Illuminate\Support\Str::random(8)}}" aria-expanded="false" aria-controls="{{Illuminate\Support\Str::random(8)}}" class="mr-1 btn btn-sm shadow-sm btn-outline-danger">
                                                    <i class="bx bx-trash mr-1" style="font-size: 14px"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <tr id="{{$prod}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                                            <td colspan="5">
                                                <form action="" class="row">
                                                    <div class="col-md-4 mb-4">
                                                        <p class="text-muted col-12 px-0">
                                                            <b style="font-size: 14px">
                                                                Group Name :
                                                            </b>
                                                        </p>
                                                        <input type="text" disabled value="" autocomplete="off" class="col-12 py-2 rounded bg-transparent border-0">
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <p class="text-muted col-12 px-0">
                                                            <b style="font-size: 14px">
                                                                Sub Grp Name :
                                                            </b>
                                                        </p>
                                                        <input type="text" disabled value="" autocomplete="off" class="col-12 py-2 rounded bg-transparent border-0">
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <p class="text-muted col-12 px-0">
                                                            <b styl
                                                            e="font-size: 14px">
                                                                Category Name :
                                                            </b>
                                                        </p>
                                                        <select type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                                            <option value="">
                                                                -- Select One --
                                                            </option>
                                                            <option value="">
                                                                CTG{{Illuminate\Support\Str::random(8)}}
                                                            </option>
                                                            <option value="">
                                                                CTG{{Illuminate\Support\Str::random(8)}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <p class="col-12 px-0">
                                                            Name :
                                                        </p>
                                                        <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                                    </div>
                                                    <div class="col-md-4 mb-3 px-4">
                                                        <div class="row">
                                                            <h6 class="col-12 px-0">
                                                                Status
                                                            </h6>
                                                            <select name="" class="col-12 py-2 bg-white shadow-sm rounded border-0" id="">
                                                                <option value="">
                                                                    -- Status --
                                                                </option>
                                                                <option value="">
                                                                    Active                                                                        
                                                                </option>
                                                                <option value="">
                                                                    Inctive                                                                    
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>                              
                                                    <div class="col-12 text-center">
                                                        <a href="" class="btn btn-sm shadow-sm bg-nyayomat-blue text-white">
                                                            <i class="bx bx-plus mr-1"></i>Add
                                                        </a>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr id="{{$cat}}" class="collapse" aria-labelledby="headingOne" data-parent="#groupDescription">
                                            <td colspan="5">
                                                <form action="" class="row">
                                                    <div class="col-md-4 mb-4">
                                                        <p class="text-muted col-12 px-0">
                                                            <b style="font-size: 14px">
                                                                Group Name :
                                                            </b>
                                                        </p>
                                                        <input type="text" disabled value="{{$group}}" autocomplete="off" class="col-12 py-2 rounded bg-transparent border-0">
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <p class="text-muted col-12 px-0">
                                                            <b style="font-size: 14px">
                                                                Sub Grp Name :
                                                            </b>
                                                        </p>
                                                        <input type="text" disabled value="" autocomplete="off" class="col-12 py-2 rounded bg-transparent border-0">
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <p class="col-12 px-0">
                                                            Category Name :
                                                        </p>
                                                        <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                                    </div>
                                                    <div class="col-12 mb-4">
                                                        <p class="col-12 px-0">
                                                            Description :
                                                        </p>
                                                        <textarea placeholder="Type here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
                                                    </div>                                
                                                    <div class="col-12 text-center">
                                                        <a href="" class="btn btn-sm shadow-sm bg-nyayomat-blue text-white">
                                                            <i class="bx bx-plus mr-1"></i>Add
                                                        </a>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <div id="newsub-group" class="collapse" aria-labelledby="headingTwo" data-parent="#sub-groups">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showsub-groups" aria-expanded="true" aria-controls="showsub-groups">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW SUB-GROUP
                                </h5>
                            </div>
                            <form action="" class="row">
                                <div class="col-12 mb-4">
                                    <p class="text-muted col-12 px-0">
                                        <b style="font-size: 14px">
                                            Group Name :
                                        </b>
                                    </p>
                                    <input type="text" disabled value="{{$group}}" autocomplete="off" class="col-12 py-2 rounded bg-transparent border-0">
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="text-muted col-12 px-0">
                                        <b style="font-size: 14px">
                                            Sub Grp Name :
                                        </b>
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                
                                <div class="col-12 mb-4">
                                    <p class="text-muted col-12 px-0">
                                        <b style="font-size: 14px">
                                            Description :
                                        </b>
                                    </p>
                                    <textarea placeholder="Type here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
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