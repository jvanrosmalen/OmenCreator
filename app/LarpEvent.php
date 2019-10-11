<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LarpEvent extends Model
{
    public $timestamps = false; 

    protected $appends = [ 'participants' ];

    public function participants(){
        return $this->belongsToMany('App\Character');
    }

    public function getParticipantsAttribute(){
        return Character::find($this->id)
                            ->participants()
                            ->select(['id','name', 'char_user'])
                            ->orderBy('name')
                            ->get();
    }
}
