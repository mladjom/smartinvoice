@extends('layouts.master')

@section('title')
@if (isset($biller))
{{ Lang::get('billers.general.edit') }} {{ $biller->name }}
@else
{{ Lang::get('billers.general.create') }}            
@endif
::@parent
@stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{{ URL::to('billers') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
            </div>
            <h2>@if (isset($biller))
                {{ Lang::get('billers.general.edit') }} {{ $biller->name }}
                @else
                {{ Lang::get('billers.general.create') }}                 
                @endif
            </h2>
        </div>
    </div>
</div> 
{{ Form::open(array('url' => 'billers', 'files' => true, 'class'=> 'form-horizontal')) }}
    @include('billers/form')
{{ Form::close() }}
@stop