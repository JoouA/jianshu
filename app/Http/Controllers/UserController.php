<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function show(User $user){
        //用户信息
        $user = User::find($user->id);

        //文章信息
        $posts = $user->posts()->orderBy('updated_at','desc')->paginate(10);

        return view('user.index',compact('user','posts'));
    }

    public function setting(User $user){
        $provinces = Province::all();
        return view('user.setting',compact('user','provinces'));
    }

    public function store(Request $request){
        $rules = [
            'name' => ['required','min:3',Rule::unique('users')->ignore(Auth::id(),'id')],
            'province' => 'numeric',
            'city' => 'numeric',
        ];
        $this->validate($request,$rules);

        $user_data = [];
        foreach ($request->except('_token') as $key => $value){
            if (!empty($value)){
                $user_data =  array_merge($user_data,[$key=>$value]);
            }
        }

        $user = Auth::user()->update($user_data);

        if($user){
            flash('个人信息更新成功')->success();
            return redirect('/user/'.Auth::id().'/setting');
        }else{
            flash('个人信息更新失败')->error()->important();
            return back()->withInput();
        }
    }

    public function cities(Request $request){
        $provinceID = $request->get('provincialID');
        $province = Province::find($provinceID);
        $cities = $province->cities()->get()->toArray();

        return  \Response::json($cities);

        //echo json_encode($arr);    ajax要返回的是json数据
    }

    public function avatar(){
        return view('user.avatar');
    }

    public function changeAvatar(Request $request){
          $file = $request->file('img');

          $filename = md5(time()).Auth::id().'.'.$file->getClientOriginalExtension();

          $file->move(public_path('avatar'),$filename);

          Auth::user()->avatar = '/avatar/'.$filename;
          Auth::user()->save();
          return ['url' => Auth::user()->avatar];
    }
}
