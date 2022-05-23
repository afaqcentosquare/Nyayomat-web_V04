@extends('admin.layouts.master')

@section('page-style')
@include('plugins.ionic')
@endsection

@section('content')

{{-- @include('admin.partials._subscription_notice')

    @if(! Auth::user()->isVerified())
		<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
{{ trans('messages.email_verification_notice') }}
<a href="{{ route('verify') }}">{{ trans('app.resend_varification_link') }}</a>
</div>
@endif
--}}
<!-- Info boxes -->
<div class="row">

  <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right ">
    <div class="info-box">
      <span class="info-box-icon bg-aqua">
        <i class="icon ion-md-cart"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">Sales</span>
        <span class="info-box-number">
          {{ round($sales_total ?? 0) }} KSh
          @if($sales_total)
          <a href="{{ url('admin/order/order') }}" class="pull-right small" data-toggle="tooltip" data-placement="left"
            title="{{ trans('app.detail') }}">
            <i class="icon ion-md-send"></i>
          </a>
          @endif
        </span>
        <div class="progress" style="background: transparent;"></div>
        <span class="progress-description text-muted">
          @if($last_sale)
          <i class="icon ion-md-time"></i> {{ $last_sale->created_at->diffForHumans() }}
          @else
          <i class="icon ion-md-hourglass"></i> {{ trans('messages.no_sale', ['date' => trans('app.yet')]) }}
          @endif
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-md-3 col-sm-6 col-xs-12 nopadding-left nopadding-right">
    <div class="info-box">
      <span class="info-box-icon bg-red">
        <i class="icon ion-md-notifications-outline"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">{{ trans('app.stock_outs') }}</span>
        <span class="info-box-number">
          {{ $stock_out_count }}
          <a href="{{ url('admin/stock/inventory') }}" class="pull-right small" data-toggle="tooltip"
            data-placement="left" title="{{ trans('app.detail') }}">
            <i class="icon ion-md-send"></i>
          </a>
        </span>

        @php
        $stock_out_percents = $stock_count == 0 ?
        ($stock_out_count * 100) : round(($stock_out_count / $stock_count) * 100);
        @endphp
        <div class="progress">
          <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
        </div>
        <span class="progress-description text-muted">
          {{ trans('messages.stock_out_percents', ['percent' => $stock_out_percents, 'total' => $stock_count]) }}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  @php

  $user_id = Auth::user()->id;

  $shops = DB::table('shops')->where("owner_id",$user_id)->get();
  $dis_cnt = "0";
  foreach($shops as $sho){

  $dis_cnt += DB::table("disputes")->where('shop_id',$sho->id)->count();

  }

  @endphp

  <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
    <div class="info-box">
      <span class="info-box-icon bg-yellow">
        <i class="icon ion-md-cube"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">Dispute</span>
        <span class="info-box-number">
          {{ $dis_cnt }}
          <a href="{{ url('admin/support/dispute') }}" class="pull-right small" data-toggle="tooltip"
            data-placement="left" title="{{ trans('app.detail') }}">
            <i class="icon ion-md-send"></i>
          </a>
        </span>

        <span class="progress-description text-muted">

        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


  @php

  $user_id = Auth::user()->id;

  $shops1 = DB::table('shops')->where("owner_id",$user_id)->get();
  $rating_total = "0";
  $total_rating = "0";
  foreach($shops1 as $sho1){

  $order = DB::table("orders")->where('shop_id',$sho1->id)->get();
  foreach($order as $ord) {

  if($ord->feedback_id!="") {

  $total_rating += "1";

  $feedback = DB::table("feedbacks")->where('id',$ord->feedback_id)->get();

  $rating_total += $feedback[0]->rating;

  }
  }
  }




  @endphp



  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12 nopadding-left">
    <div class="info-box">
      <span class="info-box-icon bg-green">
        <i class="icon ion-md-wallet"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">Rating</span>
        <span class="info-box-number">
          @if($rating_total=="0")
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>
          @else
          @if(round($rating_total/$total_rating)=="0")
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>
          @elseif(round($rating_total/$total_rating)=="1")
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>
          @elseif(round($rating_total/$total_rating)=="2")
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>
          @elseif(round($rating_total/$total_rating)=="3")
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star"></i>&nbsp;
          <i class="fa  fa-star"></i>
          @elseif(round($rating_total/$total_rating)=="4")
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star"></i>
          @elseif(round($rating_total/$total_rating)=="5")
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>&nbsp;
          <i class="fa  fa-star" style="color:#f5c004;"></i>
          @endif
          @endif

          <br>
          @if($rating_total=="0")
          0.0
          @else
          {{round($rating_total/$total_rating)}}
          @endif
        </span>


        <span class="progress-description text-muted">

        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  @php

  $user_id = Auth::user()->id;

  $shops12 = DB::table('shops')->where("owner_id",$user_id)->get();
  $dis_cnt12 = "0";
  foreach($shops12 as $sho12){

  $dis_cnt12 += DB::table("coupons")->where('shop_id',$sho12->id)->count();

  }

  @endphp
  <div class="clearfix visible-sm-block"></div>

  {{-- <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right">
    <div class="info-box">
      <span class="info-box-icon bg-green">
        <i class="icon ion-md-wallet"></i>
      </span>

      <div class="info-box-content">
        <span class="info-box-text">Marketing Campaigns</span>
        <span class="info-box-number">
          {{ $dis_cnt12 }}
          <a href="{{ url('admin/promotion/coupon') }}" class="pull-right small" data-toggle="tooltip"
            data-placement="left" title="{{ trans('app.detail') }}">
            <i class="icon ion-md-send"></i>
          </a>
        </span>


        <span class="progress-description text-muted">

        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div> --}}
  <!-- /.col -->


</div>
<!-- /.row -->

@endsection

@section('page-script')
@include('plugins.chart')

{!! $chart->script() !!}
@endsection