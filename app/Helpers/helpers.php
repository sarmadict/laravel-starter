<?php


if (!function_exists('domain')) {
    function domain($subdomain = null)
    {
        $domain = config('app.domain');

        return $subdomain ? $subdomain . '.' . $domain : $domain;
    }
}

if (!function_exists('route_path')) {
    function route_path($path = '')
    {
        return base_path("routes" . ($path ? DIRECTORY_SEPARATOR . $path : $path));
    }
}