@extends('layouts.backend.main', 
                        [
                            'title' => __("Announcements"),
                            'page_name' => 'Announcements',
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
                Announcements
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- ANNOUNCEMENTs --}}
        <div class="col-md-10 px-0 mx-auto shadow-sm rounded">
            <div class=" accordion" id="announcements">
                <div id="showannouncements" class="collapse px-4 show" aria-labelledby="headingOne" data-parent="#announcements"> 
                    <div class="header-left px-0">
                        ANNOUNCEMENTS
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newannouncement" aria-expanded="false" aria-controls="newannouncement">
                                NEW ANNOUNCEMENT
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
                            <table class="table" id="anouncementtable">
                                <thead>
                                    <tr>
                                        <th>
                                            Title  
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                        <th>
                                            Author
                                        </th>
                                        <th>
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( announcements() as $announcement)
                                    <tr>
                                        <td>
                                        {{ $announcement->action_text}} 
                                         </td>
                                         <td>
                                         {{ $announcement->body}} 
                                         </td>
                                         <td>
                                         {{  $announcement->creator->name}}
                                         </td>
                                         <td>
                                         {{  $announcement->created_at}}
                                         </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <div id="newannouncement" class="collapse" aria-labelledby="headingTwo" data-parent="#announcements">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showannouncements" aria-expanded="true" aria-controls="showannouncements">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW ANNOUNCEMENT
                                </h5>
                            </div>
                            <form method="post" action="{{ route('createnewannouncement')  }}" class="row">
                                {{csrf_field()}} 
                    <div class="col-12 mb-4">
                        <p class="col-12 px-0">
                            Target Group :
                        </p>
                        <select name="target" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                            <option disabled value="">
                                -- Select One --
                            </option>
                            @foreach( roles() as $role)
                            <option value="{{$role->name}}">
                                {{$role->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-4">
                        <p class="col-12 px-0">
                            Title :
                        </p>
                        <input name="action_text" type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                    </div>
                    <div class="col-12 mb-4">
                        <p class="col-12 px-0">
                            Body :
                        </p>
                        <textarea name="body" placeholder="Type here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
                    </div>
                    <div class="col-12 mb-4">
                        <p class="col-12 px-0">
                            Url :
                        </p>
                        <input name="action_url" type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                            Post Anouncement  <i class="bx ml-1 bx-plus"></i>
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
    $('#anouncementtable').DataTable( {
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
@endpush
