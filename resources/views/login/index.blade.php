@extends('layouts.main')
@section('content')
<div class="col-md-5 col-md-offset-2">
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
        <div class="form-group has-feedback">
            <label for="inputEmail" class="control-label">邮箱或用户名:</label>
            <input type="input" id="inputEmail" class="form-control" placeholder=" 邮箱或用户名" name="email" value="{{ old('email') }}" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <label for="inputPassword" class="control-label">密码:</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group">
            <label for="captcha" class="control-label">验证码:</label>
            <br>
            <div class="pull-left">
                <input type="input" name="captcha" id="captcha" class="form-control" style="width: 240px" placeholder="captcha" autofocus required>
            </div>
            <div class="pull-right">
                <a onclick="changeCaptcha();"><img id="yanzhengma" src="{{ captcha_src() }}" alt="captcha"></a>
            </div>
        </div>
        <div class="Form-group checkbox ">
            <br>
            <label>
                <input type="checkbox" value="1" name="is_remember"> 记住我
            </label>
        </div>
        <button class="btn  btn-success btn-block" type="submit">登陆</button>
        <a href="/register" class="btn btn-success btn-block" type="submit">去注册>></a>
    </form>
    <script type="text/javascript">
        function changeCaptcha(){
            document.getElementById('yanzhengma').src = "{{captcha_src()}}"+Math.random();
        }
    </script>
</div>
@endsection