<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::model($location, ['method' => 'PUT', 'route' => ['admin.utility.location.update', $location->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            <div class="form-group">
              {!! Form::label('Region', 'Region*') !!}
              {{--!! Form::text('city', $city, ['class' => 'form-control ', 'placeholder' => 'City Name', 'required']) !!--}}
              @php

                $city = DB::table('in_region')->get();

              @endphp
              <select class="form-control" name="region" required>
                  <option value="" selected>select region</option>
                  @foreach($city as $r)
                    <option value="{{$r->id}}" @if($location->region==$r->id) selected @endif>{{$r->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              {!! Form::label('Location Name', 'Location Name*') !!}
              {!! Form::text('name', null, ['class' => 'form-control ', 'placeholder' => 'Location Name', 'required']) !!}
            </div>
            <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->