@extends('layouts.master')

@section('title') {{ Lang::get('tax_rates.general.title') }} :: @parent @stop

@section('styles') 
{{ HTML::style('assets/lib/datatables-bootstrap3/css/datatables_fa.css'); }}
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2>
                {{ Lang::get('tax_rates.general.title') }}
            </h2>        
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="table-responsive">

            @if ($tax_rates->count())
            <table id="tax_rates" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-5">{{ Lang::get('tax_rates.table.name') }}</th>
                        <th class="col-md-5">{{ Lang::get('tax_rates.table.rate') }}</th>
                        <th class="col-md-2 text-right">{{ Lang::get('general.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tax_rates as $tax_rate)
                    <tr>
                        <td>{{ $tax_rate->name }}</td>
                        <td>{{{ $tax_rate->rate }}}</td>
                        <td class="text-right">
                            <a data-html="false" class="btn btn-danger delete-tax" data-toggle="modal" href="{{ URL::to('tax_rates/' . $tax_rate->id ) }}" data-content="{{ Lang::get('tax_rates.message.warning.delete') }}" data-title="{{ Lang::get('general.delete') }} {{ htmlspecialchars($tax_rate->name) }}?" onClick="return false;"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning alert-block">
                <i class="fa fa-warning"></i>
                {{ Lang::get('billers.table.noresults') }}
            </div>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
        {{ Form::open(array('url' => 'tax_rates', 'id'=>'create_tax')) }}
        <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
            <label class="control-label" for="name">{{ Lang::get('tax_rates.label.name') }}</label>
            <input class="form-control" type="text" name="name" id="tax_name" placeholder="{{ Lang::get('tax_rates.placeholder.name') }}" value="" />
            {{ $errors->first('name', '<span class="help-block">:message</span>') }}
        </div>
        <div class="form-group {{{ $errors->has('rate') ? 'has-error' : '' }}}">
            <label class="control-label" for="rate">{{ Lang::get('tax_rates.label.rate') }}</label>
            <input class="form-control" type="text" name="rate" id="rate" placeholder="0.00" value="" />
            {{ $errors->first('rate', '<span class="help-block">:message</span>') }}
        </div> 
        <div class="controls pull-right">
            <a href="{{{ URL::to('tax_rates/create') }}}" id="create-tax" class="btn btn-success"><i class="fa fa-plus"></i> {{ Lang::get('tax_rates.general.new') }}</a>
        </div>
        {{ Form::close() }}
    </div>
</div>

@include('layouts/modal')
@stop
@section('scripts')
{{ HTML::script('assets/lib/datatables/js/jquery.dataTables.js'); }}
{{ HTML::script('assets/lib/datatables-bootstrap3/js/datatables.js'); }}
<script type="text/javascript">
    $(document).ready(function () {
        $('#tax_rates').dataTable({
            /* Set the defaults for DataTables initialisation */
            "bAutoWidth": false,
            // Disable sorting on the last column
            "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [2]
                }],
            "sPaginationType": "bs_normal",
        });
        $('.delete-tax').click(function (evnt) {
            var href = $(this).attr('href');
            var message = $(this).attr('data-content');
            var title = $(this).attr('data-title');
            $('#myModalLabel').text(title);
            $('#dataConfirmModal .modal-body').text(message);
            $('#action').attr('action', href);
            $('#dataConfirmModal').modal({show: true});
            return false;
        });
        $("#create-tax").click(function () {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ URL::to('tax_rates/create') }}",
                data: $('form#create_tax').serialize(),
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (data) {
                    $(".help-block").hide();
                    $(".form-group").removeClass("has-error");
                    if (data.status === "success") {
                        console.log(data);
                        location.reload()
                    }
                    else {
                        if (data.errors.name)
                            $("#tax_name").after("<span class='help-block'>" + data.errors.name + "</span>").parent().addClass("has-error");
                        if (data.errors.rate)
                            $("#rate").after("<span class='help-block'>" + data.errors.rate + "</span>").parent().addClass("has-error");
                    }
                },
                error: function (xhr, textStatus, thrownError) {
                    alert("Something went wrong. Please Try again later...");
                }
            });
            return false;
        });
    });
</script>
@stop