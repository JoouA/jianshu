<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_users';

    protected $fillable = ['name','password','avatar','password','remember_token'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,'user_roles','user_id','role_id')->withTimestamps();
    }

    public function isRoleInUser(AdminRole $role)
    {
        return (bool)$this->roles()->where('role_id',$role->id)->count();
    }
}
