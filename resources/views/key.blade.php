<html>
<head>
    <title>key</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <div class="row">
                <div class="panel-heading" style="text-align: center">
                    <h2>开锁记录</h2>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    @foreach($keys as $key)
                        @if($key->type == 0)
                        <li class="list-group-item">
                            <div class="pull-left" style="padding-right: 10px;">
                                <img src="{{ asset('avatar/user.png') }}" alt="avatar" class="img-circle" style="width: 45px;height: 45px">
                            </div>
                            <div style="padding-left: 56px">
                                <h5>{{ $key->name }}</h5>
                                <h6>{{ $key->time }} 用APP开锁成功</h6>
                            </div>
                        </li>
                        @elseif($key->type == 1)
                            <li class="list-group-item">
                                <div class="pull-left" style="padding-right: 10px;">
                                    <img src="{{ asset('avatar/card.png') }}" alt="avatar" class="img-circle" style="width: 45px;height: 45px">
                                </div>
                                <div style="padding-left: 56px">
                                    <h5>{{ $key->name }}</h5>
                                    <h6>{{ $key->time }} 用卡开锁成功</h6>
                                </div>
                            </li>
                        @else
                            <li class="list-group-item">
                                <div class="pull-left" style="padding-right: 10px;">
                                    <img src="{{ asset('avatar/lock.png') }}" alt="avatar" class="img-circle" style="width: 45px;height: 45px">
                                </div>
                                <div style="padding-left: 56px">
                                    <h5>{{ $key->name }}</h5>
                                    <h6>{{ $key->time }} 用密码开锁成功</h6>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div align="center" class="col-md-4 col-md-offset-4">
        {{ $keys->links() }}
    </div>
</body>
</html>


