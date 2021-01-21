<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ParcelController;

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


Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::prefix('/parcels')->namespace('App\Http\Controllers')->name('parcels.')->group(function () {
        Route::get('/prices', 'ParcelController@getPrices')->name('prices');
        Route::post('', 'ParcelController@store')->name('store');
        Route::get('/{id}', 'ParcelController@show')->name('show');
        Route::put('/{id}', 'ParcelController@update')->name('update');
        Route::delete('/{id}', 'ParcelController@delete')->name('delete');
    });
});
