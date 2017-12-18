@extends('admin.layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-10 col-xs-6">
        <div class="box">
            <!-- /.box-header -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑用户</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('admin.user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">用户名</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="name" value="{{ old('name',$user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">用户头像</label>
                            @if($user->avatar)
                                <br>
                                <img class="Thumbnail img-responsive" src="{{ $user->avatar }}" alt="avatar" width="200" />
                            @endif
                            <br>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">重复密码</label>
                            <input type="password" id="password_confirmation" class="form-control" placeholder="Password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection