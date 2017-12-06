<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = AdminRole::all();
        return view('admin.role.index',compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = [
            'name' => 'required|unique:admin_roles,name',
            'description' => 'required|max:50'
        ];
        $this->validate($request,$roles);
        $data = $request->except('_token');

        $role = AdminRole::create($data);

        if($role){
            return redirect()->route('admin.role.index')->with('success','角色创建成功!');
        }else{
            return back()->withErrors('角色创建失败!');
        }
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function permission(AdminRole $role)
    {
        $permissions = AdminPermission::all();
        return view('admin.role.permission',compact('permissions','role'));
    }

    public function permissionStore(Request $request,AdminRole $role)
    {
         $permissions =  $request->get('permissions');

         $role->permissions()->sync($permissions);

        return back();
    }
}
