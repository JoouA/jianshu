<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','QQ','phone','weiBo','gitHub','web','city','bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany('App\Post','user_id','id');
    }



    // 当前用户的粉丝（即关注此用户的人）
    public function fans(){
        return $this->hasMany('App\Fan','start_id','id');
    }

    //当前用户关注的人
    public function starts(){
        return $this->hasMany('App\Fan','fan_id','id');
    }


    //某人是否关注我了
    public function is_fan($uid){
         return $this->fans()->where('fan_id',$uid)->count();
    }


    // 我是否关注了某人
    public function is_start($uid){
        return $this->starts()->where('start_id',$uid)->count();
    }

    // 关注某人
    public function doFan($uid){
        // uid 是要关注人的id
        $fan = new Fan();

        $fan->start_id = $uid;

        return $this->satrts()->save($fan);

    }

    //取消关注某人
    public function unFan($uid){
        $fan = new Fan();
        $fan->start_id = $uid;
        return $this->starts()->delete($fan);
    }

    public function likes(){
        return $this->belongsToMany('App\Post','user_posts','user_id','post_id')->withTimestamps();
    }

    public function isPostInLike($pid){
        return  (bool)$this->likes()->where('post_id',$pid)->count();
    }

}
