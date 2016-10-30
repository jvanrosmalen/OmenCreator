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
			
 			<form id="createSkillForm" action="/create_submit" method="POST">

<!-- ******************* -->


 			<ul class="nav nav-tabs">
			  <li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis Info</a></li>
			  <li><a id="tab2" data-toggle="tab" href="#craftequipment">Ambachtsuitrusting</a></li>
			  <li><a id="tab3" data-toggle="tab" href="#rules">Regels</a></li>
			  <li><a id="tab4" data-toggle="tab" href="#prereqs">Prereqs</a></li>
			</ul>

			<div class="tab-content">
			  <div id="base_info" class="tab-pane fade in active">
			    <h3>Basis Informatie</h3>
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
									<option value='{{$coin->id}}'>{{$coin->coin}}</option>
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
								@if($playerclass->class_name == "Algemeen")
									<input tabindex="1" type="checkbox" name="playerclass[]" value="{{$playerclass->id}}" checked="checked"><span class="checkbox_text">{{$playerclass->class_name}}</span>
								@else
									<input tabindex="1" type="checkbox" name="playerclass[]" value="{{$playerclass->id}}"><span class="checkbox_text">{{$playerclass->class_name}}</span>
								@endif
							@endforeach
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
				@include('layouts.tab_buttons', array('tab'=>'tab1', 'previous'=>null, 'save'=>false, 'next'=>'tab2'))
			  </div>
			  
			  <div id="craftequipment" class="tab-pane fade">
			    <h3>Ambachtsuitrusting</h3>
				<div id="skill_craft_equipment_selection" class="row well">
					<div class="col-xs-2"></div>
					<div class="col-xs-3">
						<div id="craft_equipment_selected" class="craft_equipment_skill">
						    <table class="table table-condensed table-hover">
						        <tbody id="craft_equipment_options">
						            @foreach ($craftequipments as $craftequipment)
						                <tr class="craft_equipment_selection craft_equipment_selection_{{ $craftequipment->id }} hidden" data-id="{{ $craftequipment->id }}">
						                    <td class="col-xs-3">{{ $craftequipment->name }}</td>
						                </tr>
						            @endforeach
						        </tbody>
						    </table>
						</div>
					</div>
					<div class="col-xs-2 text-center">
						<button type="button" class="btn btn-default craft_equip_select_btn disabled" aria-label="Select Equipment">
							<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
						</button>
						<br>
						<button type="button" class="btn btn-default craft_equip_remove_btn disabled" aria-label="Remove Equipment">
							<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
						</button>
					</div>
					<div class="col-xs-3">
						<div id="craft_equipment_options" class="craft_equipment_skill">
						    <table class="table table-condensed table-hover">
						        <tbody id="craft_equipment_options">
						            @foreach ($craftequipments as $craftequipment)
						                <tr class="craft_equipment_option craft_equipment_option_{{ $craftequipment->id }}" data-id="{{ $craftequipment->id }}">
						                    <td class="col-xs-3">{{ $craftequipment->name }}</td>
						                </tr>
						            @endforeach
						        </tbody>
						    </table>
						</div>
					</div>
					<input id="craft_equipment_list_hidden" name="craft_equipment_list" class="hidden">					
				</div>
				@include('layouts.tab_buttons', array('tab'=>'tab2', 'previous'=>'tab1', 'save'=>false, 'next'=>'tab3'))
			  </div>

				<div id="rules" class="tab-pane fade">
					@include('rules.addRulesInclude', array('rules'=>$rules, 'item_rules'=>$skill_rules))
					@include('layouts.tab_buttons', array('tab'=>'tab3', 'previous'=>'tab2', 'save'=>false, 'next'=>'tab4'))
				</div>
			  
			  <div id="prereqs" class="tab-pane fade">
			    <h3>Prereqs</h3>
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
						<button type="button" class="btn button_set1 btn-default" aria-label="Left Align" onclick = "Create.addSkillPrereq('set1');">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					</div>
					<div class="col-xs-1"><b>OF</b></div>
					<div class="col-xs-3">
						<div id="prereqs_set2" class="skill_prereqs"></div>
					</div>
					<div class="col-xs-1">
						<button type="button" class="btn btn-default button_set2 disabled" aria-label="Left Align" onclick = "Create.addSkillPrereq('set2');">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
					</div>
					
				</div>
				
				<input id="skill_prereqs_set1_list_hidden" name="skill_prereqs_set1_list" class="hidden">
				<input id="skill_prereqs_set2_list_hidden" name="skill_prereqs_set2_list" class="hidden">
				
				@include('layouts.tab_buttons', array('tab'=>'tab4', 'previous'=>'tab3', 'save'=>true, 'next'=>null))
			  </div>
			</div>

<!-- ******************* -->


			</form>
		</div>
		
		@include('popups.createSkillSelector');

		<script>
			createSkillTabControl.addTabButtonListeners();
			createSkillControl.addCreateSkillListeners();
		</script>
		
		@endsection

</html>