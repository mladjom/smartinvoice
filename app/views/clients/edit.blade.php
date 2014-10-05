@extends('layouts.master')

@section('title')
{{ Lang::get('clients.general.edit') }} {{ $client->name }}
::@parent
@stop

@section('content') 
<div class="page-header">
    <div class="pull-right">
        <a href="{{{ URL::to('clients') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
    </div>
    <h2>{{ Lang::get('clients.general.edit') }} {{ $client->name }}</h2>
</div> 
{{ Form::model($client, array('route' => array('clients.update', $client->id), 'method' => 'PUT', 'files' => true)) }}
@include('clients/form')
{{ Form::close() }}
@stop