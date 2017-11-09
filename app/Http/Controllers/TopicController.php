<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        $topic = Topic::with('posts')->withCount('posts')->find($topic->id);
        return view('topic.show',compact('topic'));
    }

    public function submit(Topic $topic,Request $request)
    {
        // 当前用户提交过来的post_id
        $post_ids = $request->get('post_ids');  //1 2

        //当前主题的post_id
        $topic_post_id = $topic->posts()->pluck('post_id')->toArray();   // 当前有1 2 3 4 5

        // 添加的数据
        $attach_ids = [];

        if (count($post_ids)>0){
            foreach ($post_ids as $post_id){
                if (!in_array($post_id,$topic_post_id)){
                    $attach_ids[] = $post_id;
                }
            }
        }

//        dd($attach_ids);

        $detach_ids = [];
        // 先得到当前用户已经投递的文章
        $theAuthPostsInTopic = \Auth::user()->posts()->whereIn('id',$topic_post_id)->pluck('id')->toArray();


        if (count($theAuthPostsInTopic) > 0){
            foreach ($theAuthPostsInTopic as $theAuthPostInTopic){
                if (count($post_ids) > 0){
                    if (!in_array($theAuthPostInTopic,$post_ids)){
                        $detach_ids[] = $theAuthPostInTopic;
                    }
                }else{
                    $detach_ids = $theAuthPostsInTopic;
                }
            }
        }


        if (!empty($attach_ids)){
            // 增加
            $topic->posts()->attach($attach_ids);
        }
        if (!empty($detach_ids)){
            //减少
            $topic->posts()->detach($detach_ids);
        }


        // 最后组成一个最终的数据集，用来更新表中的数据


        // 对文章要进行attach和dettach


        return back();
    }

}
