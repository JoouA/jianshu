<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    protected $fillable = ['name','description'];

    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class,'role_permissions','role_id','permission_id')->withTimestamps();
    }

    public function isPermissionInRole(AdminPermission $permission)
    {
        return (bool)$this->permissions()->where('permission_id',$permission->id)->count();
    }

}
