@extends('admin.layouts.master')

@section('page-style')
  @include('plugins.ionic')
@endsection

@section('content')
  <!-- Info boxes -->
  @php $asso = DB::table('users')->where('role_id','2')->count(); @endphp
  <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Associates</span>
              <span class="info-box-number">
                  {{ $asso }}
                  <a href="{{ route('admin.admin.user.index') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                    <i class="icon ion-md-send"></i>
                  </a>
              </span>
              <div class="progress" style="background: transparent;"></div>
              <span class="progress-description text-muted">

              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    @php $orders = DB::table('orders')->count(); @endphp

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right ">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">All Orders</span>
              <span class="info-box-number">
                  {{ $orders }}
                  <!--<a href="{{ url('admin/order/order') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >-->
                  <!--  <i class="icon ion-md-send"></i>-->
                  <!--</a>-->
              </span>
              <div class="progress" style="background: transparent;"></div>
              {{-- <span class="progress-description text-muted">
                  Last 7 days
              </span> --}}
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

    @php $sales = DB::table('orders')->sum('grand_total'); @endphp

      <div class="col-md-3 col-sm-6 col-xs-12  ">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Sales</span>
              <span class="info-box-number">
                   {{ round($sales,2) }} KSh
                  <!--<a href="{{ url('admin/order/order') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >-->
                  <!--  <i class="icon ion-md-send"></i>-->
                  <!--</a>-->
              </span>
              <div class="progress" style="background: transparent;"></div>
              {{-- <span class="progress-description text-muted">
                  Last 7 Days
              </span> --}}
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      @php $stock_out = DB::table('inventories')->where('stock_quantity','0')->count(); @endphp
      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-left ">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Stock Out Shops</span>
              <span class="info-box-number">
                  {{ $stock_out }}
                  <a href="{{ url('admin/vendor/shop') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                    <i class="icon ion-md-send"></i>
                  </a>
              </span>
              <div class="progress" style="background: transparent;"></div>
              <span class="progress-description text-muted">

              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      @php $products = DB::table('products')->count(); @endphp
      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right ">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Products</span>
              <span class="info-box-number">
                  {{ $products }}
                  <a href="{{ url('admin/catalog/product') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                    <i class="icon ion-md-send"></i>
                  </a>
              </span>
              <div class="progress" style="background: transparent;"></div>
              <span class="progress-description text-muted">

              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      @php $dispute = DB::table('disputes')->count(); @endphp
      <div class="col-md-3 col-sm-6 col-xs-12  nopadding-right ">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Disputes</span>
              <span class="info-box-number">
                  {{ $dispute }}
                  <a href="{{ url('admin/support/dispute') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                    <i class="icon ion-md-send"></i>
                  </a>
              </span>
              <div class="progress" style="background: transparent;"></div>
              <span class="progress-description text-muted">

              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="icon ion-md-contacts"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('app.merchants') }}</span>
                <span class="info-box-number">
                    {{ $merchant_count }}
                    <a href="{{ route('admin.vendor.merchant.index') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                      <i class="icon ion-md-send"></i>
                    </a>
                </span>
                <div class="progress" style="background: transparent;"></div>
                <span class="progress-description text-muted">
                  <i class="icon ion-md-add"></i>
                  {{ trans('app.new_in_30_days', ['new' => $new_merchant_last_30_days, 'model' => trans('app.merchants')]) }}
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      @php $tm = DB::table('users')->where("role_id","3")->where("active","!=","1")->count(); @endphp
      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">TRIALING MERCHANTS</span>
              <span class="info-box-number">
                  {{ $tm }}
                  <a href="{{ route('admin.vendor.merchant.index') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                    <i class="icon ion-md-send"></i>
                  </a>
              </span>
              <div class="progress" style="background: transparent;"></div>
              {{-- <span class="progress-description text-muted">
                  Last 7 Days
              </span> --}}
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">New {{ trans('app.customers') }}</span>
              <span class="info-box-number">
                  {{ $customer_count }}
                  <a href="{{ route('admin.admin.customer.index') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                    <i class="icon ion-md-send"></i>
                  </a>
              </span>
              <div class="progress" style="background: transparent;"></div>
              <span class="progress-description text-muted">
                  <i class="icon ion-md-add"></i>
                  {{ trans('app.new_in_30_days', ['new' => $new_customer_last_30_days, 'model' => trans('app.customers')]) }}
              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      @php $mc = DB::table('coupons')->count(); @endphp
      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Marketing Campaigns</span>
              <span class="info-box-number">
                  {{ $mc }}

              </span>
              <div class="progress" style="background: transparent;"></div>
              {{-- <span class="progress-description text-muted">
                  Last 7 Days
              </span> --}}
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>



  </div>
  <!-- /.row -->

@endsection

@section('page-script')
  @include('plugins.chart')
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>

  {!! $chart->script() !!}
@endsection
