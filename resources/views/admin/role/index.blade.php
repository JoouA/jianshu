@extends('admin.layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-10 col-xs-6">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">角色列表</h3>
            </div>
            <a type="button" class="btn " href="/admin/roles/create" >增加角色</a>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody><tr>
                        <th style="width: 10px">ID</th>
                        <th>角色名称</th>
                        <th>角色描述</th>
                        <th>操作</th>
                    </tr>
                    @foreach($roles as $role)
                    <tr>
                        <form action="{{ route('admin.role.destroy',$role->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{ method_field('DELETE') }}
                            <td>{{ $role->id }}.</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                <a type="button" class="btn btn-default" href="/admin/roles/{{ $role->id }}/permission" >权限管理</a>
                                <a href="{{ route('admin.role.edit',$role->id) }}" class="btn btn-success"><i class="fa fa-edit"></i>编辑</a>
                                <button onclick=" return confirm_delete(); " class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>删除
                                </button>
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