<div class="container">
    <form action="{{ route('posts.search') }}" method="get">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a class="blog-nav-item " href="/posts">首页</a>
        </li>
        <li>
            <a class="blog-nav-item" href="{{ Auth::check()? '/posts/create' : '/login'  }}">写文章</a>
        </li>
        <li>
            <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索词">
        </li>
        <li>
            <button class="btn btn-default" style="margin-top:10px" type="submit">Go!</button>
        </li>
    </ul>
    </form>
    <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
        {{-- 消息通知标记 --}}
        <li>
            <a href="{{ route('notice.index') }}" class="notifications-badge" style="margin-top: -2px;">
                    <span class="badge badge-{{ Auth::user()->unreadNotifications->count() > 0 ? 'hint' : 'fade' }} " title="消息提醒">
                        {{ Auth::user()->unreadNotifications->count() }}
                    </span>
            </a>
        </li>
        @endif
        <li class="dropdown">
            <div>
                @if(Auth::check())
                    <img src="{{ Auth::user()->avatar  }}" alt="avatar" class="img-circle" style="height: 30px">
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/user/{{ Auth::id() }}"><i class="fa fa-user text-md"></i> 我的主页</a></li>
                        <li><a href="/user/{{ Auth::id() }}/setting"><i class="fa fa-cog text-md "></i> 个人设置</a></li>
                        <li><a href="/user/avatar"><i class="text-md fa fa-picture-o "></i>头像设置</a></li>
                        <li><a href="/user/like"><i class="text-md fa fa-heart-o "></i>个人收藏</a></li>
                        <li><a href="/logout"><i class="fa fa-sign-out text-md"></i>登出</a></li>
                    </ul>
                @else
                    <a href="/login" class="btn btn-default" style="margin-top: 10px">登录</a>
                @endif
            </div>
        </li>
    </ul>
</div>