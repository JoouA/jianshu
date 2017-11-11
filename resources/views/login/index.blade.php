@extends('layouts.main')
@section('content')
<div class="col-sm-8 blog-main">
    @include('flash::message')
    @if($errors->count()>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form-signin" method="POST" action="/login">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="form-signin-heading">请登录</h2>
        <div class="form-group">
            <label for="inputEmail" class="control-label">邮箱或用户名:</label>
            <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email or username" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="control-label">密码:</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="captcha" class="control-label">验证码:</label>
            <input type="text" name="captcha" id="captcha" class="form-control" placeholder="captcha" required>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="is_remember"> 记住我
            </label>
        </div>
        <button class="btn  btn-success btn-block" type="submit">登陆</button>
        <a href="/register" class="btn btn-success btn-block" type="submit">去注册>></a>
    </form>
</div>
@endsection