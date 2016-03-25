<!DOCTYPE html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h1>Cre&euml;er Nieuwe Speler</h1>
		</div>
	</div>
	<form action="/player/create_submit" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="row player_form steps">
			<div class="col-md-5 ">
				<div class='row well step 1'>
					<p>What is you're name, stranger?</p>
					<input id="player_name" name="player_name" />
				</div>
				<div class='row well step 2'>
					<p>From what race where you born?</p>
					<input id="player_race" name="player_race" hidden/>
					<ul class="races buttons">
						@foreach($races as $race)
							<li class="race" id='{{$race->id}}'>
								<section>{{$race->name}}</section>
							</li>
						@endforeach
					</ul>
				</div>
				<div class='row well step 3'>
					<p>What is you're profession?</p>
					<input id="player_class" name="player_class" hidden />

					<ul class="classes buttons">
						@foreach($playerclasses as $class)
							<li class="class" id='{{$class->id}}'>
								<section>{{$class->class_name}}</section>
							</li>
						@endforeach
					</ul>
				</div>
				<div class='row well step 4'>
					<p>Do you have faith my son?</p>

					<input id="player_faith" name="player_faith" hidden/>

					<ul class="faiths buttons">
						@foreach($faiths as $fath)
							<li class="faith" id='{{$fath->id}}'>
								<section>{{$fath->name}}</section>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-7 ">
				<div class='step 5'>
					<p>Anyone giving false information will be marked a heratic!
					Are you sure you want to continue?</p>
					<button typ="submit">I am sure</button>
				</div>
			</div>
		</div>


	</form>
</div>



@endsection
