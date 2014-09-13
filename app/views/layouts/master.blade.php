<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@section('title') Smart Invoice @show </title>
        <meta name="description" content="Smart, Simple, Intuitive Online Invoicing">
        <meta property="og:site_name" content="Smart Invoice">
        <meta property="og:url" content="https://www.smartinvoice.com">
        <meta property="og:title" content="Smart Invoice">
        <!-- 500x500-->
        <meta property="og:image" content="{{ asset('assets/ico/social.png') }}">
        <meta property="og:description" content="Create and generate custom invoices online using Smart Invoice.">
        <meta name="csrf-token" content="<?= csrf_token() ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="apple-touch-icon-precomposed"  href="{{{ asset('assets/ico/apple-touch-icon-precomposed.png') }}}">
        <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}" type="image/x-icon">
        <link href='//fonts.googleapis.com/css?family=Roboto:400,700,900,100' rel='stylesheet' type='text/css'>
        {{ HTML::style('assets/lib/font-awesome/css/font-awesome.min.css'); }}
        {{ HTML::style('assets/css/main.min.css'); }}
        @yield('styles')
    </head>
    <body>
        @include('layouts/nav')
        <div class="container"> 
            @include('notifications')
            @yield('content')
        </div>
        @include('layouts/footer')
        <div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('general.cancel') }}</button>
                        {{ Form::open(array('class' => 'pull-right', 'id' => 'action')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit(trans('general.yes'), array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        {{ HTML::script('assets/lib/jquery/jquery.min.js'); }}
        {{ HTML::script('assets/js/scripts.min.js'); }}			
        @yield('scripts')
    </body>
</html>