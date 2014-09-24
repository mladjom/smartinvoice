@extends('layouts.master')

@section('title') {{ Lang::get('billers.general.title') }} :: @parent @stop

@section('styles') 
{{ HTML::style('assets/lib/datatables-bootstrap3/css/datatables_fa.css'); }}
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{{ URL::to('billers/create') }}}" class="btn btn-success"><i class="fa fa-plus"></i> {{ Lang::get('billers.general.new') }}</a>
                @if (Input::get('onlyTrashed'))
                <a class="btn btn-default" href="{{ URL::to('billers') }}">{{ Lang::get('billers.general.show_curent') }}</a>
                @else
                <a class="btn btn-default" href="{{ URL::to('billers?onlyTrashed=true') }}">{{ Lang::get('billers.general.show_deleted') }}</a>
                @endif            
            </div>
            <h2>
                @if (Input::get('onlyTrashed'))
                {{ Lang::get('billers.general.deleted') }}
                @else
                {{ Lang::get('billers.general.current') }}
                @endif
            </h2>        
        </div>
    </div>
</div>
@if ($billers->count())
<table id="billers" class="table table-bordered">
    <thead>
        <tr>
            <th class="col-md-5">{{ Lang::get('billers.table.name') }}</th>
            <th class="col-md-5">{{ Lang::get('billers.table.email') }}</th>
            <th class="col-md-2 text-right">{{ Lang::get('general.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($billers as $biller)
        <tr>
            <td>{{ $biller->name }}</td>
            <td>{{{ $biller->email }}}</td>
            <td class="text-right">
                @if (  is_null($biller->deleted_at))
                <a class="btn btn-small btn-success" href="{{ URL::to('billers/' . $biller->id) }}"><i class="fa fa-eye"></i></a>               
                <a href="{{ URL::to('billers/' . $biller->id . '/edit') }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                <a data-html="false" class="btn btn-danger delete-biller" data-toggle="modal" href="{{ URL::to('billers/' . $biller->id ) }}" data-content="{{ Lang::get('billers.message.warning.delete') }}" data-title="{{ Lang::get('general.delete') }} {{ htmlspecialchars($biller->name) }}?" onClick="return false;"><i class="fa fa-trash-o"></i></a>
                @else
                <a href="{{ URL::to('billers/' . $biller->id. '/restore' ) }}" class="btn btn-warning"><i class="fa fa-reply"></i></a>
                 <a href="{{ URL::to('billers/' . $biller->id. '/delete' ) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
               @endif
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
    @include('layouts/modal')
@stop
@section('scripts')
{{ HTML::script('assets/lib/datatables/js/jquery.dataTables.js'); }}
{{ HTML::script('assets/lib/datatables-bootstrap3/js/datatables.js'); }}
<script type="text/javascript">
    $(document).ready(function() {
        $('#billers').dataTable({
            /* Set the defaults for DataTables initialisation */
            "bAutoWidth": false,
            // Disable sorting on the last column
            "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [2]
                }],
            "sPaginationType": "bs_normal",
        });
        $('.delete-biller').click(function(evnt) {
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