@extends('layouts.master')

@section('title') {{ Lang::get('general.account') }} :: @parent @stop

@section('content') 
<div class="page-header">
    <h2>
        {{ Lang::get('general.account') }}
    </h2>        
</div>
<form method="post"  class="form-horizontal" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <!-- First Name -->
    <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
        <label for="username" class="col-md-2 control-label">{{{ Lang::get('confide::confide.username') }}}</label>
        <div class="col-md-6">
            <input class="form-control" type="text" name="username" id="username" value="{{ Input::old('username', $user->username) }}" />
            {{ $errors->first('username', '<span class="help-block">:message</span>') }}
        </div>
    </div>
    <!-- Email -->
    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-2 control-label">{{{ Lang::get('confide::confide.e_mail') }}}</label>
        <div class="col-md-6">
            <input class="form-control" type="email" name="email" id="email" value="{{ Input::old('email', $user->email) }}" />
            {{ $errors->first('email', '<span class="help-block">:message</span>') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-2 control-label">{{{ Lang::get('confide::confide.password') }}}</label>
        <div class="col-md-5">
            <input class="form-control" type="password" name="password" id="password" />
            {{ $errors->first('password', '<span class="help-block">:message</span>') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password_confirmation" class="col-md-2 control-label">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
        <div class="col-md-5">
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" />
            {{ $errors->first('password_confirmation', '<span class="help-block">:message</span>') }}
        </div>
    </div>
    <!-- form actions -->
    <div class="form-group">
        <div class="controls pull-right">
            <button type="submit" id="save" class="btn btn-primary btn-lg">{{ Lang::get('general.save') }}</button>
        </div>
    </div>  
</form>
@stop