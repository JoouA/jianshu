@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-xs-6">
            <div class="box">

                <!-- /.box-header -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">编辑角色</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.role.update',$role->id) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">角色名</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name',$role->name) }}" required>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">描述</label>
                                <input type="text" class="form-control" name="description"  value="{{ old('description',$role->description) }}" required>
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