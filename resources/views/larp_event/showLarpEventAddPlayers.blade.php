<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h3>Toevoegen Spelers: {{ $event->name }}</h3>
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
			 
			        <tbody id="participants">
                        @foreach ($characters as $character)
                            <tr id="participant_{{ $character->id }}" class="hidden">
                                <td class="character_name col-xs-5">
                                    {{ $character->name }}
                                </td>
                                <td class="user_name col-xs-6">
                                    {{ $character->char_user->name }}
                                </td>
                                <td class="user_name col-xs-1">
                                    <button type="button" class="btn btn-xs btn-danger remove-skill-btn" value-id="{{ $character->id }}" onClick='LarpEvent.removeSelectedParticipant(event);'>
                                        <span class="glyphicon glyphicon-minus"></span> 
                                    </button>
        						</td>
                            </tr>
                        @endforeach
			        </tbody>
			    </table>
		    </div>
		</div>  

	<div class="row">
		<div class="row button-row">
			<div class="col-xs-2 col-xs-offset-5">
				<a href="{{ url('/larpeventsshowall') }}" class="btn btn-success"
					type="button"
					style="width: 100%; font-size: 18px;">Event Overzicht</a>
			</div>
		</div>
    </div>
    
@include('popups.selectParticipant', array('submitMethod'=>'LarpEvent.submitParticipantSelection(event)', 'characters'=>$characters))

@stop
</html>