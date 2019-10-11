<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3>Beheren Spelers: {{ $event->name }}</h3>
		</div>
	</div>

	<div class='row'>
        <div class="col-xs-1">
        </div>
		<div class='col-xs-8'>
			<h4>Deelnemers</h4>
        </div>
        <div class='col-xs-2'>
			<button class="btn btn-default float-right" onClick='ParticipantSelector.openParticipantSelector(event)'>Selecteer Deelnemers</button> 
		</div>
        
	</div>
    <div class="row">
            <div class="col-xs-1">
            </div>
			<div class="col-xs-10">
			    <table id="participants_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
			        <thead>
			            <tr>
			                <th class="col-xs-5">
			                    Karakternaam
			                </th>
			                <th class="col-xs-6">
			                	Spelernaam
                            </th>
			                <th class="col-xs-1">
			                	Actie
			                </th>                            
			            </tr>
			        </thead>
			 
			        <tbody id="selected_participants">
                        @foreach ($characters as $character)
							<?php
							if(in_array($participant_ids, $character->id)){
								echo "<tr id='participant_".$character->id."'>";	
							} else {
								echo "<tr id='participant_".$character->id."' class='hidden'>";
							}
							?>
                                <td class="character_name col-xs-5">
                                    {{ $character->name }}
                                </td>
                                <td class="user_name col-xs-6">
                                    {{ $character->char_user->name }}
                                </td>
                                <td class="user_name col-xs-1">
                                    <button type="button" class="btn btn-xs btn-danger remove-skill-btn" onClick='LarpEvent.removeSelectedParticipant(event);'>
                                        <span class="glyphicon glyphicon-minus" data-id="{{ $character->id }}" ></span> 
                                    </button>
        						</td>
                            </tr>
                        @endforeach
			        </tbody>
			    </table>
		    </div>
		</div>  

		<div class="row button-row">
			<div class="col-xs-3"></div>
			<div class="col-xs-2">
				<form action='larpeventupdateparticipants' method='POST' >
					<input type='hidden' id="selected_participants_list_hidden" name='selected_participants' value="{{$participant_ids_json}}">
					<input type='submit' class="btn btn-default" id="cancel_button" type="button" value="Update Spelers" style="width: 150px; font-size: 18px;">
				</form>
			</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-2">
				<a href="larpeventsshowall" class="btn btn-default" id="cancel_button" type="button"	style="width: 150px; font-size: 18px;">
				Cancel
				</a>
			</div>
		</div>
    
@include('popups.selectParticipant', array('submitMethod'=>'LarpEvent.submitParticipantSelection(event)', 'characters'=>$characters))

@stop
</html>