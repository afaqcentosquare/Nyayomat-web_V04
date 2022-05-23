<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon flat"><i class="fa fa-user"></i></span>
    {!! Form::text('address_title', Null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.address_title'), 'required']) !!}
  </div>
  <div class="help-block with-errors"></div>
</div>

<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::select('country_id', $countries ,
        isset($address) ? Null :
        ( session('selected_country') ? session('selected_country') :config('system_settings.address_default_country')) , ['class' => 'form-control flat', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {{-- {!! Form::text('zip_code', Null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.zip_code'), 'required']) !!} --}}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::text('address_line_1', Null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.address_line_1'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::text('address_line_2', Null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.address_line_2')]) !!}
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
         {!! Form::select('city', $cities_list ,
        $c_city->id, ['class' => 'form-control flat', 'required']) !!}
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
        {!! Form::select('region_id', $regions ,
        $c_region->id, ['class' => 'form-control flat', 'required']) !!}
      <!--<select class="form-control input-lg" required name="state_id" id="region" required>-->
      <!--  <option>select region</option>-->
      <!--</select>-->
      <!--<div class="help-block with-errors"></div>-->
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::text('phone', Null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.phone_number'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

