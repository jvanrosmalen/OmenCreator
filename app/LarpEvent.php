<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LarpEvent extends Model
{
    public function characters(){
        return $this->belongsToMany('App\Character')->withTimeStamps();
    }
}
