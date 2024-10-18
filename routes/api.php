<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1', 'as' => 'api.v1.', 'namespace' => 'App\Http\Controllers\Api'], function () {
    Route::prefix('auth')->group(base_path('routes/v1/auth.php'));
    Route::prefix('products')->group(base_path('routes/v1/products.php'));
    Route::prefix('orders')->group(base_path('routes/v1/orders.php'));
});








Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
