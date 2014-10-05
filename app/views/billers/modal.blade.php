<div class="modal fade" id="biller_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-hg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="biller_modal_label"></h4>
            </div>
            {{ Form::open(array('url' => 'billers', 'id'=>'create_biller')) }}
              <div class="modal-body">
                @include('billers/form')
              </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
