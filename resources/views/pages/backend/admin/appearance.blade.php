@extends('layouts.backend.main', 
                        [
                            'title' => __("Appearances"),
                            'page_name' => 'Appearances',
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
            .parent-center{
                position: relative;
                /* height: 125px;
                width: 125px; */
                border-radius: 15px
            }
            
            .centered-content{
                position: absolute;
                top: 50%;
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
            }
            .centered-content > span {
                border:2px dashed #036CB1;
                border-radius: 10px;
                padding: 45px 25px 25px 25px;
                transition: cubic-bezier(1, 0, 0, 1);
                color: #036CB1
            }

            .centered-content:hover > span {
                /* border:2px dashed #036CB1; */
                background-color: #036CB1;
                color: #ffffff;
                border-radius: 10px;
                padding: 45px 25px 25px 25px;
                transition: cubic-bezier(1, 0, 0, 1)
            }
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
                {{ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted mr-1">
                {{ucfirst("Super Admin")}}
            </a> /
            <a href="" class="text-primary ml-1">
                Appearance 
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- Appearances --}}
        <div class="col mx-auto rounded">
            <div class="header-left px-0">
                Appearances
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
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-header bg-transparent border-0">
                            <div class="row">
                                <div class="col-7">
                                    <h5 class="card-title nyayomat-blue mt-2">
                                        <i class="bx bx-map-pin mr-2"></i> Nairobi
                                    </h5>
                                </div>
                                <div class="col-5 pt-2">
                                    <span class="text-muted">
                                        <small>12,000  Merchants</small>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 mx-auto border-bottom  shadow-lg"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-12 text-center">
                                    <span class="text-uppercase text-muted font-weight-bold">
                                        Sub counties
                                    </span>
                                </div>
                            </div>
                            
                            <div class="accordion row" id="Appearances">
                                <div id="showAppearances" class="collapse col-12 show" aria-labelledby="headingOne" data-parent="#Appearances">
                                    <div class="row">
                                        <div class="col-4 px-0">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 border-0">
                                                    <a data-toggle="modal" href="#" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-4 px-0">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-4 px-0">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                                <li class="list-group-item px-0 border-0">
                                                    <a href="" class="">
                                                        <small>
                                                            <i class="bx bx-location-plus mr-1"></i> {{Illuminate\Support\Str::random(8)}}
                                                        </small>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 pt-3 text-center">
                                            <a class="badge badge-pill badge-success rounded p-2 shadow-sm collapsed"  data-toggle="collapse" href="#newLocation" aria-expanded="false" aria-controls="newLocation">
                                                <i class="bx bx-plus mr-1"></i> New Location
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="newLocation" class="collapse" aria-labelledby="headingTwo" data-parent="#Appearances">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showAppearances" aria-expanded="true" aria-controls="showAppearances">
                                                    Back
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="col-12 mb-3">
                                                Adding a new location in <b class="nyayomat-blue">Nairobi</b>
                                            </span>
                                            <form action="" class="col-12">
                                                <div class="row">
                                                    <select name="" class="col-12 mb-3 py-2 bg-nyayomat-blue text-white border-0 rounded shadow-sm" autocomplete="off" id="">
                                                        <option value="">
                                                            -- Select Sub-county --
                                                        </option>
                                                        @for ($is = 0; $is < 8; $is++)
                                                            <option value="">
                                                                {{Illuminate\Support\Str::random(8)}}
                                                            </option>
                                                        @endfor
                                                    </select>

                                                    <input type="text" class="col-12 my-3 py-2 border-0 rounded shadow-sm" placeholder="New Location" name="" id="">
                                                    <input type="text" class="col-12 mt-3 py-2 border-0 rounded shadow-sm" placeholder="New Estate / Area" name="" id="">

                                                    <div class="col-12 text-center mt-4">
                                                        <a href="" class="badge badge-pill badge-success rounded p-2 shadow-sm ">
                                                            Add
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="collapse col-md-6 col-lg-3" id="allnewLocation">
                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-header bg-transparent border-0">
                            <div class="row mt-2">
                                <input type="text" class="rounded col-12 border-0 py-2" placeholder="Enter County Name">  
                            
                            </div>
                        </div>
                        {{-- <div class="col-8 mx-auto border-bottom  shadow-lg"></div> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-12 text-center">
                                    <div class="text-uppercase py-1 row text-muted justify-content-center font-weight-bold">
                                        <input type="text" class="rounded shadow-sm col-9 border-0 mx-auto py-2" placeholder="Sub County">  
                                        <a href="" class="col py-2">
                                            <span class="rounded shadow-sm bg-success p-1">
                                                <i class="bx bx-plus text-white"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion mt-3 row" id="Appearances">
                                <div id="showAppearances" class="collapse col-12 show" aria-labelledby="headingOne" data-parent="#Appearances">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <input type="text" class="rounded shadow-sm col-9 border-0 mx-auto py-1" placeholder="Location">  
                                                <a href="" class="col text-center py-2">
                                                    <span class="rounded shadow-sm bg-nyayomat-blue p-1">
                                                        <i class="bx bx-plus text-white"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-3 mt-3 text-center">
                                            <a class="badge badge-pill badge-success rounded p-2 shadow-sm collapsed"  data-toggle="collapse" href="#newLocation" aria-expanded="false" aria-controls="newLocation">
                                                <i class="bx bx-plus mr-1"></i> ADD
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6 parent-center col-lg-3">
                    <p class="col-12 text-center centered-content" style="">
                        <span class="">
                            <a data-toggle="collapse" href="#allnewLocation" class="text-decoration-none">
                                <i class="bx bx-plus" style="font-size: 5vh"></i>
                            </a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <span class="d-none">
        {{$mdl = Illuminate\Support\Str::random(10)}}
    </span>

    <div class="modal px-5 fade" id="{{$mdl}}" tabindex="0" data-backdrop="false" style="width: 100%" aria-labelledby="{{$mdl}}Label" aria-hidden="true">
        <div class="modal-dialog-full-width mx-3 modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Appearances
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="col-12">
                            <small class="font-weight-bold">
                                Location Name
                            </small>
                        </h5>
                        @for ($ie = 0; $ie < rand(10,23); $ie++)
                            <span class="col-lg-3 col-6 mb-2 mx-auto" nowrap>
                                <i class="bx bx-target-lock"></i>{{Illuminate\Support\Str::random(10)}}
                            </span>
                        @endfor
                    </div>
                </div>
                
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('@{{$mdl}}').modal('hide')
</script>
@endpush