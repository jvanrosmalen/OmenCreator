@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-5">
			<span class="overview_header">EP Overzicht</span>
		</div>
	</div>

	<div class="row"></div>

	<div class="row well">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1"><h4>EP Toekennen</h4></div>
		</div>
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1">Geef hieronder aan hoeveel EP je wil toekennen aan <label>{{ $character->name }} (Speler: {{$character->char_user->name}})</label> en met welke reden.</div>
		</div>
		<br>
		<form action='/do_character_add_ep' method='POST'>
			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
		
			<input name='charId' type='hidden' value='{{$character->id}}'>
		
			<div class='row'>
				<div class='col-xs-2 col-xs-offset-2'>
					<input class='input_number_field' name='ep_amount' type='number' value='3' min='1'>&emsp;EP
				</div>
				<div class='col-xs-4'>
					<input name="ep_reason" style="width: 100%;" placeholder="Reden van EP toekenning" value="">
				</div>
				<div class='col-xs-2'>
					<input type='checkbox' name='event_survived' checked='checked'>&emsp;Event overleefd
				</div>
			</div>
			<br>
			<div class="row">
				<div class="row button-row">
					<div class="col-xs-3 col-xs-offset-4">
						<button type='submit' class="btn btn-default">EP Toekennen</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div class="row">
		<div class='row'>
			<div class="col-xs-8 col-xs-offset-2"><h4>EP Overzicht - ({{$character->getSpentEpAmount()}}/{{$character->getTotalEpAmount()}})</h4></div>
		</div>
		<div class='row'>
			<div class="col-xs-8 col-xs-offset-2">
				<table id="char_ep_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
					<thead>
						<tr>
							<th class="col-xs-2">
								Datum
							</th>
							<th class="col-xs-2">
								Aantal EP
							</th>
							<th class="col-xs-7">
								Beschrijving
							</th>
							<th class="col-xs-1">
								Actie
							</th>
						</tr>
					</thead>
					<tbody>
						<?php $first = true;?>
						@foreach($character->ep_assignments as $assignment)
							@if($first)
								<tr id="{{ $assignment->id }}">
									<td id="{{$assignment->id}}" class="col-xs-2">
										<?php
										$first = false;
										$createDate = new DateTime($assignment->created_at);
										$stripped = $createDate->format('Y-m-d');
										?>
										{{$stripped}}
									</td>
									<td class="col-xs-2">
										{{$assignment->amount}}
									</td>
									<td class="col-xs-7">
										{{$assignment->reason}}
									</td>
									<td class="col-xs-1">
																				
									</td>
								</tr>
								<tr id="{{ $assignment->id }}">
									<td id="{{$assignment->id}}" class="col-xs-2">
										{{$stripped}}
									</td>
									<td class="col-xs-2">
										{{$character->descent_ep_amount}}
									</td>
									<td class="col-xs-7">
										Afkomst EP
									</td>
									<td class="col-xs-1">
									</td>
								</tr>
							@else
								<tr id="{{ $assignment->id }}">
									<td id="{{$assignment->id}}" class="col-xs-2">
										<?php
										$createDate = new DateTime($assignment->created_at);
										
										$stripped = $createDate->format('Y-m-d');
										?>
										{{$stripped}}
									</td>
									<td class="col-xs-2">
										{{$assignment->amount}}
									</td>
									<td class="col-xs-7">
										{{$assignment->reason}}
									</td>
									<td class="col-xs-1">
									
									<form action='/remove_character_ep' method='POST'>
										<!-- ******************* -->
										<!-- For Laravel CSRF administration -->
										<input type="hidden" name="_token" value="{!! csrf_token() !!}">
										<!-- ******************* -->
			
										<input name='charId' type='hidden' value='{{$character->id}}'>
										<input name='assignmentId' type='hidden' value='{{ $assignment->id }}'>
			
										<button type='submit' class="btn btn-default btn-danger btn-xs glyphicon glyphicon-minus" data-toggle="tooltip" title="Verwijder EP">
										</button>
									</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-3 col-xs-offset-5">
			<a href="/showall_character/" class="btn btn-default"
				id="cancel_button" type="button"
				style="width: 120px; font-size: 18px;"> Terug </a>
		</div>
	</div>
</div>
@endsection
