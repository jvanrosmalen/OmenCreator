<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="{{ URL::asset('css/char_combatsheet.css') }}" rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class='landscape_a4'>
			<div class='page heavy_outline left_page'>
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
			<div class='page heavy_outline right_page'>
				Right page
			</div>
		</div>
	</body>
</html>