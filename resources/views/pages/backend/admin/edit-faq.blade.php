@extends('layouts.backend.main', 
                        [
                            'title' => __("Edit-Faq"),
                            'page_name' => 'Edit-Faq',
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
                Edit Faq Topic
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

        <div class="card">
            <div id="newfaq" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="nyayomat-blue font-weight-bold " href="{{ route('faqs')}}">
                                Back
                            </a>
                        </div>

                        <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                            EDIT FAQ
                        </h5>
                    </div>
                    <form action="{{ route('update-faq',['faq-topic-id'=>$faq->id])  }}" method="POST" enctype="multipart/form-data" files="true" class="row">
                        @csrf
                       
                        <div class="col-12 mb-4">
                            <p class="col-12 px-0">
                                Existing Topic :
                            </p>
                            <select name="faq_topic_id" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                <option value="">
                                    -- Select One --
                                </option>
                                @foreach( faqtopics() as $topic )
                                <option value="{{$topic->id}}">
                                    {{ $topic->name }}
                                </option>
                                @endforeach   
                            </select>
                        </div>
                        <div class="col-12 mb-4">
                            <p class="col-12 px-0">
                                Question :
                            </p>
                            <input name="question" type="text" value="{{$faq->question}}" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                        </div>
                        <div class="col-12 mb-4">
                            <p class="col-12 px-0">
                                Answer :
                            </p>
                            <textarea name="answer" value="{{$faq->answer}}" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
                        </div>
                        <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                            Update  <i class="bx ml-1 bx-plus"></i>
                                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
@endpush
