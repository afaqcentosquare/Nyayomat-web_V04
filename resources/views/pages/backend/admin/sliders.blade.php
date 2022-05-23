@extends('layouts.backend.main', 
                        [
                            'title' => __("Sliders"),
                            'page_name' => 'Sliders',
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
            .modal{
                width: 100vw;
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
                Sliders
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- Sliders --}}
        <div class="col mx-auto shadow-sm rounded">
            <div class="accordion" id="Sliders">
                <div id="showSliders" class="collapse show" aria-labelledby="headingOne" data-parent="#Sliders"> 
                    <div class="header-left px-0">
                        Sliders
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="btn btn-sm btn-info mr-3 py-2 shadow collapsed"  href="{{url('/pages')}}" aria-expanded="false" aria-controls="newBanner">
                                Back
                            </a>

                            <a class="btn btn-sm btn-success mr-3 py-2 shadow  collapsed"  data-toggle="collapse" href="#newSlider" aria-expanded="false" aria-controls="newSlider">
                                 Add Slider
                            </a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mb-4 text-left">
                            <a class="nyayomat-blue " data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
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

                        <div class="col-12 table-responsive">
                            <table class="table  table-borderless">
                                <thead>
                                    <tr>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Slider Image
                                        </th>
                                        <th nowrap>
                                            Sub title
                                        </th>
                                        <th nowrap>
                                            Options
                                        </th>
                                        <th nowrap>
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( sliders() as $slider )
                                        <tr>
                                            <td>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        Title Text: <span class="font-weight-bold ml-2">{{$slider->title}}</span>
                                                    </li>
                                                    <li>
                                                        Title Text Color : <span class="font-weight-bold ml-2">{{$slider->title_color}}</span>
                                                    </li>
                                                    
                                                </ul>
                                            </td>
                                            <td>
                                                @if(!empty($slider->image['path']))
                                                @php
                                                $path = $slider->image['path'];
                                                @endphp
                                          
                                                <img src="{{asset('image/'.$path.'?p=tiny')}}" />
                                               
                                                @else
                                                No Image
                                                @endif
                                            </td>
                                            <td>
                                                <span class="d-none">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            Title Text: <span class="font-weight-bold ml-2">{{$slider->sub_title}}</span>
                                                        </li>
                                                        <li>
                                                            Title Text Color : <span class="font-weight-bold ml-2">{{$slider->sub_title_color}}</span>
                                                        </li>
                                                        
                                                    </ul>
                                                </span>
                                               
                                            </td>
                                            <td nowrap>
                                                <ul class="list-unstyled">
                                                  
                                                    <li>
                                                        Order : 
                                                        <span class="font-weight-bold ml-2">
                                                            {{$slider->order}}
                                                        </span>
                                                    </li>
                                                    <li>
                                                        Link : <span class="font-weight-bold ml-2">{{$slider->link}}</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                {{$slider->created_at}}
                                            </td>
                                            <td>
                                                <a href="#restock}" data-toggle="modal" class="">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                <a href="#discontinue" data-toggle="modal" class="">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="col-12 modal text-muted" id="restock"  data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                            Edit 
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" class="">
                                                            <div class="row">
                                                                <div class="col-md-4 col-6 mb-4">
                                                                    <p class="col-12 px-0">
                                                                        Title :
                                                                    </p>
                                                                    <input type="text" name="title" class="col-12 py-2 bg-white shadow-sm rounded border-0" placeholder="Type" autocomplete="off" id="">
                                                                </div>
                                                                <div class="col-md-4 col-6 mb-4">
                                                                    <p class="col-12 px-0">
                                                                        Position :
                                                                    </p>
                                                                    <select autocomplete="off" class="col-12 py-2 bg-white rounded shadow-sm border-0">
                                                                        <option value="">
                                                                            -- Select One --
                                                                        </option>
                                                                        <option value="">
                                                                            Alternative Credit Platform
                                                                        </option>
                                                                        <option value="">
                                                                            Ecommerce
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-6 mb-4">
                                                                    <p class="col-12 px-0">
                                                                        slug :
                                                                    </p>
                                                                    <input type="text" placeholder="https://nyayomat.com/" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                                                </div>
                                                                <div class="col-12 mb-4">
                                                                    <p class="col-12 px-0">
                                                                        Content :
                                                                    </p>
                                                                    <textarea placeholder="Type here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
                                                                </div>
                                                                <div class="col-6 mb-4">
                                                                    <p class="col-12 px-0">
                                                                        Featured Image :
                                                                    </p>
                                                                    <input type="file" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                                                </div>
                                                                <div class="col-6 mb-4">
                                                                    <p class="col-12 px-0">
                                                                        Visibility :
                                                                    </p>
                                                                    <select autocomplete="off" class="col-12 bg-white    py-2 rounded shadow-sm border-0">
                                                                        <option value="">
                                                                            -- Select One --
                                                                        </option>
                                                                        <option value="">
                                                                            Alternative Credit Platform
                                                                        </option>
                                                                        <option value="">
                                                                            Ecommerce
                                                                        </option>
                                                                    </select>
                                                                </div>                              
                                                                <div class="col-12 text-center">
                                                                    <a href="" class="btn btn-sm shadow-sm bg-nyayomat-blue text-white">
                                                                        <i class="bx bx-plus mr-1"></i>Add
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </form>         
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-12 modal text-muted" id="discontinue" data-backdrop="false" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                            Delete Page
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
                                    @endforeach
                                </tbody>
                            </table>
                                    
                        </div>
                    </div>
                    
                </div>
                <div class="card">
                    <div id="newSlider" class="collapse" aria-labelledby="headingTwo" data-parent="#Sliders">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showSliders" aria-expanded="true" aria-controls="showSliders">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    New Slider
                                </h5>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush