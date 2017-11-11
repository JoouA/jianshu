<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Commit;
use App\Zan;
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
    {   // 使用with预加载可以减少sql的执行次数   commits_count
        $posts = Post::with('user')->withCount('commits')->withCount('zans')->orderBy('updated_at','desc')->paginate(5);
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
        $post = Post::with('user')->with('commits')->find($id);
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


    public function commit(Request $request)
    {
        $rules = [
            'post_id' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'content.required' => '评论不能为空'
        ];
        $this->validate($request,$rules,$messages);
        $commit_data = $request->except('_token');
//        dd($commit_data);
        $commit_data = array_merge($commit_data,['user_id' => Auth::id()]);

        $commit = Commit::firstOrCreate($commit_data);

        if($commit){
            return back();
        }else{
            flash('评论失败')->warning();
            return back()->withInput();
        }
    }

    // 进行点赞取消赞的行为
    public function zan(Request $request){
         $id =  $request->get('postID');
         $post = Post::find($id);

        // toggle 是一个辅助的方法操作的是中间表
        $post->zans()->toggle(Auth::id());

        if ($post){
            return \Response::json([
                'error' => 0,
            ]);
        }else{
            return \Response::json([
                'error' => 1,
            ]);
        }

    }

    public function like(Post $post){
         Auth::user()->likes()->toggle($post->id);
        return back();
    }
}
