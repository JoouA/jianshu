<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provincials';

    protected $primaryKey = 'provincialID';

    public function cities(){
        return $this->hasMany('App\City','provincialID','provincialID');
    }
}
