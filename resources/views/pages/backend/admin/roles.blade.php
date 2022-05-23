@extends('layouts.backend.main', 
                        [
                            'title' => __("User-Roles"),
                            'page_name' => 'User-Roles',
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
                User-Roles
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

    <div class="row">
        {{-- User-Roles --}}
        
        <div class="col-md-10 mx-auto shadow-sm rounded">
            <div class="accordion" id="user-roles">
                <div id="showuser-roles" class="collapse show" aria-labelledby="headingOne" data-parent="#user-roles"> 
                    <div class="header-left px-0">
                        USER-ROLES
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newuser-role" aria-expanded="false" aria-controls="newuser-role">
                                NEW ROLE
                            </a>

                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#new-permission" aria-expanded="false" aria-controls="new-permission">
                                NEW PERMISSION
                            </a>
                            
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col mb-4 text-left">
                          
                            <a class="nyayomat-blue ml-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bx bx-link-external mr-2"></i>  Export Information
                            </a>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">

                        
                            <table id="rolestable" class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Role  
                                        </th>
                                        <th>
                                            Permissions
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Level
                                        </th>
                                        <th>
                                           Option 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                        
                                    @foreach( $roles as $role )
                                    <tr>
                                        <td>
                                            <ul class="list-unstyled">
                                                <li class="font-weight-bold">
                                                   {{$role->name}}
                                                </li>
                                                <li>
                                                    <small>
                                                        {{$role->description}}
                                                    </small>
                                                </li>

                                            </ul>
                                        </td>
                                        <td>

                                        @foreach( $role->permissions as $permission_name)
                                        <ul>
                                            <li>
                                            <small>  {{$permission_name->name}} </small>
                                            </li>
                                        </ul>
                                        @endforeach

                                        </td>
                                        <td>
                                        {{$role->public}}
                                        </td>
                                        <td>
                                        {{$role->level}}
                                        </td>
                                        <td>
                                            <a href="{{ route('edit-role-form',[ 'rolename' => $role->name , 'roleid' => $role->id ] ) }}" class="mr-2">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                           
                                            <a  data-toggle="collapse"  aria-expanded="false" aria-controls=" {{$role->name}}" class="mr-1 btn btn-sm shadow-sm btn-outline-danger"  onclick="event.preventDefault();
                                                     document.getElementById('{{$role->name}}').submit();">
                                                        <i class="bx bx-trash mr-1" style="font-size: 14px"></i> Delete Role
                                                </a>

                                                <form id="{{$role->name}}" action="{{ route('deleterole',[ $role->id , $role->name ] ) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                 
                                                </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                             
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <div id="newuser-role" class="collapse" aria-labelledby="headingTwo" data-parent="#user-roles">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showuser-roles" aria-expanded="true" aria-controls="showuser-roles">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    NEW ROLE
                                </h5>
                            </div>
                            
                            <form id="delete-product" action="{{ route('createnewrole' ) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Name :
                                    </p>
                                    <input type="text" name="role_name" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Description :
                                    </p>
                                    <textarea name="role_description" placeholder="Type here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Platform :
                                    </p>
                                    <select name="role_target" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                        <option value="">
                                            -- Select One --
                                        </option>
                                        <option value="acp">
                                            ACP
                                        </option>
                                        <option selected value="ecom">
                                            Ecommerce
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 px-4 mt-3 mb-2 text-muted pl-3">
                                    {{-- <b style="font-size: 14px"> --}}
                                        Set Privileges :
                                    {{-- </b> --}}
                                </div>
                                @foreach(getModules() as $value)
            
                                <div class="col-12 px-4 mt-3 mb-2 text-muted pl-3">
                                    <b class="text-uppercase" style="font-size: 14px">
                                    {{ $value->name }} :
                                    </b>
                                </div>
                                @foreach($value->permissions as $exact_permission ) 
                                <div class="col-12 px-4 mt-2">
                                    <div class="row">                                                        
                                     <div class="col-md-3 col-4 mb-2">
                                            <div class="custom-control custom-control-alternative custom-checkbox mb-3 ">
                                        
                                {{ Form::checkbox('permission[]', $exact_permission->id, false, array('class' => 'name')) }}
                                         {{ $exact_permission->name }}
           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @endforeach
                                <div class="col-12 px-4 mt-2">
                                    
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



                <!--added New permission form  -->
                <div class="card border-0">
                    <div id="new-permission" class="collapse" aria-labelledby="headingTwo" data-parent="#user-roles">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showuser-roles" aria-expanded="true" aria-controls="showuser-roles">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    New Permission
                                </h5>
                            </div>
                            
                            <form id="permission-created" action="{{ route('createnewpermission' ) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                
                                
                             
                                
                               
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Choose Module :
                                    </p>
                                    <select name="module_id"  class="col-12 py-2 rounded shadow-sm border-0">
                                        <option disabled selected value="">
                                            -- Select One --
                                        </option>
                                        @foreach( modules() as $value)
                                        <option value="{{ $value->id }}">
                                        {{ $value->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Permission Slug :
                                    </p>
                                    <input type="text" name="permission_slug" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>

                                
                                <div class="col-12 px-4 mt-2">
                                    
                                </div>
                                <div class="col-12 text-center">
                                   <button type="submit" class="btn btn-success btn-sm shadow-sm">
                                                        Add Permission <i class="bx ml-1 bx-plus"></i>
                                                    </button>
                                </div>
                            </form>
                           
                        </div>
                    </div>
                    
                </div>

                <!-- end New Permission form -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#rolestable').DataTable( {
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
