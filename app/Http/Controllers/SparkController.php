<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Character;
use App\Race;

class SparkController extends Controller
{
	public function showSparkStart($charId){
		return view('spark/sparkStart', ['charId'=>$charId]);
	}
	
	public function showSparkChose($charId){
		
	}
	
	public function showSparkRandom($charId){
		$sparkRoll = rand(1, 10);
		$sparkIndex = 0;
		
		foreach($this->SPARK_TABLE as $i=>$spark){
			if($sparkRoll <= $spark['end'] && $sparkRoll >= $spark['start']){
				// found it.
				$sparkIndex = $i;
				break;
			}
		}
		
		// For testing
		$sparkIndex = 23;
		
		switch($sparkIndex){
			case 1:
			case 2:
			case 17:
				return view('spark/sparkEntries/sparkEntry'.$sparkIndex);
				break;
			case 14:
				return view('spark/sparkEntries/sparkEntry14',
					['amount'=>rand(1,10)]);
				break;
			case 15:
				return view('spark/sparkEntries/sparkEntry15',
					['resourceString'=> $this->getResourceString(1)]);
				break;
			case 21:
				return view('spark/sparkEntries/sparkEntry21',
					['armorString'=>$this->getDescentArmorString($charId)]);
				break;
			case 23:
				return view('spark/sparkEntries/sparkEntry23',
					['resourceString'=> $this->getResourceString(rand(1,3))]);
				break;
			
			default:
				return view('spark/sparkEntries/sparkEntryTextOnly',
					['sparkIndex'=>$sparkIndex,
					'title'=>$this->SPARK_TABLE[$sparkIndex]['title'],
					'text'=>$this->SPARK_TABLE[$sparkIndex]['text']]);
				break;
		}
	}
	
	private function getResourceString($amount){
		$resourceStrArray = array();
		
		for($x = 0; $x < $amount; $x++){
			$resourceStrArray[] = $this->RESOURCE_TABLE[rand(0, (sizeof($this->RESOURCE_TABLE))-1)];
		}
		
		return join(', ', $resourceStrArray);
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
			'text'=>['Je begint met +1 Trauma punt van een vorige, nare aanvaring. 
					(speler mag zelf kiezen.)',
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
			'text'=>['Je hebt recent nog een herbalistisch brouwsel kunnen kopen / ruilen / stelen.',
					'Je ontvangt 1 Nv1 Herbalisme Brouwsel']
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
					'Je ontvangt 1 Niveau 1 Reliek.']
			],
		20=>['start'=>33,
			'end'=>34,
			'title'=>'Voorouderlijk Anker 1',
			'shortText'=>'Het karakter bezit een klein Anker.',
			'text'=>['Je bent in het bezit van een klein Anker dat ooit van je 
					voorouders geweest is. Het is gebonden aan jouw familie door  
					een Spiritist van lang vervlogen tijden.',
					'Je ontvangt 1 Niveau 1 Anker.']
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
			'text'=>['Er is een foutje opgetreden.']
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
			'text'=>['Er is een foutje opgetreden.']
			],
		27=>['start'=>46,
			'end'=>47,
			'title'=>'Herbalisme 2',
			'shortText'=>'Het karakter begint met een brouwsel.',
			'text'=>['Er is een foutje opgetreden.']
			],
		28=>['start'=>48,
			'end'=>49,
			'title'=>'Gelukkige Inkomsten 4',
			'shortText'=>'Het karakter begint met 4 Zilver extra.',
			'text'=>['Er is een foutje opgetreden.']
			],
		29=>['start'=>50,
			'end'=>50,
			'title'=>'Medium',
			'shortText'=>'Het karakter heeft een verbinding met de geesteswereld.',
			'text'=>['Er is een foutje opgetreden.']
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
			'text'=>['Er is een foutje opgetreden.']
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
			'text'=>['Er is een foutje opgetreden.']
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
			'text'=>['Er is een foutje opgetreden.']
			],
		37=>['start'=>63,
			'end'=>64,
			'title'=>'Voorouderlijk Anker 2',
			'shortText'=>'Het karakter bezit een Anker.',
			'text'=>['Er is een foutje opgetreden.']
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
			'text'=>['Er is een foutje opgetreden.']
			],
		41=>['start'=>70,
			'end'=>70,
			'title'=>'Tot de Tanden Gewapend',
			'shortText'=>'Het karakter bezit een wapen van normale kwaliteit.',
			'text'=>['Er is een foutje opgetreden.']
			],
		42=>['start'=>71,
			'end'=>72,
			'title'=>'Alles al gezien',
			'shortText'=>'Het karakter is niet snel bang.',
			'text'=>['Er is een foutje opgetreden.']
			],
		43=>['start'=>73,
			'end'=>74,
			'title'=>'Alles al meegemaakt',
			'shortText'=>'Het karakter is niet snel van zijn stuk gebracht.',
			'text'=>['Er is een foutje opgetreden.']
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
			'text'=>['Er is een foutje opgetreden.']
			],
		46=>['start'=>78,
			'end'=>79,
			'title'=>'Gelukkige Inkomsten 8',
			'shortText'=>'Het karakter begint met 8 Zilver extra.',
			'text'=>['Er is een foutje opgetreden.']
			],
		47=>['start'=>80,
			'end'=>80,
			'title'=>'Haat',
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
			'text'=>['Er is een foutje opgetreden.']
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
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>85,
			'end'=>85,
			'title'=>'Afkomst specialisatie 1',
			'shortText'=>'Het karakter krijgt +1 afkomstpunt te spenderen.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>86,
			'end'=>86,
			'title'=>'Lady Killer/Jaw Dropper',
			'shortText'=>'Het karakter krijgt +1 Status tegen het andere geslacht.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>87,
			'end'=>87,
			'title'=>'Klein Fortuin',
			'shortText'=>'Het karakter ontvangt +1 Goud.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>88,
			'end'=>88,
			'title'=>'Heilig Reliek 3',
			'shortText'=>'Het karakter bezit een machtig reliek.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>89,
			'end'=>89,
			'title'=>'Voorouderlijk Anker 3',
			'shortText'=>'Het karakter bezit een machtig Anker.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>90,
			'end'=>90,
			'title'=>'Manusje van Alles',
			'shortText'=>'Het karakter mag zelf zijn Afkomst klasse kiezen.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>91,
			'end'=>91,
			'title'=>'Uitzonderlijke Energie 1',
			'shortText'=>'Het karakter krijgt +1 Focus.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>92,
			'end'=>92,
			'title'=>'Uitzonderlijke Ervaring 1',
			'shortText'=>'Het karakter krijgt +1 EP.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>93,
			'end'=>93,
			'title'=>'Uitzonderlijke Gezondheid',
			'shortText'=>'Het karakter krijgt +1 LP.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>94,
			'end'=>94,
			'title'=>'Uitzonderlijke Wilskracht',
			'shortText'=>'Het karakter krijgt +1 Wilskracht.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>95,
			'end'=>95,
			'title'=>'Uitzonderlijke Energie 2',
			'shortText'=>'Het karakter krijgt +2 Focus.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>96,
			'end'=>96,
			'title'=>'Uitzonderlijk Charisma/Leiderschap',
			'shortText'=>'Het karakter krijgt +1 Status.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>97,
			'end'=>97,
			'title'=>'Afkomst Specialisatie 1',
			'shortText'=>'Het karakter krijgt +2 Afkomstpunten.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>98,
			'end'=>98,
			'title'=>'Uitzonderlijke Ervaring 2',
			'shortText'=>'Het karakter krijgt +2 EP.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>99,
			'end'=>99,
			'title'=>'Uitzonderlijke Welvaart',
			'shortText'=>'Het karakter is rijker dan normaal.',
			'text'=>['Er is een foutje opgetreden.']
			],
		52=>['start'=>100,
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
