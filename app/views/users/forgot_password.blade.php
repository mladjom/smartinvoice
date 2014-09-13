@extends('public.master')

@section('title') {{ Lang::get('confide::confide.forgot.title') }} :: @parent @stop

@section('content')
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-lock"></i> {{{ Lang::get('confide::confide.forgot.title') }}}</h4>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ URL::to('/users/forgot_password') }}" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                <div class="form-group">
                    <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}</label>
                    <div class="input-append input-group">
                        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                        <span class="input-group-btn">
                            <input class="btn btn-primary" type="submit" value="{{{ Lang::get('confide::confide.forgot.submit') }}}">
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop