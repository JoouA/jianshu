@extends('admin.layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-10 col-xs-6">
        <div class="box">
            <!-- /.box-header -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">增加通知</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('admin.notice.store') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">标题</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="content">内容</label>
                            <textarea class="form-control" name="content"></textarea>
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