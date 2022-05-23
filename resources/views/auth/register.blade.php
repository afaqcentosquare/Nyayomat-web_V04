@extends('auth.master')

@section('content')
  <div class="box login-box-body">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.form.register') }}</h3>
    </div> <!-- /.box-header -->
    <div class="box-body">
      {!! Form::open(['route' => 'register', 'id' => config('system_settings.required_card_upfront') ? 'stripe-form' : 'registration-form', 'data-toggle' => 'validator']) !!}
        <div class="form-group has-feedback">
          {{-- Form::select('plan', $plans, isset($plan) ? $plan : Null, ['id' => 'plans' , 'class' => 'form-control input-lg', 'required']) --}}
          @php $plan2 = DB::table('subscription_plans')->where('deleted_at',null)->get(); @endphp
          <select class="form-control input-lg" name="plan">
              @foreach($plan2 as $pl)
                <option value="{{$pl->plan_id}}">{{$pl->name}} ( {{$pl->cost}} KSh /day )</option>
              @endforeach
          </select>
            <i class="glyphicon glyphicon-dashboard form-control-feedback"></i>
            <div class="help-block with-errors">
              Will be charged for each location which have you select.
            </div>
        </div>
        <div class="form-group has-feedback">
          {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.placeholder.valid_email'), 'required']) !!}
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
          {!! Form::text('mobile', null, ['class' => 'form-control input-lg', 'placeholder' => 'Your Mobile', 'required']) !!}
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('app.placeholder.password') . ' should be 6 digit pin, no alphabets', 'data-minlength' => '6', 'required', 'pattern' => '[0-9]+']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            {!! Form::password('password_confirmation', ['class' => 'form-control input-lg', 'placeholder' => trans('app.placeholder.confirm_password'), 'data-match' => '#password', 'required', 'pattern' => '[0-9]+']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            {!! Form::text('shop_name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.placeholder.shop_name'), 'required']) !!}
            <i class="glyphicon glyphicon-equalizer form-control-feedback"></i>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
          @php $city = DB::table('in_cities')->where('deleted_at',null)->get(); @endphp
          <select class="form-control input-lg" name="city" id="city" required>
              <option>select city</option>
              @foreach($city as $ct)
                <option value="{{$ct->id}}">{{$ct->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group has-feedback">
          {{-- Form::select('plan', $plans, isset($plan) ? $plan : Null, ['id' => 'plans' , 'class' => 'form-control input-lg', 'required']) --}}
          <select class="form-control input-lg" required name="region" id="region" required>
              <option>select region</option>
          </select>
        </div>
        <div class="form-group has-feedback">
          {{-- Form::select('plan', $plans, isset($plan) ? $plan : Null, ['id' => 'plans' , 'class' => 'form-control input-lg', 'required']) --}}
          <select class="form-control input-lg select2" required  name="locations[]" id="location" multiple>
              <option>select location</option>
          </select>
        </div>

          {{-- @include('auth.stripe_form') --}}

          <div class="row">
            <div class="col-xs-8">
              <div class="form-group">
                  <label>
                      {!! Form::checkbox('service_merchant', 1, null, ['class' => 'icheck']) !!} {!! trans('Merchant Service account type') !!}

                  </label>
                  <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="form-group">
                <label>
                    {!! Form::checkbox('agree', null, null, ['class' => 'icheck', 'required']) !!} {!! trans('app.form.i_agree_with_merchant_terms', ['url' => route('page.open', \App\Page::PAGE_TNC_FOR_MERCHANT)]) !!}
                </label>
                <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="col-xs-4">
            {!! Form::submit(trans('app.form.register'), ['class' => 'btn btn-block btn-lg btn-flat btn-success']) !!}
          </div>
        </div>
      {!! Form::close() !!}

      <a href="{{ route('login') }}" class="btn btn-link">{{ trans('app.form.merchant_login') }}</a>
    </div>
  </div>
  <!-- /.form-box -->
@endsection

@section('scripts')
  @include('plugins.stripe-scripts')
  <script type="text/javascript">
  $(document).ready(function() {

      $("#city").on('change', function(){

          var city = $("#city").val();

          $.ajax({
			    url: '/customer/region',
			    type: 'POST',
			    data: {'city':city,'_token': '{{ csrf_token() }}'},
			    complete: function (text) {
			    	$("#region").html(text.responseText);
			        var region = $("#region").val();
			    	$.ajax({
        			    url: '/customer/location',
        			    type: 'POST',
        			    data: {'region':region,'_token': '{{ csrf_token() }}'},
        			    complete: function (text) {
        			    	$("#location").html(text.responseText);

        			    },
        			});
			    },
			});

      });

      $("#region").on('change', function(){

         	var region = $("#region").val();
	    	$.ajax({
			    url: '/customer/location',
			    type: 'POST',
			    data: {'region':region,'_token': '{{ csrf_token() }}'},
			    complete: function (text) {
			    	$("#location").html(text.responseText);

			    },
			});


      });

  });
</script>

@endsection
