@extends('layouts.main')
@section('content')
    <div class="col-sm-8">
        <p><img src="{{ $user->avatar }}" alt="" class="img-circle" style="height: 40px">{{ $user->name}}</p>
        <ul style="padding-left: 2px">
            <li class="banner-profile__twitter" style="display: inline"><i class="fa fa-weibo"></i>
                <a href="{{ $user->weiBo or '#' }}" style="color: black" >{{ $user->name }}</a>
            </li>
            <li class="banner-profile__github" style="display: inline"><i class="fa fa-github"></i>
                <a href="{{ $user->gitHub or '#' }}" style="color: black">{{ $user->name }}</a>
            </li>
            <li class="banner-profile__github" style="display: inline"><i class="fa fa-globe">
                </i><a href="{{ $user->web or '#' }}" style="color: black">个人网站</a>
            </li>
        </ul>
        <footer>关注：4｜粉丝：0｜文章：9</footer>
    </div>
    <div class="col-sm-8 blog-main">
        @include('flash::message')
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class=""><a href="/user/{{$user->id}}">{{ $user->name }}</a> {{ $post->updated_at->diffForHumans() }}</p>
                        <p class=""><a href="/posts/{{ $post->id }}" >{{ $post->title }}</a></p>
                        {!!  $post->content !!}
                    </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">Jadyn Medhurst Jr.</p>
                        <p class="">关注：1 | 粉丝：1｜ 文章：0</p>
                        <div>
                            <button class="btn btn-default like-button" like-value="1" like-user="6" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                        </div>
                    </div>
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">Mrs. Felicita D&#039;Amore DVM</p>
                        <p class="">关注：0 | 粉丝：1｜ 文章：1</p>
                        <div>
                            <button class="btn btn-default like-button" like-value="1" like-user="55" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                        </div>
                    </div>
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">Maybell VonRueden</p>
                        <p class="">关注：0 | 粉丝：2｜ 文章：0</p>
                        <div>
                            <button class="btn btn-default like-button" like-value="1" like-user="3" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                        </div>
                    </div>
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">Miss Melyssa Bogan DDS</p>
                        <p class="">关注：2 | 粉丝：2｜ 文章：3</p>
                        <div>
                            <button class="btn btn-default like-button" like-value="1" like-user="2" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </div><!-- /.blog-main -->
@endsection