<div class="modal-dialog modal-md">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.utility.faqTopic.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
	        @include('admin.faq-topic._form')
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->