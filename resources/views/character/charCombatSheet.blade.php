<!DOCTYPE html>
<!-- This is a horrible view. It's way too long and cumbersome.
Unfortunately, DOMPDF can't handle all the handy stuff that the
Blade engine gives, so everything is coded out in HTML.
So good luck... -->

<html lang="en">
	<head>
		<link href="css/char_combatsheet.css" rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class='landscape_a4'>
			<div id='page_1' class='page heavy_outline left_page'>
				<table>
					<tr>
						<td colspan='18' class='heavy_outline height_5_row'>
							<img class="nav_bar_png" src="img/omen.jpg" alt="Omen Logo">
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td colspan='5' class='heavy_top light_bottom heavy_right heavy_left text_left'>
						Speler
						</td>
						<td colspan='13' class='heavy_top light_bottom heavy_right heavy_left text_left'>
						{{$character->char_user->name}}
						</td>
					</tr>
					<tr>
						<td colspan='5' class='light_top light_bottom heavy_right heavy_left text_left'>
						Naam Personage
						</td>
						<td colspan='13' class='light_top light_bottom heavy_right heavy_left text_left'>
						{{$character->name}}
						</td>
					</tr>
					<tr>
						<td colspan='5' class='light_top light_bottom heavy_right heavy_left text_left'>
						Niveau
						</td>
						<td colspan='13' class='light_top light_bottom heavy_right heavy_left text_left'>
						{{$character->char_level}}
						</td>
					</tr>
					<tr>
						<td colspan='5' class='light_top light_bottom heavy_right heavy_left text_left'>
						Afkomst
						</td>
						<td colspan='13' class='light_top light_bottom heavy_right heavy_left text_left'>
						{{$character->char_race->race_name}}
						</td>
					</tr>
					<tr>
						<td colspan='5' class='light_top light_bottom heavy_right heavy_left text_left'>
						Klasse
						</td>
						<td colspan='13' class='light_top light_bottom heavy_right heavy_left text_left'>
						{{$character->getPlayerClassesListString()}}
						</td>
					</tr>
					<tr>
						<td colspan='5' class='light_top light_bottom heavy_right heavy_left text_left'>
						Geloof
						</td>
						<td colspan='13' class='light_top light_bottom heavy_right heavy_left text_left'>
						Nog te implementeren
						</td>
					</tr>
					<tr>
						<td colspan='5' class='light_top light_bottom heavy_right heavy_left text_left'>
						Rijkdom
						</td>
						<td colspan='13' class='light_top light_bottom heavy_right heavy_left text_left'>
						{{$character->wealth_string}}
						</td>
					</tr>
					<tr>
						<td colspan='5' class='light_top heavy_bottom heavy_right heavy_left text_left'>
						Titel
						</td>
						<td colspan='13' class='light_top heavy_bottom heavy_right heavy_left text_left'>
						Nog te implementeren
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<!-- Can't use rowspan due to bug in DOMPDF -->
					<tr>
						<td class='heavy_outline text_centered' colspan='6'>
						Levenspunten
						</td>
						<td class='heavy_outline text_centered' colspan='6'>
						Wilskracht
						</td>
						<td class='heavy_outline text_centered' colspan='6'>
						Status
						</td>
					</tr>
					<tr>
						<td class='height_3_row heavy_outline large_text_centered_heigth_3' colspan='6'>
						{{$character->lp_torso}}/{{$character->lp_limbs}}
						</td>
						<td class='height_3_row heavy_outline large_text_centered_heigth_3' colspan='6'>
						{{$character->willpower}}
						</td>
						<td class='height_3_row heavy_outline large_text_centered_heigth_3' colspan='6'>
						{{$character->status}}
						</td>
					</tr>
					<tr>
						<td class='heavy_outline text_centered' colspan='6'>
						Focus
						</td>
						<td class='heavy_outline text_centered' colspan='6'>
						Trauma
						</td>
						<td class='heavy_outline text_centered' colspan='6'>
						Besteed / Totaal EP
						</td>
					</tr>
					<tr>
						<td class='height_3_row heavy_outline large_text_centered_heigth_3' colspan='6'>
						{{$character->focus}}
						</td>
						<td class='height_3_row heavy_outline large_text_centered_heigth_3' colspan='6'>
						{{$character->trauma}}
						</td>
						<td class='height_3_row heavy_outline large_text_centered_heigth_3' colspan='6'>
						{{$character->getSpentEpAmount()}}/{{$character->getTotalEpAmount()}}
						</td>
					</tr>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Resistenties
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_top light_bottom heavy_right heavy_left dashed text_centered'>
						Angst
						</td>
						<td id='res_trauma_0' class='dashed'>
						</td>
						<td id='res_trauma_1' class='dashed'>
						</td>
						<td id='res_trauma_2' class='dashed'>
						</td>
						<td id='res_trauma_3' class='dashed'>
						</td>
						<td id='res_trauma_4' class='dashed'>
						</td>
						<td id='res_trauma_5' class='dashed'>
						</td>
						<td id='res_trauma_6' class='dashed'>
						</td>
						<td id='res_trauma_7' class='dashed'>
						</td>
						<td id='res_trauma_8' class='dashed'>
						</td>
						<td id='res_trauma_9' class='dashed'>
						</td>
						<td id='res_trauma_10' class='dashed'>
						</td>
						<td id='res_trauma_11' class='dashed'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Diefstal
						</td>
						<td id='res_theft_0' class='dashed'>
						</td>
						<td id='res_theft_1' class='dashed'>
						</td>
						<td id='res_theft_2' class='dashed'>
						</td>
						<td id='res_theft_3' class='dashed'>
						</td>
						<td id='res_theft_4' class='dashed'>
						</td>
						<td id='res_theft_5' class='dashed'>
						</td>
						<td id='res_theft_6' class='dashed'>
						</td>
						<td id='res_theft_7' class='dashed'>
						</td>
						<td id='res_theft_8' class='dashed'>
						</td>
						<td id='res_theft_9' class='dashed'>
						</td>
						<td id='res_theft_10' class='dashed'>
						</td>
						<td id='res_theft_11' class='dashed'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Gif
						</td>
						<td id='res_poison_0' class='dashed'>
						</td>
						<td id='res_poison_1' class='dashed'>
						</td>
						<td id='res_poison_2' class='dashed'>
						</td>
						<td id='res_poison_3' class='dashed'>
						</td>
						<td id='res_poison_4' class='dashed'>
						</td>
						<td id='res_poison_5' class='dashed'>
						</td>
						<td id='res_poison_6' class='dashed'>
						</td>
						<td id='res_poison_7' class='dashed'>
						</td>
						<td id='res_poison_8' class='dashed'>
						</td>
						<td id='res_poison_9' class='dashed'>
						</td>
						<td id='res_poison_10' class='dashed'>
						</td>
						<td id='res_poison_11' class='dashed'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Magie
						</td>
						<td id='res_magic_0' class='dashed'>
						</td>
						<td id='res_magic_1' class='dashed'>
						</td>
						<td id='res_magic_2' class='dashed'>
						</td>
						<td id='res_magic_3' class='dashed'>
						</td>
						<td id='res_magic_4' class='dashed'>
						</td>
						<td id='res_magic_5' class='dashed'>
						</td>
						<td id='res_magic_6' class='dashed'>
						</td>
						<td id='res_magic_7' class='dashed'>
						</td>
						<td id='res_magic_8' class='dashed'>
						</td>
						<td id='res_magic_9' class='dashed'>
						</td>
						<td id='res_magic_10' class='dashed'>
						</td>
						<td id='res_magic_11' class='dashed'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left  text_centered'>
						Trauma
						</td>
						<td id='res_trauma_0' class='dashed'>
						</td>
						<td id='res_trauma_1' class='dashed'>
						</td>
						<td id='res_trauma_2' class='dashed'>
						</td>
						<td id='res_trauma_3' class='dashed'>
						</td>
						<td id='res_trauma_4' class='dashed'>
						</td>
						<td id='res_trauma_5' class='dashed'>
						</td>
						<td id='res_trauma_6' class='dashed'>
						</td>
						<td id='res_trauma_7' class='dashed'>
						</td>
						<td id='res_trauma_8' class='dashed'>
						</td>
						<td id='res_trauma_9' class='dashed'>
						</td>
						<td id='res_trauma_10' class='dashed'>
						</td>
						<td id='res_trauma_11' class='dashed'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_top heavy_bottom heavy_right heavy_left text_centered'>
						Ziekte
						</td>
						<td id='res_disease_0' class='dashed'>
						</td>
						<td id='res_disease_1' class='dashed'>
						</td>
						<td id='res_disease_2' class='dashed'>
						</td>
						<td id='res_disease_3' class='dashed'>
						</td>
						<td id='res_disease_4' class='dashed'>
						</td>
						<td id='res_disease_5' class='dashed'>
						</td>
						<td id='res_disease_6' class='dashed'>
						</td>
						<td id='res_disease_7' class='dashed'>
						</td>
						<td id='res_disease_8' class='dashed'>
						</td>
						<td id='res_disease_9' class='dashed'>
						</td>
						<td id='res_disease_10' class='dashed'>
						</td>
						<td id='res_disease_11' class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
				</table>
			</div>
			
			<div id='page_2' class='page heavy_outline right_page page_break'>
				<table>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Hoofdpantser
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
						<td class='dashed heavy_top light_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur Hoofd
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
						<td class='dashed light_top heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Torsopantser
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur Torso
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td class='heavy_top heavy_bottom heavy_left bold_italic'>
						</td>
						<td colspan='4' class='heavy_top heavy_bottom heavy_right text_centered bold_italic'>
						LP Torso
						</td>
						<td class='heavy_outline text_centered'>
						{{$character->lp_torso}}
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						R Arm Pantser
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur R Arm
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td class='heavy_top heavy_bottom heavy_left bold_italic'>
						</td>
						<td colspan='4' class='heavy_top heavy_bottom heavy_right text_centered bold_italic'>
						LP R Arm
						</td>
						<td class='heavy_outline text_centered'>
						{{$character->lp_limbs}}
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						L Arm Pantser
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur L Arm
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td class='heavy_top heavy_bottom heavy_left bold_italic'>
						</td>
						<td colspan='4' class='heavy_top heavy_bottom heavy_right text_centered bold_italic'>
						LP L Arm
						</td>
						<td class='heavy_outline text_centered'>
						{{$character->lp_limbs}}
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						R Been Pantser
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur R Been
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td class='heavy_top heavy_bottom heavy_left bold_italic'>
						</td>
						<td colspan='4' class='heavy_top heavy_bottom heavy_right text_centered bold_italic'>
						LP R Been
						</td>
						<td class='heavy_outline text_centered'>
						{{$character->lp_limbs}}
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						L Been Pantser
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur L Been
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
						<td class='dashed heavy_top heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td class='heavy_top heavy_bottom heavy_left bold_italic'>
						</td>
						<td colspan='4' class='heavy_top heavy_bottom heavy_right text_centered bold_italic'>
						LP L Been
						</td>
						<td class='heavy_outline text_centered'>
						{{$character->lp_limbs}}
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
				</table>
			</div>

			<div id='page_3' class='page heavy_outline left_page'>
				<table>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Schild
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur Schild
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
						<td class='dashed heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Bufferpunten
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Speciale Effecten
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
					</tr>
					<tr>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Bufferpunten
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Speciale Effecten
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
					</tr>
					<tr>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Bufferpunten
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
						<td class='dashed heavy_top'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
						<td class='dashed light_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Speciale Effecten
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
						<td class='dashed_bottom light_top'>
						</td>
					</tr>
					<tr>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
						<td class='heavy_bottom'>
						</td>
					</tr>
				</table>
			</div>
			
			<div id='page_4' class='page heavy_outline right_page page_break'>
				<table>
					<tr>
						<td colspan='14' class='heavy_outline text_centered'>
						Uitrusting &amp; Bezittingen
						</td>
						<td colspan='4' class='heavy_outline text_centered'>
						Kwaliteit
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='4' class='dashed_bottom heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='14' class='heavy_right'>
						</td>
						<td colspan='4' class='heavy_left'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Periodiek
						</td>
						<td colspan='3' class='heavy_outline text_centered'>
						VR
						</td>
						<td colspan='3' class='heavy_outline text_centered'>
						ZA1
						</td>
						<td colspan='3' class='heavy_outline text_centered'>
						ZA2
						</td>
						<td colspan='3' class='heavy_outline text_centered'>
						ZO
						</td>
					</tr>
					<tr>
						<td colspan='6' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom heavy_right'>
						</td>
						<td colspan='3' class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_right'>
						</td>
						<td colspan='3' class='heavy_right'>
						</td>
						<td colspan='3' class='heavy_right'>
						</td>
						<td colspan='3' class='heavy_right'>
						</td>
						<td colspan='3'>
						</td>
					</tr>
					<tr>
						<td class='heavy_top heavy_bottom heavy_left'>
						</td>
						<td colspan='4' class='heavy_top heavy_bottom text_centered'>
						Status
						</td>
						<td class='heavy_outline text_centered'>
						{{$character->status}}
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='heavy_top heavy_bottom heavy_left'>
						</td>
						<td colspan='4' class='heavy_top heavy_bottom text_centered'>
						Focus
						</td>
						<td class='heavy_outline text_centered'>
						{{$character->focus}}
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
						<td class='heavy_top dashed_bottom dashed_left dashed_right'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
				</table>
			</div>			
			
			<div id='page_5' class='page heavy_outline left_page'>
				<table>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Trauma Journaal
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Opgelopen op
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Omen
						</td>
						<td class='heavy_outline'>
						</td>
						<td colspan='5' class='heavy_outline text_centered'>
						Aantal
						</td>
						<td class='heavy_outline'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Hoe?
						</td>
						<td colspan='12' class='dashed_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td colspan='6' class='light_outline text_centered'>
						Genezen door?
						</td>
						<td colspan='12' class='light_bottom text_centered'>
						</td>
					</tr>
					<tr>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
						<td class='dashed'>
						</td>
					</tr>
				</table>
			</div>			
			
			<div id='page_6' class='page heavy_outline right_page page_break'>
				<table>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Opmerkingen, Bevindingen &amp; Andere Zaken
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
						<td class='dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
						<td >
						</td>
					</tr>
				</table>			
			</div>			
			
			<div id='page_7' class='page heavy_outline left_page'>
				<table id='p4_skills'>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Overzicht Vaardigheden
						</td>
					</tr>
					<tr>
						<td id='p4_name_0' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_0' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_1' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_1' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_2' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_2' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_3' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_3' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_4' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_4' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_5' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_5' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_6' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_6' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_7' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_7' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_8' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_8' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_9' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_9' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_10' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_10' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_11' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_11' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_12' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_12' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_13' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_13' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_14' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_14' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_15' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_15' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_16' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_16' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_17' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_17' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_18' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_18' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_19' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_19' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_20' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_20' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_21' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_21' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_22' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_22' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_23' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_23' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_24' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_24' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_25' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_25' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_26' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_26' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_27' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_27' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p4_name_28' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p4_desc_small_28' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
					</tr>					
				</table>
			</div>
			
			<div id='page_8' class='page heavy_outline right_page'>
				<table id='p5_skills'>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Overzicht Vaardigheden
						</td>
					</tr>
					<tr>
						<td id='p5_name_0' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_0' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_1' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_1' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_2' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_2' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_3' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_3' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_4' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_4' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_5' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_5' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_6' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_6' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_7' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_7' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_8' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_8' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_9' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_9' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_10' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_10' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_11' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_11' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_12' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_12' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_13' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_13' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_14' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_14' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_15' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_15' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_16' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_16' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_17' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_17' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_18' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_18' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_19' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_19' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_20' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_20' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_21' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_21' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_22' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_22' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_23' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_23' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_24' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_24' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_25' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_25' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_26' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_26' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_27' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_27' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td id='p5_name_28' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
						</td>
						<td id='p5_desc_small_28' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
						</td>
					</tr>
					<tr>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom clear_right clear_left'>
						</td>
					</tr>					
				</table>
			</div>
		</div>
	</body>
</html>