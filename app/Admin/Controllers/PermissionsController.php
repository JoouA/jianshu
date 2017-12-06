<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = AdminPermission::all();
        return view('admin.permission.index',compact('permissions'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $roles = [
            'name' => 'required|unique:admin_permissions,name',
            'description' => 'required|max:50'
        ];
        $this->validate($request,$roles);

        $data = $request->except('_token');

        $permission = AdminPermission::create($data);

        if($permission){
            return redirect()->route('admin.permission.index')->with('success','创建成功');
        }else{
            return back()->withErrors('权限创建失败');
        }
    }
}
