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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('post', 'PostController');
Route::apiResource('region', 'RegionController');
Route::apiResource('town', 'TownController');
Route::apiResource('customer','CustomerController');
Route::apiResource('category','CategoryController');

Route::get('coviddata', 'ConvidDataController@getCovidData');
