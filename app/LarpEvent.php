<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LarpEvent extends Model
{
    public $timestamps = false; 

    protected $appends = [ 'characters' ];

    public function characters(){
        return $this->belongsToMany('App\Character');
    }

    public function getCharactersAttribute(){
        return Character::find($this->id)
                            ->characters()
                            ->select(['id','name', 'char_user'])
                            ->orderBy('name')
                            ->get();
    }
}
