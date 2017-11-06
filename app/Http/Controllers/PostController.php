<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show','index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->orderBy('updated_at','desc')->paginate(5);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post_data =  $request->only(['title','content']);
        $post_data = array_merge($post_data,['user_id'=>Auth::guard()->id()]);

        $post = Post::create($post_data);

        if($post){
            flash('文章创建成功！')->success();
            return redirect('/posts/'.$post->id);
        }else{
            flash('文章创建失败！')->error();
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        flash()->overlay('Modal Message', 'Modal Title');
        $post = Post::with('user')->find($id);
        // 如果post存在，显示页面
        if($post){
            return view('post.show',compact('post'));
        }else{
            return redirect('/posts');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => ['required','max:100',Rule::unique('posts','title')->ignore($id)],
            'content' => 'required'
        ];

        $this->validate($request,$rules);

        $post_data = $request->only(['title','content']);

        $is_update = Post::find($id)->update($post_data);

        if($is_update){
            flash('文章更新成功！')->success();
            return redirect('/posts/'.$id);
        }else{
            flash('文章更新失败！')->error();
            // back() 返回之前的数据
            return back()->withInput();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $is_delete = Post::destroy($id);

        if($is_delete){
            flash('文章更新成功！')->success();
            return redirect('/posts/index');
        }else{
            flash('文章更新成功！')->success();
            return back();
        }


    }
}
