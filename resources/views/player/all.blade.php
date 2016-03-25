<!DOCTYPE html>
@extends('layouts.app')

	@section('content')
	
	<div class='container'>
		<h1>Overzicht Spelers</h1>

		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Faith</th>
					<th>Race</th>
					<th>Class</th>
				</tr>
			</thead>
			<tbody>
				@foreach($players as $player)
					<tr>
						<td>{{$player->name}}</td>
						<td>{{$player->faith}}</td>
						<td>{{$player->race}}</td>
						<td>{{$player->class}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection
