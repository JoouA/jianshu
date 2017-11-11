@extends('layouts.main')
@section('content')
    <div class="col-sm-8">
        <blockquote>
            <p>{{ $topic->name }}</p>
            <footer>文章：{{ $topic->posts->count() }}</footer>
            <button class="btn btn-default topic-submit"  data-toggle="modal" data-target="#topic_submit_modal" topic-id="1" type="button">投稿</button>
        </blockquote>
    </div>
    <div class="modal fade" id="topic_submit_modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">我的文章</h4>
                </div>
                <div class="modal-body">
                    @if(Auth::check())
                    <form action="/topic/{{ $topic->id }}/submit" method="post">
                        {{ csrf_field() }}
                        @foreach(Auth::user()->posts as $post)
                        @if($topic->hasPost($post->id))
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="post_ids[]" value="{{ $post->id }}" checked>
                                {!! $post->title !!}
                            </label>
                        </div>
                        @else
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="post_ids[]" value="{{ $post->id }}">
                                    {!! $post->title !!}
                                </label>
                            </div>
                        @endif
                        @endforeach
                        <button type="submit" class="btn btn-default">投稿</button>
                    </form>
                    @else
                        <a href="/login" class="btn btn-success btn-block">登录后进行投稿</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($topic->posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <h3><a href="/posts/{{ $post->id }}">{{ $post->title }} </a></h3>
                        <p class=""><a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a> {!! str_repeat('&nbsp',3) !!}  {{ $post->updated_at->diffForHumans() }}</p>
                        <p class=""><a href="/posts/55" >{{ $post->titile }}</a></p>
                        <pre>{!! str_limit($post->content,1000) !!}</pre>
                    </div>
                    @endforeach
                </div>

            </div>
            <!-- /.tab-content -->
        </div>
    </div><!-- /.blog-main -->
@endsection