<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>注册</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    @if($errors->count()>0)
        <div class="alert alert-danger col-md-4 col-md-offset-4">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
    @endif
    </div>
    <div class="alert col-md-4 col-md-offset-4">
        @include('flash::message')
    </div>
    <form class="form-signin" method="POST" action="/register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2 class="form-signin-heading" align="center">请注册</h2>
        <div class="form-group">
            <label for="name" class="control-label">名字:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="名字" value="{{ old('name') }}" required autofocus>
        </div>
        <div>
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

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $('#flash-overlay-modal').modal();
</script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</body>
</html>
