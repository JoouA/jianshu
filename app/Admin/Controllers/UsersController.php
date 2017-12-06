<?php

namespace App\Admin\Controllers;

use App\AdminRole;
use App\AdminUser;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = AdminUser::all();
        return view('admin.user.index',compact('users'));
    }

    public function show(AdminUser $user)
    {
        dd($user);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit(AdminUser $user)
    {
        return view('admin.user.edit',compact('user'));
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:admin_users,name',
            'password' => 'required|min:5|max:16|confirmed'
        ];

        $this->validate($request,$rules);

        $data = [
            'name' => $request->get('name'),
            'password' => bcrypt($request->get('password')),
        ];

        $user = AdminUser::create($data);

        if($user){
            return redirect()->route('admin.user.index')->with('success','用户创建成功!');
        }else{
            return back()->withErrors('用户创建失败!');
        }

    }

    public function role(AdminUser $user)
    {
        $roles = AdminRole::all();
        return view('admin.user.role',compact('user','roles'));
    }

    public function roleStore(Request $request,AdminUser $user)
    {
        $roles = $request->get('roles');

        $user->roles()->sync($roles);

        return back();
    }
}
