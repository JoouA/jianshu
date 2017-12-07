@extends('admin.layouts.app')
@section('content')
        <!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-12 col-xs-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">权限列表</h3>
            </div>
            <a type="button" class="btn " href="/admin/permissions/create" >增加权限</a>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>权限名称</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <form action="{{ route('admin.permission.destroy',$permission->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a type="button" class="btn btn-default" href="{{ route('admin.permission.edit',$permission->id) }}">
                                    <span class="fa fa-edit"></span>编辑
                                </a>
                                <button onclick="return confirm_delete(); " type="submit" class="btn btn-danger">
                                    <span class="fa fa-trash"></span>删除
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
