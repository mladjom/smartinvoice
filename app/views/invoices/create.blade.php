@extends('layouts.master')

@section('title')
@if (isset($invoice))
{{ Lang::get('invoices.general.edit') }} {{ $invoice->name }}
@else
{{ Lang::get('invoices.general.create') }}            
@endif
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{{ URL::to('invoices') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
            </div>
            <h2>@if (isset($invoice))
                {{ Lang::get('invoices.general.edit') }} {{ $invoice->name }}
                @else
                {{ Lang::get('invoices.general.create') }}                 
                @endif
            </h2>
        </div>
    </div>
</div> 
{{ Form::open(array('url' => 'invoices', 'files' => true)) }}
    @include('invoices/form')
{{ Form::close() }}
@stop