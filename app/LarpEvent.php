<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LarpEvent extends Model
{
    public $timestamps = false; 

    public function characters(){
        return $this->belongsToMany('App\Character')->withTimeStamps();
    }
}
