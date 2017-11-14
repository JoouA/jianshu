<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mews\Captcha\Captcha;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    // 如果不将方法设置成public 路由将不能访问到该方法
    public function login(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required|min:6|max:14',
            'captcha' => 'required'
        ];
        $this->validate($request,$rules);

        $username = $request->get('email');
        $password = $request->get('password');
        $captcha = $request->get('captcha');
        //判断是邮箱还是用户名登录
        $type = filter_var($username, FILTER_VALIDATE_EMAIL ) ? 'email' : 'name';

        if($type=='email'){
            // 邮箱登录
            $user_data = [
                'email' => $username,
                'password' => $password,
            ];
        }else{
            // 用户名登录
            $user_data = [
                'name' => $username,
                'password' => $password,
            ];
        }

        if (captcha_check($captcha)){
            $remember = isset($user_data['is_remember'])? true : false;
            if(Auth::attempt($user_data,$remember)){
                return redirect('/');
            }else{
                return back()->withErrors('用户名或者密码错误');
            }
        }else{
            return back()->withErrors('验证码有误');
        }


    }



    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
