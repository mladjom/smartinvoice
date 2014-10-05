<div class="modal fade" id="client_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-hg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="client_modal_label"></h4>
            </div>
            {{ Form::open(array('url' => 'clients', 'id'=>'create_client')) }}
              <div class="modal-body">
                @include('clients/form')
              </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
