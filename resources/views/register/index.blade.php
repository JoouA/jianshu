@extends('layouts.main')
@section('content')
<div class="col-sm-8 blog-main">
    @if($errors->count()>0)
        <div class="alert alert-danger col-md-4 col-md-offset-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form-signin" method="POST" action="/register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name" class="control-label">名字:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="名字" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="control-label">邮箱:</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="邮箱" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="control-label">密码:</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="输入密码" required>
        </div>
        <div class="form-group">
            <label class="control-label">重复密码:</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="重复输入密码" required>
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">注册</button>
    </form>
</div> <!-- /container -->
@endsection