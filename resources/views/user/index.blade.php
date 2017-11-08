@extends('layouts.main')
@section('content')
    <div class="col-sm-8">
        <p>
            <img src="{{ $user->avatar }}" alt="" class="img-circle" style="height: 40px">{{ $user->name}}
            @if($user->id != Auth::id())
            <a href="/user/{{ $user->id }}/{{  Auth::user()->is_start($user->id) > 0 ? 'unFollow' : 'follow' }}" class="btn btn-success" >{{ Auth::user()->is_start($user->id) > 0 ? '取消关注' : '关注' }}</a>
            @endif
        </p>
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
        <footer>关注：{{ $user->starts_count }}｜粉丝：{{ $user->fans_count }}｜文章：{{ $user->posts_count }}</footer>
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
                    <hr style="height:1px;border:none;border-top:1px solid #555555;" />
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @foreach($sUsers as $sUser )
                    <div class="blog-post" style="margin-top: 30px">
                        <p class=""><img src="{{ asset($sUser->avatar) }}" alt="avatar" class="img-circle" style="width: 30px;height: 30px"> {{ $sUser->name }}</p>
                        <p class="">关注：{{ $sUser->starts_count }} | 粉丝：{{ $sUser->fans_count }}｜ 文章：{{ $sUser->posts_count }}</p>
                        @if(Auth::check())
                            @if($user->id == Auth::id())
                                <div>
                                    <a href="/user/{{ $sUser->id }}/unFollow" class="btn btn-default like-button" like-value="1" like-user="6"  type="button">取消关注</a>
                                </div>
                            @endif
                        @endif
                    </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @foreach($fUsers as $fUser )
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><img src="{{ asset($fUser->avatar) }}" alt="avatar" class="img-circle" style="width: 30px;height: 30px"> {{ $fUser->name }}</p>
                            <p class="">关注：{{ $fUser->starts_count }} | 粉丝：{{ $fUser->fans_count }}｜ 文章：{{ $fUser->posts_count }}</p>
                            @if(Auth::check())
                                @if($user->id == Auth::id())
                                <div>
                                    <a href="/user/{{ $fUser->id }}/{{ Auth::user()->is_start($fUser->id) > 0 ? 'unFollow':'follow' }}" class="btn btn-default like-button"
                                       like-value="1" like-user="6" type="button">
                                        {{ Auth::user()->is_start($fUser->id) > 0 ? '取消关注':'关注' }}
                                    </a>
                                </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </div><!-- /.blog-main -->
@endsection