<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerClass extends Model
{
    public $timestamps = false;
    protected $appends = [	'wealth_type'
    ];
    
    public function classRule(){
    	return $this->hasOne('App\ClassRule');
    }
    
    public function skills(){
    	return $this->belongsToMany('App\Skill');
    }
    
    public function prohibitedRaces(){
    	return $this->belongsToMany('App\Race');
    }
    
    public function descentRaces(){
    	return $this->hasMany('App\Race', 'id', 'descent_class');
    }
    
    public function getWealthTypeAttribute(){
    	return WealthType::find($this->wealth_type_id);
    }
}
