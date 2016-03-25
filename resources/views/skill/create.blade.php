<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')
	

		<div class='container'>
			<div class='row'>
				<div class='col-xs-12'>
					<h1>Cre&euml;er Nieuwe Vaardigheid</h1>
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
					 			
					<div class='col-xs-1'>
						Kosten:
					</div>
					<div class='col-xs-1'>
						<input type="number" name="ep_cost" min="1" max="6" value='1'> EP
					</div> 
					
					<div class='col-xs-1'>
						Klasse:
					</div>	
					<div>
						<div class='col-xs-1'>
						<select name='player_class'>
							@foreach($playerclasses as $playerclass)
								<option value='{{$playerclass->id}}'>{{$playerclass->class_name}}</option>
							@endforeach
						</select>
					</div>					</div>
					
					<div class='col-xs-1'>
						Niveau:
					</div>
					<div class='col-xs-1'>
						<select name='skill_level'>
							@foreach($levels as $level)
								<option value='{{$level->id}}'>{{$level->skill_level}}</option>
							@endforeach
						</select>
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
						<input type='number' name='profile_amount' min='0' max='20' value='0' style="width: 40px;">
						<select name='profile_type'>
							@foreach($stats as $stat)
								<option value='{{$stat->id}}'>{{$stat->statistic_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				
				<div class="row well">
					<div class="col-xs-2">Vaardigheid prereq:</div>
					<div class="col-xs-3">
						<div class="skill_prereqs prereqs_set1"></div>
					</div>
					<div class="col-xs-1">
						<button type="button button_set1" class="btn btn-default" aria-label="Left Align" onclick = "Create.addSkillPrereq(1);">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					</div>
					<div class="col-xs-1"><b>OF</b></div>
					<div class="col-xs-3">
						<div class="skill_prereqs prereqs_set2"></div>
					</div>
					<div class="col-xs-1">
						<button type="button button_set2" class="btn btn-default" aria-label="Left Align">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					</div>
					
				</div>
				
				<div class="row well">
					<div class="row">
						<div class= "col-xs-2">
							Inkomsten:
						</div>
						<div class="col-xs-2">
							<input type="number" name="income_amount" min="0" value='0' style="width: 40px;">
							<select name='income_type'>
								@foreach($coins as $coin)
									<option value='{{$coin->id}}'>{{$coin->coin_name}}</option>
								@endforeach
							</select>
						</div>
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