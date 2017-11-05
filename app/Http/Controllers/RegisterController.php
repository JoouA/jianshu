<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index');
    }

    public function register(Request $request){
        $rules = [
            'name' => 'required|unique:users,name|min:1|max:10',
            'password' => 'required|confirmed|min:6|max:16',
            'email' => 'required|email|unique:users,email',
        ];
        $this->validate($request,$rules);

        $user_data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];

        $user = User::create($user_data);

        if($user){
            flash('注册成功')->success();
            return back();
        }else{
            return back()->withInput()->withErrors('创建账号失败');
        }
    }

}
