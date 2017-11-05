<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/posts') ;
});


//post
Route::resource('/posts','PostController');



//login
Route::get('/login','LoginController@index');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');

//register
Route::get('/register','RegisterController@index');
Route::post('/register','RegisterController@register');

//user
Route::get('/user/{user}','UserController@show');
Route::get('/user/{user}/setting','UserController@setting');
Route::post('/user/{user}/setting','UserController@store');
Route::post('/cities','UserController@cities');





/*Route::get('/test',function () {
    echo dd(\App\Province::all());
});*/
Route::get('/test/{provinceID}','UserController@cities');



