<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charioteer extends Model
{
    public $timestamps = ['updated_at'];
    const CREATED_AT = null; //and updated by default null set

    // public function setCreatedAtAttribute($value) { 
    //     $this->attributes['updated_at'] = \Carbon\Carbon::now(); 
    // }
}
