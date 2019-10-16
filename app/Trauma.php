<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Character;

class Trauma extends Model
{
    protected $appends = ['character'];


    public function character(){
    	return $this->belongsTo("App\Character");
    }
    
    public function getCharacterAttribute() {
        return $this->character()->first();
    }
}
