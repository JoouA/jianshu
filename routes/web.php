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
//收藏文章
Route::get('/posts/{post}/like','PostController@like');
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





Route::get('/test',function () {
//    echo dd(\App\Province::all());
    return view('test');
});

Route::get('/hash',function (){
    $hash = new \Illuminate\Hashing\BcryptHasher();
    echo $hash->make('123456');
    echo "<br>";
    echo bcrypt('123456');

});
/*Route::get('/test/{provinceID}','UserController@cities');*/
Route::any('captcha-test', function()
{
    if (Request::getMethod() == 'POST')
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p><img src="'.captcha_src() .'"></p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});



