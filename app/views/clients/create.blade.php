@extends('layouts.master')

@section('title')
{{ Lang::get('clients.general.create') }}            
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{{ URL::to('clients') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
            </div>
            <h2>{{ Lang::get('clients.general.create') }}</h2>
        </div>
    </div>
</div> 
{{ Form::open(array('url' => 'clients', 'files' => true, 'id'=> 'create_client')) }}
    @include('clients/form')
{{ Form::close() }}
@stop