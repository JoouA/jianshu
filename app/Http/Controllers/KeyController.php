<?php

namespace App\Http\Controllers;

use App\Key;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    public function index()
    {
        $keys = Key::paginate(10);
        return view('key',compact('keys'));
    }

    public function iphone()
    {
        return view('iphone');
    }
}
