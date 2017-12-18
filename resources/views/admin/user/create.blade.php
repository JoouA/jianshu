@extends('admin.layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-10 col-xs-6">
        <div class="box">

            <!-- /.box-header -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">增加用户</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">用户名</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="avatar">头像</label>
                            <input type="file" id="avatar" name="avatar" class="form-control">
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