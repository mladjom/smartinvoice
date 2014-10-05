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
        {{ HTML::style('assets/lib/font-awesome/css/font-awesome.min.css'); }}
        {{ HTML::style('assets/css/main.min.css'); }}
        @yield('styles')
    </head>
    <body>
        @include('public/nav')
        @include('notifications')
            @yield('content')
        <div class="container"> 
        </div>
        @include('layouts/footer')
        {{ HTML::script('assets/lib/jquery/jquery.min.js'); }}
        {{ HTML::script('assets/js/scripts.min.js'); }}			
        @yield('scripts')
    </body>
</html>