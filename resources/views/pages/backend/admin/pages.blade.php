@extends('layouts.backend.main', 
                        [
                            'title' => __("Nyayomat Pages"),
                            'page_name' => ' Nyayomat Pages',
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
                width:100vw ;
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
                border-left: 0 !important;
                border-right: 0 !important;
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
                Ads Directory
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- Pages --}}
        <div class="col px-0 mx-auto shadow-sm rounded">
            <div class="accordion" id="Pages">
                <div id="showPages" class="collapse show py-2 px-3" aria-labelledby="headingOne" data-parent="#Pages"> 
                    <div class="header-left px-0">
                        Directories
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <div class="btn-group">
                                <button type="button" class="btn px-4 btn-sm bg-nyayomat-blue text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    New
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item collapsed" data-toggle="collapse" href="#newPage"">
                                        Page
                                    </a>
                                    <a class="dropdown-item" href="{{route('banners')}}">
                                        Banner
                                    </a>
                                    <a class="dropdown-item" href="{{route('sliders')}}">
                                        Slider
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mb-4 text-left">
                            <a class="nyayomat-blue ml-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bx bx-link-external mr-2"></i>  Export Information
                            </a>
                        </div>
                        <div class="collapse col-12 mb-4" id="collapseExample">
                            <span class="text-uppercase ml-3 text-mute  d font-weight-bold">
                                Select Method :
                            </span>
                            <br class="mb-2">
                            <a nowrap href="" class="mr-2  nyayomat-blue mx-3">
                                <i class="bx bxs-file-pdf"></i> Porta   ble Document Format <code>(PDF)</code>
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
                            <table class="table  table-borderless" id="pagestable">
                                <thead>
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <th nowrap>
                                            Visibility
                                        </th>
                                        <th nowrap>
                                            View Position
                                        </th>
                                        <th nowrap>
                                            Created At
                                        </th>
                                        <th nowrap>
                                            Last Updated
                                        </th>
                                        <th nowrap>
                                            Author
                                        </th>
                                        <th nowrap>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( webPages() as $page )
                                        <tr>
                                            
                                            <td nowrap>
                                                {{ $page->title }}
                                            </td>
                                            <td nowrap>
                                                <span class="btn btn-sm btn-info">
                                                    {{ $page->visibility }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $page->position}}
                                            </td>
                                            
                                            <td nowrap>
                                                {{ $page->created_at }}
                                            </td>
                                            <td nowrap>
                                                {{ $page->updated_at }}
                                            </td>
                                            <td nowrap>
                                                {{ $page->author->name}}
                                            </td>
                                            <td nowrap>
                                                <a href="#restock" data-toggle="modal" class="nyayomat-blue">
                                                    <i class="bx bx-edit"></i>
                                                    <a href="" class="nyayomat-blue"  onclick="event.preventDefault();
                                                    document.getElementById('{{$page->id}}').submit();">
                                                        <i class="bx bx-trash"></i>
                                                    </a>
                                                    
    
                                                   <form id="{{$page->id}}" action="{{ route('delete-page',[ $page->id ] ) }}" method="POST" style="display: none;">
                                                       @csrf
                                                       @method('DELETE')
                                                    
                                                   </form>
                                            </td>
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
                                                            <form action="" class="row">
                                                                <div class="col-md-4 col-6 mb-4">
                                                                    <p class="col-12 px-0">
                                                                        Title :
                                                                    </p>
                                                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                                                </div>
                                                                <div class="col-md-4 col-6 mb-4">
                                                                    <p class="col-12 px-0">
                                                                        Position :
                                                                    </p>
                                                                    <select autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
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
                                                                    <select autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                    
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div id="newPage" class="collapse" aria-labelledby="headingTwo" data-parent="#Pages">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showPages" aria-expanded="true" aria-controls="showPages">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-left font-weight-bold nyayomat-blue mt-3">
                                    New Page
                                </h5>
                            </div>
                            <form action="" class="row">
                                <div class="col-md-4 col-6 mb-4">
                                    <p class="col-12 px-0">
                                        Title :
                                    </p>
                                    <input type="text" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
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
    $('#pagestable').DataTable( {
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
