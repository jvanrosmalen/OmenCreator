<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')
		<div class='container'>
			<div class='row'>
				<div class='col-xs-12'>
					@if($craft_equipment == null)
						<h3>Cre&euml;er Nieuwe Ambachtsuitrusting</h3>
					@else
						<h3>Aanpassen Ambachtsuitrusting</h3>
					@endif
				</div>
			</div>
		
			@if ($craft_equipment == null)
			<form id="{{ ($craft_equipment!=null?$craft_equipment->id:-1) }}" action="/create_craft_equipment_submit" method="POST">
			@else
			<form id="{{ ($craft_equipment!=null?$craft_equipment->id:-1) }}" action="/create_craft_equipment_update/{{ $craft_equipment->id }}" method="POST">
			@endif

 			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#base_info">Basis Info</a></li>
			  <li><a data-toggle="tab" href="#optional">Optioneel</a></li>
			</ul>

			<div class="tab-content">
			  <div id="base_info" class="tab-pane fade in active">
			    <h3>Basis Informatie</h3>
			<div class='row well'>
				<div class='col-xs-2'>Naam:</div>
				<div class='col-xs-3'>
					<input onfocus= "Weapon.hideNameWarning()" onfocusout="Weapon.checkName()" id="weapon_name" type="text" name="weapon_name" style="width: 100%;" value="{{ ($craft_equipment!=null?$craft_equipment->name:'') }}">
				</div>
				<div class='col-xs-4 name_warning hidden'>Deze naam bestaat al. Kies een andere.</div>
			</div>
	
			<div class="row well">
				<div class="col-xs-2">Beschrijving:</div>
				<div class="col-xs-7">
					<script type="text/javascript" src="{{ URL::asset('js/nicedit/nicEdit.js') }}"></script>
					<script type="text/javascript">
						bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
					</script>
				
					<textarea name="weapon_desc" class="equipment_desc">{{ ($craft_equipment!=null?$craft_equipment->description:'') }}</textarea>
				</div>
			</div>
	
			<div class="row well">
				<div class="col-xs-2">Prijs (in koperstukken)</div>
				<div class="col-xs-4">
					<table class="table borderless">
				        <thead>
				            <tr>
				                <th>
				                    Normaal
				                </th>
				                <th>
				                	Goed
				                </th>
				                <th>
				                	Meesterlijk
				                </th>
				            </tr>
				        </thead>
				        
				        <tbody>
				        	<tr>
				        		<td class="col-xs-4">
				        			<input type="text" name="price" style="width: 100%;" value="{{ ($craft_equipment!=null?$craft_equipment->price:'') }}">
				        		</td>
				        		<td class="col-xs-4">
				        			Nvt
				        		</td>
				        		<td class="col-xs-4">
				        			Nvt
				        		</td>
				        	</tr>
				        </tbody>					
					</table>
					
				</div>
			</div>
			  </div>
			  <div id="optional" class="tab-pane fade">
			    @include('rules.addRulesInclude', array('rules'=>$rules))
			  </div>
			</div>
			</form>
		</div>
@endsection
</html>