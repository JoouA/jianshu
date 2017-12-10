@extends('admin.layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-10 col-xs-6">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">通知列表</h3>
            </div>
            <a type="button" class="btn " href="/admin/notices/create">增加通知</a>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>通知名称</th>
                        <th>操作</th>
                    </tr>
                    @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{!! $message->content !!}</td>
                        <td>
                            <a href="#" class="btn btn-default"><i class=" fa fa-edit"></i>编辑</a>
                            <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i>删除</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull pull-right">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection