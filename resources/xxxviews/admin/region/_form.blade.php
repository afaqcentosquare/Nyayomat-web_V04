<div class="form-group">
  {!! Form::label('City', 'City*') !!}
  {{--!! Form::text('city', $city, ['class' => 'form-control ', 'placeholder' => 'City Name', 'required']) !!--}}
  @php 
    
    $city = DB::table('in_cities')->get();
  
  @endphp
  <select class="form-control" name="city" required>
      <option value="" selected>select city</option>
      @foreach($city as $r)
        <option value="{{$r->id}}" @if($region->city==$r->id) selected @endif>{{$r->name}}</option>
      @endforeach
  </select>
</div>
<div class="form-group">
  {!! Form::label('Region Name', 'Region Name*') !!}
  {!! Form::text('name', null, ['class' => 'form-control ', 'placeholder' => 'Region Name', 'required']) !!}
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>