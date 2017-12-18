<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
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

//        $user->hasPermission(AdminPermission::find(1));
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

        $avatar_file =  $request->file('avatar');


        // 如果有文件
        if ($avatar_file){
            $rules = [
                'name' => 'required|unique:admin_users,name',
                'password' => 'required|min:5|max:16|confirmed',
                'avatar' => 'image|dimensions:min_width=100,min_height=200'
            ];

            $this->validate($request,$rules);

            $folder_name = 'avatar/'. date("Ym",time()) . '/' . date('d',time());

            $upload_path = public_path() . '/' . $folder_name ;

            $avatar = md5(time()). '.' .$avatar_file->getClientOriginalExtension();

            $avatar_file->move($upload_path,$avatar);


            $data = [
                'name' => $request->get('name'),
                'password' => bcrypt($request->get('password')),
                'avatar' =>  config('app.url') . "/$folder_name/$avatar",
            ];


        }else{
            $data = [
                'name' => $request->get('name'),
                'password' => bcrypt($request->get('password')),
            ];
        }


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


    public function update(Request $request,AdminUser $user)
    {

        $messages = [
            'name.unique' => '用户名已存在',
        ];

        $avatar_file = $request->file('avatar');

        if ($avatar_file){
            $rules = [
                'name' => 'required|unique:admin_users,name,'.$user->id,
                'password' => 'required|min:5|confirmed',
                'avatar' => 'image|dimensions:min_width=100,min_height=200'
            ];
            $this->validate($request,$rules,$messages);

            $folder_name = 'avatar/' . date('Ym',time()) . '/' . date('d',time());

            $upload_path = public_path() . '/' . $folder_name;

            $filename = md5(time()). '.' .$avatar_file->getClientOriginalExtension();

            $avatar_file->move($upload_path,$filename);


            $data = [
                'name' => $request->get('name'),
                'password' => bcrypt($request->get('password')),
                'avatar' => config('app.url') . '/' . "$folder_name/$filename",
            ];

            // asset($folder_name. '/ ' .$filename) 的效果和 config('app.url') . '/' . "$folder_name/$filename" 是一样的

        }else{
            $rules = [
                'name' => 'required|unique:admin_users,name,'.$user->id,
                'password' => 'required|min:5|confirmed',
            ];
            $this->validate($request,$rules,$messages);

            $data = [
                'name' => $request->get('name'),
                'password' => bcrypt($request->get('password')),
            ];
        }


        if ($user->update($data)){
            return redirect()->route('admin.user.index')->with('success','用户信息更新成功!');
        }else{
            return back()->withErrors('用户信息更新失败!');
        }
    }

    public function destroy(AdminUser $user)
    {

       if ($user->delete()){
            return redirect()->route('admin.user.index')->with('success','用户删除成功!');
       }else{
           return back()->withErrors('用户删除失败!');
       }
    }
}
