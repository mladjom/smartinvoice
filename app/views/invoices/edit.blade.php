@extends('layouts.master')

@section('title')
{{ Lang::get('invoices.general.edit') }} {{ $invoice->number }}
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="#" class="btn btn-default download-pdf"><i class="fa fa-download"></i> {{ Lang::get('general.pdf') }}</a>
                <a href="{{{ URL::to('invoices') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
            </div>
            <h2>{{ Lang::get('invoices.general.edit') }} #{{ $invoice->number }}</h2>
        </div>
    </div>
</div>
{{ Form::model($invoice, array('route' => array('invoices.update', $invoice->id), 'method' => 'PUT', 'files' => true)) }}
    @include('invoices/form')
{{ Form::close() }}
@stop