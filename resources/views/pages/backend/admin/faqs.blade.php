@extends('layouts.backend.main', 
                        [
                            'title' => __("Frequently Asked Questions"),
                            'page_name' => 'Frequently Asked Questions',
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
                            
                                <table class="table">
                                    <tbody>
                                        @foreach ( faqtopics() as $faq)
                                            <tr>
                                                <td nowrap>
                                                    {{$faq->name}}
                                                </td>
                                                {{-- <td nowrap>
                                                    {{$faq->for}}
                                                </td> --}}
                                                <td nowrap>
                                                    <a href="{{ route('edit-faq-topic-form',[ 'faqtopic_id' => $faq->id ] ) }}" class="mr-2">
                                                        <i class="bx bx-edit"></i>
                                                    </a>

                                                    <a href="" class="nyayomat-blue"  onclick="event.preventDefault();
                                                        document.getElementById('{{$faq->id}}').submit();">
                                                            <i class="bx bx-trash"></i>
                                                    </a>
                                                

                                               <form id="{{$faq->id}}" action="{{ route('delete-faq-topic',[ $faq->id ] ) }}" method="POST" style="display: none;">
                                                   @csrf
                                                   @method('DELETE')
                                                
                                               </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
                            <form action="{{ route('createnewfaqtopic')  }}" method="POST" enctype="multipart/form-data" files="true" class="row">
                                @csrf
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Topic Title :
                                    </p>
                                    <input name="name" type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Target Group :
                                    </p>
                                    <select name="for" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                        <option value="">
                                            -- Select One --
                                        </option>
                                        @foreach( roles() as $role )
                                        <option value="{{$role->name}}">
                                            {{ $role->name }}
                                        </option>
                                        @endforeach   
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                                        Add  <i class="bx ml-1 bx-plus"></i>
                                                    </button>
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
                       
                        <table id="faqstable">
                            <thead>
                                <th>
                                    
                                </th>
                            </thead>
                            <tbody>
                        @foreach ( faqs() as $faq)
                        <tr>
                            <td>
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
                                                        {{$faq->question}}
                                                    </h6>
                                                </div>
                                                <div class="col mr-3 pr-4 text-right">
                                                    <a href="{{ route('edit-faq-form',[ 'faq_id' => $faq->id ] ) }}" class="mr-2">
                                                        <i class="bx bx-edit"></i>
                                                    </a>

                                                    <a href="" class="nyayomat-blue"  onclick="event.preventDefault();
                                                        document.getElementById('{{$faq->id}}').submit();">
                                                            <i class="bx bx-trash"></i>
                                                    </a>
                                                

                                               <form id="{{$faq->id}}" action="{{ route('delete-faq',[ $faq->id ] ) }}" method="POST" style="display: none;">
                                                   @csrf
                                                   @method('DELETE')
                                                
                                               </form>
                                                </div>
                                            </div>
                                            {!! $faq->answer!!}
                                        </div>
                                        <div class="col-6 text-muted">
                                            <span class="font-weight-bold">
                                                {{$faq->topic->name}}
                                            </span> <span class="ml-2">Actor</span>
                                        </div>
                                        <div class="col-6 pr-lg-5 text-right text-muted">
                                            <span class="font-weight-bold ">
                                                Last Updated
                                            </span> <span class="ml-2">{{$faq->updated_at}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto border-bottom my-3 shadow-lg"></div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                        </table>
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
                            <form action="{{ route('createnewfaq')  }}" method="POST" enctype="multipart/form-data" files="true" class="row">
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
                                    <input name="question" type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Answer :
                                    </p>
                                    <textarea name="answer" placeholder="Type here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
                                </div>
                                <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                                        Add  <i class="bx ml-1 bx-plus"></i>
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



<script> 
    function onlyNumberKey(evt) { 
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 

    $(document).ready(function() {
    $('#faqstable').DataTable( {
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



// 
table.buttons().container()
    .appendTo( $('.btnscont', table.table().container() ) );


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
