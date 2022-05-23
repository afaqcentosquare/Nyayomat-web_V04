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
                Edit User-Role
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
                        EDIT USER-ROLE
                    </div> 
                    
                    
                    
                  
                    <div class="row">
                        <div class="col-12 table-responsive">

                        
                            <table class="table">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a class="nyayomat-blue font-weight-bold " href="{{ route('roles')}}">
                                                Back
                                            </a>
                                        </div>
        
                                        <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                            EDIT ROLE
                                        </h5>
                                    </div>
                                    
                                    <form id="delete-product" action="{{ route('update-role',[ 'id' => $role->id ]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                                        
                                        <div class="col-12 mb-4">
                                            <p class="col-12 px-0">
                                                Name :
                                            </p>
                                            <input type="text" name="name" value="{{$role->name}}"  class="col-12 py-2 rounded shadow-sm border-0">
                                        </div>
                                        <div class="col-12 mb-4">
                                            <p class="col-12 px-0">
                                                Description :
                                            </p>
                                            <textarea name="description" value="{{$role->description}}" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
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
                                                
                                                        {{ Form::checkbox('permission[]', $exact_permission->id, in_array($exact_permission->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                            
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
                                                                Update Role  <i class="bx ml-1 bx-plus"></i>
                                                            </button>
                                        </div>
                                    </form>
                                   
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
              

            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
