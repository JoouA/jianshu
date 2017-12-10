@extends('admin.layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-10 col-xs-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">专题列表</h3>
            </div>
            <a type="button" class="btn " href="{{ route('admin.topic.create') }}" >增加专题</a>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>专题名称</th>
                        <th>操作</th>
                    </tr>
                    @foreach($topics as $topic)
                    <form action="{{ route('admin.topic.destroy',$topic->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <tr>
                        <td>{{ $topic->id }}.</td>
                        <td>{{ $topic->name }}</td>
                        <td>
                            <a type="button"  href="{{ route('admin.topic.edit',$topic->id) }}" class="btn btn-success" ><i class="fa fa-edit"></i>编辑</a>
                            <button type="submit" class="btn resource-delete btn-danger" ><i class="fa fa-trash"></i>删除</button>
                        </td>
                    </tr>
                    </form>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection