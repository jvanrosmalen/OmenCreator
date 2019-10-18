<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="css/char_combatsheet.css" rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class='landscape_a4'>
			<div id='page_1' class='page heavy_outline left_page'>
				<table>
					<tr>
						<td colspan='18' class='heavy_outline height_2_row'>
<!--							<img class="nav_bar_png" src="img/omen.jpg" alt="Omen Logo"> -->
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
						{{$character->char_faith->faith_name}}
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
						{{$character->title}}
						</td>
					</tr>
					<tr>
					<td colspan='18' class='heavy_outline height_4_row'>
						@php
						$sparkData = json_decode($character->spark_data);
						@endphp
						<strong>Levensvonk - {{$sparkData->title}}:</strong>
						@foreach($sparkData->text as $sparkLine)
							{{$sparkLine}}&nbsp;
						@endforeach
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
						<?php
							for($i = 0; $i < 12; $i++){
								echo "<td class='dashed'>";
								
								if($i < $character->res_fear){
									echo "<div class='res_checkbox'></div>";
								}
							}
						?>
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Diefstal
						</td>
						<?php
							for($i = 0; $i < 12; $i++){
								echo "<td class='dashed'>";
								
								if($i < $character->res_theft){
									echo "<div class='res_checkbox'></div>";
								}
							}
						?>
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Gif
						</td>
						<?php
							for($i = 0; $i < 12; $i++){
								echo "<td class='dashed'>";
								
								if($i < $character->res_poison){
									echo "<div class='res_checkbox'></div>";
								}
							}
						?>
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Magie
						</td>
						<?php
							for($i = 0; $i < 12; $i++){
								echo "<td class='dashed'>";
								
								if($i < $character->res_magic){
									echo "<div class='res_checkbox'></div>";
								}
							}
						?>
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left  text_centered'>
						Trauma
						</td>
						<?php
							for($i = 0; $i < 12; $i++){
								echo "<td class='dashed'>";
								
								if($i < $character->res_trauma){
									echo "<div class='res_checkbox'></div>";
								}
							}
						?>
					</tr>
					<tr>
						<td colspan='6' class='light_top heavy_bottom heavy_right heavy_left text_centered'>
						Ziekte
						</td>
						<?php
							for($i = 0; $i < 12; $i++){
								echo "<td class='dashed'>";
								
								if($i < $character->res_disease){
									echo "<div class='res_checkbox'></div>";
								}
							}
						?>
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
				<?php
					// Create a variable to hold the amount of trauma left to display
					$trauma_count = count($character->getUnhealedTraumaAssignments());
				?>

				<table>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Trauma Journaal
						</td>
					</tr>

					@for($i = 0; $i < 9; $i++)
						@if ($trauma_count > 0)
							<tr>
								<td colspan='6' class='heavy_outline text_centered'>
								Opgelopen op
								</td>
								<td colspan='5' class='heavy_outline text_centered'>
								Omen
								</td>
								<td class='heavy_outline text_centered'>
									{{ $character->getUnhealedTraumaAssignments()[$i]->gotten_on_omen }}
								</td>
								<td colspan='5' class='heavy_outline text_centered'>
								Aantal
								</td>
								<td class='heavy_outline text_centered'>
									{{ $character->getUnhealedTraumaAssignments()[$i]->amount }}
								</td>
							</tr>
							<tr>
								<td colspan='6' class='light_outline text_centered'>
								Hoe?
								</td>
								<td colspan='12' class='dashed_bottom ellipsis text_centered'>
									{{ $character->getUnhealedTraumaAssignments()[$i]->description }}
								</td>
							</tr>
							<tr>
								<td colspan='6' class='light_outline text_centered'>
								Genezen door?
								</td>
								<td colspan='12' class='dashed_bottom text_centered'>
								</td>
							</tr>
							 <?php
							 	$trauma_count--;
							 ?>
						@else
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
						@endif
					@endfor

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
					<?php
						for($rowcount = 0; $rowcount < 30; $rowcount++){
							echo "<tr>";

							for($columncount = 0; $columncount < 18; $columncount++){
								echo "<td class='dashed_bottom'></td>";
							}

							echo "</tr>";
						}
					?>

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

			<?php
				// Create a variable to hold the amount of skills left to display
				$skill_count = count($character->skills);
			?>

			<div id='page_7' class='page heavy_outline left_page'>
				<table id='p4_skills'>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Overzicht Vaardigheden
						</td>
					</tr>

					@for($i = 0; $i < 29; $i++)
						@if ($skill_count > 0)
							<tr>
						 		<td colspan='6' class='span6 ellipsis text_left heavy_left dashed_right dashed_bottom'>
									{{$character->skills[$i]->name}}
						 		</td>
						 		<td colspan='12' class='span12 ellipsis text_left dashed_left heavy_right dashed_bottom'>
								 	{{$character->skills[$i]->description_small}}
						 		</td>
							 </tr>
							 <?php
							 	$skill_count--;
							 ?>
						@else
							<tr>
						 		<td colspan='6' class='span6 ellipsis text_left heavy_left dashed_right dashed_bottom'>
						 		</td>
						 		<td colspan='12' class='span12 ellipsis text_left dashed_left heavy_right dashed_bottom'>
						 		</td>
						 	</tr>
						@endif
					@endfor

					<tr>
						<td class='heavy_bottom clear_right heavy_left'>
						</td>
						<td colspan='16' class='heavy_bottom clear_right clear_left'>
						</td>
						<td class='heavy_bottom heavy_right clear_left'>
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
					@for($i = 29; $i < 58; $i++)
						@if ($skill_count > 0)
							<tr>
						 		<td colspan='6' class='span6 ellipsis text_left heavy_left dashed_right dashed_bottom'>
									{{$character->skills[$i]->name}}
						 		</td>
						 		<td colspan='12' class='span12 ellipsis text_left dashed_left heavy_right dashed_bottom'>
								 	{{$character->skills[$i]->description_small}}
						 		</td>
							 </tr>
							 <?php
							 	$skill_count--;
							 ?>
						@else
							<tr>
						 		<td colspan='6' class='span6 ellipsis text_left heavy_left dashed_right dashed_bottom'>
						 		</td>
						 		<td colspan='12' class='span12 ellipsis text_left dashed_left heavy_right dashed_bottom'>
						 		</td>
						 	</tr>
						@endif
					@endfor			

					<tr>
						<td class='heavy_bottom clear_right heavy_left'>
						</td>
						<td colspan='16' class='heavy_bottom clear_right clear_left'>
							@if($skill_count > 0)
								Je hebt meer vaardigheden dan getoond kunnen.
							@endif
						</td>
						<td class='heavy_bottom heavy_right clear_left'>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
