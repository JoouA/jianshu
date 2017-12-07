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

    //用户是否有这个权限
    public function hasPermission(AdminPermission $permission)
    {
        // 先算出这个用户拥有什么role
        // 算出$permission 属于那几个role

        // 拥有当前权限有的role
        $permissionRoles =  $permission->roles;

        // 这个与用户的roles
        $userRoles = $this->roles;

        return (bool)$permissionRoles->intersect($userRoles)->count();
    }
}
