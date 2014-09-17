@extends('layouts.master')

@section('title')
{{ Lang::get('billers.general.edit') }} {{ $biller->name }}
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{{ URL::to('billers') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
            </div>
            <h2>{{ Lang::get('billers.general.edit') }} {{ $biller->name }}</h2>
        </div>
    </div>
</div> 
{{ Form::model($biller, array('route' => array('billers.update', $biller->id), 'method' => 'PUT', 'files' => true)) }}
    @include('billers/form')
{{ Form::close() }}
@stop