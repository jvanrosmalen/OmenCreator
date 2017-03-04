<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')
		<div class='container'>
			<div class='row'>
				<div class='col-xs-12'>
					@if($generic_equipment == null)
						<h3>Cre&euml;er Nieuwe Algemene Uitrusting</h3>
					@else
						<h3>Aanpassen Algemene Uitrusting</h3>
					@endif
				</div>
			</div>
		
			@if ($generic_equipment == null)
			<form id="{{ ($generic_equipment!=null?$generic_equipment->id:-1) }}" action="/create_generic_equipment_submit" method="POST">
			@else
			<form id="{{ ($generic_equipment!=null?$generic_equipment->id:-1) }}" action="/create_generic_equipment_update/{{ $generic_equipment->id }}" method="POST">
			@endif

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
 			<ul class="nav nav-tabs">
			  <li class="active"><a id="tab1" data-toggle="tab" href="#base_info">Basis Info</a></li>
			  <li><a id="tab2" data-toggle="tab" href="#optional">Optioneel</a></li>
<!-- 			  <li><a style="cursor:not-allowed" href="#optional">Optioneel</a></li>  -->
			</ul>

			<div class="tab-content">
			  <div id="base_info" class="tab-pane fade in active">
			    <h3>Basis Informatie</h3>
					<div class='row well'>
						<div class='col-xs-2'>Naam:</div>
						<div class='col-xs-3'>
							<input onfocus= "GenericEquipment.hideNameWarning()" onfocusout="GenericEquipment.checkName()" id="generic_equipment_name" type="text" name="generic_equipment_name" style="width: 100%;" value="{{ ($generic_equipment!=null?$generic_equipment->name:'') }}">
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
						
							<textarea name="generic_equipment_desc" class="equipment_desc">{{ ($generic_equipment!=null?$generic_equipment->description:'') }}</textarea>
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
						        			<input type="text" name="price_normal" style="width: 100%;" value="{{ ($generic_equipment!=null?$generic_equipment->price_normal:'') }}">
						        		</td>
						        		<td class="col-xs-4">
						        			<input type="text" name="price_good" style="width: 100%;" value="{{ ($generic_equipment!=null?$generic_equipment->price_good:'') }}">
						        		</td>
						        		<td class="col-xs-4">
						        			<input type="text" name="price_master" style="width: 100%;" value="{{ ($generic_equipment!=null?$generic_equipment->price_master:'') }}">
						        		</td>
						        	</tr>
						        </tbody>					
							</table>
							
						</div>
					</div>
						
					@include('layouts.tab_buttons', array('tab'=>'tab1', 'previous'=>null, 'save'=>false, 'next'=>'tab2'))
				</div>

				<div id="optional" class="tab-pane fade">
					@include('rules.addRulesInclude', array('rules'=>$rules, 'item_rules'=>$item_rules))
					@include('layouts.tab_buttons', array('tab'=>'tab2', 'previous'=>'tab1', 'save'=>true, 'next'=>null))
				</div>
			</div>
			
			</form>
		</div>
			<script>
				GenericEquipmentTabControl.addTabButtonListeners();
			</script>
@stop
</html>