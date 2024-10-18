<?php

use Illuminate\Support\Facades\Route;




Route::group(['namespace' => 'Product', 'as' => 'product.'], function () {

    Route::get('/', 'ProductController@index')
        ->name('products');

    Route::get('/filter', 'ProductController@filter')
        ->name('products.filter');

    Route::post('product/create', 'ProductController@store')->middleware('auth:sanctum')
        ->name('product.create');

    Route::put('product/update/{product}', 'ProductController@update')->middleware('auth:sanctum')
        ->name('product.update');
});
