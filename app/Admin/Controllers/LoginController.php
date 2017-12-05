<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class LoginController extends Controller
{
    public function index()
    {

        return view('admin.login.index');
    }

    public function login(Request $request)
    {
        $data = $request->except('_token');

        if (Auth::guard('admin')->attempt($data)){
            return redirect('admin/home');
        }else{
            return back()->withErrors('用户名或者密码错误');
        }
    }
}
