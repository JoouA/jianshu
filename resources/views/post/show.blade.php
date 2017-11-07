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
                 @if($post->zan_exit())
                    <button  id="zan" type="button"
                       postID="{{ $post->id }}"  current_zan = "取消赞"
                       class="btn btn-warning">取消赞
                    </button>
                 @else
                    <button  id="zan" type="button"
                         postID="{{ $post->id }}"  current_zan = "赞"
                         class="btn  btn-success">赞
                    </button>
                 @endif
                <a style="margin: auto"  href="/posts/{{ $post->id }}/edit">
                    <span class="btn btn-success">编辑</span>
                </a>
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
                @foreach($post->commits as $commit)
                <li class="list-group-item">
                    <div class="pull-left" style="padding-right: 10px;">
                        <img src="{{ asset($commit->user->avatar) }}" alt="avatar" class="img-circle" style="width: 45px;height: 45px">
                    </div>
                    <div style="padding-left: 56px">
                        <h5>{{ $commit->content }}</h5>
                        {{--carbon對時間進項格式化--}}
                        <h6>{{ $commit->updated_at->toDateTimeString() }} by  <a href="/user/{{ $commit->user->id }}">{{ $commit->user->name  }} </a></h6>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>
            <!-- List group -->
            <ul class="list-group">
                @if(Auth::check())
                @if($errors->count() > 0)
                    @foreach($errors->all() as $error)
                        <span class="error">{{ $error }}</span>
                    @endforeach
                @endif
                <form action="/posts/comment" method="post">
                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                    <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="5"  maxlength="50"
                         onchange="this.value=this.value.substring(0, 50)" onkeydown="this.value=this.value.substring(0, 50)"
                         onkeyup="this.value=this.value.substring(0, 50)" required></textarea>
                        <button class="btn btn-success btn-block" type="submit" style="margin-top: 10px;">提交</button>
                    </li>
                </form>
                @else
                    <a href="/login" class="btn btn-success btn-block" type="submit" style="margin-top: 10px;">登陆提交评论</a>
                @endif
            </ul>
        </div>

    </div><!-- /.blog-main -->
@endsection