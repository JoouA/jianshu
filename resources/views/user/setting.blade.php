@extends('layouts.main')
@section('content')
    <div class="col-sm-8 ">
        @include('flash::message')
        @if($errors->count()>0)
            <div class=" alert-danger alert-important">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" action="/user/{{ $user->id }}/setting" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name" class="control-label col-sm-3">用户昵称</label>
                <div class="col-sm-9">
                    <input id="name" class="form-control" placehplder="昵称用于显示" name="name" type="text" value="{{ $user->name or old('name')}}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">头像</label>
                <div class="col-sm-9">
                    <img src="{{ $user->avatar }}" alt="avatar" style="height: 200px;width: 200px">
                </div>
            </div>
            <div class="form-group">
                <label for="weibo" class=" control-label col-sm-3">微博链接</label>
                <div class="col-sm-9">
                    <input id="weibo" class="form-control setting-slug" placehplder="微博主页链接" name="weiBo" type="text" value="{{ $user->weiBo or old('weiBo') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="QQ" class=" control-label col-sm-3">QQ</label>
                <div class="col-sm-9">
                    <input id="QQ" class="form-control setting-slug" placehplder="QQ" name="QQ" type="text" value="{{ $user->QQ }}">
                </div>
            </div>
            <div class="form-group">
                <label for="setting-birthday" class="control-label col-sm-3">Github</label>
                <div class="col-sm-9">
                    <input id="github" class="form-control" placehplder="Github 地址" name="gitHub" type="text" value="{{ $user->gitHub or old('gitHub') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="control-label col-sm-3">现居城市</label>
                <div class="col-sm-9">
                    <select class="form-control bootstrap-tagsinput js-example-placeholder-single" id="province" name="province">
                        @foreach($provinces as $province)
                        @if( $province->provincialID == \App\City::find($user->city)->province->provincialID)
                            <option value="{{ $province->provincialID }}" selected>{{ $province->provincialName }}</option>
                        @else
                            <option value="{{ $province->provincialID }}">{{ $province->provincialName }}</option>
                        @endif
                        @endforeach
                    </select>
                    <select class="form-control bootstrap-tagsinput js-example-placeholder-single" name="city" id="city">
                        <option value="{{ $user->city }}">{{ \App\City::find($user->city)->cityName }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="setting-homepage" class="control-label col-sm-3">个人网站</label>
                <div class="col-sm-9">
                    <input id="setting-homepage" class="form-control" placehplder="http://example.com" name="web" type="text" value="{{ $user->web or old('web') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="setting-phone" class="control-label col-sm-3">手机号码</label>
                <div class="col-sm-9">
                    <input id="setting-phone" class="form-control"  name="phone" type="text" value="{{ $user->phone or old('phone') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="setting-description" class="control-label col-sm-3">自我简介</label>
                <div class="col-sm-9">
                    <textarea id="setting-description" class="form-control mono" rows="4" name="bio" cols="50">{!! $user->bio or old('bio')  !!}</textarea>
                </div>
            </div>
            <div class="form-action row">
                <div class="col-sm-offset-3 col-sm-9">
                    <button class="btn btn-xl btn-success profile-sub btn-block btnBlack" type="submit">更新我的资料</button>
                </div>
            </div>
        </form>
    </div>
@endsection