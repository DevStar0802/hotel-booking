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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Hotel Manager
Route::get('/hotel', 'HotelController@show');
Route::put('/hotel/update', 'HotelController@update');
//!Hotel Manager

Route::resource('/room-types', 'RoomTypeController', ['except' => ['create', 'edit']]);
Route::resource('/room-capacities', 'RoomCapacityController', ['except' => ['create', 'edit']]);
Route::resource('/rooms', 'RoomController', ['except' => ['create', 'edit']]);

Route::resource('/price', 'PriceController', ['except' => ['create', 'edit']]);
