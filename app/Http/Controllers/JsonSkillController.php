<?php

namespace App\Http\Controllers;

use Request;
use App\Skill;
use DB;

class JsonSkillController extends Controller {
	public function decodeJson() {
		$skills = array();
		
		if(Request::has('levels')){
			$levels_filter = Request::input("levels", []);
			$skills = DB::table('skills')->whereIn('level', $levels_filter)->get();
		}
		
		if(Request::has('classes')){
			$class_filter = Request::input("classes", []);
		}
		
 		echo json_encode($skills);
	}
}
?>