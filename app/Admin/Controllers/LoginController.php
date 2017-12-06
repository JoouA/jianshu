<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()){
            return redirect('/admin/home');
        }else{
            return view('admin.login.index');
        }
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required|min:5'
        ]);
        $data = $request->except('_token');

        if (Auth::guard('admin')->attempt($data)){
            return redirect('admin/home');
        }else{
            return back()->withErrors('用户名或者密码错误');
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/');
    }
}
