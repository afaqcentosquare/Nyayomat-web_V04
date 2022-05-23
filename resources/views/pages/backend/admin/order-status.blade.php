@extends('layouts.backend.main', 
                        [
                            'title' => __("Order status"),
                            'page_name' => 'Order statuss',
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
                {{Str::ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted mr-1">
                {{Str::ucfirst("Super Admin")}}
            </a> /
            <a href="" class="text-primary ml-1">
                Order status
            </a>  
        </div>
    </div>
      
    <div class="row">
     
        {{-- FAQs --}}
        <div class="col-md-9 mx-auto shadow-sm rounded">
            <div class="accordion" id="faqs">
                <div id="showfaqs" class="collapse show" aria-labelledby="headingOne" data-parent="#faqs"> 
                    <div class="header-left px-0">
                        Order status
                    </div>
                    <div class="row">
                        <div class="col mb-4 text-left">
                            <span class="mr-2">
                                <i class="bx bx-expand mr-2"></i> 
                                Showing
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

                        <div class="col-12 table-responsive">
                            <table class="table  table-borderless">
                                <thead>
                                    <tr>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Color <small>(hex)</small>
                                        </th>
                                        <th nowrap>
                                            Appearance
                                        </th>
                                        
                                        <th nowrap>
                                            
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <span class="d-none">
                                        {{$collection = collect(['ffffff','f04fff' , '00ffff', 'fff11f', 'fddfff'])}}
                                    </span>
                                    @for ($i = 0; $i < 7 ; $i++)
                                        <tr>
                                            <td>
                                                Status Name
                                            </td>
                                            <td>
                                                #{{$collection->random()}}
                                            </td>
                                            <td>
                                                <a href="" class="btn sm shadow-sm" style="background-color: #{{$collection->random()}}">
                                                    color
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" class="nyayomat-blue">
                                                    <i class="bx bx-edit"></i>
                                                <a href="" class="nyayomat-blue">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                                    
                        </div>
                    </div>
                    
                </div>
                <div class="card">
                    <div id="newfaq" class="collapse" aria-labelledby="headingTwo" data-parent="#faqs">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showfaqs" aria-expanded="true" aria-controls="showfaqs">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW FAQ
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
