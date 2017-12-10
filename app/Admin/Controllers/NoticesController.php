<?php

namespace App\Admin\Controllers;

use App\Message;
use App\User;
use App\Notifications\SendMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class NoticesController extends Controller
{
    public function index()
    {
        $messages = Message::paginate(2);
        return view('admin.notice.index',compact('messages'));
    }

    public function create()
    {
        return view('admin.notice.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $message = [
            'title.required' => '通知标题不能为空',
            'content.required' => '通知内容不能为空',
        ];

        $this->validate($request,$rules,$message);


        $message =  Message::create($request->all());

        if($message){
            $users = User::all();
            Notification::send($users,new SendMessage($message));
            return redirect()->route('admin.notice.index')->with('success','通知增加成功!');
        }else{
            return back()->withErrors('通知增加失败!');
        }

    }
}
