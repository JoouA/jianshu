<?php

namespace App\Admin\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
//        $posts = Post::withoutGlobalScope('status')->paginate(5);
        $posts = Post::where('status',0)->paginate(5);

        return view('admin.post.index',compact('posts'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }


    public function edit(Post $post)
    {
        return view('admin.post.edit',compact('post'));
    }

    public function store(Request $request)
    {

    }

    public function status(Request $request)
    {
        // validate
        $this->validate($request,[
            'status' => 'required|in:-1,1'
        ]);

        $status = $request->get('status');
        $post_id = $request->get('post_id');

        $post = Post::find($post_id);

        // is post exist
        if($post){

            $post->status = $status;
            $post->save();

            return \Response::json([
                'error' => 0,
                'status' => $status,
                'post_id' => $post_id,
            ]);
        }else{
            return \Response::json([
                'msg' => 'failed',
                'status' => $status,
                'post_id' => $post_id,
            ]);
        }

    }

}
