<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
