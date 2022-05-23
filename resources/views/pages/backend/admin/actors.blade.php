@extends('layouts.backend.main', 
                        [
                            'title' => __("System Actors"),
                            'page_name' => 'System Actors',
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
            .collapse{
                width: 100%
            }

            .nyayomat-blue{
                color: #036CB1
            }
            .bg-nyayomat-blue{
                background-color: #036CB1
            }
            /* // Small devices (landscape phones, 576px and up) */
            @media (min-width: 350px) {
                .big-money {
                    font-size: 4vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }
                .icon-size {
                    font-size: 3rem;
                }
            }

            /* // Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {  }

            /* // Large devices (desktops, 992px and up) */
            @media (min-width: 992px) { }

            /* // Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) { 
                .big-money {
                    font-size: 2vw;
                }
                
                h3 > small {
                    font-size: 2.0vw
                }
                .icon-size {
                    font-size: 3rem;
                }
                .icon-size{
                    font-size: 7.0vh;
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
                {{config('app.name')}}
            </a> /
            <a href="" class="text-primary ml-1">
                System Actors
            </a>  
        </div>
    </div>
    
    <ul class="nav nav-pills nav-list mb-3" id="pills-tab" role="tablist">
        <li class="nav-item mr-2" role="presentation">
            <a class="nav-link active" id="pills-merchants-tab" data-toggle="pill" href="#pills-merchants" role="tab" aria-controls="pills-merchants" aria-selected="true">
                Merchants
            </a>
        </li>
        <li class="nav-item mr-2" role="presentation">
            <a class="nav-link" id="pills-customers-tab" data-toggle="pill" href="#pills-customers" role="tab" aria-controls="pills-customers" aria-selected="false">
                Customers
            </a>
        {{-- </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-associates-tab" data-toggle="pill" href="#pills-associates" role="tab" aria-controls="pills-associates" aria-selected="false">
                Associates
            </a>
        </li> --}}
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-merchants" role="tabpanel" aria-labelledby="pills-merchants-tab" style="">
            <ul class="nav pl-4  nav-pills nav-list mb-3" id="pills-tab" role="tablist">
                <li class="nav-item mr-2" role="presentation">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" style="padding: 2px 6px 2px 6px ">
                        Listed
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" style="padding: 2px 6px 2px 6px ">
                        Applications
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="">
                    <div class="row mb-4">
                        <div class="col-md-7 col-0 d-none d-md-block">
                            <input type="text" id="myInput" class="form-control col-12" onkeyup="myFunction()" placeholder="Find Merchant.." title="Type in a name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="font-weight-normal">
                                            Img
                                        </th>
                                        <th class="font-weight-normal">
                                            Name
                                        </th>
                                        <th class="font-weight-normal">
                                            County
                                        </th>
                                        <th nowrap class="font-weight-normal">
                                            Location
                                        </th>
                                        <th nowrap class="font-weight-normal">
                                            Phone
                                        </th>
                                        <th nowrap class="font-weight-normal">
                                            E - Mail
                                        </th>
                                        <th nowrap class="font-weight-normal">
                                            Region
                                        </th>
                                        
                                        <th class="font-weight-normal">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="accordion" id="accordionExample2">
                                            <td>
                                            {{$user->image['path']?? 'No Image'}}
                                            </td>
                                            <td class="text-uppercase">
                                                <a href="{{url('/merchant-dashboard')}}" class="">
                                                    {{$user->name}}
                                                </a>
                                                
                                            </td>
                                            
                                
                                            
                                            <td nowrap>
                                                @foreach( $user->locations as $location )
                                                {{ getregionfromid($user->region)}}
                                                @endforeach
                                            </td>
                                            <td nowrap>
                                                @foreach( $user->locations as $location )
                                                {{ $location->name }}
                                                @endforeach
                                            </td>
                                            
                                            <td nowrap>
                                                0{{$user->mobile}} 
                                            </td>
                
                                            <td nowrap>
                                                {{$user->email}}
                                            </td>
                
                                            <td nowrap class="font-weight-light">
                                                @foreach( $user->locations as $location )
                                                {{ getregionfromid($user->region)}}
                                                @endforeach
                                            </td>
                                        

                                            <td nowrap>
                                                <a href="#merchantModal" data-toggle="modal" class="btn btn-sm btn-warning"  style="border-radius: 15px">
                                                    Suspend A / C
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$users->links()}}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                   <div class="row pb-4">
                        <div class="col-md-4 col-lg-3">
                            <div class="card border-0 shadow-sm">
                                <ul class="list-group list-group-flush nyayomat-blue border-0">
                                    <li class="list-group-item my-0 py-1 border-0">
                                        <span class="font-weight-bold text-uppercase">
                                            merchant.
                                        </span>
                                    </li>
                                    <li class="list-group-item my-0 py-1 border-0">
                                        County , <small>Location</small>
                                    </li>
                                    <li class="list-group-item my-0 py-1 border-0">
                                        <a href="" class="mr-2">
                                            <i class="bx bx-phone"></i>
                                        </a>

                                        <a href="" class="mr-2">
                                            <i class="bx bx-at"></i>
                                        </a>
                                    </li>
                                </ul>
                                <div class="row mb-2 pb-2 px-3">
                                    <div class="col-12 text-right">
                                        <a href="" class="shadow-sm ml-1 btn btn-sm btn-success">
                                            Visited <i class="bx bx-check-circle ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-customers" role="tabpanel" aria-labelledby="pills-customers-tab">
            <div class="row mb-4">
                <div class="col-md-7 col-0 d-none d-md-block">
                    <input type="text" id="myInput" class="form-control col-12" onkeyup="myFunction()" placeholder="Find Customer.." title="Type in a name">
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{-- <a href=""> --}}
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
                                    {{-- </a> --}}
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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="tab-pane fade" id="pills-associates" role="tabpanel" aria-labelledby="pills-associates-tab">
            
            <div class="row mb-4">
                <div class="col-md-7 col-0 d-none d-md-block">
                    <input type="text" id="myInput" class="form-control col-12" onkeyup="myFunction()" placeholder="Find Associate.." title="Type in a name">
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th class="font-weight-normal">
                                    Username
                                </th>
                                <th class="font-weight-normal">
                                    Full Name
                                </th>
                                <th nowrap class="font-weight-normal">
                                    E - Mail
                                </th>
                                <th nowrap class="font-weight-normal">
                                    Phone
                                </th>
                                <th class="font-weight-normal">
                                    Role
                                </th>
                                <th class="font-weight-normal">
                                    Team
                                </th>
                                <th class="font-weight-normal">
                                    Status
                                </th>
                                <th class="font-weight-normal">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10 ; $i++)
                                <tr class="accordion" id="accordionExample2">
                                    <td nowrap class="text-uppercase">
                                        {{str::random(15)}}
                                    </td>
                                    <td nowrap class="text-uppercase">
                                        {{str::random(5)}}
                                        {{str::random(5)}}
                                        {{str::random(5)}}
                                    </td>
                                    <td nowrap>
                                        {{str::lower(str::random(10))}}@gmail.com
                                    </td>
                                    <td nowrap>
                                        07{{rand(10000000,90000000)}}
                                    </td>
                                    <td nowrap>
                                        @if ($i %4 != 0)
                                            <span class="font-weight-bold nyayomat-blue h6">
                                                Onboarder     
                                            </span>        
                                        @elseif ($i %3 != 0)
                                            <span class="font-weight-bold nyayomat-blue h6">
                                                Admin    
                                            </span>  
                                        @else
                                            <span class="font-weight-bold nyayomat-blue h6">
                                                Super Admin
                                            </span>
                                        @endif
                                    </td>
                                    <td nowrap>
                                        -- null --
                                    </td>
                                    <td>
                                        @if ($i %5 != 0)
                                        <span class="font-weight-bold text-success h6">
                                            <i class="bx bx-check-circle mr-2"></i>    Active    
                                        </span>        
                                        @else
                                        <span class="font-weight-bold text-muted h6">
                                            <i class="bx bx-dots-horizontal"></i>  Inactive    
                                        </span>  
                                        @endif
                                    </td>
        
                                    <td nowrap>
                                        <a href="#providerModal" data-toggle="modal" class="btn btn-sm btn-warning">
                                            Suspend A / C
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>


    <div class="modal fade" id="merchanModal" data-backdrop="" data-keyboard="false" tabindex="-1" aria-labelledby="merchanModalLabel" aria-hidden="true" style="width: 100%">
        <div class="modal-dialog modal-dialog-centered " style="width: 100%">
            <div class="modal-content border-0 shadow-lg bg-nyayomat-blue">
                <div class="modal-header border-0 text-white">
                    <h5 class="modal-title font-weight-bold text-warning" id="merchanModalLabel">
                        Verification Requried
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="bx bx-x text-white"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body text-white">
                    <div class="row">
                        <p class="col-12">
                            You're about to suspend this account.
                            <br>
                            Do you wish to proceed ?
                        </p>
                        <div class="col-12 text-right font-weight-bolder shadow-md">
                            <a href="" class="btn btn-sm btn-warning nyayomat-blue font-weight-bold text-uppercase">
                                Confirm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="providerModal" data-backdrop="" data-keyboard="false" tabindex="-1" aria-labelledby="providerModalLabel" aria-hidden="true" style="width: 100%">
        <div class="modal-dialog modal-dialog-centered " style="width: 100%">
            <div class="modal-content border-0 shadow-lg bg-nyayomat-blue">
                <div class="modal-header border-0 text-white">
                    <h5 class="modal-title font-weight-bold text-warning" id="providerModalLabel">
                        Verification Requried
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="bx bx-x text-white        "></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body text-white">
                    <div class="row">
                        <p class="col-12">
                            You're about to suspend this account.
                            <br>
                            Do you wish to proceed ?
                        </p>
                        <div class="col-12 text-right font-weight-bolder shadow-md">
                            <a href="" class="btn btn-sm btn-warning nyayomat-blue font-weight-bold text-uppercase">
                                Confirm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

@endsection

@push('scripts')
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
@endpush