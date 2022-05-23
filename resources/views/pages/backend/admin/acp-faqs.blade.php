@extends('layouts.acp', 
                        [
                            'title' => __("Frequently Asked Questions"),
                            'page_name' => 'Frequently Asked Questions',
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
            <a href="" class="text-primary ml-1">
                Frequently Asked Questions
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- Topics --}}
        <div class="col-md-3">
            <div class="accordion" id="topics">
                    <div id="showTopics" class="collapse show" aria-labelledby="headingOne" data-parent="#topics">
                        <div class="header-left px-0">
                            Topics
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3 text-right">
                                <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newTopic" aria-expanded="false" aria-controls="newTopic">
                                    Add Topic
                                </a>
                            </div>
                            <div class="col-12 mt-2">
                                <span class="d-none">
                                    {{$collection = collect(["Merchant", "Customer"])}}
                                </span>
                                <table class="table">
                                    <tbody>
                                        @for ($i = 0; $i < 5; $i++)
                                            <tr>
                                                <td nowrap>
                                                    {{Str::random(8)}}
                                                </td>
                                                <td nowrap>
                                                    {{$collection->random()}}
                                                </td>
                                                <td nowrap>
                                                    <a href="" class="mr-2">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                    <a href="" class="mr-2">
                                                        <i class="bx bx-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>

                            <h6 class="col-12 px-4 text-muted font-weight-bold">
                                Tips
                            </h6>
                            <ul class="col-12 px-4 text-muted list-unstyled">
                                <li class="">
                                    <i class="bx bx-check mr-2"></i> 
                                    Click on topic item to filter the FAQ's
                                </li>
                            </ul>
                        </div>
                    </div>
                <div class="card rounded">
                    <div id="newTopic" class="collapse" aria-labelledby="headingTwo" data-parent="#topics">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold rounded"  data-toggle="collapse" href="#showTopics" aria-expanded="true" aria-controls="showTopics">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW TOPIC
                                </h5>
                            </div>
                            <form action="" class="row">
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Topic Title :
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Target Group :
                                    </p>
                                    <select autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                        <option value="">
                                            -- Select One --
                                        </option>
                                        <option value="">
                                            Customer
                                        </option>
                                        <option value="">
                                            Merchant
                                        </option>
                                        <option value="">
                                             Asset Provider 
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
        {{-- FAQs --}}
        <div class="col-md-9 shadow-sm rounded">
            <div class="accordion" id="faqs">
                <div id="showfaqs" class="collapse show" aria-labelledby="headingOne" data-parent="#faqs"> 
                    <div class="header-left px-0">
                        FAQ's
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newfaq" aria-expanded="false" aria-controls="newfaq">
                                ADD FAQ
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

                        @for ($iw = 0; $iw < 9; $iw++)
                        <div class="col-12">
                            <div class="media">
                                <span class="bg-nyayomat-blue p-1 pb-0  rounded shadow-lg text-white" style="opacity: 0.5">
                                    <i class="bx bx-question-mark mb-0"></i>
                                </span>
                                <div class="media-body">
                                    <div class="row px-2">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="mt-0 mx-auto font-weight-bold text-uppercase">
                                                        How Do I manage my account ?  
                                                    </h6>
                                                </div>
                                                <div class="col mr-3 pr-4 text-right">
                                                    <a href="" class="mr-2">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                    <a href="" class="mr-2">
                                                        <i class="bx bx-trash text-danger"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <p>She'll turn cold as a freezer. At the eh-end of it all. Stinging like a bee I earned my stripes. Bikinis, zucchinis, Martinis, no weenies. I hope you got a healthy appetite. We can dance, until we die, you and I, will be young forever. We're living the life. We're doing it right. Word on the street, you got somethin' to show me, me.</p>
                                        </div>
                                        <div class="col-6 text-muted">
                                            <span class="font-weight-bold">
                                                Sample Topic
                                            </span> <span class="ml-2">Actor</span>
                                        </div>
                                        <div class="col-6 pr-lg-5 text-right text-muted">
                                            <span class="font-weight-bold ">
                                                Last Updated
                                            </span> <span class="ml-2">01 - 10 - 2022</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto border-bottom my-3 shadow-lg"></div>
                        @endfor
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
                            <form action="" class="row">
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Target Group :
                                    </p>
                                    <select autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                        <option value="">
                                            -- Select One --
                                        </option>
                                        <option value="">
                                            Customer
                                        </option>
                                        <option value="">
                                            Merchant
                                        </option>
                                        <option value="">
                                             Asset Provider 
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Question :
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Answer :
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
