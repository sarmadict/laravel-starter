<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]>
<html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en"><!--<![endif]-->
<head>
    <title>@yield('page-title')</title>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1"/><![endif]-->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token()}}">

    @section('meta-tags')
        <meta content="Application" name="description"/>
    @show

    @include('admin.partials.head-assets')
</head>

<body class="@yield('body-class')">
<div id="app">

    @include('admin.partials.sidebar')

    <div class="app-content">
        @include('admin.partials.navbar')

        <div class="main-content">
            <div class="wrap-content container" id="container">
                @yield('page-header')

                @include('admin.partials.alerts')

                @yield('page-contents')
            </div>
        </div>
    </div>

    @include('admin.partials.footer')

    @include('admin.partials.off-sidebar')

    @include('admin.partials.settings')

</div>

@include('admin.partials.foot-assets')

</body>

</html>