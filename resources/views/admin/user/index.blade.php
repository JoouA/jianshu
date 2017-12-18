@extends('admin.layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-10 col-xs-6">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">用户列表</h3>
            </div>
            <a type="button" class="btn " href="/admin/users/create" >增加用户</a>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>用户头像</th>
                        <th>用户名称</th>
                        <th>操作</th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ $user->avatar }}" class="img-circle" style="height: 30px;width: 30px" alt="avatar"></td>
                        <td>{{ $user->name }}</td>
                        <form action="{{ route('admin.user.destroy',$user->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <td>
                                <a class="btn btn-default" href="{{ route('admin.user.role',$user->id) }}" >角色管理</a>
                                <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-default"><span class="fa fa-edit"></span>编辑</a>
                                <button type="submit" class="btn btn-danger"><span class="fa fa-trash"></span>删除</button>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection