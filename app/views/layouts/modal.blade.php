<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('general.cancel') }}</button>
                {{ Form::open(array('class' => 'pull-right', 'id' => 'action')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit(trans('general.yes'), array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>