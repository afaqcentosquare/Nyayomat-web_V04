@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Regions</h3>
	      <div class="box-tools pull-right">

				<a href="#" data-link="{{ route('admin.utility.region.create') }}" class="ajax-modal-btn btn btn-success btn-flat">Add Region</a>

	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">

	      <table class="table table-hover table-no-sort">
	        <thead>
		        <tr>
		          <th>City</th>
		          <th>Name</th>
		          <th>&nbsp;</th>
		        </tr>
	        </thead>
	        <tbody>
		        @foreach($cities as $blog )
		        @php

                $city = DB::table('in_cities')->where('id',$blog->city)->get();

              @endphp
			        <tr>

			          <td>{{ $city[0]->name }}</td>
			          <td>{{ $blog->name }}</td>

			          <td class="row-options text-muted small">

			                    <a href="#" data-link="{{ route('admin.utility.region.edit', $blog->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;

		                    {!! Form::open(['route' => ['admin.utility.region.trash', $blog->id], 'method' => 'delete', 'class' => 'data-form']) !!}
		                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
							{!! Form::close() !!}

			          </td>
			        </tr>
		        @endforeach
	        </tbody>
	      </table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->

	<div class="box collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title"><i class="fa fa-trash-o"></i>{{ trans('app.trash') }}</h3>
	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
	        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover ">
	        <thead>
	        <tr>
	          <th>City</th>
	          <th>Name</th>

	        </tr>
	        </thead>
	        <tbody>
		        @foreach($trashes as $trash )
			        <tr>
			            @php

                        $city = DB::table('in_cities')->where('id',$trash->city)->get();

                      @endphp
        			        <tr>

        			          <td>{{ $city[0]->name }}</td>
			          <td>{{ $trash->name }}</td>
			          <td class="row-options small">

		                    <a href="{{ route('admin.utility.region.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;
		                    {!! Form::open(['route' => ['admin.utility.region.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
		                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
							{!! Form::close() !!}

			          </td>
			        </tr>
		        @endforeach
	        </tbody>
	      </table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection
