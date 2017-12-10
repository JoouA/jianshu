<?php

namespace App\Admin\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function index()
    {
        $topics = Topic::paginate(5);
        return view('admin.topic.index',compact('topics'));
    }

    public function create()
    {
        return view('admin.topic.create');
    }

    public function edit(Topic $topic)
    {
        return view('admin.topic.edit',compact('topic'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:topics,name'
        ];
        $this->validate($request,$rules);

        $data = $request->except('_token');

        $topic = Topic::create($data);

        if($topic){
            return redirect()->route('admin.topic.index')->with('success','专题创建成功!');
        }else{
            return back()->withErrors('创建专题失败!');
        }
    }

    public function update(Request $request,Topic $topic)
    {
        $rules = [
            'name' => 'required|unique:topics,name,'.$topic->id
        ];
        $this->validate($request,$rules);

        if($topic->update($request->all())){
            return redirect()->route('admin.topic.index')->with('success','专题更新成功!');
        }else{
            return back()->withErrors('专题更新失败！');
        }
    }

    public function destroy(Topic $topic)
    {
        if($topic->delete()){
            return redirect()->route('admin.topic.index')->with('success','专题删除成功!');
        }else{
            return back()->withErrors('专题删除失败！');
        }
    }
}
