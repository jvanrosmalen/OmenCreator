<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SkillLevel;
use App\PlayerClass;
use App\Race;
use App\Skill;

class CharacterController extends Controller
{
	public function showCreatePlayerCharacter($id = -1){
		if($id < 0){
			return view('character/createPlayerCharacter', ['character'=>null,
					'skilllevels' => SkillLevel::all(),
					'playerclasses' => PlayerClass::all(),
					'races' => Race::all(),
					'skills' => Skill::all()
			]);
		}	
    }
    
    public function showAllCharacter(){
    	return view('/');
    }
}
