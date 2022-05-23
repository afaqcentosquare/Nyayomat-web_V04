<div class="form-group">
  {!! Form::label('Region', 'Region*') !!}
  {{--!! Form::text('city', $city, ['class' => 'form-control ', 'placeholder' => 'City Name', 'required']) !!--}}
  @php 
    
    $city = DB::table('in_region')->get();
  
  @endphp
  <select class="form-control" name="region" required>
      <option value="" selected>select region</option>
      @foreach($city as $r)
        <option value="{{$r->id}}" @if($location->name==$r->id) selected @endif>{{$r->name}}</option>
      @endforeach
  </select>
</div>
<div class="form-group">
  {!! Form::label('Location Name', 'Location Name*') !!}
  {!! Form::text('name', null, ['class' => 'form-control ', 'placeholder' => 'Location Name', 'required']) !!}
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>