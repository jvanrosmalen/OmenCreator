@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-xs-5">
				<h3>Levensvonk: {{$title}}</h3>
			</div>
		</div>

		<form action="spark_submit/{{$sparkIndex}}" method="POST">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->
			
			<input type="hidden" name="charId" value="{{$charId}}">
			<input type="hidden" name="sparkIndex" value="{{$sparkIndex}}">
			
			<div class="row well">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					Je ontvangt gratis 1 kennisvaardigheid naar keuze.<br>
					Selecteer hieronder ofwel een kennisvaardigheid die je al hebt gekozen of een nieuwe kennisvaardigheid. 
					Deze nieuwe vaardigheid moet een klasse-vaardigheid zijn, of een algemene vaardigheid, en het
					 karakter moet aan eventuele prereqs voldoen. (Geen nood, zo zijn ze al gefilterd.)<br><br>
					<em>Als je een vaardigheid kiest die je al had, dan wordt deze vaardigheid gratis. Je krijgt de EP terug en kan
					 die in een andere vaardigheid investeren.<br>
					Als je een nieuwe vaardigheid kiest, krijg je die vaardigheid gratis.
					</em>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					<h4>Nieuwe Vaardigheden</h4>
					@foreach($classKnowSkills as $skill)
						<input type='radio' name='selectedSkill' value='{{$skill->id}}'> {{$skill->name}} ( {{$skill->ep_cost}} EP )<br>
					@endforeach
				</div>
				<div class="col-xs-1">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					<h4>Reeds Gekende Vaardigheden</h4>
					@foreach($charKnowSkills as $skill)
						<input type='radio' name='selectedSkill' value='{{$skill->id}}'> {{$skill->name}} ( {{$skill->ep_cost}} EP )<br>
					@endforeach
					@if(count($charKnowSkills) == 0)
					<em>Geen</em>
					@endif
					<br><br>
				</div>
			</div>
			<div class="row well">
				<div class="col-xs-1">
				</div>
				<div class="col-xs-10">
					Je kent natuurlijk ook al de ras-vaardigheden:<br>
					@foreach($raceKnowSkills as $skill)
					<div class="row">
						<div class="col-xs-1">
						</div>
						<div class="col-xs-8">
							<em>{{$skill->name}}</em><br>
						</div>
					</div>
					@endforeach						
					Maar die is&#47;zijn al gratis.		
				</div>
				<div class="col-xs-1">
				</div>
			</div>

			<div class="row">
				<div class="col-xs-7">
				</div>
				<div class="col-xs-2">
					<button type='submit' class="btn btn-default" style="width: 120px; font-size: 18px;">
						Ga door
					</button>
				</div>
				<div class="col-xs-3">
				</div>
			</div>
			
		</form>
 	</div>
@endsection