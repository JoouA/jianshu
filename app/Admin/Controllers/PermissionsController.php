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

    public function edit(AdminPermission $permission)
    {
        return view('admin.permission.edit',compact('permission'));
    }

    public function update(Request $request,AdminPermission $permission)
    {
        $data = $request->except('_token');

        $permission = $permission->update($data);

        if ($permission){
            return redirect()->route('admin.permission.index')->with('success','权限更新成功!');
        }else{
            return back()->withErrors('权限更新失败!');
        }

    }

    public function destroy(AdminPermission $permission)
    {
        if ($permission->delete()){
            return redirect()->route('admin.permission.index')->with('success','权限删除成功');
        }else{
            return back()->withErrors('权限删除失败');
        }
    }
}
