<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Character;
use App\Race;
use App\Skill;
use App\EpAssignment;
use App\PlayerClass;

class SparkController extends Controller
{
	public function showSparkStart($charId){
		return view('spark/sparkStart', ['charId'=>$charId]);
	}
	
	public function showSparkChose($charId){
		
	}
	
	public function submitSpark($sparkId){
		// Get data structure for spark
		$sparkArray = Character::getSparkArray();
		
		
		$sparkIndex = $_POST['sparkIndex'];
		$charId = $_POST['charId'];
		$character = Character::find($charId);
		
		$sparkArray['title'] = $this->SPARK_TABLE[$sparkIndex]['title'];
		$sparkArray['text'] = $this->SPARK_TABLE[$sparkIndex]['text'];
		
		switch($sparkIndex){
		case 1:
			$sparkArray['text'] = ["Indien je schade ontvangt van ".$_POST['allergicTo'].
					" ontvang je automatisch de ziekte Allergische Reactie. Deze".
					" zorgt ervoor dat je niet geheeld kan worden met Chirurgie".
					" tot de Allergie met de vaardigheid Menden is weggewerkt"];
			break;
		case 2:
			$sparkArray['text'] = ["Je hebt een uitzinnige angst voor "
					.$_POST['scaredOf'].". Je kan nooit Angst Resistentie gebruiken tegen ".
					"Angstaanvallen van ".$_POST['scaredOf']."."];
			break;
		case 3:
			$sparkArray['money'] = 5;
			break;
		case 4:
			$sparkArray['money'] = 10;
			break;
		case 5:
			$sparkArray['money'] = 5;
			break;
		case 6:
			$sparkArray['money'] = 10;
			break;
		case 11:
			$sparkArray['trauma'] = 1;
			$character->ep_amount = $character->ep_amount + 1; 
			break;
		case 14:
			$sparkArray['money'] = $_POST['amount'];
			$sparkArray['text'] = ["Je hebt een klein beetje zakgeld kunnen opsparen.",
					"Je ontvangt ".$_POST['amount']." Brons "];
			break;
		case 15:
			$sparkArray['text'] = ["Ook al ben je geen handelaar (of net wel),".
			" je hebt ergens in het verleden wat grondstoffen kunnen ruilen of".
			" kopen die je nog bij je hebt.",
			"Je ontvangt 1 grondstof van het type: ".$_POST['resource_string']];
			break;
		case 17:
			$sparkArray['text'] = ["Je bent in het bezit van een ".$_POST['art_choice'].
			" (Niveau 1) van een beginnend artiest."];
			break;
		case 18:
			// Add 1 to Poison and Disease resistance.
			$sparkArray['resistances'][4] = 1;
			$sparkArray['resistances'][6] = 1;
			break;
		case 21:
			$sparkArray['text'] = ["Je bent in het bezit van 1 stuk pantser dat jouw".
			" volk typeert.",
			"Je ontvangt 1 stuk pantser van het type ".$this->getDescentArmorString($charId).
			", van normale kwaliteit."];
			break;
		case 22:
			$sparkArray['money'] = 10;
			break;
		case 23:
		case 39:
			$sparkArray['text'] = ["Ook al ben je geen handelaar (of net wel),".
			" je hebt ergens in het verleden &eacute;&eacute;n of meer grondstoffen ".
			" kunnen ruilen of kopen die je nog bij je hebt.",
			"Je ontvangt 1 grondstof ieder van de types: ".$_POST['resource_string']];
			break;
		case 24:
			$sparkArray['money'] = 20;
			break;
		case 25:
		case 35:
			$sparkArray['text'] = ["Je bent in het bezit van een voorwerp jouw volk typeert.",
			"Je ontvangt een ".$_POST['speciality_string']];
			break;
		case 26:
			$sparkArray['money'] = 30;
			break;
		case 28:
			$sparkArray['money'] = 40;
			break;
		case 30:
			$sparkArray['text'] = json_decode($_POST['tradeToolJson']);
			break;
		case 31:
			$sparkArray['money'] = 50;
			break;
		case 32:
			$sparkArray['text'] = ["Je bent in het bezit van 2 stukken pantser die jouw".
					" volk typeren.",
					"Je ontvangt 2 stukken pantser van het type ".$this->getDescentArmorString($charId).
					", van normale kwaliteit."];
			break;
		case 33:
			$sparkArray['text'] = ["Je bent in het bezit van een ".$_POST['art_choice'].
			" (Niveau 2) van een artiest."];
			break;
		case 34:
			$sparkArray['money'] = 60;
			break;
		case 38:
			$sparkArray['text'] = ["Je bent in het bezit gekomen van een mysterieuze maar".
					" belangrijke brief.",
					"Je ontvangt een ".$_POST["letterString"]];
			break;
		case 40:
			$sparkArray['money'] = 70;
			break;
		case 42:
			// Add one to fear resistance
			$sparkArray['resistances'][1] = 1;
			break;
		case 43:
			// Add one to trauma resistance
			$sparkArray['resistances'][3] = 1;
			break;
		case 44:
			$sparkArray['text'] = ["Je bent in het bezit van 3 stukken pantser die".
					" jouw volk typeren.",
					"Je ontvangt 3 stukken pantser van het type ".$this->getDescentArmorString($charId).
					", van normale kwaliteit.",
					"Deze stukken zijn gratis. Je mag deze 3 stukken inruilen voor ".
					"&eacute;&eacute;n kwaliteit pantserdeel op	een locatie naar keuze.".
					" (Behalve Ranae dan. Die hebben pech.)"];
			break;
		case 46:
			$sparkArray['money'] = 80;
			break;
		case 47:
			$sparkArray['text'] = ["Je koestert een hartsgrondige, diepe haat voor ".$_POST['hatredFor'].".".
					" Je moet deze diepgewortelde haat constant uitspelen en proberen aan te vallen.",
					"Per dag krijg je gratis: &eacute;&eacute;n keer &#39;Krachtslag +1&#39; op ".$_POST['hatredFor']."."];
			break;
		case 48:
			$sparkArray['text'] = ["Je bent in het bezit van een ".$_POST['art_choice'].
			" (Niveau 3) van een ervaren artiest."];
			break;
		case 50:
			// App\User::find(1)->roles()->save($role, ['expires' => $expires]);
			$selectedSkillId = $_POST['selectedSkill'];
			$skills = $character->skills;
			$skillIdArray = array();
			foreach($skills as $skill){
				$skillIdArray[] = $skill->id;
			}
			
			if(in_array($selectedSkillId, $skillIdArray)){
				// skill already taken. Update EP cost in pivot table
				$character->skills()->updateExistingPivot($selectedSkillId, ['purchase_ep_cost'=>0], true);
			}else{
				// new skill
				$character->skills()->save(Skill::find($selectedSkillId),
						['purchase_ep_cost'=> 0,
						'is_descent_skill'=>false
						]);
			}
			$sparkArray['text'] = ["Je ontvangt gratis de kennisvaardigheid &#39;".
					Skill::find($selectedSkillId)->name."&#39;"];
			break;
		case 52:
			$character->descent_ep_amount = $character->descent_ep_amount + 1;
			$character->spark_data = json_encode($sparkArray);
			
			$epAssignment = new EpAssignment();
			$epAssignment->amount = 1;
			$epAssignment->reason = 'Levensvonk: Afkomst Specialisatie 1';
			$epAssignment->character_id = $character->id;
			$epAssignment->save();
			
			$character->save();

			$url = route('show_edit_character', ['charId' => $charId]);
			header("Location:".$url);
			die();
				
			break;
		case 54:
			$sparkArray['money'] = 100;
			break;
		case 57:
			$excludeDescentClassId = $_POST['excludeDescentClassId'];
			$includeDescentClassId = $_POST['includeDescentClassId'];
			$changes = $character->changeDescentClassFromTo($excludeDescentClassId, $includeDescentClassId);
			$sparkArray['text'] = ["Je hebt de afkomstklasse ".
					PlayerClass::find($excludeDescentClassId)->class_name.
					" vervangen door de afkomstklasse ".
					PlayerClass::find($includeDescentClassId)->class_name.
					"."];
			break;
		default:
			break;
		}	
		
		$character->spark_data = json_encode($sparkArray);
		$character->save();
		
		$url = route('show_character', ['charId' => $charId]);
		header("Location:".$url);
		die();
	}
	
	public function showSparkRandom($charId){
		$sparkRoll = rand(1, 100);
		$sparkIndex = 0;
		
		foreach($this->SPARK_TABLE as $i=>$spark){
			if($sparkRoll <= $spark['end'] && $sparkRoll >= $spark['start']){
				// found it.
				$sparkIndex = $i;
				break;
			}
		}
		
		// For testing
		$sparkIndex = 57;
		
		switch($sparkIndex){
			case 1:
			case 2:
			case 17:
			case 33:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
							['sparkIndex'=>$sparkIndex,
							'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
							'charId'=>$charId]);
				break;
			case 14:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'amount'=>rand(1,10),
					'charId'=>$charId]);
				break;
			case 15:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'resourceString'=> $this->getResourceString(1),
					'charId'=>$charId]);
				break;
			case 21:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'armorString'=>$this->getDescentArmorString($charId),
					'charId'=>$charId]);
				break;
			case 23:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'resourceString'=> $this->getResourceString(rand(1,3)),
					'charId'=>$charId]);
				break;
			case 25:
				return view('spark/sparkEntries/sparkEntrySpeciality',
						['sparkIndex'=>$sparkIndex,
						'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
						'specialityString'=> $this->getDescentSpecialityString($charId)." (Niveau 1)",
						'charId'=>$charId]);
				break;
			case 30:
				$text = $this->getToolsOfTradeString(rand(1,10));
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
						['sparkIndex'=>$sparkIndex,
						'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
						'tradeToolJson'=> json_encode($text),
						'text'=>$text,
						'charId'=>$charId]);
				break;
			case 32:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'armorString'=>$this->getDescentArmorString($charId),
					'charId'=>$charId]);
					break;
			case 35:
				return view('spark/sparkEntries/sparkEntrySpeciality',
						['sparkIndex'=>$sparkIndex,
						'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
						'specialityString'=> $this->getDescentSpecialityString($charId)." (Niveau 2)",
						'charId'=>$charId]);
				break;
			case 38:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
						['sparkIndex'=>$sparkIndex,
						'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
						'letterString'=> $this->getMysteriousLetterString(),
						'charId'=>$charId]);
				break;
			case 39:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'resourceString'=> $this->getResourceString(rand(1,3)+2),
					'charId'=>$charId]);
				break;
			case 44:
					return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'armorString'=>$this->getDescentArmorString($charId),
					'charId'=>$charId]);
					break;
			case 47:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
						['sparkIndex'=>$sparkIndex,
						'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
						'charId'=>$charId]);
				break;
			case 50:
				// Get some generic stuff for all the nasty queries hereafter
				$character = Character::find($charId);
				$classIdArray = $character->getPlayerClassesIdArray();
				$charRace = array();
				$charRace[] = $character->char_race->id;
				$charLevel = $character->getCharLevelId();
				
				// Create an array with the race knowledge skills
				// These must be excluded from the char knowledge skills
				// because they were free to begin with.
				$raceKnowSkills = $character
					->charRace()->get()[0]->raceSkills()
					->where('name', 'LIKE', '%kennis%')
					->where('name', '!=', 'Boekenkennis')
					->orderBy('name', 'asc')->get();
				$raceKnowSkillIds = array();
				foreach($raceKnowSkills as $skill){
					$raceKnowSkillIds[] = $skill->id;
				}
				
				// Get all knowledge skills already known, excluding all
				// race knowledge skills.
				$charKnowSkills = $character->skills()
					->where('name', 'LIKE', '%kennis%')
					->where('name', '!=', 'Boekenkennis')
					->whereNotIn('id', $raceKnowSkillIds)
					->orderBy('name', 'asc')->get();

				$charKnowSkillIds = array();
				foreach($charKnowSkills as $skill){
					$charKnowSkillIds[] = $skill->id;
				}
				
				// Get all other knowledge skills that are either class
				// skills, or generic skills, and that are not already in
				// the char knowledge or the race knowledge skills
				$classKnowSkillsDirty = Skill::whereHas('playerClasses',
					function($query) use( $classIdArray){
						$query->whereIn('id', $classIdArray)
						->orWhere('id','=', 1);
					})
					->where(function($query) use ($charRace){
						$query->whereHas('racePrereqs',
								function($q)use($charRace){
									$q->whereIn( 'id', $charRace );})
									->orWhereHas('racePrereqs',
											function($q){
												$q;
											},
									'<', 1);
								}
							)
					->where('skill_level_id','<=',$charLevel)
					->where('name', 'LIKE', '%kennis%')
					->where('name', '!=', 'Boekenkennis')
					->whereNotIn('id', $charKnowSkillIds)
					->whereNotIn('id', $raceKnowSkillIds)
					->orderBy('name', 'asc')->get();
				
				// Now filter out all class knowledge skills for which the
				// character does not meet the skill prereqs
				$classKnowSkills = array();
				foreach($classKnowSkillsDirty as $dirtySkill){
					if($character->hasAllPrereqs($dirtySkill)){
						$classKnowSkills[] = $dirtySkill;
					}
				}
					
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
						['sparkIndex'=>$sparkIndex,
						'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
						'raceKnowSkills'=>$raceKnowSkills,
						'charKnowSkills'=>$charKnowSkills,
						'classKnowSkills'=>$classKnowSkills,
						'charId'=>$charId]);				
				break;
			case 57:
				$character = Character::find($charId);
				$char_descent_classes_ids =
					$character->charRace()->get()[0]->descent_class_ids;
    			$char_descent_classes =
    				PlayerClass::find($char_descent_classes_ids);
    			$char_descent_options =
    				PlayerClass::whereNotIn('id', $char_descent_classes_ids)->
    					where('class_name', '!=', 'Algemeen')->get();
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex,
						['sparkIndex'=>$sparkIndex,
						'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
						'classes'=>PlayerClass::all(),
						'char_descent_classes'=> $char_descent_classes,
						'char_descent_options'=> $char_descent_options,
						'charId'=>$charId]);
				break;
			default:
				return view('spark/sparkEntries/sparkEntryTextOnly',
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'text'=>$this->SPARK_TABLE[$sparkIndex]['text'],
					'charId'=>$charId]);
				break;
		}
	}
	
	private function getResourceString($amount){
		$resourceStrArray = array();
		
		for($x = 0; $x < $amount; $x++){
			$resourceStrArray[] = $this->RESOURCE_TABLE[rand(0, (sizeof($this->RESOURCE_TABLE))-1)];
		}
		
		return join(", ", $resourceStrArray);
	}
	
	private function getDescentArmorString($charId){
		switch(Character::find($charId)->race_id){
			case 1:
				// Mannheimer
				return "Berenbont";
			case 2:
				// Goliad
				return "Robbenleer";
			case 3:
				// Khalier
				return "Khalisch Hertenleer";
			case 4:
				// Bhanda Korr
				return "Beenderpantser";
			case 5:
				// Ranae
				return "Kwaliteit Versterkte Kledij";
			default:
				// unknown
				return "Onbekend ras";
		}
	}
	
	private function getDescentSpecialityString($charId){
		$roll = rand(1,5);
		$text = "error";
		
		switch(Character::find($charId)->race_id){
			case 1:
				// Mannheimer
				switch($roll){
					case 1:
						$text = "Reliek van Hymir";
						break;
					case 2:
						$text = "Ruw mineraal – willekeurig";
						break;
					case 3:
						$text = "Gerechtelijke Volmachtsbrief";
						break;
					case 4:
						$text = "Kanalisatie Kristal";
						break;
					case 5:
						$text = "Anker van Moed (Krijger)";
						break;
				}
				break;
			case 2:
				// Goliad
				switch($roll){
					case 1:
						$text = "Alchemisch Brouwsel";
						break;
					case 2:
						$text = "Reliek van Thallatan";
						break;
					case 3:
						$text = "Handelsbrief – willekeurig Gilde";
						break;
					case 4:
						$text = "Westerland Tatoeage";
						break;
					case 5:
						$text = "Innovatie Mechanisatie";
						break;
				}
				break;
			case 3:
				// Khalier
				switch($roll){
					case 1:
						$text = "Anker van het Woud (Dru&iuml;de)";
						break;
					case 2:
						$text = "Kanalisatie Kristal";
						break;
					case 3:
						$text = "Reliek van Ahl&eacute;nnia";
						break;
					case 4:
						$text = "Herbalisme Brouwsel";
						break;
					case 5:
						$text = "Woudval";
						break;
				}
				break;
			case 4:
				// Bhanda Korr
				switch($roll){
					case 1:
						$text = "Dosis Oorlogsverf";
						break;
					case 2:
						$text = "Beest Anker (Dier)";
						break;
					case 3:
						$text = "Kanalisatie Kristal";
						break;
					case 4:
						$text = "Reliek van Het Beest";
						break;
					case 5:
						$text = "Proviand Mensenvlees";
						break;
				}
				break;
			case 5:
				// Ranae
				switch($roll){
					case 1:
						$text = "Bloed Anker (Spiritist)";
						break;
					case 2:
						$text = "Gestolen Kistje";
						break;
					case 3:
						$text = "Gif";
						break;
					case 4:
						$text = "Schaduw Opdracht";
						break;
					case 5:
						$text = "Reliek van Senestha";
						break;
				}
				break;
			default:
				// unknown
				$text =  "Onbekend ras";
				break;
		}
		
		return $text;
	}
	
	private function getToolsOfTradeString($roll){
		switch($roll){
			case 1:
				return ["Iemand van je familie of goede kennis was".
				" wachter en liet jouw zijn gereedschap na",
				"Je ontvangt een set boeien."];
			case 2:
				return ["Iemand van je familie of goede kennis was".
				" schilder en liet jouw zijn gereedschap na",
				"Je ontvangt verf en penselen."];
			case 3:
				return ["Iemand van je familie of goede kennis was".
				" houtbewerker en liet jouw zijn gereedschap na",
				"Je ontvangt een houtbewerking set."];
			case 4:
				return ["Iemand van je familie of goede kennis was".
				" scribent en liet jouw zijn gereedschap na",
				"Je ontvangt schrijfgerief en ".rand(1,10)." vellen papier."];
			case 5:
				return ["Iemand van je familie of goede kennis was".
				" herbalist en liet jouw zijn gereedschap na",
				"Je ontvangt een meng set en ".rand(1,3)." glazen flesjes."];
			case 6:
				return ["Iemand van je familie of goede kennis was".
				" beul en liet jouw zijn gereedschap na",
				"Je ontvangt folter werktuigen."];
			case 7:
				return ["Iemand van je familie of goede kennis was".
				" leerlooier en liet jouw zijn gereedschap na",
				"Je ontvangt een leder set ".rand(1,3)." vellen leer."];
			case 8:
				return ["Iemand van je familie of goede kennis was".
				" smid en liet jouw zijn gereedschap na",
				"Je ontvangt smeedtuigen en ".rand(1,3)." ijzer erts."];
			case 9:
				return ["Iemand van je familie of goede kennis was".
				" chirurgijn en liet jouw zijn gereedschap na",
				"Je ontvangt een dokterstas en ".rand(1,3)." verband."];
			case 10:
				return ["Iemand van je familie of goede kennis was".
				" diek en liet jouw zijn gereedschap na",
				"Je ontvangt een krakers set."];
		} 
	}
	
	private function getMysteriousLetterString(){
		$roll = rand(1,5);
		
		switch($roll){
			case 1:
				return "Vervalste Adelbrief";
			case 2:
				return "Moordopdracht";
			case 3: 
				return "Handelsbrief (willekeurig gilde)";
			case 4:
				return "Landkaart met X ergens aangeduid";
			case 5:
				return "Toelatingsbrief Universiteit (andere naam)";
			default:
				return "error";
		}
	}
	
	// The Spark tabel is immutable. Also: the variety of actions to be taken for each
	// entry would make a complete database model of this tabel unwieldy and overly
	// complicated.
	// Therefore it is coded here in its entirety.
	private $SPARK_TABLE = [
		0 =>['start'=>1,
			'end'=>1,
			'title'=>'Trollen Aantrekking',
			'shortText'=>'Het karakter is onweerstaanbaar voor trollen.',
			'text'=>["Niemand kan het verklaren, zelf weet je niet waarom maar je bent
					 onweerstaanbaar voor Trollen. De monsters laten zelfs makkelijkere
					  prooien liggen en gaat toch achter jou aan.",
					  "Dit heeft verder speltechnisch geen effect voor jou. Pas goed
					   op want Trollen krijgen een speciale briefing ivm dit personage."
					]
			],
		1 =>['start'=>2,
			'end'=>2,
			'title'=>'Allergische reactie',
			'shortText'=>'Het karakter is allergisch aan schade van een bepaalde bron.',
			'text'=>['Er is een foutje opgetreden.']
			],
		2 =>['start'=>3,
			'end'=>3,
			'title'=>'Phobia',
			'shortText'=>'Het karakter heeft een uitzinnige angst voor bepaalde wezens.',
			'text'=>['Er is een foutje opgetreden.']
			],
		3 =>['start'=>4,
			'end'=>5,
			'title'=>'Vergiftigd 1',
			'shortText'=>'Het karakter begint het spel onder invloed van een licht gif.',
			'text'=>['Je bent gebeten, gestoken of had nooit van die Ranae een drankje mogen aannemen.
				 Je begint het spel onder invloed van een Niveau 2 Gif.',
				'Koppig heb je wel op dokterskosten bespaart: Je ontvangt 5 Brons.']
			],
		4 =>['start'=>6,
			'end'=>6,
			'title'=>'Vergiftigd 2',
			'shortText'=>'Het karakter begint het spel onder invloed van een gif.',
			'text'=>['Je bent gebeten, gestoken of had nooit van die Ranae een drankje mogen aannemen.
				 Je begint het spel onder invloed van een Niveau 2 Gif.',
				'Koppig heb je wel op dokterskosten bespaart: Je ontvangt 1 Zilver.']
			],
		5 =>['start'=>7,
			'end'=>8,
			'title'=>'Ziek 1',
			'shortText'=>'Het karakter begint het spel onder invloed van een lichte ziekte.',
			'text'=>['Tijdens je reizen heb je een vervelende ziekte opgelopen.
				 Je begint het spel onder invloed van een Niveau 1 Ziekte.',
				'Koppig heb je wel op dokterskosten bespaart: Je ontvangt 5 Brons.']
			],
		6 =>['start'=>9,
			'end'=>9,
			'title'=>'Ziek 2',
			'shortText'=>'Het karakter begint het spel onder invloed van een ziekte.',
			'text'=>['Tijdens je reizen heb je een vervelende ziekte opgelopen.
				 Je begint het spel onder invloed van een Niveau 2 Ziekte.',
				'Koppig heb je wel op dokterskosten bespaart: Je ontvangt 1 Zilver.']
				],
		7 =>['start'=>10,
			'end'=>10,
			'title'=>'Vloek van het Graf',
			'shortText'=>'Het karakter wordt achtervolgd door een kwade geest.',
			'text'=>['Er zit een geest achter je aan en deze is niet vriendelijk. 
					Je weet niet waarom maar op onregelmatige tijdstippen gebeuren
					 er vreemde en gevaarlijke dingen in je buurt.',
					'Je slaapt er niet goed van en diegenen die in jouw gezelschap
					 reizen lopen gevaar.']
			],
		8 =>['start'=>11,
			'end'=>12,
			'title'=>'Vijand/Rivaal 1',
			'shortText'=>'Het karakter heeft een vijand of rivaal.',
			'text'=>['In het verre of recente verleden heb je een rivaal of vijand 
					 gemaakt die tot op deze dag nog in je weg kan lopen.',
					'Spelleiding zal beroep doen op je achtergrond en je  
					informeren wie je vijand(en) zal zijn.']
			],
		9 =>['start'=>13,
			'end'=>14,
			'title'=>'Bestolen!',
			'shortText'=>'Het karakter is bestolen en verliest geld of uitrusting.',
			'text'=>['Je resterende munt is gestolen!  Indien je niets meer over  
					heeft, wordt een stuk aangekochte uitrusting gestolen!!',
					'Gelukkig weet je via via de naam van de dief en kun je hem  
					achterna gaan.']
			],
		10=>['start'=>15,
			'end'=>16,
			'title'=>'Vijand/Rivaal 2',
			'shortText'=>'Het karakter heeft een sterke vijand of rivaal.',
			'text'=>['In het verre of recente verleden heb je een sterke rivaal of vijand 
					 gemaakt die tot op deze dag nog in je weg kan lopen.',
					'Spelleiding zal beroep doen op je achtergrond en je  
					informeren wie je vijand(en) zal zijn.']
			],
		11=>['start'=>17,
			'end'=>18,
			'title'=>'Trauma',
			'shortText'=>'Het karakter begint met een trauma.',
			'text'=>['Je begint met +1 Trauma punt van een vorige, nare aanvaring.'.
					'(speler mag zelf kiezen.)',
					'Je hebt het echter overleefd. Je ontvangt +1 EP.']
			],
		12=>['start'=>19,
			'end'=>19,
			'title'=>'Vijand/Rivaal 3',
			'shortText'=>'Het karakter heeft een machtige vijand of rivaal.',
			'text'=>['In het verre of recente verleden heb je een machtige rivaal of vijand 
					 gemaakt die tot op deze dag nog in je weg kan lopen.',
					'Spelleiding zal beroep doen op je achtergrond en je  
					informeren wie je vijand(en) zal zijn.']
				],
		13=>['start'=>20,
			'end'=>20,
			'title'=>'Orakel Visioenen',
			'shortText'=>'Het karakter krijgt soms visioenen.',
			'text'=>['Niemand kan het verklaren maar heel zelden krijg je een  
					epileptische aanval waarin visioenen ontvangt. Tijdens zo’n 
					aanval kun je niets doen behalve schokken en schuimbekken op 
					de grond.',
					'Spelleiding kan ten allen tijde een orakel inroepen en bepaalt 
					hoe lang het duurt en wat je te zien krijgt']
			],
		14=>['start'=>21,
			'end'=>23,
			'title'=>'Zakgeld',
			'shortText'=>'Het karakter heeft wat brons gespaard.',
			'text'=>['Er is een foutje opgetreden.']
			],
		15=>['start'=>24,
			'end'=>25,
			'title'=>'Grondstoffen 1',
			'shortText'=>'Het karakter begint met een grondstof.',
			'text'=>['Er is een foutje opgetreden.']
			],
		16=>['start'=>26,
			'end'=>27,
			'title'=>'Herbalisme 1',
			'shortText'=>'Het karakter begint met een licht brouwsel.',
			'text'=>['Je hebt recent nog een herbalistisch brouwsel kunnen kopen, ruilen of stelen.',
					'Je ontvangt $eacute;$eacute;n Niveau 1 Herbalisme Brouwsel']
			],
		17=>['start'=>28,
			'end'=>29,
			'title'=>'Po&euml;zie 1',
			'shortText'=>'Het karakter bezit een kort stuk po&euml;zie.',
			'text'=>['Er is een foutje opgetreden.']
			],
		18=>['start'=>30,
			'end'=>30,
			'title'=>'Stalen gestel',
			'shortText'=>'Het karakter heeft een extra stevig gestel.',
			'text'=>['Je natuurlijke resistenties zijn hoger dan bij andere mensen.',
					'Je ontvangt +1 op Gif en Ziekte Resistentie.',
					'Dit telt niet als een vaardigheid!']
			],
		19=>['start'=>31,
			'end'=>32,
			'title'=>'Heilig Reliek 1',
			'shortText'=>'Het karakter bezit een klein reliek.',
			'text'=>['Je bent in het bezit van een klein reliek toegewijd aan jouw geloof.',
					'Je ontvangt een Niveau 1 Reliek.']
			],
		20=>['start'=>33,
			'end'=>34,
			'title'=>'Voorouderlijk Anker 1',
			'shortText'=>'Het karakter bezit een klein Anker.',
			'text'=>['Je bent in het bezit van een klein Anker dat ooit van je 
					voorouders geweest is. Het is gebonden aan jouw familie door  
					een Spiritist van lang vervlogen tijden.',
					'Je ontvangt een Niveau 1 Anker.']
			],
		21=>['start'=>35,
			'end'=>35,
			'title'=>'Afkomst Pantser 1',
			'shortText'=>'Het karakter bezit een stuk pantser.',
			'text'=>['Er is een foutje opgetreden.']
			],
		22=>['start'=>36,
			'end'=>37,
			'title'=>'Gelukkige Inkomsten',
			'shortText'=>'Het karakter begint met 1 Zilver extra.',
			'text'=>['Een gevonden beurs, iets geruild of verkocht, maakt niet  
					uit want je ontvangt +1 Zilver.']
			],
		23=>['start'=>38,
			'end'=>39,
			'title'=>'Grondstoffen 2',
			'shortText'=>'Het karakter begint met &eacute;&eacute;n of meer grondstoffen.',
			'text'=>['Er is een foutje opgetreden.']
			],
		24=>['start'=>40,
			'end'=>41,
			'title'=>'Gelukkige Inkomsten 2',
			'shortText'=>'Het karakter begint met 2 Zilver extra.',
			'text'=>['Een gevonden beurs, iets geruild of verkocht, maakt niet uit ".
					"want je ontvangt +2 Zilver.']
			],
		25=>['start'=>42,
			'end'=>43,
			'title'=>'Afkomst Specialiteit 1',
			'shortText'=>'Het karakter begint met iets typisch voor zijn volk.',
			'text'=>['Er is een foutje opgetreden.']
			],
		26=>['start'=>44,
			'end'=>45,
			'title'=>'Gelukkige Inkomsten 3',
			'shortText'=>'Het karakter begint met 3 Zilver extra.',
			'text'=>['Een gevonden beurs, iets geruild of verkocht, maakt niet uit '.
					'want je ontvangt +3 Zilver.']
				],
		27=>['start'=>46,
			'end'=>47,
			'title'=>'Herbalisme 2',
			'shortText'=>'Het karakter begint met een brouwsel.',
			'text'=>['Je hebt recent nog een herbalistisch brouwsel kunnen kopen, ruilen of stelen.',
					'Je ontvangt &eacute;&eacute;n Niveau 2 Herbalisme Brouwsel']
			],
		28=>['start'=>48,
			'end'=>49,
			'title'=>'Gelukkige Inkomsten 4',
			'shortText'=>'Het karakter begint met 4 Zilver extra.',
			'text'=>['Een gevonden beurs, iets geruild of verkocht, maakt niet uit '.
					'want je ontvangt +4 Zilver.']
			],
		29=>['start'=>50,
			'end'=>50,
			'title'=>'Medium',
			'shortText'=>'Het karakter heeft een verbinding met de geesteswereld.',
			'text'=>['Ook al bezit je geen ‘Geestesoog’, je hebt een uitzonderlijke'.
			' connectie met de wereld der geesten. Geesten vinden het makkelijker'.
			' om interactie naar of via jouw te zoeken, of je het nu wilt of niet.',
			'Dit heeft verder speltechnisch geen effect op jou, Geesten krijgen'.
			' gewoon een speciale briefing omtrent jouw personage.']
			],
		30=>['start'=>51,
			'end'=>52,
			'title'=>'Tools of the Trade',
			'shortText'=>'Het karakter bezit gereedschap van een overleden familielid.',
			'text'=>['Er is een foutje opgetreden.']
			],
		31=>['start'=>53,
			'end'=>54,
			'title'=>'Gelukkige Inkomsten 5',
			'shortText'=>'Het karakter begint met 5 Zilver extra.',
			'text'=>['Een gevonden beurs, iets geruild of verkocht, maakt niet uit '.
					'want je ontvangt +5 Zilver.']
			],
		32=>['start'=>55,
			'end'=>55,
			'title'=>'Afkomst Pantser 2',
			'shortText'=>'Het karakter bezit twee stukken pantser.',
			'text'=>['Er is een foutje opgetreden.']
			],
		33=>['start'=>56,
			'end'=>57,
			'title'=>'Po&euml;zie 2',
			'shortText'=>'Het karakter bezit een stuk po&euml;zie.',
			'text'=>['Er is een foutje opgetreden.']
			],
		34=>['start'=>58,
			'end'=>59,
			'title'=>'Gelukkige Inkomsten 6',
			'shortText'=>'Het karakter begint met 6 Zilver extra.',
			'text'=>['Een gevonden beurs, iets geruild of verkocht, maakt niet uit '.
					'want je ontvangt +6 Zilver.']
				],
		35=>['start'=>60,
			'end'=>60,
			'title'=>'Afkomst Specialiteit 2',
			'shortText'=>'Het karakter begint met iets typisch voor zijn volk.',
			'text'=>['Er is een foutje opgetreden.']
			],
		36=>['start'=>61,
			'end'=>62,
			'title'=>'Heilig Reliek 2',
			'shortText'=>'Het karakter bezit een reliek.',
			'text'=>['Je bent in het bezit van een reliek toegewijd aan jouw geloof.',
					'Je ontvangt een Niveau 2 Reliek.']
			],
		37=>['start'=>63,
			'end'=>64,
			'title'=>'Voorouderlijk Anker 2',
			'shortText'=>'Het karakter bezit een Anker.',
			'text'=>['Je bent in het bezit van een Anker dat ooit van je'.
					' voorouders geweest is. Het is gebonden aan jouw familie door'.
					' een Spiritist van lang vervlogen tijden.',
					'Je ontvangt een Niveau 2 Anker.']
			],
		38=>['start'=>65,
			'end'=>65,
			'title'=>'Mysterieuze Brief',
			'shortText'=>'Het karakter heeft een mysterieuze brief op zak.',
			'text'=>['Er is een foutje opgetreden.']
			],
		39=>['start'=>66,
			'end'=>67,
			'title'=>'Grondstoffen 3',
			'shortText'=>'Het karakter begint met een aantal grondstoffen.',
			'text'=>['Er is een foutje opgetreden.']
			],
		40=>['start'=>68,
			'end'=>69,
			'title'=>'Gelukkige Inkomsten 7',
			'shortText'=>'Het karakter begint met 7 Zilver extra.',
			'text'=>['Een gevonden beurs, iets geruild of verkocht, maakt niet uit '.
					'want je ontvangt +7 Zilver.']
			],
		41=>['start'=>70,
			'end'=>70,
			'title'=>'Tot de Tanden Gewapend',
			'shortText'=>'Het karakter bezit een wapen van normale kwaliteit.',
			'text'=>['Je bezit nog een extra wapen dat ooit van je familie of'.
					' goede kennis is geweest.',
					'Je ontvangt gratis 1 wapen naar keuze van normale kwaliteit.']
			],
		42=>['start'=>71,
			'end'=>72,
			'title'=>'Alles al gezien',
			'shortText'=>'Het karakter is niet snel bang.',
			'text'=>['Je hebt al redelijk wat angstaanjagende taferelen gezien.',
					'Je ontvangt +1 Angst Resistentie. Dit telt niet als een vaardigheid.']
			],
		43=>['start'=>73,
			'end'=>74,
			'title'=>'Alles al meegemaakt',
			'shortText'=>'Het karakter is niet snel van zijn stuk gebracht.',
			'text'=>['Je hebt al in redelijk wat benarde situaties gezeten.',
					'Je ontvangt +1 Trauma Resistentie. Dit telt niet als een vaardigheid.']
			],
		44=>['start'=>75,
			'end'=>75,
			'title'=>'Afkomst Pantser 3',
			'shortText'=>'Het karakter bezit een 3 stukken pantser.',
			'text'=>['Er is een foutje opgetreden.']
			],
		45=>['start'=>76,
			'end'=>77,
			'title'=>'Herbalisme 3',
			'shortText'=>'Het karakter begint met een sterk brouwsel.',
			'text'=>['Je hebt recent nog een herbalistisch brouwsel kunnen kopen, ruilen of stelen.',
					'Je ontvangt &eacute;&eacute;n Niveau 3 Herbalisme Brouwsel']
			],
		46=>['start'=>78,
			'end'=>79,
			'title'=>'Gelukkige Inkomsten 8',
			'shortText'=>'Het karakter begint met 8 Zilver extra.',
			'text'=>['Een gevonden beurs, iets geruild of verkocht, maakt niet uit '.
					'want je ontvangt +8 Zilver.']
			],
		47=>['start'=>80,
			'end'=>80,
			'title'=>'Hartgrondige Haat',
			'shortText'=>'Het karakter haat een bepaald volk of ras.',
			'text'=>['Er is een foutje opgetreden.']
			],
		48=>['start'=>81,
			'end'=>81,
			'title'=>'Po&euml;zie 3',
			'shortText'=>'Het karakter bezit een uitvoerig stuk po&euml;zie.',
			'text'=>['Er is een foutje opgetreden.']
			],
		49=>['start'=>82,
			'end'=>82,
			'title'=>'Bling bling',
			'shortText'=>'Het karakter begint het spel met een juweel.',
			'text'=>['Je bent in het bezit van een mooi juweel dat je ge&euml;rfd,'.
					' gestolen, geruild of gewonnen hebt.',
					'Je ontvangt een willekeurig niveau 1 Juweel ']
			],
		50=>['start'=>83,
			'end'=>83,
			'title'=>'Uitzonderlijke Kennis',
			'shortText'=>'Het karakter heeft een extra kennisvaardigheid.',
			'text'=>['Er is een foutje opgetreden.']
			],
		51=>['start'=>84,
			'end'=>84,
			'title'=>'Kwaliteitsvoorwerp',
			'shortText'=>'Een voorwerp van het karakter is een kwaliteitsvoorwerp.',
			'text'=>['Een door jou aangekocht stuk uitrusting wordt gratis opgewaardeerd naar Kwaliteit.']
			],
		52=>['start'=>85,
			'end'=>85,
			'title'=>'Afkomst specialisatie 1',
			'shortText'=>'Het karakter krijgt +1 afkomstpunt te spenderen.',
			'text'=>['Je ontvangt +1 Afkomstpunt dat je in de Afkomst Klasse mag spenderen.']
			],
		53=>['start'=>86,
			'end'=>86,
			'title'=>'Lady Killer/Jaw Dropper',
			'shortText'=>'Het karakter krijgt +1 Status tegen het andere geslacht.',
			'text'=>['Je ontvangt +1 Status. Deze is niet op je sheet meegenomen in je status score!'.
					' Je mag deze enkel gebruiken in sociale aanvallen / verdedigen tegen het'.
					' andere geslacht.']
			],
		54=>['start'=>87,
			'end'=>87,
			'title'=>'Klein Fortuin',
			'shortText'=>'Het karakter ontvangt +1 Goud.',
			'text'=>['Je ontvangt +1 Goud.']
			],
		55=>['start'=>88,
			'end'=>88,
			'title'=>'Heilig Reliek 3',
			'shortText'=>'Het karakter bezit een machtig reliek.',
			'text'=>['Je bent in het bezit van een machtig reliek toegewijd aan jouw geloof.',
					'Je ontvangt een Niveau 3 Reliek.']
			],
		56=>['start'=>89,
			'end'=>89,
			'title'=>'Voorouderlijk Anker 3',
			'shortText'=>'Het karakter bezit een machtig Anker.',
			'text'=>['Je bent in het bezit van een machtig Anker dat ooit van je'.
					' voorouders geweest is. Het is gebonden aan jouw familie door'.
					' een Spiritist van lang vervlogen tijden.',
					'Je ontvangt een Niveau 3 Anker.']
			],
		57=>['start'=>90,
			'end'=>90,
			'title'=>'Manusje van Alles',
			'shortText'=>'Het karakter mag zelf zijn Afkomst klasse kiezen.',
			'text'=>['Er is een foutje opgetreden.']
			],
		58=>['start'=>91,
			'end'=>91,
			'title'=>'Uitzonderlijke Energie 1',
			'shortText'=>'Het karakter krijgt +1 Focus.',
			'text'=>['Er is een foutje opgetreden.']
			],
		59=>['start'=>92,
			'end'=>92,
			'title'=>'Uitzonderlijke Ervaring 1',
			'shortText'=>'Het karakter krijgt +1 EP.',
			'text'=>['Er is een foutje opgetreden.']
			],
		60=>['start'=>93,
			'end'=>93,
			'title'=>'Uitzonderlijke Gezondheid',
			'shortText'=>'Het karakter krijgt +1 LP.',
			'text'=>['Er is een foutje opgetreden.']
			],
		61=>['start'=>94,
			'end'=>94,
			'title'=>'Uitzonderlijke Wilskracht',
			'shortText'=>'Het karakter krijgt +1 Wilskracht.',
			'text'=>['Er is een foutje opgetreden.']
			],
		62=>['start'=>95,
			'end'=>95,
			'title'=>'Uitzonderlijke Energie 2',
			'shortText'=>'Het karakter krijgt +2 Focus.',
			'text'=>['Er is een foutje opgetreden.']
			],
		63=>['start'=>96,
			'end'=>96,
			'title'=>'Uitzonderlijk Charisma/Leiderschap',
			'shortText'=>'Het karakter krijgt +1 Status.',
			'text'=>['Er is een foutje opgetreden.']
			],
		64=>['start'=>97,
			'end'=>97,
			'title'=>'Afkomst Specialisatie 1',
			'shortText'=>'Het karakter krijgt +2 Afkomstpunten.',
			'text'=>['Er is een foutje opgetreden.']
			],
		65=>['start'=>98,
			'end'=>98,
			'title'=>'Uitzonderlijke Ervaring 2',
			'shortText'=>'Het karakter krijgt +2 EP.',
			'text'=>['Er is een foutje opgetreden.']
			],
		66=>['start'=>99,
			'end'=>99,
			'title'=>'Uitzonderlijke Welvaart',
			'shortText'=>'Het karakter is rijker dan normaal.',
			'text'=>['Er is een foutje opgetreden.']
			],
		67=>['start'=>100,
			'end'=>100,
			'title'=>'Ontwaking!',
			'shortText'=>'Het karakter is geboren met magisch potentieel.',
			'text'=>['Er is een foutje opgetreden.']
			]
	];
	
	private $RESOURCE_TABLE = [
		'Erts', 'Hout', 'Stof', 'Huid', 'Vacht', 'Kruiden', 'Beender'			
	];
}
