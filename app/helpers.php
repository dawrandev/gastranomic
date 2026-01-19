<?php

function getBrands()
{
    return App\Models\Brand::all();
}

function getCategories()
{
    return App\Models\Category::all();
}

function getCities()
{
    return App\Models\City::all();
}
