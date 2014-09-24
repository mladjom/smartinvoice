@extends('layouts.master')

@section('title')
{{ Lang::get('invoices.general.create') }}            
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{{ URL::to('invoices') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
            </div>
            <h2>{{ Lang::get('invoices.general.create') }}</h2>
        </div>
    </div>
</div> 
{{ Form::open(array('url' => 'invoices', 'files' => true)) }}
    @include('invoices/form')
{{ Form::close() }}
@include('tax_rates/modal')
@stop