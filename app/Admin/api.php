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

Route::middleware('admin:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('admin:api')->get('/city', function (Request $request) {
    $provinceId = $request->get('q');

    return \App\City::where('provincialID', $provinceId)->get([DB::raw('cityID as id'), DB::raw('cityName as text')]);
});

