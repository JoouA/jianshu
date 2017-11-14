<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use function foo\func;

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

            $content->header('header');
            $content->description('description');

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
            $grid->created_at('创建时间');
            $grid->updated_at('最后修改时间');

            $grid->filter(function ($filter){
                //设置created_at字段的查询范围
                $filter->between('created_at','Created Time')->datetime();
            });

            $grid->actions(function ($actions){
                // append
                $actions->prepend('<a href="/admin/users/'.$actions->row->id.'"><i class="fa fa-eye"></i></a>');
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

            $form->display('id', 'ID');
            $form->text('name','用户名')->rules('required|max:20');
            $form->email('email','邮箱')->rules('required');
            $form->password('password','密码')->rules('required|min:6|max:16');
            $form->image('avatar','头像');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
