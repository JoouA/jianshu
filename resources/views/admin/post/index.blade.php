@extends('admin.layouts.app')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-10 col-xs-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">文章列表</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>文章标题</th>
                        <th>操作</th>
                    </tr>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}.</td>
                        <td>{!! $post->title !!}</td>
                        <td>
                            <a type="button" class="btn btn-block btn-success post-audit"
                               post-id="{{ $post->id }}" post-action-status="1" >通过</a>
                            <a type="button" class="btn btn-block btn-danger post-audit"
                               post-id="{{ $post->id }}" post-action-status="-1" >拒绝</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection