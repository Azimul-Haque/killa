<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charioteer extends Model
{
    public $timestamps = ['updated_at'];

    // public function setCreatedAtAttribute($value) { 
    //     $this->attributes['updated_at'] = \Carbon\Carbon::now(); 
    // }
}
