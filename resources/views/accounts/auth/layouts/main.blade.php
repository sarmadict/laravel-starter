<!DOCTYPE html>
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
{{-- start: HEAD --}}
<head>
    <title>@yield('page-title')</title>
    {{-- start: META --}}
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1"/><![endif]-->
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    @section('meta_tags')
        <meta content="Application Login" name="description"/>
    @show
    {{-- end: META --}}

    @include('accounts.auth.partials.head-assets')

</head>
{{-- end: HEAD --}}

{{-- start: BODY --}}
<body class="layout layout-vertical layout-right-navigation layout-above-toolbar">

@yield('page-contents')

@include('accounts.auth.partials.foot-assets')
</body>
{{-- end: BODY --}}
</html>