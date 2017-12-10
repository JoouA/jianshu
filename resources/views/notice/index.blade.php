@extends('layouts.main')
@section('content')
    <div class="col-sm-8 blog-main panel panel-default">
        @foreach($messages as $message)
        <div class="blog-post panel-body">
            <p class="blog-post-meta">{{ $message->data['title'] }}</p>

            <p>{!! $message->data['content'] !!}</p>
        </div>
        <hr>
        @endforeach
    </div><!-- /.blog-main -->
@endsection