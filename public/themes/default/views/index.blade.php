@extends('layouts.home')

@section('content')

    <style>


        .select2-container{
            display: block !important;
            font-size: 17px;
            height: 47px;
        }
        .select2-selection__rendered{
            margin-top: 10px;
        }
        .select2-selection{
            height: 47px !important;

        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height:100% !important;
        }


.bg {

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
  .bg .head {
   position: absolute;
   top: 140px;
   /*left: 100px; */
   width: 100%;
   color:#eeee;
   font-size: 45px;
}

.bg .head2 {
   position: absolute;
   top: 200px;
   /*left: 100px; */
   width: 100%;
   color:#eeee;
   font-size: 45px;
}
    </style>
    <div class="bg text-center" style="height: 500px">
        <img src="public/bg2.jpg" class="image">
        {{-- @include('sliders.main') --}}
        <div style="position:absolute;top: 140px; width: 100%; color: #eeee; font-size: 45px;width: 100%; margin: 0 auto;">
            <h2 class="headx" style="font-size: 45px;">Time to order</h2>
            <h2 class="head2x">Now find offers in your area</h2>
    
            <div class="rowx text-center" style="width:100%;margin: auto 0;">
                <div class="col-sm-3 col-md-3"></div>
                <div class="col-sm-6 col-xs-12 col-md-6">
                    <form method="post" action="{{route('countrywise')}}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon cus-addon"><i class="fa fa-map-marker"></i></span>
                                <!-- <input type="text" class="form-control cus-input" name="country" placeholder="Enter Your Country"> -->
                                <select class="form-control cus-input select2 len_location" name="country" style="height:50px;" >
                                    <option value="" selected>select location</option>
                                    @foreach($countries as $con)
    
                                        <option value="{{$con->id}}">{{$con->name}}</option>
    
                                    @endforeach
                                </select>
    
                                <span class="input-group-addon"><button type="submit" id="show_len"  class="cus-btn"><span>Enter</span></button></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3 col-md-3"></div>
            </div>
        </div>
    </div>
@endsection