<div class="row">
    @if (Auth::user()->email == 'superadmin@gmail.com')
        <p class="col-12 mt-2">
            {{__('To add an asset,')}} 
            <a  data-toggle="modal" href="#uploadAsset" class="btn btn-sm btn-default my-0 btn-default text-white">
                {{__('Click here')}}
            </a>
        </p>
    @endif
    <div class="col-12 px-0">
        <ul class="nav nav-tabs border-0 mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                  Open
                </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                  Engaged
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="px-0 table-responsive mt-3">
                    <table class="table ">  
                        <thead>
                            <tr>
                                <th>
                                    Listing    
                                </th>    

                                <th>
                                    Cost  
                                </th>    

                                <th>
                                    Units   
                                </th>    

                                <th>
                                    Location    
                                </th> 
                                
                                <th>
                                    Action    
                                </th>  
                               
                            </tr>    
                        </thead>   
                        <tbody class="px-0 table-borderless">
                            @foreach ($service_provider -> assets as $asset)
                                <tr class="">
                                    <td>
                                        <a href="#assetModal{{$asset -> id}}" data-toggle="modal" class="text-primary">
                                            {{Str::title($asset -> name)}}
                                        </a>
                                    </td>
        
                                    <td>
                                        <span class="text-muted small-text mr-2">Ksh</span>{{number_format($asset -> amount)}}
                                    </td>

                                    <td>
                                        {{(rand(10,20))}}
                                    </td>
        
                                    <td>
                                        <i class="bx bxs-map"></i> {{Str::title($asset -> county)}} , <span class="small-text">{{Str::title($asset -> location)}}</span>
                                    </td>
                                    @if (Auth::user()->email != 'assetprovider@gmail.com')
                                        <td>
                                            <a href="#assetApplicationModal{{$asset -> id}}" data-toggle="modal" class="btn shadow my-0 mr-2 shadow btn-sm btn-secondary text-success font-weight-light">
                                                {{__('Update')}}
                                            </a>
                                        </td>
                                    @endif
        
                                    @if (Auth::user()->email == 'superadmin@gmail.com')
                                        <td>
                                            <a href="{{route('login')}}" class="btn shadow my-0 mr-2 shadow btn-sm btn-secondary text-danger font-weight-light">
                                                <i class="bx bx-trash-alt"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="accordion pt-3" id="engagedAssets">
                    @foreach ($service_provider -> assets as $asset)
                        <div class="card mb-2 rounded">
                            <button class="btn btn-link btn-block mt-0 my-2 text-left" type="button" data-toggle="collapse" data-target="#asset{{$asset->id}}" aria-expanded="true" aria-controls="asset{{$asset->id}}">
                                {{Str::title($asset -> name)}}1
                            </button>
                            <div id="asset{{$asset->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#engagedAssets">
                                <div class="row">
                                    <div class="col-12 pl-3 mb-2">
                                        <span class="small-text font-weight-light mr-3">
                                            Totals
                                        </span> 
                                        <span class="d-none">
                                            {{$cap= rand(10000,50000)}}
                                        </span>
                                        <span class="text-muted mr-3">
                                            <sub>Ksh.</sub> {{number_format($cap,2)}}  <i class="bx bx-minus"></i>
                                        </span>

                                        <span class="text-success mx-2 small-text">
                                            {{-- <sub>Ksh.</sub> {{number_format(2500,2)}}  <i class="bx bxs-up-arrow"></i>
                                             --}}
                                             Amt Rcvd
                                        </span>
                                        
                                        <span class="text-danger mx-2 small-text">
                                            {{-- <sub>Ksh.</sub> {{number_format(2500,2)}}  <i class="bx bxs-down-arrow"></i>                                                                              
                                             --}}
                                             Outstanding
                                        </span>

                                        <span class="text-primary font-weight-light mx-2 small-text">
                                            Merchants: {{number_format(80,0)}}
                                        </span>
                                    </div>
                                </div>
                                <div class="px-0 table-responsive mt-3">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>
                                                    {{__("Transaction ID")}}
                                                </th>
                                                <th>
                                                    {{__("Merchant ID")}}
                                                </th>
                                                <th>
                                                    {{__("Transaction Date")}}
                                                </th>
                                                <th>
                                                    {{__("Status")}}
                                                </th>
                                                @if (Auth::user()-> email == 'superadmin@gmail.com')
                                                    <th>
                                                        {{__("Nyayomat Status")}}
                                                    </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="px-0 table-borderless">
                                            @foreach ($service_provider -> assets as $asset)
                                                <tr class="">
                                                    <td>
                                                        {{Str::upper(Str::random(8))}}
                                                    </td>
                                                    <td>
                                                        {{__('NYAYOMAT-')}}{{Str::upper(Str::random(4))}}
                                                    </td>
                                                    <td class="text-muted">
                                                        {{Carbon\Carbon::today()->subDays(rand(0, 365))->format('d-M-Y')}}
                                                    </td>
                                                    @if ($loop->even)
                                                        <td class="text-success">
                                                            {{Str::title('on going')}}
                                                        </td>
                                                    @else
                                                        <td class="text-muted">
                                                            {{Str::ucfirst('completed')}}
                                                        </td>
                                                    @endif
                        
                                                    @if (Auth::user()->email != 'assetprovider@gmail.com')
                                                        {{-- <td>
                                                            <a href="#assetApplicationModal{{$asset -> id}}" data-toggle="modal" class="btn shadow my-0 mr-2 shadow btn-sm btn-secondary text-success font-weight-light">
                                                                {{__('Apply')}}
                                                            </a>
                                                        </td> --}}
                                                    @endif
                        
                                                    @if (Auth::user()->email == 'superadmin@gmail.com')
                                                        <td>
                                                            <a href="{{route('login')}}" class="btn shadow my-0 mr-2 shadow btn-sm btn-secondary text-danger font-weight-light">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

