@extends('layouts.main')
@section('content')
    <div class="col-sm-8 ">
        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: center ;">修改头像</div>
            <div class="panel-body">
                <user-avatar avatar="{{ Auth::user()->avatar }}" csrf_tk="{{ csrf_token() }}"></user-avatar>
            </div>
        </div>
    </div>
@endsection