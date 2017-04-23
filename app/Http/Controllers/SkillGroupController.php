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
	
	public function submitSkillGroupCreate(){
		// Save everything to skill group table
		$newSkillGroup = new SkillGroup();
		$newSkillGroup->name = $_POST["skillgroup_name"];
		$newSkillGroup->desc_short = $_POST["desc_short"];
	
		$newSkillGroup->save();
	
		$skillgroup_id = $newSkillGroup->id;
	
		// Sync skills of skill group
		$skills = json_decode($_POST['skillgroup_skills_list_hidden']);
	
		$newSkillGroup->skills()->sync($skills);
	
		$url = route('skillgroup_showall');
		header("Location:".$url);
		die();
	}
	
	public function updateSkillGroup($id){
		$skillGroup = SkillGroup::find($id);
	
		// Save everything to skillgroup table
		$skillGroup->name = $_POST["skillgroup_name"];
		$skillGroup->desc_short = $_POST["desc_short"];
	
		$skillGroup->save();
	
		// Sync skills of skill group
		$skills = json_decode($_POST['skillgroup_skills_list_hidden']);
	
		$skillGroup->skills()->sync($skills);
	
		$url = route('skillgroup_showall');
		header("Location:".$url);
		die();
	}
}
