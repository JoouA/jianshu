@extends('layouts.main')
@section('content')
    <div class="col-sm-8 blog-main">
        <div>
            @foreach($posts as $post)
                <div class="blog-post">
                    <h3 class="blog-post-title"><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></h3>
                    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
                    <pre>{!! str_limit($post->content,1000) !!}</pre>
                </div>
            @endforeach
            <div style="text-align: center">
                {{--分页--}}
                {{ $posts->links() }}
            </div>
        </div><!-- /.blog-main -->
    </div>
@endsection