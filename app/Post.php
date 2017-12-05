<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

    protected $table = 'posts';

    protected $fillable = ['title','content','user_id'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function commits(){
        return $this->hasMany('App\Commit','post_id','id');
    }

   /* // 这个文章被人赞的人数
    public function users(){
        return $this->belongsToMany('App\User','zans','post_id','user_id');
    }*/

   public function zan(){
        return $this->hasOne('App\Zan','post_id','id')->where('user_id',Auth::id());
   }

   public function zans(){
        return $this->belongsToMany('App\User','zans','post_id','user_id')->withTimestamps();
//        return $this->hasMany('App\Zan','post_id','id');
   }

   public function zan_exit(){
         // 要加上first 因为$this->zan()获取到的是hasOne的一大堆东西
         // 写法一 (bool)$this->zan；
        // 写法二 (bool)$this->zan()->first()；
        return (bool)$this->zan()->first();
   }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
   public function searchable()
   {
       return 'posts';
   }

    //配置可搜索的数据
   public function toSearchableArray()
   {
       return [
           'title' => $this->title,
           'content' => $this->content,
       ];
   }


}
