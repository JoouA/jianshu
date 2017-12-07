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

Route::get('/','PostController@index');

//login
Route::get('/login','LoginController@index')->name('login');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout')->name('logout');

//register
Route::get('/register','RegisterController@index')->name('register');
Route::post('/register','RegisterController@register');


//search
Route::get('/posts/search','PostController@search')->name('posts.search');
//post
Route::resource('/posts','PostController');
Route::post('/posts/comment','PostController@commit');
//收藏文章
Route::get('/posts/{post}/like','PostController@like');
//zan
Route::post('/posts/{post}/zan','PostController@zan');

//user avatar
Route::get('/user/avatar','UserController@avatar');
Route::post('/user/avatar','UserController@changeAvatar');


//个人收藏
Route::get('/user/like','UserController@likePostList');
Route::get('/user/{user}','UserController@show');
Route::get('/user/{user}/setting','UserController@setting');
Route::post('/user/{user}/setting','UserController@store');
Route::post('/cities','UserController@cities');
Route::post('/user/{user}/follow','UserController@follow');
Route::post('/user/{user}/unFollow','UserController@unFollow');

//topic
Route::get('/topic/{topic}','TopicController@show');
Route::post('/topic/{topic}/submit','TopicController@submit');


Route::get('/key','KeyController@index');
Route::get('/iphone','KeyController@iphone');


Route::group(['prefix' => 'admin'],function(){
    Route::get('/','\App\Admin\Controllers\LoginController@index');
    Route::get('/login','\App\Admin\Controllers\LoginController@index')->name('admin.user.login');
    Route::post('/login','\App\Admin\Controllers\LoginController@login');
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout')->name('admin.user.logout');

    Route::group(['middleware' => 'auth:admin'],function(){
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

        Route::group(['middleware' => 'can:system'],function (){
            Route::get('/permissions','\App\Admin\Controllers\PermissionsController@index')->name('admin.permission.index');
            Route::get('/permissions/create','\App\Admin\Controllers\PermissionsController@create')->name('admin.permission.create');
            Route::post('/permissions','\App\Admin\Controllers\PermissionsController@store')->name('admin.permission.store');
            Route::put('/permissions/{permission}/update','\App\Admin\Controllers\PermissionsController@update')->name('admin.permission.update');
            Route::get('/permissions/{permission}/edit','\App\Admin\Controllers\PermissionsController@edit')->name('admin.permission.edit');
            Route::delete('/permissions/{permission}','\App\Admin\Controllers\PermissionsController@destroy')->name('admin.permission.destroy');

            Route::get('/users','\App\Admin\Controllers\UsersController@index')->name('admin.user.index');
            Route::get('/users/create','\App\Admin\Controllers\UsersController@create')->name('admin.user.create');
            Route::get('/users/{user}','\App\Admin\Controllers\UsersController@show')->name('admin.user.show');
            Route::get('/users/{user}/edit','\App\Admin\Controllers\UsersController@edit')->name('admin.user.edit');
            Route::get('/users/{user}/role','\App\Admin\Controllers\UsersController@role')->name('admin.user.role');
            Route::post('/users/{user}/role','\App\Admin\Controllers\UsersController@roleStore')->name('admin.user.roleStore');
            Route::get('/users/{user}/delete','\App\Admin\Controllers\UsersController@delete')->name('admin.user.delete');
            Route::post('/users','\App\Admin\Controllers\UsersController@store')->name('admin.user.store');


            Route::get('/roles','\App\Admin\Controllers\RolesController@index')->name('admin.role.index');
            Route::get('/roles/create','\App\Admin\Controllers\RolesController@create')->name('admin.role.create');
            Route::post('/roles','\App\Admin\Controllers\RolesController@store')->name('admin.role.store');
            Route::get('/roles/{role}/permission','\App\Admin\Controllers\RolesController@permission')->name('admin.role.permission');
            Route::post('/roles/{role}/permission','\App\Admin\Controllers\RolesController@permissionStore')->name('admin.role.permissionStore');
        });
        Route::group(['middleware' => 'can:post'],function(){
            Route::get('/posts','\App\Admin\Controllers\PostsController@index')->name('admin.post.index');
            Route::put('/posts/status','\App\Admin\Controllers\PostsController@status')->name('admin.post.status');
        });
    });
});
