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
Route::post('/posts/comment','PostController@commit');

//zan
Route::post('/posts/{post}/zan','PostController@zan');


//login
Route::get('/login','LoginController@index');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');

//register
Route::get('/register','RegisterController@index');
Route::post('/register','RegisterController@register');

//user avatar
Route::get('/user/avatar','UserController@avatar');
Route::post('/user/avatar','UserController@changeAvatar');

//user
Route::get('/user/{user}','UserController@show');
Route::get('/user/{user}/setting','UserController@setting');
Route::post('/user/{user}/setting','UserController@store');
Route::post('/cities','UserController@cities');
Route::post('/user/{user}/follow','UserController@follow');
Route::post('/user/{user}/unFollow','UserController@unFollow');




Route::get('/test',function () {
    echo dd(\App\Province::all());
});

Route::get('/hash',function (){
    $hash = new \Illuminate\Hashing\BcryptHasher();
    echo $hash->make('123456');
    echo "<br>";
    echo bcrypt('123456');

});
/*Route::get('/test/{provinceID}','UserController@cities');*/



