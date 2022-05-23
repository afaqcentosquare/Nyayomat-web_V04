@extends('layouts.backend.main', 
                        [
                            'title' => __("Email-Templates"),
                            'page_name' => 'Email-Templates',
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
                {{ucfirst(config('app.name'))}}
            </a> /
            <a href="" class="text-muted mr-1">
                {{ucfirst("Super Admin")}}
            </a> /
            <a href="" class="text-primary ml-1">
                Email-Templates
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- Email-Templates --}}
        <div class="col-md-10 mx-auto shadow-sm rounded">
            <div class="accordion" id="email-templates">
                <div id="showemail-templates" class="collapse show" aria-labelledby="headingOne" data-parent="#email-templates"> 
                    <div class="header-left px-0">
                        EMAIL-TEMPLATES
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newemail-template" aria-expanded="false" aria-controls="newemail-template">
                                NEW EMAIL-TEMPLATE
                            </a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mb-4 text-left">
                            <a class="nyayomat-blue" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                                        <th>
                                            Title  
                                        </th>
                                        <th>
                                            Subject
                                        </th>
                                        <th>
                                            Sender Email
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Target Audience
                                        </th>
                                        <th>
                                            Created At
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div id="newemail-template" class="collapse" aria-labelledby="headingTwo" data-parent="#email-templates">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showemail-templates" aria-expanded="true" aria-controls="showemail-templates">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW EMAIL TEMPLATE
                                </h5>
                            </div>
                            <form action="" method="post" class="px-5">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-md-2 col-form-label">
                                        Target Group
                                    </label>
                                    <div class="col-md-10">
                                        <select name="" id="" class="form-control col-12">
                                            <option value="">
                                                -- Target Audience --
                                            </option>
                                            <option value="">
                                                Merchants
                                            </option>
                                            <option value="">
                                                Asset Providers
                                            </option>
                                            <option value="">
                                                Customers
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="text" class="form-control col-12 " placeholder="Template Name">
                                </div>
                                <div class="form-group mt-5 row">
                                    <label for="staticEmail" class="col-md-2 col-form-label">
                                        Type
                                    </label>
                                    <div class="col-md-10">
                                        <select name="" id="" class="form-control col-12">
                                            <option value="">
                                                -- Type  --
                                            </option>
                                            <option value="">
                                                Plain Text
                                            </option>
                                            <option value="">
                                                Html
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <input type="text" class="form-control col-12 " placeholder="Subject">
                                </div>
                                <div class="row my-5">
                                    <textarea name="" id="" class="form-control col-12 " placeholder="Body . . ." rows="10"></textarea>
                                </div>
                                <div class="row my-5">
                                    <div class="col-6">
                                        <select name="" id="" class="form-control col-12">
                                            <option value="">
                                                -- sender email --
                                            </option>
                                            <option value="">
                                                info@xyz.abc
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control col-12 " placeholder="sender name">
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="btn-block btn btn-primary">
                                        save
                                    </button>
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