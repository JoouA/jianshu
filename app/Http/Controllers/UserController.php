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

    // 数据进行存储
    public function store(Request $request){
        $rules = [
            'name' => ['required','min:3',Rule::unique('users')->ignore(Auth::id(),'id')],
            'province' => 'numeric',
            'city' => 'numeric',
//            'phone' => ['sometimes','required','regex:/^1[34578][0-9]{9}$/',Rule::unique('users')->ignore(Auth::id(),'id')],
        ];
        $this->validate($request,$rules);

        // get city name
        $provinceID = $request->get('province');
        $cityID = $request->get('city');
        $provinceName = Province::find($provinceID)->provincialName;
        $cityName = City::find($cityID)->cityName;
        $city = $provinceName.$cityName;

        $user_data = [
            'name' => $request->get('name'),
            'weiBo' => $request->get('weibo'),
            'QQ' => $request->get('QQ'),
            'gitHub' => $request->get('github'),
            'city' => $city,
            'web' => $request->get('site'),
            'phone' => $request->get('phone'),
            'bio' => $request->get('bio'),
        ];


        $user = Auth::user()->update($user_data);

        if($user){
            flash('个人信息更新成功')->success();
            return redirect('/user/'.Auth::id().'/setting');
        }else{
            flash('个人信息更新失败')->error()->important();
            return back()->withErrors()->withInput();
        }
    }

    public function cities(Request $request){
        $provinceID = $request->get('provincialID');
        $province = Province::find($provinceID);
        $cities = $province->cities()->get()->toArray();

        return  \Response::json($cities);

        //echo json_encode($arr);    ajax要返回的是json数据
    }

}
