<!DOCTYPE html>
@extends('layouts.app')

@section('content')



<div class='container'>
	<div class='row'>
		<div class='col-xs-12'>
			<h1>Cre&euml;er Nieuwe Speler</h1>
		</div>
	</div>
	<form action="/create_submit" method="POST">
		<div class="row player_form">
			<div class="col-md-8" class="step" id="one">
				<div class='row well name'>

					<p>What is you're name, stranger?</p>

					<input name="player_name">
				</div>

			</div>
			<div class="col-md-4" class="step" id="two">

			</div>
			<div id="next"></div>
		</div>


	</form>
</div>

<script src="/js/player/create.js"></script>

@endsection
