@extends('public.master')

@section('title') {{ Lang::get('confide::confide.login.title') }} :: @parent @stop

@section('content')	
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-lock"></i> {{{ Lang::get('confide::confide.login.title') }}}</h4>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{{ URL::to('/users/login') }}}" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                <fieldset>
                    <div class="form-group">
                        <label for="email">{{{ Lang::get('confide::confide.username_e_mail') }}}</label>
                        <input class="form-control" tabindex="1" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                    </div>
                    <div class="form-group">
                        <label for="password">
                            {{{ Lang::get('confide::confide.password') }}}
                            <small>
                                <a href="{{{ URL::to('/users/forgot_password') }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
                            </small>
                        </label>
                        <input class="form-control" tabindex="2" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                    </div>
                    <div class="form-group checkbox">
                        <label for="remember" class="checkbox">
                            <input type="hidden" name="remember" value="0">
                            <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
                            {{{ Lang::get('confide::confide.login.remember') }}}
                        </label>
                    </div>
                    <div class="form-group">
                        <button tabindex="3" type="submit" class="btn btn-secondary">{{{ Lang::get('confide::confide.login.submit') }}}</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="panel-footer">
            <a href="{{{ URL::to('users/create') }}}">{{{ Lang::get('confide::confide.signup.desc') }}}</a>
        </div>
    </div>
</div>
@stop