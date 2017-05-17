<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Character;

class EpAssignment extends Model
{
    public function character(){
    	return $this->belongsTo("App\Character");
	}
}
