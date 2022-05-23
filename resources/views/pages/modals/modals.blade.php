{{-- Cart --}}
<div class="modal fade" id="myCart" tabindex="-1" role="dialog" aria-labelledby="myCartLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="myCartLabel">
                    Shopping Cart
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th scope="col">
                                    Name
                                </th>
                                <th scope="col">
                                    Quantity
                                </th>
                                <th scope="col">
                                    
                                </th>
                                <th scope="col">
                                    Cost
                                </th>
                            </tr>
                        </thead>
                        <tbody class="show-cart">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default">
                    Total <sub class="font-weight-bold ml-2">Ksh</sub> <span class="total-cart"></span>
                </button>

                <button class="clear-cart btn btn-outline-danger">
                    Empty Cart <i class="bx bxs-trash ml-2"></i>
                </button>
                
            </div>
            <div class="modal-footer mt-0 pt-0">
                <a href="{{route('checkout')}}" class="btn btn-success col-12">
                    Checkout
                </a>
            </div>
        </div>
    </div>
</div>
@if (Route::is('landing'))
    {{-- Services Modal --}}
    <div class="modal fade" id="servicesModal" tabindex="-1" role="dialog" aria-labelledby="servicesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servicesModalLabel">
                        Nyayomat Services
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-md-column row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active col-5 mr-1 col-md-12 mb-3" id="v-pills-asset-finance-tab" data-toggle="pill" href="#v-pills-asset-finance" role="tab" aria-controls="v-pills-asset-finance" aria-selected="true">
                                    Asset Finance
                                </a>
                                <a class="nav-link mb-3 col-6 mx-auto col-md-12" id="v-pills-location-tab" data-toggle="pill" href="#v-pills-vending" role="tab" aria-controls="v-pills-vending" aria-selected="false">
                                    Merchant Services
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-asset-finance" role="tabpanel" aria-labelledby="v-pills-asset-finance-tab">
                                    <div class="row">
                                        <p class="col-12">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum quam accusantium expedita tenetur, odit eligendi ad corrupti non debitis, 
                                            vitae a vel delectus libero, eius in commodi voluptatum dolores voluptatem?
                                        </p>
                                        <p class="">
                                            <a href="{{route('downloads')}}" class="">
                                                Download Template
                                            </a>
                                        </p>
                                        <p class="col-12">
                                            <span class="z-depth-1">
                                            <a href="" class="btn col btn-outline-primary">
                                                    More <i class='bx bx-link-external ml-2' ></i>
                                                </a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-vending" role="tabpanel" aria-labelledby="v-pills-location-tab">
                                    <div class="row">
                                        <p class="col-12">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum quam accusantium expedita tenetur, odit eligendi ad corrupti non debitis, 
                                            vitae a vel delectus libero, eius in commodi voluptatum dolores voluptatem?
                                        </p>
                                        <p class="col-12">
                                            <span class="z-depth-1">
                                            <a href="" class="btn btn-outline-primary">
                                                    More <i class='bx bx-link-external ml-2' ></i>
                                                </a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <div class="row">

                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
@endif
@if (Route::is('shopping'))
    {{-- Filter --}}
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">
                        Filter Products By :
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active mb-3" id="v-pills-change-location-tab" data-toggle="pill" href="#v-pills-change-location" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                    Change Location
                                </a>
                                <a class="nav-link mb-3" id="v-pills-asset-price-tab" data-toggle="pill" href="#v-pills-price" role="tab" aria-controls="v-pills-asset-finance" aria-selected="true">
                                    <span class="text-muted text-white"></span> Price
                                </a>
                                <a class="nav-link mb-3" id="v-pills-location-tab" data-toggle="pill" href="#v-pills-location" role="tab" aria-controls="v-pills-vending" aria-selected="false">
                                Category 
                                </a>
                                {{-- 
                                <a class="nav-link mb-3" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                    Settings
                                </a> --}}
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane show active fade" id="v-pills-change-location" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="col-12 text-muted" style="font-size: 1.8vh">
                                                {{__('Change Location')}}
                                            </p>
                                            <select class="form-control border-top-0 border-left-0 border-right-0"  name="" autocomplete="off"  onchange="location = this.value;">
                                                <option value="{{route('shopping')}}">
                                                    Location 1
                                                </option>
                                                <optgroup label="Area One">
                                                    Area One
                                                    <option value="{{route('shopping')}}">
                                                        Location 1
                                                    </option>
                                                    <option value="{{route('shopping')}}">
                                                        Location 2
                                                    </option>
                                                    <option value="{{route('shopping')}}">
                                                        Location 3
                                                    </option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="v-pills-price" role="tabpanel" aria-labelledby="v-pills-asset-price-tab">
                                    <div class="row">
                                        <div>
                                            <Slider v-model="value" />
                                        </div>
                                        
                                        <p class="col-12 text-center mt-3">
                                            <a href="{{route('landing')}}" class="text-primary ">
                                                More <i class="bx bx-link-external ml-2"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-location" role="tabpanel" aria-labelledby="v-pills-location-tab">
                                    <div class="row">
                                        <p class="col-12 ">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum quam accusantium expedita tenetur, odit eligendi ad corrupti non debitis, 
                                            vitae a vel delectus libero, eius in commodi voluptatum dolores voluptatem?
                                        </p>
                                        <p class="col-12">
                                            <a href="" class="text-default btn-md">
                                                More <i class="bx bx-external-link ml-2"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                {{-- 

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <div class="row">

                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
@endif
@if (Route::is('admin'))
    {{-- Asset Provider --}}
    <div class="modal fade" id="newAssetProvider" tabindex="-1" role="dialog" aria-labelledby="newAssetProviderLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                                    Add Asset Provider
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                                    Upload File
                                </a>
                            </li>
                        </ul>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Business Name" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-phone"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Phone No." type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-at"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="E Mail" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-map"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="county" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-map-alt"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Location" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-user-plus"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="User Email" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="form-group">
                                            <a href="{{route('asset provider')}}" class="btn btn-md btn-outline-primary">
                                                Submit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group has-success">
                                            <input type="text" placeholder="Success" class="form-control form-control-alternative" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Vendors --}}
    <div class="modal fade" id="newVendor" tabindex="-1" role="dialog" aria-labelledby="newVendorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="vendor-menu-tab" data-toggle="tab" href="#vendor-menu" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                                    Add Vendor
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="upload-vendor-tab" data-toggle="tab" href="#upload-vendor" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                                    Upload File
                                </a>
                            </li>
                        </ul>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="vendor-menu" role="tabpanel" aria-labelledby="vendor-menu-tab">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Business Name" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-phone"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Phone No." type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-at"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="E Mail" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-map"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="county" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-map-alt"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Location" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-user-plus"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="User Email" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="form-group">
                                            <a href="{{route('vendor')}}" class="btn btn-md btn-outline-primary">
                                                Submit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="upload-vendor" role="tabpanel" aria-labelledby="upload-vendor-tab">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group has-success">
                                            <input type="text" placeholder="Success" class="form-control form-control-alternative" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
    </div>
@endif

@if (Route::is('service-provider.show') && $service_provider -> type == 'asset_provider')
    {{-- Upload Asset --}}
    <div class="modal fade" id="uploadAsset" tabindex="-1" role="dialog" aria-labelledby="uploadAssetLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="vendor-menu-tab" data-toggle="tab" href="#vendor-menu" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                                    Add Asset
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="upload-vendor-tab" data-toggle="tab" href="#upload-vendor" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                                    Upload Assets File
                                </a>
                            </li>
                        </ul>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="vendor-menu" role="tabpanel" aria-labelledby="vendor-menu-tab">
                            <form role="form" method="POST"   enctype="multipart/form-data"   action="{{ route('asset.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-photo-album"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" name="image" type="file" accept="images/*">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Asset Name" name="name" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-info-circle"></i>
                                                    </span>
                                                </div>
                                                <textarea class="form-control form-control-alternative" rows="4" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-category-alt"></i>
                                                    </span>
                                                </div>
                                                <select required class="form-control form-control-alternative" name="sell_type" id="">
                                                    <option value="">
                                                        {{__('Select option')}}
                                                    </option>
                                                    <option value="hire_purchase">
                                                        {{__('Hire Purchase')}}
                                                    </option>
                                                    <option value="rental">
                                                        {{__('Rent')}}
                                                    </option>
                                                    <option value="sale">
                                                        {{__('Sale')}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-dollar"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Amount" name="amount" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-map-alt"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="County" type="text" name="county">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-map-alt"></i>
                                                    </span>
                                                </div>
                                                <input class="form-control form-control-alternative" placeholder="Location" name="location" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="service_provider_id" value="{{$service_provider -> id }}">
                                    <div class="col-12 text-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="upload-vendor" role="tabpanel" aria-labelledby="upload-vendor-tab">
                            <form action="{{ route('import-assets') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control form-control-alternative" type="file" name="file" class="form-control">

                                <button class="btn btn-sm btn-success">
                                    {{__('Upload')}}
                                </button>
                            </form>

                            <div class="row">
                                <div class="col-12">
                                    <a href="{{route('downloads')}}" class="btn btn-sm my-0 btn-secondary">
                                        <i class="bx bx-cloud-download mr-2"></i> Dowload Template
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
    </div>
    
    {{-- Asset image --}}
    @foreach ($service_provider -> assets as $asset)
        <div class="modal fade" id="assetModal{{$asset -> id}}" tabindex="-1" role="dialog" aria-labelledby="assetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="display-4 col-12">
                            {{Str::title($service_provider -> name)}}
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="content-overlay"></div>
                                <img class="content-image shadow" src="{{asset('uploads/landscape.jpg')}}" style="object-fit:cover;height:55vh">
                                <div class="content-details fadeIn-bottom">
                                    <h3 class="content-title mb-0">
                                        
                                    </h3>
                                </div>
                            </div>
                            <div class="col-12 pt-3">
                                <div class="row">
                                    <h3 class="display-4 col-12">
                                        {{Str::title($asset -> name)}} <sub class="ml-3 font-weight-light"></sub>
                                    </h3>
                                    <p class="col-12">
                                        {{$asset -> description}}
                                    </p>
                                    <h3 class="col-12">
                                       <span class="small-text mr-2 text-muted">Ksh.</span> {{number_format(($asset -> amount),2)}}
                                    </h3>
                                    <p class="col-12">
                                        <i class="bx bxs-map"></i> 
                                        {{Str::title($asset -> county)}} , 
                                        <span class="small-text">
                                            {{Str::title($asset -> location)}}
                                        </span>
                                    </p>
                                    {{-- <p class="col-12">
                                        Leased out to :
                                    </p>
                                    <ul class="col-12 list-unstyled">
                                        <li>
                                            <span class="mr-2"> 
                                                User
                                            </span>

                                            John  J Doe
                                        </li>

                                        <li>
                                            <span class="mr-2"> 
                                                Date Posted
                                            </span>
                                            10 / 02 / 2021 
                                        </li>

                                        <li>
                                            <span class="mr-2"> 
                                                Location
                                            </span>
                                                Location Here
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="assetApplicationModal{{$asset -> id}}" tabindex="-1" role="dialog" aria-labelledby="assetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header my-0">
                        @if ($asset -> sell_type == 'rental')
                            <h3 class="display-4 font-weight-light text-center mb-4">
                                {{__('Asset Rental Application')}} <sub class="ml-3 font-weight-light"></sub>
                            </h3>
                        @endif
                        @if ($asset -> sell_type == 'sale')
                            <h3 class="display-4 font-weight-light text-center mb-4">
                                {{__('Asset Purchase Application')}} <sub class="ml-3 font-weight-light"></sub>
                            </h3>
                        @endif
                        @if ($asset -> sell_type == 'hire-purchase')
                            <h3 class="display-4 font-weight-light text-center mb-4">
                                {{__('Asset Hire Purchase Application')}} <sub class="ml-3 font-weight-light"></sub>
                            </h3>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  py-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="accordion col-12" id="accordionExample">
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="row">
                                                @if ($asset -> sell_type == 'sale')
                                                    <h3 class="col-12">
                                                        <span class="small-text mr-2 text-muted">
                                                            Ksh.
                                                        </span>
                                                        {{number_format(($asset -> amount) , 2)}}
                                                    </h3>
                                                    <p class="col-12">
                                                        <i class="bx bxs-map"></i> 
                                                        {{Str::title($asset -> county)}} , 
                                                        <span class="small-text">
                                                            {{Str::title($asset -> location)}}
                                                        </span>
                                                    </p>
                                                @endif

                                                @if ($asset -> sell_type == 'rental')
                                                    <p class="col-12">
                                                        {{__("You're about to submit a renting application for")}}
                                                        <span class="font-weight-bold">
                                                            {{Str::title($asset -> name)}}
                                                        </span>
                                                        {{__("at a monthly rate of")}}
                                                        <span class="font-weight-bold">
                                                            <span class="small-text mr-2 text-muted">Ksh.</span> {{number_format(($asset -> amount),2)}}
                                                        </span>
                                                    </p>
                                                    <p class="col-12">
                                                        {{__("Recepient : ")}} 
                                                        <span class="font-weight-bold"> {{Str::title($asset -> service_provider -> name)}}</span>
                                                    </p>
                                                @endif

                                                @if ($asset -> sell_type == 'hire-purchase')
                                                    <h3 class="col-12">
                                                    <span class="small-text mr-2 text-muted">Ksh.</span> {{number_format(($asset -> amount),2)}}
                                                    </h3>
                                                    <p class="col-12">
                                                        <i class="bx bxs-map"></i> 
                                                        {{Str::title($asset -> county)}} , 
                                                        <span class="small-text">
                                                            {{Str::title($asset -> location)}}
                                                        </span>
                                                    </p>
                                                    <p class="col-12">
                                                        {{__("Recepient : ")}}  {{$asset -> asset_provider -> name}}
                                                    </p>
                                                @endif
                                                <div class="col-12">
                                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                                        <input class="custom-control-input" autocomplete="off" id="customCheckRegister" type="checkbox">
                                                        <label class="custom-control-label" for="customCheckRegister">
                                                            <span class="text-muted">
                                                                {{ __('By checking this box, you are agreeing to certain terms and conditions') }}
                                                                <a class=" collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    {{ __('Click here to read') }}
                                                                </a>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="text-center col-12 mb-3">
                                                    <button type="submit" disabled class="btn btn-primary btn-md mt-4">
                                                    {{__('Proceed')}}
                                                    </button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                          
                                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body mt-0">
                                                <div class="row">
                                                    <p class="text-small col-12">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta ipsam, 
                                                        tempore inventore aliquam laboriosam in odit rerum iure fuga quia, reiciendis natus
                                                        atque eum! Excepturi cum cupiditate iste voluptatum vel.
                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste corrupti quasi perferendis? 
                                                        Quidem, ea. Deserunt, excepturi delectus! Sequi nobis fugiat, nam qui laudantium soluta mollitia, 
                                                        numquam fugit deserunt at aliquid!
                                                    </p>
                                                    <p class="col-12 text-right">
                                                        <a class="text-primary" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            back
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                          </div>
                                        
                                      </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach (App\Asset::get() as $asset)
    <div class="modal fade" id="assetModal{{$asset -> id}}" tabindex="-1" role="dialog" aria-labelledby="assetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="display-4 col-12">
                        {{Str::title($service_provider -> name)}}
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="content-overlay"></div>
                            <img class="content-image shadow" src="{{asset('uploads/landscape.jpg')}}" style="object-fit:cover;height:55vh">
                            <div class="content-details fadeIn-bottom">
                                <h3 class="content-title mb-0">
                                    
                                </h3>
                            </div>
                        </div>
                        <div class="col-12 pt-3">
                            <div class="row">
                                <h3 class="display-4 col-12">
                                    {{Str::title($asset -> name)}} <sub class="ml-3 font-weight-light"></sub>
                                </h3>
                                <p class="col-12">
                                    {{$asset -> description}}
                                </p>
                                <h3 class="col-12">
                                   <span class="small-text mr-2 text-muted">Ksh.</span> {{number_format(($asset -> amount),2)}}
                                </h3>
                                <p class="col-12">
                                    <i class="bx bxs-map"></i> 
                                    {{Str::title($asset -> county)}} , 
                                    <span class="small-text">
                                        {{Str::title($asset -> location)}}
                                    </span>
                                </p>
                                {{-- <p class="col-12">
                                    Leased out to :
                                </p>
                                <ul class="col-12 list-unstyled">
                                    <li>
                                        <span class="mr-2"> 
                                            User
                                        </span>

                                        John  J Doe
                                    </li>

                                    <li>
                                        <span class="mr-2"> 
                                            Date Posted
                                        </span>
                                        10 / 02 / 2021 
                                    </li>

                                    <li>
                                        <span class="mr-2"> 
                                            Location
                                        </span>
                                            Location Here
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="assetApplicationModal{{$asset -> id}}" tabindex="-1" role="dialog" aria-labelledby="assetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header my-0">
                    @if ($asset -> sell_type == 'rental')
                        <h3 class="display-4 font-weight-light text-center mb-4">
                            {{__('Asset Rental Application')}} <sub class="ml-3 font-weight-light"></sub>
                        </h3>
                    @endif
                    @if ($asset -> sell_type == 'sale')
                        <h3 class="display-4 font-weight-light text-center mb-4">
                            {{__('Asset Purchase Application')}} <sub class="ml-3 font-weight-light"></sub>
                        </h3>
                    @endif
                    @if ($asset -> sell_type == 'hire-purchase')
                        <h3 class="display-4 font-weight-light text-center mb-4">
                            {{__('Asset Hire Purchase Application')}} <sub class="ml-3 font-weight-light"></sub>
                        </h3>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  py-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="accordion col-12" id="accordionExample">
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="row">
                                            @if ($asset -> sell_type == 'sale')
                                                <h3 class="col-12">
                                                    <span class="small-text mr-2 text-muted">
                                                        Ksh.
                                                    </span>
                                                    {{number_format(($asset -> amount) , 2)}}
                                                </h3>
                                                <p class="col-12">
                                                    <i class="bx bxs-map"></i> 
                                                    {{Str::title($asset -> county)}} , 
                                                    <span class="small-text">
                                                        {{Str::title($asset -> location)}}
                                                    </span>
                                                </p>
                                            @endif

                                            @if ($asset -> sell_type == 'rental')
                                                <p class="col-12">
                                                    {{__("You're about to submit a renting application for")}}
                                                    <span class="font-weight-bold">
                                                        {{Str::title($asset -> name)}}
                                                    </span>
                                                    {{__("at a monthly rate of")}}
                                                    <span class="font-weight-bold">
                                                        <span class="small-text mr-2 text-muted">Ksh.</span> {{number_format(($asset -> amount),2)}}
                                                    </span>
                                                </p>
                                                <p class="col-12">
                                                    {{__("Recepient : ")}} 
                                                    <span class="font-weight-bold"> {{Str::title($asset -> service_provider -> name)}}</span>
                                                </p>
                                            @endif

                                            @if ($asset -> sell_type == 'hire-purchase')
                                                <h3 class="col-12">
                                                <span class="small-text mr-2 text-muted">Ksh.</span> {{number_format(($asset -> amount),2)}}
                                                </h3>
                                                <p class="col-12">
                                                    <i class="bx bxs-map"></i> 
                                                    {{Str::title($asset -> county)}} , 
                                                    <span class="small-text">
                                                        {{Str::title($asset -> location)}}
                                                    </span>
                                                </p>
                                                <p class="col-12">
                                                    {{__("Recepient : ")}}  {{$asset -> asset_provider -> name}}
                                                </p>
                                            @endif
                                            <div class="col-12">
                                                <div class="custom-control custom-control-alternative custom-checkbox">
                                                    <input class="custom-control-input" autocomplete="off" id="customCheckRegister" type="checkbox">
                                                    <label class="custom-control-label" for="customCheckRegister">
                                                        <span class="text-muted">
                                                            {{ __('By checking this box, you are agreeing to certain terms and conditions') }}
                                                            <a class=" collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                {{ __('Click here to read') }}
                                                            </a>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="text-center col-12 mb-3">
                                                <button type="submit" disabled class="btn btn-primary btn-md mt-4">
                                                {{__('Proceed')}}
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                      
                                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body mt-0">
                                            <div class="row">
                                                <p class="text-small col-12">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta ipsam, 
                                                    tempore inventore aliquam laboriosam in odit rerum iure fuga quia, reiciendis natus
                                                    atque eum! Excepturi cum cupiditate iste voluptatum vel.
                                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste corrupti quasi perferendis? 
                                                    Quidem, ea. Deserunt, excepturi delectus! Sequi nobis fugiat, nam qui laudantium soluta mollitia, 
                                                    numquam fugit deserunt at aliquid!
                                                </p>
                                                <p class="col-12 text-right">
                                                    <a class="text-primary" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        back
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                      </div>
                                    
                                  </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
    
@endif
@if (Route::is('service-provider.show'))
    <div class="modal fade" id="updateItemModal" tabindex="-1" role="dialog" aria-labelledby="updateItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="ni ni-zoom-split-in"></i>
                                            </span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Item Name" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bx bx-phone"></i>
                                            </span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Weight / Size" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bx bx-at"></i>
                                            </span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Buying Price" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bx bx-map"></i>
                                            </span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Selling Price" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bx bx-map-alt"></i>
                                            </span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Quantity" type="text">
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 text-center">
                                <div class="form-group">
                                    <a href="{{route('asset provider')}}" class="btn btn-md btn-outline-primary">
                                        Submit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="makePaymentmodal" tabindex="-1" role="dialog" aria-labelledby="makePaymentmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bx bx-hash"></i>
                                            </span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Recepient" type="text">
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bx bx-info-circle"></i>
                                            </span>
                                        </div>
                                        <textarea class="form-control form-control-alternative" placeholder="Purpose" type="text"></textarea>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text small-text" style="font-size: 1.8vh">
                                                Ksh
                                            </span>
                                        </div>
                                        <input class="form-control form-control-alternative" placeholder="Amount" type="text">
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-12 text-center">
                                <div class="form-group">
                                    <a href="{{route('asset provider')}}" class="btn btn-sm shadow btn-primary">
                                        Make Payment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif