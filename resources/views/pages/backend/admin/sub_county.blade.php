@extends('layouts.backend.main',
[
'title' => __("Our Locations"),
'page_name' => 'Our Locations',
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
            .parent-center {
                position: relative;
                /* height: 125px;
                                width: 125px; */
                border-radius: 15px
            }

            .centered-content {
                position: absolute;
                top: 50%;
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
            }

            .centered-content>span {
                border: 2px dashed #036CB1;
                border-radius: 10px;
                padding: 45px 25px 25px 25px;
                transition: cubic-bezier(1, 0, 0, 1);
                color: #036CB1
            }

            .centered-content:hover>span {
                /* border:2px dashed #036CB1; */
                background-color: #036CB1;
                color: #ffffff;
                border-radius: 10px;
                padding: 45px 25px 25px 25px;
                transition: cubic-bezier(1, 0, 0, 1)
            }

            .nyayomat-blue {
                color: #036CB1
            }

            .bg-nyayomat-blue {
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

            .card {
                border-top: 0 !important;
                margin-top: 15px !important;
            }

            .collapse {
                width: 100%
            }

            .nav {
                height: 100%;
                display: flex;
                flex-direction: row;
                justify-content: start;
                overflow: hidden;
                border: 0;
            }

            /* // Small devices (landscape phones, 576px and up) */
            @media (min-width: 350px) {
                .mg-top {
                    margin-top: 95px;
                }
            }

            /* // Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {}

            /* // Large devices (desktops, 992px and up) */
            @media (min-width: 992px) {}

            /* // Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) {
                .big-money {
                    font-size: 1vw;
                }

                h3>small {
                    font-size: 2.0vw
                }

                .icon-size {
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
                {{ ucfirst(config('app.name')) }}
            </a> /
            <a href="" class="text-muted mr-1">
                {{ ucfirst('Super Admin') }}
            </a> /
            <a href="" class="text-primary ml-1">
                Locations
            </a>
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{ $error }}
                <br>
                @endforeach
            </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-12 px-0 mx-auto shadow-sm rounded">
            <div class="accordion" id="county_data">
                <div id="show_county" class="collapse px-4 show" aria-labelledby="headingOne" data-parent="#county_data">
                    <div class="header-left px-0">
                        Sub County
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed" data-toggle="collapse"
                                href="#new_county" aria-expanded="false" aria-controls="new_county">
                                NEW SUB COUNTY
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4 text-left">
                            <a class="nyayomat-blue ml-3" data-toggle="collapse" href="#collapseExample" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="bx bx-link-external mr-2"></i> Export Information
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
                            <table class="table display nowrap">
                                <thead>
                                    <tr>
                                        <th nowrap>
                                            Sub County
                                        </th>
                                        <th nowrap>
                                            Locations
                                        </th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="accordion">
                                    @foreach ($regions as $region)
                                    @php
                                    $locations = App\Location::where('region', $region->id)->count();
                                    @endphp
                                        
                                        <tr>
                                            <td>
                                                {{$region->name}}
                                            </td>
                                            <td>
                                                <a   href="{{route('locations',$region->id)}}" class="mr-1 nyayomat-blue">
                                                 
                                                {{ $locations}}
                                                </a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th nowrap>
                                            Sub County
                                        </th>
                                        <th nowrap>
                                            Locations
                                        </th>
                                       
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </tfoot>
                            </table>
                            {{$regions->links()}}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div id="new_county" class="collapse" aria-labelledby="headingTwo" data-parent="#county_data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold" data-toggle="collapse" href="#show_county"
                                        aria-expanded="true" aria-controls="show_county">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW SUB COUNTY
                                </h5>
                            </div>
                            <form method="post" action="{{route('create.subcounty')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6 mb-3 px-4">
                                        <div class="row">
                                            <h6 class="col-12">
                                                County
                                            </h6>
                                            <select name="city" class="col-12 bg-white shadow-sm rounded border-0 mx-auto" autocomplete="off" id="group">
                                                <option value="" disabled selected>
                                                        -- Select County --
                                                    </option>
                                        
                                                @foreach ( $cities as $city )
                                                        <option value="{{$city->id}}">
                                                             {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 px-4">
                                        <div class="row">
                                            <h6 class="col-12">
                                                Sub County
                                            </h6>
                                            <input type="text" name="sub_county_name"
                                                class="col-12 bg-white shadow-sm rounded border-0 mx-auto"
                                                placeholder="Sub County Name" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                            Add Sub County <i class="bx ml-1 bx-plus"></i>
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
        $('@{{ $mdl }}').modal('hide')
    </script>
@endpush
