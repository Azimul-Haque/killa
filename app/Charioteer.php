<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charioteer extends Model
{
    public $timestamps = false;

    public function setCreatedAtAttribute($value) { 
        $this->attributes['created_at'] = \Carbon\Carbon::now(); 
    }
}
