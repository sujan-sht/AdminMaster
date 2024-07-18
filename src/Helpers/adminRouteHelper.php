<?php

if(! function_exists('adminBaseUrl')){
    function adminBaseUrl($route)
    {
        return url('admin/'.$route);
    }
}

if(! function_exists('adminRedirectRoute')){
    function adminRedirectRoute($route)
    {
        return adminBaseUrl($route);
    }
}

if(! function_exists('adminCreateRoute')){
    function adminCreateRoute($route)
    {
        return adminBaseUrl($route).'/create';
    }
}

if(! function_exists('adminStoreRoute')){
    function adminStoreRoute($route)
    {
        return adminBaseUrl($route);
    }
}


if(! function_exists('adminShowRoute')){
    function adminShowRoute($route,$id)
    {
        return adminBaseUrl($route).'/'.$id;
    }
}

if(! function_exists('adminEditRoute')){
    function adminEditRoute($route,$id)
    {
        return adminBaseUrl($route).'/'.$id .'/edit';
    }
}

if (! function_exists('adminUpdateRoute')) {
    function adminUpdateRoute($route, $id)
    {
        return adminBaseUrl($route).'/'.$id;
    }
}

if (! function_exists('adminDeleteRoute')) {
    function adminDeleteRoute($route, $id)
    {
        return adminBaseUrl($route).'/'.$id;
    }
}
