@extends('layouts.main')

@section('content')
    <div class="col-sm-8 blog-main">
        @include('layouts.errors')
        <form action="/posts" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label>内容</label>
                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain">{!! old('content') !!}</script>
            </div>
            <button type="submit" class="btn btn-success btn-block ">提交</button>
        </form>
        <br>

    </div><!-- /.blog-main -->
@endsection