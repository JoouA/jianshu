<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $table = 'admin_permissions';

    protected $fillable = ['name','description'];

    //权限属于哪一个角色
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,'role_permissions','permission_id','role_id')->withTimestamps();
    }

}
