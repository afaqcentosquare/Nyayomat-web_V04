@extends('admin.layouts.master')

@section('content')
	<div class="box">
	  	@if(Auth::user()->isFromPlatform())
		    <div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-user"></i> {{ trans('app.profile') }}</h3>
		    </div>
		    <div class="box-body">
	    		@include('admin.account._profile')
	    		<span class="spacer20"></span>
    		</div>
	  	@else
			<h2>Your account Balance is: <?php echo number_format(DB::table('accounts')->where('type', 1)->where('user_id', Auth::user()->id)->sum('amount'), 2); ?></h2>
			<div class="col-md-12">
				<br/>
				{!! Form::open(['route' => 'admin.account.withdrawal']) !!}
				<div class="form-group">
					{!! Form::label('withdraw_amount', trans('app.placeholder.withdraw_amount').'*') !!}
					{!! Form::text('withdraw_amount', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.withdraw_amount'), 'required']) !!}
					<div class="help-block with-errors"></div>
				</div>
				{!! Form::submit(trans('app.placeholder.withdraw'), ['class' => 'btn btn-flat btn-new']) !!}
				{!! Form::close() !!}
			</div>
	  	@endif
	</div> <!-- /.box -->
@endsection

@section('page-script')

  @include('plugins.stripe-scripts')

@endsection
