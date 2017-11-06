<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $primaryKey = 'cityID';

    public function province(){
        return $this->belongsTo('App\Province','provincialID','provincialID');
    }
}
