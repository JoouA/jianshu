<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>laravel for blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/cast.css')}}">
    <link rel="stylesheet" href="{{asset('css/user.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/blog.css')}}">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>

<body>

<div class="blog-masthead">
    @include('layouts.head')
</div>
<div class="container">
    <div class="blog-header"></div>
    <div class="row" id="app">
        @yield('content')
        @include('layouts.aslide')
    </div>
</div>

@include('layouts.foot')

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/ylaravel.js') }}"></script>

@include('vendor.ueditor.assets')
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });

    $('#flash-overlay-modal').modal();

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>

<script>
    window._bd_share_config={"common":{"bdSnsKey":{"tsina":"120473611"}, "bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["tsina","renren","douban","weixin","qzone","tqq","bdhome"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","renren","douban","weixin","qzone","tqq","bdhome"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
@yield('script')
</body>
</html>
