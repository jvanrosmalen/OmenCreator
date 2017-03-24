<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use Request;
use App\Race;
use Response;

class JsonClassController extends Controller
{
	public function checkClassName(){
		// True means the name already exists.
		// False will be returned when:
		// - the name does not exist
		// - the name is the same as the id of the armor that is checked.
		$name = "";
		$id = 0;
		$retBool = false;
		
		if(Request::has('name')){
			$name = Request::input('name');
		}
		
		if(Request::has('class_id')){
			$id = Request::input('class_id');
		}

		$classs = PlayerClass::where('name', '=', $class_name)->get();

		if(sizeof($classs)>0 && $classs[0]->id != $id){
			$retBool = true;
		}
		
		return Response::json(json_encode($retBool));
	}
}
