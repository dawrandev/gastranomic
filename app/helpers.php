<?php

if (!function_exists('getBrands')) {
    function getBrands()
    {
        return App\Models\Brand::all();
    }
}
if (!function_exists('getCategories')) {
    function getCategories()
    {
        return App\Models\Category::all();
    }
}
if (!function_exists('getCities')) {
    function getCities()
    {
        return App\Models\City::all();
    }
}
if (!function_exists('getLanguages')) {
    function getLanguages()
    {
        return \App\Models\Language::all();
    }
}
