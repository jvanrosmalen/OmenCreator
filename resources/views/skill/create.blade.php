<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')
	

		<div class='container'>
			<div class='row'>
				<div class='col-xs-12'>
					<h3>Cre&euml;er Nieuwe Vaardigheid</h3>
				</div>
			</div>
			
 			<form action="/create_submit" method="POST">
				<div class='row well'>
					<div class='col-xs-2'>
						Naam:
					</div>
					<div class='col-xs-3'>
						<input type="text" name="skill_name" style="width: 100%;">
					</div>
					
					<div class='col-xs-7'> 			
						<div class='col-xs-1'>
							Kosten:
						</div>
						<div class='col-xs-2'>
							<input type="number" name="ep_cost" min="1" max="6" value='1'> EP
						</div> 
	
						<div class= "col-xs-2">
							Inkomsten:
						</div>
						<div class="col-xs-3">
							<input type="number" name="income_amount" min="0" value='0' style="width: 40px;">
							<select name='income_type'>
								@foreach($coins as $coin)
									<option value='{{$coin->id}}'>{{$coin->coin_name}}</option>
								@endforeach
							</select>
						</div>
											
						<div class='col-xs-1'>Niveau:</div>
						<div class='col-xs-3'>
							<select name='skill_level'>
								@foreach($levels as $level)
									<option value='{{$level->id}}'>{{$level->skill_level}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				
				<div class="row well">
					<div class="row">
						<div class='col-xs-2'>
							Klasse:
						</div>	
						<div class='col-xs-10'>
							@foreach($playerclasses as $playerclass)
									<input tabindex="1" type="checkbox" name="playerclass[]" value="{{$playerclass->id}}"><span class="checkbox_text">{{$playerclass->class_name}}</span>
							@endforeach
							
<!-- 								$friends_checked = Input::get('friend'); -->
<!-- if(is_array($friends_checked)) -->
<!-- { -->
<!--    // do stuff with checked friends -->
<!-- } -->								
						</div>
					</div>
					
					<div class="row">
						<div class='col-xs-2'>
							Afkomst:
						</div>
						<div class='col-xs-10'>
							@foreach($playerraces as $playerrace)
									<input tabindex="1" type="checkbox" name="playerrace[]" value="{{$playerrace->id}}"><span class="checkbox_text">{{$playerrace->race_name}}</span>
							@endforeach
						</div>
					</div>
				</div>
				
				<div class="row well">
					<div class="row">
						<div class="col-xs-2">Korte beschrijving:</div>
						<div class="col-xs-10">
							<input type="text" name="desc_short" maxlength="255" style="width: 100%;">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-2">Lange beschrijving:</div>
						<div class="col-xs-10">
							<script type="text/javascript" src="js/nicedit/nicEdit.js"></script>
							<script type="text/javascript">
								bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
							</script>
						
							<textarea name="desc_long" class="desc_long"></textarea>
						</div>
					</div>
				</div>

				<div class="row well">
					<div class="col-xs-2">Profiel prereq:</div>
					<div class="col-xs-3">
						<input type='number' name='profile_prereq_amount' min='0' max='20' value='0' style="width: 40px;">
						<select name='profile_prereq'>
							@foreach($stats as $stat)
								<option value='{{$stat->id}}'>{{$stat->statistic_name}}</option>
							@endforeach
						</select>
					</div>
					
					<div class="col-xs-2">Profiel bonus:</div>
					<div class="col-xs-2">
						<input type='number' name='profile_bonus_amount' min='0' max='20' value='0' style="width: 40px;">
						<select name='profile_bonus'>
							@foreach($stats as $stat)
								<option value='{{$stat->id}}'>{{$stat->statistic_name}}</option>
							@endforeach
						</select>
					</div>
					
					<div class="col-xs-3">
						<input tabindex="1" type="checkbox" name="mentor"><span class="checkbox_text">Mentor Vereist</span>
					</div>
				</div>
				
				<div class="row well">
					<div class="col-xs-2">Vaardigheid prereq:</div>
					<div class="col-xs-3">
						<div id="prereqs_set1" class="skill_prereqs"></div>
					</div>
					<div class="col-xs-1">
						<button type="button button_set1" class="btn btn-default" aria-label="Left Align" onclick = "Create.addSkillPrereq('set1');">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					</div>
					<div class="col-xs-1"><b>OF</b></div>
					<div class="col-xs-3">
						<div id="prereqs_set2" class="skill_prereqs"></div>
					</div>
					<div class="col-xs-1">
						<button type="button button_set2" class="btn btn-default disabled" aria-label="Left Align">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					</div>
					
				</div>
				
				
				<div class="row">
					<div class="col-xs-2">
					</div>
					<div class="col-xs-1">
						<input type="submit" value="Cre&euml;er" style="width: 80px; font-size:18px;">
					</div>
				</div>
			</form>
		</div>
		
		@include('popups.createSkillSelector');
		
		@endsection

</html>