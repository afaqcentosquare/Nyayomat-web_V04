<div class="form-group">
  {!! Form::label('City Name', 'City Name*') !!}
  {!! Form::text('name', null, ['class' => 'form-control ', 'placeholder' => 'City Name', 'required']) !!}
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>