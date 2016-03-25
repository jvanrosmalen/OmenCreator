<?php

namespace App\Http\Controllers;


use App\Coin;
use App\PlayerClass;
use App\Statistic;
use App\SkillLevel;
use App\Skill;


use App\Player;

class PlayerController extends Controller
{
	public function all(){
		return view('player/all', [ "players"=>Player::all() ]);
	}


	public function create(){

		$params = [
			"coins"=>Coin::all(),
			"playerclasses"=>PlayerClass::all(),
			"stats"=>Statistic::all(),
			"levels"=>SkillLevel::all(),
		];

		return view('player/create', $params);

	}

//	public function submitCreate(){
//		//Valide post
//
//		$player = new Player;
//		$player->name = $_POST["name"];
//		$player->status = $_POST["status"];
//		$player->focus = $_POST["focus"];
//		$player->experience = $_POST["experience"];
//		$player->ras = $_POST["ras"];
//
//		return $this->showAll();
//	}
}
?>
