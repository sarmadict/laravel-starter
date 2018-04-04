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

    @include('panel.admin.partials.head-assets')
</head>

<body class="@yield('body-class')">
<div id="app">

    @include('panel.admin.partials.sidebar')

    <div class="app-content">
        @include('panel.admin.partials.navbar')

        @yield('page-contents')
    </div>

    @include('panel.admin.partials.footer')

    @include('panel.admin.partials.off-sidebar')

    @include('panel.admin.partials.settings')

</div>

@include('panel.admin.partials.alerts')

@include('panel.admin.partials.foot-assets')
</body>

</html>