<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable = ['name'];

    public function posts(){
        return $this->belongsToMany('App\Post','post_topics','topic_id','post_id')->withTimestamps();
    }

    public function hasPost($pid){
        return (bool)$this->posts()->where('post_id',$pid)->count();
    }

}
