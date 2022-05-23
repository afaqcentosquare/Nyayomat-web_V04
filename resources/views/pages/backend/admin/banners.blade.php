@extends('layouts.backend.main', 
                        [
                            'title' => __("Banners"),
                            'page_name' => 'Banners',
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
                Banners
            </a>  
        </div>
    </div>
      
    <div class="row">
        {{-- Banners --}}
        <div class="col mx-auto shadow-sm rounded">
            <div class="accordion" id="Banners">
                <div id="showBanners" class="collapse show" aria-labelledby="headingOne" data-parent="#Banners"> 
                    <div class="header-left px-0">
                        Banners
                    </div> 
                    <div class="row">
                        <div class="col-12 text-right">
                            <a class="badge badge-pill badge-success py-2 shadow rounded collapsed"  data-toggle="collapse" href="#newBanner" aria-expanded="false" aria-controls="newBanner">
                                ADD Banner
                            </a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mb-4 text-left">
                            <span class="mr-2">
                               <i class="bx bx-expand mr-2"></i> Showing
                                <select name="" autocomplete="off" class="mx-1 rounded shadow-sm px-auto border-0" id="">
                                    @for ($w = 0; $w< 10; $w++)
                                        <option value="">
                                            {{(($w + 1 )* 10)}}
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

                        <div class="col-12 table-responsive">
                            <table class="table  table-borderless">
                                <thead>
                                    <tr>
                                        <th>
                                            Title
                                        </th>
                                        
                                        <th>
                                            Banner Image
                                        </th>
                                        <th nowrap>
                                            Background
                                        </th>
                                        <th nowrap>
                                            Options
                                        </th>
                                        <th nowrap>
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( banners() as $banner )
                                        <tr>
                                            <td>
                                                {{ $banner->title }}
                                            </td>
                                            <td>
                                            @if(!empty($banner->image['path']))
                                                @php
                                                $path = $banner->image['path'];
                                                @endphp
                                          
                                                <img src="{{asset('image/'.$path.'?p=tiny')}}" />
                                               
                                                @else
                                                No Image
                                                @endif
                                            

                                            </td>
                                            <td>
                                                
                                                {{ $banner->bg_color }}
                                            </td>
                                            <td nowrap>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        Group : <span class="font-weight-bold ml-2">{{ $banner->group->name}}</span>
                                                    </li>
                                                    <li>
                                                        Columns : <span class="font-weight-bold ml-2">{{ $banner->columns }}</span>
                                                    </li>
                                                    <li>
                                                        Order : <span class="font-weight-bold ml-2">{{ $banner->order }}</span>
                                                    </li>
                                                    <li>
                                                        Link label : <span class="font-weight-bold ml-2">{{ $banner->link_label }}</span>
                                                    </li>
                                                    <li>
                                                        Link : <span class="font-weight-bold ml-2">{{ $banner->link }}</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                {{ $banner->created_at }}
                                            </td>
                                            <td>
                                                <a href="{{ route('edit-banner-form',[ 'banner_id' => $banner->id ] ) }}" class="mr-2">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                <a href="" class="nyayomat-blue"  onclick="event.preventDefault();
                                                document.getElementById('{{$banner->id}}').submit();">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                                

                                               <form id="{{$banner->id}}" action="{{ route('delete-banner',[ $banner->id ] ) }}" method="POST" style="display: none;">
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
                <div class="card">
                    <div id="newBanner" class="collapse" aria-labelledby="headingTwo" data-parent="#Banners">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="nyayomat-blue font-weight-bold "  data-toggle="collapse" href="#showBanners" aria-expanded="true" aria-controls="showBanners">
                                        Back
                                    </a>
                                </div>

                                <h5 class="col-12 text-center font-weight-bold nyayomat-blue mt-3">
                                    New Banner
                                </h5>
                            </div>
                            <form action="{{ route('createnewbanner')  }}" method="POST" enctype="multipart/form-data" files="true" class="row">
                                @csrf
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Banner Title :
                                    </p>
                                    <textarea name="title" placeholder="Type here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Image :
                                    </p>
                                    <input type="file" name="image" accept="image" placeholder="Type Here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="col-12 px-0">
                                        Description :
                                    </p>
                                    <textarea name="description" placeholder="Type here" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0"></textarea>
                                </div>
                                <div class="col-md-3 col-4  mb-4">
                                    <p class="col-12 px-0">
                                        Background :
                                    </p>
                                    <input name="bg_color" type="color" autocomplete="off" class="col-12 bg-white py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-md-3 col-4 mb-4">
                                    <p class="col-12 px-0">
                                        Banner Group:
                                    </p>
                                    <select name="group_id" autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                        <option disabled value="">
                                            -- Select One --
                                        </option>
                                        @foreach( bannergroups() as $bannergroup )
                                        <option value="{{$bannergroup->id}}">
                                            {{ $bannergroup->name }}
                                        </option>
                                        @endforeach   
                                    </select>
                                </div>
                                <div class="col-md-3 col-4  mb-4">
                                    <p class="col-12 px-0">
                                        Columns :
                                    </p>
                                    <input name="columns" type="number" autocomplete="off" placeholder="Type Here" min="1" class="col-12 py-2 rounded shadow-sm border-0">
                                </div>
                                <div class="col-6 mb-4">
                                    <p class="col-12 px-0">
                                        Link Label :
                                    </p>
                                    <select name="link_label"  autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                        <option disabled value="">
                                            -- Select One --
                                        </option>
                                        <option selected value="Show Now">
                                            Shop Now
                                        </option>
                                        <option value="Buy Now">
                                            Buy Now
                                        </option>
                                      
                                    </select>
                                </div>         
                                
                                <div class="col-6 mb-4">
                                    <p class="col-12 px-0">
                                        Banner for :
                                    </p>
                                    <select name="for"  autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                        <option disabled value="">
                                            -- Select --
                                        </option>
                                        <option value="category">
                                            Category
                                        </option>
                                        <option value="shop">
                                            Shop
                                        </option>
                                      
                                    </select>
                                </div>  

                                <div class="col-6 mb-4">
                                    <p class="col-12 px-0">
                                        Location :
                                    </p>
                                    <select name="location"  autocomplete="off" class="col-12 py-2 rounded shadow-sm border-0">
                                        <option disabled value="">
                                            -- Select --
                                        </option>
                                        @foreach( locations() as $location )
                                        <option value="{{$location->id}}">
                                            {{ $location->name }}
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
    </div>
@endsection

@push('scripts')
@endpush
