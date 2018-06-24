@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">EP Aanpassing Succesvol</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1">
				De toekenning:<br>
			</div>
			<div class="col-xs-10 col-xs-offset-2">
				<div class='row'>
					<table>
						<tr>
							<td class="col-xs-2">
								<?php
								$createDate = new DateTime($ep_assignment->created_at);
								
								$stripped = $createDate->format('Y-m-d');
								?>
								{{$stripped}}
							</td>
							<td class="col-xs-2">
								{{$ep_assignment->amount}}
							</td>
							<td class="col-xs-7">
								{{$ep_assignment->reason}}
							</td>
						<tr>
					</table>
				</div>
			</div>
			<div class="col-xs-10 col-xs-offset-1">
				is succesvol verwijderd uit de EP van <label>{{ $character->name }} (Speler: {{$character->char_user->name}})</label>.
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="row button-row">
			<div class="col-xs-2 col-xs-offset-5">
				<a href="{{ url('/show_character_ep') }}/{{$character->id}}" class="btn btn-default"
					id="cancel_button" type="button"
					style="width: 100%; font-size: 18px;">EP Overzicht</a>
			</div>
		</div>

	</div>
</div>
@endsection
