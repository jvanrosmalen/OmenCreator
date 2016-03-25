<?php

namespace App\Http\Controllers;


use App\Faith;
use App\PlayerClass;
use App\Statistic;
use App\SkillLevel;
use App\Skill;


use App\Player;
use App\Race;

class PlayerController extends Controller
{
	public function all(){
		return view('player/all', [ "players"=>Player::all() ]);
	}


	public function create(){

		$params = [
			"races"=>Race::all(),
			"playerclasses"=>PlayerClass::all(),
			"faiths"=>Faith::all(),
			"skills"=>Skill::all(),
		];

		return view('player/create', $params);

	}

	public function createSubmit(){
		//Valide post

		$player = new Player;
		$player->name = $_POST["player_name"];
		$player->class = $_POST["player_class"];
		$player->race = $_POST["player_race"];
		$player->faith = $_POST["player_faith"];
		$player->save();

		return redirect('player');
	}
}
?>
