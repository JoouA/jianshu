@extends('layouts.main')

@section('content')
    <div class="col-sm-8 blog-main">
        @include('flash::message')
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{ $post->title }}</h2>
            </div>
            <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
            <div class="panel-body">
                {!! $post->content !!}
            </div>
            <div>
                <form action="/posts/{{ $post->id }}" method="post">
                <a href="/posts/{{ $post->id }}/zan" type="button" class="btn btn-success">赞</a>
                {{ str_repeat('&nbsp;',3) }}
                <a style="margin: auto"  href="/posts/{{ $post->id }}/edit">
                    <span class="btn btn-success">编辑</span>
                </a>
                {{ str_repeat('&nbsp;',3) }}

                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}
                    <a style="margin: auto"  href="/posts/{{ $post->id }}">
                        <button  type="submit"  class="btn btn-success" onclick=" return confirm_delete(); " >删除</button>
                    </a>
                </form>
            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <h5>2017-05-28 10:15:08 by Kassandra Ankunding2</h5>
                    <div>
                        这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论
                    </div>
                </li>
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="/posts/comment" method="post">
                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                    <input type="hidden" name="post_id" value="62"/>
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        <button class="btn btn-default btn-block" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->
@endsection