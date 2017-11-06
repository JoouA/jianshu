<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title','content','user_id'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function commits(){
        return $this->hasMany('App\Commit','post_id','id');
    }
}
