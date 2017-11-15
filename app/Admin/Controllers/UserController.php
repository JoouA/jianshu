<?php

namespace App\Admin\Controllers;

use App\City;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use DB;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('用户列表');
            $content->description('用户列表');

            $content->body($this->grid());
        });
    }


    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('用户编辑');
            $content->description('用户编辑');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新增用户');
            $content->description('新增用户');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('avatar','头像')->display(function ($avatar){
                return  "<img src='$avatar' class='img-circle' style='width: 30px;height: 30px' alt='avatar' />";
            });
            $grid->name('用户名');
            $grid->email('电子邮箱');
            $grid->column('QQ','QQ');
            $grid->column('gitHub','github');
            $grid->created_at('创建时间');
            $grid->updated_at('最后修改时间');

            $grid->filter(function ($filter){
                //设置created_at字段的查询范围
                $filter->between('created_at','Created Time')->datetime();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {
            $id = \request('user');
            $provinces = \DB::table('provincials')->select('provincialID','provincialName')->get()->toArray();
            $provinces_data = [];

            foreach($provinces as $key => $value){
                $provinces_data[$key+1] = $value->provincialName;
            }

            $form->display('id', 'ID');
            $form->text('name','用户名')->rules('required|max:20');
            $form->email('email','邮箱')->rules('required|unique:user,email');
            $form->password('password','密码')->rules('required|min:6|max:16');
            $form->text('gitHub','github');
            $form->text('QQ','QQ');
            $form->text('weiBo','微博');
            $form->text('phone','手机号码');
            $form->textarea('bio','个人简介');

            if (User::find($id)){
                $form->select('province','省')->options($provinces_data)->default(function() use ($id){
                    $city = User::find($id)->city;
                    $provinceId = City::find($city)->province->provincialID;
                    return $provinceId;
                })->load('city','/admin/city');
                $cityData = [];
                $city = User::find($id)->city;
                $provinceId = City::find($city)->province->provincialID;
                $cities =  City::where('provincialID', $provinceId)->get([DB::raw('cityID as id'), DB::raw('cityName as text')])->toArray();
                foreach ($cities as $key => $city){
                    $cityData[$city['id']] = $city['text'];
                }

                $form->select('city','市')->options($cityData)->default(function()use($id){
                    $cityId = User::find($id)->city;
                    return $cityId;
                });
            }else{
                $form->select('province','省')->options($provinces_data)->load('city','/admin/city');
                $form->select('city','市');
            }
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }


    /**
     * get the city data
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function city(Request $request){

        $provinceId = $request->get('q');

        return City::where('provincialID', $provinceId)->get([DB::raw('cityID as id'), DB::raw('cityName as text')]);

    }
}
