<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(ProductController::class)->prefix('products')->name('product.')->group(function () {
    Route::get('/', 'ProductController@index')->name('index');
    Route::get('/{id}', 'ProductController@show')->name('show');

    Route::middleware('auth.api')->group(function () {
        Route::post('/', 'ProductController@store')->name('store');
        Route::put('/{id}', 'ProductController@update')->name('update');
        Route::delete('/{id}', 'ProductController@delete')->name('delete');
    });
});
