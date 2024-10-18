<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
    Route::post('register', 'RegisterController@register')
        ->name('register');

    Route::post('login', 'LoginController@login')
        ->name('login');
});
