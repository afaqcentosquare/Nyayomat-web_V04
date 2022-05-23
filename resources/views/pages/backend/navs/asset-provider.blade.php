@extends('dashboard.backend.body', 
                        [
                            'title' => __("Dashboard"),
                            'page_name' => 'Dashboard',
                            'bs_version' => 'bootstrap@4.6.0',
                            'left_nav_color' => '#5723D9',
                            'nav_icon_color' => '#AFA5D9',
                            'active_nav_icon_color' => '#fff',
                            'active_nav_icon_color_border' => 'greenyellow' ,
                            'top_nav_color' => '#F7F6FB',
                            'background_color' => '#F7F6FB',
                        ])

@push('link-css')
<link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
@endpush

@push('link-js')
@endpush


@push('navs')
    <a href="{{route('jamo-dashboard')}}" class="nav_link active"> 
        <i class='bx bx-grid-alt nav_icon'></i> 
        <span class="nav_name">
            Dashboard
        </span>
    </a>

    <a href="{{route('jamo-inventory')}}" class="nav_link">
        <i class='bx bx-package nav_icon'></i>
        <span class="nav_name">
            Inventory
        </span>
    </a>

    <a href="{{route('jamo-category')}}" class="nav_link"> 
        <i class='bx bx-cabinet nav_icon'></i> 
        <span class="nav_name">
            Categories
        </span> 
    </a> 

    <a href="{{route('jamo-promotions')}}" class="nav_link"> 
        <i class='bx bx-gift nav_icon'></i> 
        <span class="nav_name">
            Promotions
        </span>
    </a>

    <a href="{{route('jamo-supplier')}}" class="nav_link"> 
        <i class='bx bx-star nav_icon'></i> 
        <span class="nav_name">
            Suppliers
        </span>
    </a>

    <a href="{{route('jamo-customers')}}" class="nav_link">
        <i class='bx bx-user nav_icon'></i>
        <span class="nav_name">
            Customers    
        </span> 
    </a> 
@endpush

@section('content')
<div class="card-columns">
    {{-- Inventory  --}}
    <div class="card">
        <div class="card-body">
            <div class="">
                <h5 class="text-primary text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                    <span class="badge text-white bg-success">
                        Inventory
                    </span> 
                </h5>
            </div>
            <div class="d-flex justify-content-between px-md-1">
                <div>
                    <h3 class="text-success display-4 my-2 ">
                        {{$itms = rand(100,300)}}</b>
                    </h3>
                    <p class="mb-0 mt-4 text-muted font-weight-light">
                        Total number of items
                    </p>
                </div>
                <div class="align-self-center">
                    <i class="bx bx-package text-success fa-4x"></i>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                    <a href="{{route('jamo-inventory')}}" class="btn btn-sm btn-success" style="letter-spacing: .5px">
                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Categories --}}
    <div class="card">
        <div class="card-body">
            <div class="">
                <h5 class="text-primary text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                    <span class="badge text-white bg-primary">
                        Categories
                    </span> 
                </h5>
            </div>
            <div class="d-flex justify-content-between px-md-1">
                <div>
                    <h3 class="text-primary display-4 my-2 ">
                        {{rand(8,10)}}
                    </h3>
                    <p class="mb-0 mt-4 text-muted font-weight-light" >
                        With <b>{{rand(12,20)}}</b> sub categories having <b>{{$itms}}</b> products
                    </p>
                </div>
                <div class="align-self-center">
                    <i class="bx bx-cabinet text-primary fa-4x"></i>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                    <a href="{{route('jamo-category')}}" class="btn btn-sm btn-primary" style="letter-spacing: .5px">
                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Customers --}}
    <div class="card">
        <div class="card-body">
            <div class="">
                <h5 class="text-secondary text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                    <span class="badge text-white bg-secondary">
                        Customers
                    </span> 
                </h5>
            </div>
            <div class="d-flex justify-content-between px-md-1">
                <div class="align-self-center">
                    <i class="bx bx-user text-secondary fa-4x"></i>
                    <p class="mb-0 mt-4 text-muted font-weight-light">
                        Subscribed customers
                    </p>
                </div>
                <div>
                    <h3 class="text-secondary display-4 my-2 ">
                        {{rand(100,300)}}</b>
                    </h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                    <a href="{{route('jamo-customers')}}" class="btn btn-sm btn-secondary" style="letter-spacing: .5px">
                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Promotions --}}
    <div class="card">
        <div class="card-body">
            <div class="">
                <h5 class="text-teal-400 text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                    <span class="badge text-white bg-danger">
                        Promotions   
                    </span> 
                </h5>
            </div>
            <div class="d-flex justify-content-between px-md-1">
                <div class="align-self-center">
                    <i class="bx bx-star text-danger fa-4x"></i>
                    <p class="mb-0 mt-4 text-muted font-weight-light">
                        Promotions currently active
                    </p>
                </div>
                <div>
                    <h3 class="text-danger display-4 my-2 ">
                        {{rand(1,15)}}
                    </h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                    <a href="{{route('jamo-promotions')}}" class="btn btn-sm btn-danger" style="letter-spacing: .5px">
                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Suppliers --}}
    <div class="card">
        <div class="card-body">
            <div class="">
                <h5 class="text-warning text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                    <span class="badge text-white bg-info">
                        Suppliers
                    </span> 
                </h5>
            </div>
            <div class="d-flex justify-content-between px-md-1">
                <div class="align-self-center">
                    <i class="bx bx-star  text-info fa-4x"></i>
                    <p class="mb-0 mt-4 text-muted font-weight-light">
                        In the system
                    </p>
                </div>
                <div>
                    <h3 class="text-info display-4 my-2 ">
                        {{rand(15,30)}}
                    </h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                    <a href="{{route('jamo-supplier')}}" class="btn btn-sm btn-info" style="letter-spacing: .5px">
                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Newsletter --}}
    <div class="card">
        <div class="card-body">
            <div class="">
                <h5 class="text-warning text-uppercase" style="font-weight: 800;opacity: .4;letter-spacing: .5px">
                    <span class="badge text-white bg-warning">
                        Newsletter   
                    </span> 
                </h5>
            </div>
            <div class="d-flex justify-content-between px-md-1">
                <div class="align-self-center">
                    <i class="bx bx-receipt text-warning fa-4x"></i>
                    <p class="mb-0 mt-4 text-muted font-weight-light">
                        Sent Newsletters
                    </p>
                </div>
                <div>
                    <h3 class="text-warning display-4 my-2 ">
                        {{rand(1,15)}}
                    </h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                    <a href="{{route('jamo-customers')}}" class="btn btn-sm btn-warning" style="letter-spacing: .5px">
                        view <i class="bx bx-right-arrow-alt font-weight-bold" style="font-size: 12px"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> 
{{-- Modals --}}
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Modal title
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
        </div>
    </div>
</div>
  
@endsection

@push('scripts')
@endpush
