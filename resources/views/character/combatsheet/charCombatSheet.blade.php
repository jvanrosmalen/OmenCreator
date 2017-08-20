<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="{{ URL::asset('css/char_combatsheet.css') }}" rel='stylesheet' type='text/css'>
	    <script src="{{ URL::asset('js/character/charCombatSheet.js') }}"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	</head>
	<body>
		<div class='landscape_a4'>
			<div id='page_1' class='page heavy_outline left_page'>
				<table>
					<tr>
						<td colspan='18' class='heavy_outline height_5_row'>
							<img class="nav_bar_png" src="{{ URL::asset('img/omen.jpg') }}" alt="Omen Creator">
						</td>
					</tr>
					<tr>
						@for($count=0; $count<18; $count++)
							<td class='dashed'>
							</td>
						@endfor
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
						@for($count=0; $count<18; $count++)
							<td class='dashed'>
							</td>
						@endfor
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
						@for($count=0; $count<12; $count++)
							@if($count < $character->res_fear)
								<td class='dashed'>
									<div class='thin_circle'></div>
								</td>
							@else
								<td class='dashed'>
								</td>
							@endif
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Diefstal
						</td>
						@for($count=0; $count<12; $count++)
							@if($count < $character->res_theft)
								<td class='dashed'>
									<div class='thin_circle'></div>
								</td>
							@else
								<td class='dashed'>
								</td>
							@endif
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Gif
						</td>
						@for($count=0; $count<12; $count++)
							@if($count < $character->res_poison)
								<td class='dashed'>
									<div class='thin_circle'></div>
								</td>
							@else
								<td class='dashed'>
								</td>
							@endif
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left text_centered'>
						Magie
						</td>
						@for($count=0; $count<12; $count++)
							@if($count < $character->res_magic)
								<td class='dashed'>
									<div class='thin_circle'></div>
								</td>
							@else
								<td class='dashed'>
								</td>
							@endif
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='light_top light_bottom heavy_right heavy_left  text_centered'>
						Trauma
						</td>
						@for($count=0; $count<12; $count++)
							@if($count < $character->res_trauma)
								<td class='dashed'>
									<div class='thin_circle'></div>
								</td>
							@else
								<td class='dashed'>
								</td>
							@endif
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='light_top heavy_bottom heavy_right heavy_left text_centered'>
						Ziekte
						</td>
						@for($count=0; $count<12; $count++)
							@if($count < $character->res_disease)
								<td class='dashed heavy_bottom'>
									<div class='thin_circle'></div>
								</td>
							@else
								<td class='dashed heavy_bottom'>
								</td>
							@endif
						@endfor
					</tr>
					<tr>
						@for($count=0; $count<18; $count++)
							<td class='dashed'>
							</td>
						@endfor
					</tr>
				</table>
			</div>
			
			<div id='page_2' class='page heavy_outline right_page page_break'>
				<table>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Hoofdpantser
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top light_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur Hoofd
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed light_top heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Torsopantser
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur Torso
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
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
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						R Arm Pantser
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur R Arm
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top heavy_bottom'>
							</td>
						@endfor
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
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						L Arm Pantser
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur L Arm
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top heavy_bottom'>
							</td>
						@endfor
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
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						R Been Pantser
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur R Been
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top heavy_bottom'>
							</td>
						@endfor
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
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						L Been Pantser
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur L Been
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top heavy_bottom'>
							</td>
						@endfor
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
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
				</table>
			</div>

			<div id='page_3' class='page heavy_outline left_page'>
				<table>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Schild
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					@for($index = 0; $index < 5; $index++)
						<tr>
							@for($count = 0; $count<18; $count++)
								<td class='dashed'>
								</td>
							@endfor
						</tr>
					@endfor
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					<tr>
						<td colspan='6' class='heavy_outline text_centered'>
						Structuur Schild
						</td>
						@for($count = 0; $count<12; $count++)
							<td class='dashed heavy_top'>
							</td>
						@endfor
					</tr>
					@for($index = 0; $index < 3; $index++)
						<tr>
							@for($count = 0; $count<18; $count++)
								<td class='dashed'>
								</td>
							@endfor
						</tr>
					@endfor
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='dashed heavy_bottom'>
							</td>
						@endfor
					</tr>
					@for($i=0; $i<3; $i++)
						<tr>
							<td colspan='6' class='heavy_outline text_centered'>
							Bufferpunten
							</td>
							@for($count = 0; $count<12; $count++)
								<td class='dashed heavy_top'>
								</td>
							@endfor
						</tr>
						@for($index = 0; $index < 2; $index++)
							<tr>
								@for($count = 0; $count<18; $count++)
									<td class='dashed'>
									</td>
								@endfor
							</tr>
						@endfor
						<tr>
							@for($count = 0; $count<18; $count++)
								<td class='dashed light_bottom'>
								</td>
							@endfor
						</tr>
						<tr>
							<td colspan='6' class='light_outline text_centered'>
							Speciale Effecten
							</td>
							@for($count = 0; $count<12; $count++)
								<td class='dashed_bottom light_top'>
								</td>
							@endfor
						</tr>
						<tr>
							@for($count = 0; $count<18; $count++)
								<td class='heavy_bottom'>
								</td>
							@endfor
						</tr>
					@endfor
				</table>
			</div>
			
			<div id='page_4' class='page heavy_outline right_page page_break'>
				<table id='p4_skills'>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Overzicht Vaardigheden
						</td>
					</tr>
					@for($count = 0; $count < 29; $count++)
						<tr>
							<td id='p4_name_{{$count}}' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
							</td>
							<td id='p4_desc_small_{{$count}}' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
							</td>
						</tr>
					@endfor
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='heavy_bottom clear_right clear_left'>
							</td>
						@endfor
					</tr>					
				</table>
			</div>
			
			<div id='page_5' class='page heavy_outline left_page'>
				<table id='p5_skills'>
					<tr>
						<td colspan='18' class='heavy_outline text_centered'>
						Overzicht Vaardigheden
						</td>
					</tr>
					@for($count = 0; $count < 29; $count++)
						<tr>
							<td id='p5_name_{{$count}}' colspan='6' class='text_left heavy_left dashed_right dashed_bottom'>
							</td>
							<td id='p5_desc_small_{{$count}}' colspan='12' class='text_left dashed_left heavy_right dashed_bottom'>
							</td>
						</tr>
					@endfor
					<tr>
						@for($count = 0; $count<18; $count++)
							<td class='heavy_bottom clear_right clear_left'>
							</td>
						@endfor
					</tr>					
				</table>
			</div>
		</div>
		<div class='hidden' id="hidden_skills" data-skills="{{$character->skills}}" >
		<script>CharCombatSheet.fillSkillTables();</script>
	</body>
</html>