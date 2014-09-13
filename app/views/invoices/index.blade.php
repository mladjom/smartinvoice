@extends('layouts.master')

@section('title') {{ Lang::get('invoices.general.title') }} :: @parent @stop

@section('styles') 
{{ HTML::style('assets/lib/datatables-bootstrap3/css/datatables_fa.css'); }}
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{{ URL::to('invoices/create') }}}" class="btn btn-success"><i class="fa fa-plus"></i> {{ Lang::get('invoices.general.new') }}</a>
                @if (Input::get('onlyTrashed'))
                <a class="btn btn-default" href="{{ URL::to('invoices') }}">{{ Lang::get('invoices.general.show_curent') }}</a>
                @else
                <a class="btn btn-default" href="{{ URL::to('invoices?onlyTrashed=true') }}">{{ Lang::get('invoices.general.show_deleted') }}</a>
                @endif            
            </div>
            <h2>
                @if (Input::get('onlyTrashed'))
                {{ Lang::get('invoices.general.deleted') }}
                @else
                {{ Lang::get('invoices.general.current') }}
                @endif
            </h2>        
        </div>
    </div>
</div>
@if ($invoices->count())
<table id="invoices" class="table table-bordered">
    <thead>
        <tr>
            <th class="col-md-1"><input type="checkbox" class="selectAll"></th>
            <th class="col-md-2 text-right">{{ Lang::get('general.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
        <tr>
            <td></td>
            <td class="text-right">
                @if (  is_null($invoice->deleted_at))
                <a class="btn btn-small btn-success" href="{{ URL::to('invoices/' . $invoice->id) }}"><i class="fa fa-eye"></i></a>               
                <a href="{{ URL::to('invoices/' . $invoice->id . '/edit') }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                <a data-html="false" class="btn btn-danger delete-invoice" data-toggle="modal" href="{{ URL::to('invoices/' . $invoice->id ) }}" data-content="{{ Lang::get('invoices.message.warning.delete') }}" data-title="{{ Lang::get('general.delete') }} {{ htmlspecialchars($invoice->name) }}?" onClick="return false;"><i class="fa fa-trash-o"></i></a>
                @else
                <a href="{{ URL::to('invoices/' . $invoice->id. '/restore' ) }}" class="btn btn-warning"><i class="fa fa-reply"></i></a>
                 <a href="{{ URL::to('invoices/' . $invoice->id. '/delete' ) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
               @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-warning alert-block">
    <i class="fa fa-warning"></i>
    {{ Lang::get('invoices.table.noresults') }}
</div>
@endif
@stop
@section('scripts')
{{ HTML::script('assets/lib/datatables/js/jquery.dataTables.js'); }}
{{ HTML::script('assets/lib/datatables-bootstrap3/js/datatables.js'); }}
<script type="text/javascript">
    $(document).ready(function() {
        $('#invoices').dataTable({
            /* Set the defaults for DataTables initialisation */
            "bAutoWidth": false,
            'aaSorting': [['1', 'asc']],
            // Disable sorting on the first and column
            "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0, 3]
                }],
            "sPaginationType": "bs_normal",
        });
        $('.delete-invoice').click(function(evnt) {
            var href = $(this).attr('href');
            var message = $(this).attr('data-content');
            var title = $(this).attr('data-title');
            $('#myModalLabel').text(title);
            $('#dataConfirmModal .modal-body').text(message);
            $('#action').attr('action', href);
            $('#dataConfirmModal').modal({show: true});
            return false;
        });
    });
</script>
@stop