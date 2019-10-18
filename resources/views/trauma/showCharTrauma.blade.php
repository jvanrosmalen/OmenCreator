@extends('layouts.app') @section('content')
<div class='container'>
	<div class="row">
		<div class="col-xs-12">
			<span class="overview_header">Trauma {{ $character->name }} (Speler: {{$character->char_user->name}})</span>
		</div>
	</div>

	<br>

	<div class="row"></div>

	<div class="row well">
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1"><h4>Trauma Toekennen</h4></div>
		</div>
		<div class='row'>
			<div class="col-xs-10 col-xs-offset-1">Geef hieronder de reden aan waarom je trauma wil toekennen aan <label>{{ $character->name }}</label>.</div>
		</div>
		<br>
		<form action='do_character_add_trauma' method='POST'>
			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
		
			<input name='charId' type='hidden' value='{{$character->id}}'>
		
			<div class='row'>
				<div class='col-xs-2 col-xs-offset-2'>
					Gekregen op Omen <input class='input_number_field' name='gotten_on_omen' type='number' min='1'>
				</div>
				<div class='col-xs-6'>
					<input name="trauma_reason" style="width: 100%;" placeholder="Reden van Trauma toekenning" value="">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="row button-row">
					<div class="col-xs-4 col-xs-offset-4">
						<button type='submit' class="btn btn-default">Trauma Toekennen</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	
	<div class="row">
		<div class='row'>
			<div class="col-xs-8 col-xs-offset-2"><h4>Trauma Overzicht</h4></div>
		</div>
		<div class='row'>
			<div class="col-xs-8 col-xs-offset-2">
				<table id="char_trauma_table" class="table table-fixedheader table-responsive table-condensed table-hover sortable">
					<thead>
						<tr>
							<th class="col-xs-11">
								Beschrijving
							</th>
							<th class="col-xs-1">
								Actie
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($character->getUnhealedTraumaAssignments() as $unhealedTrauma)
							<tr>
								<td class="col-xs-11">
									{{$unhealedTrauma->description}} (Omen {{$unhealedTrauma->gotten_on_omen}})
									<br>
									&nbsp;&nbsp;<em>Nog niet genezen</em>
								</td>
								<td class="col-xs-1">
									<a href="show_heal_trauma/{{$unhealedTrauma->id}}" class="btn btn-default btn-xs heal-trauma-btn" data-toggle="tooltip" title="Genees Trauma">
		   								<span class="glyphicon glyphicon-certificate"></span> 
		   							</a>

									<a href="remove_trauma/{{$unhealedTrauma->id}}" class="btn btn-default btn-danger btn-xs" data-toggle="tooltip" title="Verwijder Trauma">
		   								<span class=" glyphicon glyphicon-minus"></span> 
		   							</a>
								</td>
							</tr>
						@endforeach
						@foreach($character->getHealedTraumaAssignments() as $healedTrauma)
							<tr>
								<td class="col-xs-11">
									{{$healedTrauma->description}} (Omen {{$healedTrauma->gotten_on_omen}})
									<br>
									&nbsp;&nbsp;{{$healedTrauma->healed_by}} (Omen {{$healedTrauma->healed_on_omen}})
								</td>
								<td class="col-xs-1">
									<a href="remove_trauma/{{$healedTrauma->id}}" class="btn btn-default btn-danger btn-xs" data-toggle="tooltip" title="Verwijder Trauma">
		   								<span class=" glyphicon glyphicon-minus"></span> 
		   							</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-4 col-xs-offset-4 text-center">
			<a href="{{ url('/showall_character') }}" class="btn btn-default"
				id="cancel_button" type="button"
				style="width: 120px; font-size: 18px;"> Terug </a>
		</div>
    </div>
</div>
@endsection
