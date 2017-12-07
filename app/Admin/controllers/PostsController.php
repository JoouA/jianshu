<?php

namespace App\Admin\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::withoutGlobalScope('status')->paginate(5);

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
        $status = $request->get('status');
        $post_id = $request->get('post_id');
        return \Response::json([
            'status' => $status,
            'post_id' => $post_id,
        ]);
    }


}
