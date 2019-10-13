<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Character;

class LarpEvent extends Model
{
    public $timestamps = false; 

    protected $appends = [ 'participants' ];

    public function participants(){
        return $this->belongsToMany('App\Character');
    }

    public function getParticipantsAttribute(){
        return LarpEvent::find($this->id)
                            ->participants()
                            ->orderBy('name')
                            ->select(['id', 'name'])
                            ->get();
    }
}
