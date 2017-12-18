<?php

namespace App\Admin\Controllers;

use App\User;
use Illuminate\Http\Request;

class FrontUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(3);

        return view('admin.front.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.front.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ];

        $this->validate($request,$rules);


        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];


        if ( User::create($data) ){
            return redirect()->route('fronts.index')->with('success','用户添加成功');
        }else{
            return back()->withErrors('用户添加失败!');
        }
    }


    public function edit(User $front)
    {
        $user = $front;

        return view('admin.front.edit',compact('user'));
    }


    public function update(Request $request, User $front)
    {

        $user = $front;

        $rules = [
            'name' => 'required|unique:users,name,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request,$rules);


        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];


        if ( $user->update($data)){
            return redirect()->route('fronts.index')->with('success','更新用户信息成功!');
        }else{
            return back()->withErrors('更新用户信息错误!');
        }

    }


    public function destroy(User $front)
    {
        $user = $front;
        $this->destroyInfoWithUser($user);
        
        if ($user->delete()){
            return redirect()->route('fronts.index')->with('success','删除用户成功');
        }else{
            return back()->withErrors('删除用户失败');
        }
    }

    protected function destroyInfoWithUser(User $user)
    {
        // 删除文章
        $posts = $user->posts();


        // 删除评论
        $commits = $user->commits();


        // 删除关注
        $fs = \DB::table('fans')->where('fan_id',$user->id)->orWhere('start_id',$user->id);


        // 删除投稿的信息
        $postsInTopic = \DB::table('post_topics')->whereIn('post_id',$posts);


        $posts->delete();
        $commits->delete();
        $fs->delete();
        $postsInTopic->delete();

    }
}
