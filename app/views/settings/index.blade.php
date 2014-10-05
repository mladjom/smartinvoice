@extends('layouts.master')

@section('title') {{ Lang::get('general.edit') }} {{ Lang::get('general.settings') }} :: @parent @stop

@section('content')
<div class="page-header">
    <h2>
        {{ Lang::get('general.settings') }}
    </h2>        
</div>
<form class="" method="post" action="{{ URL::to('settings') }}"  autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <input type="hidden" name="id" value="{{{ $setting->id }}}" />
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label" for="language">{{ Lang::get('general.language') }}</label>
                <select class="form-control" name="language" id="language">
                    @foreach(Config::get('languages') as $k => $v)
                    <option {{ $k == $setting->language ? 'selected="selected"' : null }} value="{{ $k }}">{{ $v }}</option>
                    @endforeach               
                </select>      
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label" for="country_id">{{ Lang::get('general.default_currency') }}</label>
                <select class="form-control" name="country_id" id="country_id">
                    @foreach ($countries as $country)
                    <option {{ $setting->currency_id == $country->id ? 'selected="selected"' : null }} value="{{ $country->id }}">{{ $country->currency_code }}</option>
                    @endforeach
                </select>      
            </div>
        </div>
    </div>
    <!-- form actions -->
    <div class="form-group">
        <div class="controls pull-right">
            <button type="submit" id="save" class="btn btn-success btn-lg">{{ Lang::get('general.save') }}</button>
        </div>
    </div>  
</form>
@stop