<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::model($faq, ['method' => 'PUT', 'route' => ['admin.utility.faq.update', $faq->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            @include('admin.faq._form')
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->