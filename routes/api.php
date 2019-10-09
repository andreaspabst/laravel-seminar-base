<?php

use Illuminate\Http\Request;

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


Route::post('/sentry-bug', function () {
    throw new Exception;
});

Route::apiResource('countries', 'CountryController');
Route::apiResource('cities', 'CityController');
Route::apiResource('houses', 'HouseController');

Route::get('/products/{id}/buy/{quantity}', 'ProductController@buy_product');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
