@extends('layouts.master')

@section('title')
{{ Lang::get('invoices.general.edit') }} {{ $invoice->number }}
::@parent
@stop

@section('content') 
<div class="page-header">
    <div class="pull-right">
        <a href="{{{ URL::to('invoices') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
    </div>
    <h2>{{ Lang::get('invoices.general.edit') }} #{{ $invoice->number }}</h2>
</div>
{{ Form::model($invoice, array('route' => array('invoices.update', $invoice->id), 'method' => 'PUT', 'files' => true)) }}
@include('invoices/form')
{{ Form::close() }}
@stop