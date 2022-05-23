@extends('layouts.backend.main', 
                        [
                            'title' => __("Customers"),
                            'page_name' => 'Customers',
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
                Customers
            </a>  
        </div>
    </div>
      
    <div class="row">
        
<div class="dropdown">
    <button class="btn btn-secondary " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
        <li class="dropdown-item"><a href="#">Some action</a></li>
        <li class="dropdown-item"><a href="#">Some other action</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-submenu">
          <a  class="dropdown-item" tabindex="-1" href="#">Hover me for more options</a>
          <ul class="dropdown-menu">
            <li class="dropdown-item"><a tabindex="-1" href="#">Second level</a></li>
            <li class="dropdown-submenu">
              <a class="dropdown-item" href="#">Even More..</a>
              <ul class="dropdown-menu">
                  <li class="dropdown-item"><a href="#">3rd level</a></li>
                    <li class="dropdown-submenu"><a class="dropdown-item" href="#">another level</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="#">4th level</a></li>
                        <li class="dropdown-item"><a href="#">4th level</a></li>
                        <li class="dropdown-item"><a href="#">4th level</a></li>
                    </ul>
                  </li>
                    <li class="dropdown-item"><a href="#">3rd level</a></li>
              </ul>
            </li>
            <li class="dropdown-item"><a href="#">Second level</a></li>
            <li class="dropdown-item"><a href="#">Second level</a></li>
          </ul>
        </li>
      </ul>
</div>

</div>
        {{-- Customers --}}
        <div class="col-md-10 mx-auto shadow-sm rounded">
            <div class="accordion" id="customers">
                <div id="showcustomers" class="collapse show" aria-labelledby="headingOne" data-parent="#customers"> 
                    <div class="header-left px-0">
                        CUSTOMERS
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newcustomer" aria-expanded="false" aria-controls="newcustomer">
                                NEW CUSTOMER
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
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Name  
                                        </th>
                                        <th nowrap>
                                            E Mail
                                        </th>
                                        <th nowrap>
                                            Phone
                                        </th>
                                        <th nowrap>
                                            Orders
                                        </th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <ul class="list-unstyled">
                                                <li class="font-weight-bold">
                                                    John Doe
                                                </li>
                                                <li>
                                                    <span class="text-success border-0" style="opacity: .7">
                                                        <small style="font-size: 8px">
                                                            <i class="bx bxs-circle mr-1"></i> 
                                                        </small>
                                                        Active
                                                    </span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <span class="badge bg-nyayomat-blue text-white p-10">
                                                100
                                            </span>
                                        </td>
                                        <td>
                                            <a href="" class="mr-1">
                                                <i class="bx bx-user-circle"></i>
                                            </a>
                                            <a href="" class="mr-1">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <a href="" class="mr-1">
                                                <i class="bx bx-id-card"></i>
                                            </a>
                                            <a href="" class="">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div id="newcustomer" class="collapse" aria-labelledby="headingTwo" data-parent="#customers">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showcustomers" aria-expanded="true" aria-controls="showcustomers">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW CUSTOMER
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
