<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $messages = \Auth::user()->notifications()->get();

        \Auth::user()->unreadNotifications->markAsRead();

        return view('notice.index',compact('messages'));
    }
}
