<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SkillGroup;
use App\PlayerClass;

class SkillGroupController extends Controller
{
    public function showAll(){
    	$skillGroups = SkillGroup::all()->sortBy(function($skillGroup)
		{
			return sprintf('%-30s', $skillGroup->name );
		});
    	
    	return view('/skill/showallskillgroups',
    			[
    					"skillgroups"=>$skillGroups
    			]);
	}
	
	public function showCreateSkillGroup($id = -1){
		if($id < 0){
			// this is a create. Not an update
			return view('skill/createSkillGroup',
					[
						"skillgroup"=>null,
						"playerclasses"=>PlayerClass::all()
					]);
		} else {
			// This is an update
			return view('skill/createSkillGroup',
					[
						"skillgroup"=>SkillGroup::find($id),
						"playerclasses"=>PlayerClass::all()
					]);
		}
	}
}
