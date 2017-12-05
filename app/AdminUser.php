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
}
