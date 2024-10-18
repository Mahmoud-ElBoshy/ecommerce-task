<?php

use Illuminate\Support\Facades\Route;




Route::group(['namespace' => 'Order', 'as' => 'order.','middleware' => 'auth:sanctum'], function () {

    Route::get('/order', 'OrderController@show')->name('order');

    Route::post('order/create', 'OrderController@store')->name('order.create');
});
