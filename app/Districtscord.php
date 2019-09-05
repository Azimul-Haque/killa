<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Districtscord extends Model
{
    public function disasterdatas(){
        return $this->belongsToMany('App\Disasterdata');
    }
}
