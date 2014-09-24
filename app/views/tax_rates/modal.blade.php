<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            {{ Form::open(array('url' => 'tax_rates', 'id'=>'create_tax')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-6 {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label class="control-label" for="name">{{ Lang::get('tax_rates.label.name') }}</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="{{ Lang::get('tax_rates.placeholder.name') }}" value="" />
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group col-sm-6 {{{ $errors->has('rate') ? 'has-error' : '' }}}">
                        <label class="control-label" for="rate">{{ Lang::get('tax_rates.label.rate') }}</label>
                        <input class="form-control" type="text" name="rate" id="rate" placeholder="0.00" value="" />
                        {{ $errors->first('rate', '<span class="help-block">:message</span>') }}
                    </div>            
                </div>
            </div>
            <div class="modal-footer">
                <div class="controls pull-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('general.cancel') }}</button>
                    {{ Form::submit(trans('general.yes'), array('class' => 'btn btn-primary', 'id' => 'create-tax')) }}
                </div>
            </div> 
            {{ Form::close() }}
        </div>
    </div>
</div>
