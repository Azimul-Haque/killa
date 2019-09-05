<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disdata extends Model
{
    public function districtscords(){
        return $this->belongsToMany('App\Districtscord');
    }

    public function discategory() {
      return $this->belongsTo('App\Discategory');
    }
}
