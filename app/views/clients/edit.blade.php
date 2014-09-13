@extends('layouts.master')

@section('title')
@if (isset($client))
{{ Lang::get('clients.general.edit') }} {{ $client->name }}
@else
{{ Lang::get('clients.general.create') }}            
@endif
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{{ URL::to('clients') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
            </div>
            <h2>@if (isset($client))
                {{ Lang::get('clients.general.edit') }} {{ $client->name }}
                @else
                {{ Lang::get('clients.general.create') }}                 
                @endif
            </h2>
        </div>
    </div>
</div> 
{{ Form::model($client, array('route' => array('clients.update', $client->id), 'method' => 'PUT', 'files' => true)) }}
    @include('clients/form')
{{ Form::close() }}
@stop