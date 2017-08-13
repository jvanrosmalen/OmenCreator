<!DOCTYPE html>
<html>
@extends('layouts.app')

@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-xs-5'>
			<h3>Mijn Profiel</h3>
		</div>
	</div>
	
	<ul class="nav nav-tabs">
		<li class="active"><a id="tab1" data-toggle="tab" href="#user_name">Gebruikersnaam</a></li>
		<li><a id="tab2" data-toggle="tab" href="#user_email">E-mailadres</a></li>
		<li><a id="tab3" data-toggle="tab" href="#user_password">Wachtwoord</a></li>
	</ul>

	<div class="tab-content">
		<div id="user_name" class="tab-pane fade in active">
			<br>
			<div class='row well col-xs-10 col-xs-offset-1'>
				<div class='row'>
					<div class="col-xs-12">
						<h4>Huidig</h4>
					</div>
				</div>
		
				<div class='row'>
					<div class="col-xs-2 col-xs-offset-1">
						Gebruikersnaam:
					</div>
					<div class="col-xs-8">
						{{$user->name}}
					</div>
				</div>
				<div class='row'>
					<div class="col-xs-2 col-xs-offset-1">
						Rechten:
					</div>
					<div class="col-xs-8">
						{{$rights_string}}
					</div>
				</div>
			</div>
			<div class='row well col-xs-10 col-xs-offset-1'>
				<div class='row'>
					<div class="col-xs-12">
						<h4>Aanpassen</h4>
					</div>
				</div>
		
				<div class='row'>
					<div class="col-xs-11 col-xs-offset-1">
						<em>Je gebruikersnaam dient gelijk te zijn aan je eigen naam, zonder eventuele spaties.
						 Hierbij dient elk deel van je eigen naam met een hoofdletter geschreven te worden voor de leesbaarheid. Een gebruikersnaam
						 dient minimaal 4 karakters lang te zijn en minimaal 2 hoofdletters te bevatten. De naam mag enkel hoofdletters en kleine letters bevatten.<br>
						Als je bijvoorbeeld Jan de Geweldenaar heet, wordt je gebruikersnaam JanDeGeweldenaar. (Let op dat het tussenvoegsel 'de'
						 in de gebruikersnaam nu met een hoofdletter geschreven wordt.)</em>
					</div>
				</div>
				<br>
				
				<form action="/new_username_submit" onsubmit="return MyProfile.checkUsernameSubmit(event)" method="POST">
					<!-- ******************* -->
					<!-- For Laravel CSRF administration -->
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<!-- ******************* -->

					<div class='row'>
						<div class="col-xs-2 col-xs-offset-1">
							Gebruikersnaam:
						</div>
						<div class="col-xs-3">
							<input id='user_name_input' name='user_name' type='text' style='width:100%' placeholder='Nieuwe gebruikersnaam' onfocus="MyProfile.focusUsernameInput()">
						</div>
						<div class="col-xs-5">
							<span id="user_name_error" class="alert alert-danger hidden">Deze naam voldoet niet aan de voorwaarden.</span>
						</div>
					</div>
					<div class='row'>
						<div class="col-xs-2 col-xs-offset-1">
							Wachtwoord:
						</div>
						<div class="col-xs-3">
							<input id='user_name_password_input' name='user_name_password' type='password' autocomplete="off" style='width:100%' placeholder='Wachtwoord ter controle' onfocus="MyProfile.focusUsernamePasswordInput()">
						</div>
						<div class="col-xs-5">
							<span id="user_name_password_error" class="alert alert-danger hidden">Een wachtwoord dient minimaal 6 karakters te zijn.</span>
						</div>
					</div>
					<br>
					<div class='row'>
						<div class="col-xs-3 col-xs-offset-2">
							<button type='submit' class="btn btn-default" style="width:100%">Gebruikersnaam Aanpassen</button>
						</div>
					</div>
				</form>
				<br>
				<div class='row'>
					<div class="col-xs-11 col-xs-offset-1">
						<em>Het is niet mogelijk om zelf je rechten aan te passen.</em>
					</div>
				</div>
			</div>
		</div>
		
		<div id="user_email" class="tab-pane fade">
			<br>
			<div class='row well col-xs-10 col-xs-offset-1'>
				<div class='row'>
					<div class="col-xs-12">
						<h4>Huidig</h4>
					</div>
				</div>
		
				<div class='row'>
					<div class="col-xs-2 col-xs-offset-1">
						E-mailadres:
					</div>
					<div class="col-xs-8">
						{{$user->email}}
					</div>
				</div>
			</div>
			<div class='row well col-xs-10 col-xs-offset-1'>
				<div class='row'>
					<div class="col-xs-12">
						<h4>Aanpassen</h4>
					</div>
				</div>
		
				<br>
				<form action="/new_email_submit" onsubmit="return MyProfile.checkEmailSubmit(event)" method="POST">
					<!-- ******************* -->
					<!-- For Laravel CSRF administration -->
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<!-- ******************* -->

					<div class='row'>
						<div class="col-xs-2 col-xs-offset-1">
							E-mailadres:
						</div>
						<div class="col-xs-3">
							<input id='user_email_input' name='user_email' type='text' style='width:100%' placeholder='Nieuw e-mailadres' onfocus="MyProfile.focusEmailInput()">
						</div>
						<div class="col-xs-5">
							<span id="user_email_error" class="alert alert-danger hidden">Deze input is geen geldig e-mailadres.</span>
						</div>
					</div>
					<div class='row'>
						<div class="col-xs-2 col-xs-offset-1">
							Wachtwoord:
						</div>
						<div class="col-xs-3">
							<input id='user_email_password_input' name='user_email_password' type='password' autocomplete="off" style='width:100%' placeholder='Wachtwoord ter controle' onfocus="MyProfile.focusEmailPasswordInput()">
						</div>
						<div class="col-xs-5">
							<span id="user_email_password_error" class="alert alert-danger hidden">Een wachtwoord dient minimaal 6 karakters te zijn.</span>
						</div>
					</div>
					<br>
					<div class='row'>
						<div class="col-xs-3 col-xs-offset-2">
							<button type='submit' class="btn btn-default" style="width:100%">Email Adres Aanpassen</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div id="user_password" class="tab-pane fade">
			<br>
			<div class='row well col-xs-10 col-xs-offset-1'>
				<div class='row'>
					<div class="col-xs-12">
						<h4>Aanpassen</h4>
					</div>
				</div>
		
				<br>
				<form action="/new_password_submit" onsubmit="return MyProfile.checkPasswordSubmit(event)" method="POST">
					<!-- ******************* -->
					<!-- For Laravel CSRF administration -->
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<!-- ******************* -->

					<div class='row'>
						<div class="col-xs-3 col-xs-offset-1">
							Huidig wachtwoord:
						</div>
						<div class="col-xs-3">
							<input id='user_password_input' name='user_password' type='password' autocomplete="off" style='width:100%' placeholder='Huidig wachtwoord' onfocus="MyProfile.focusPasswordPasswordInput()">
						</div>
						<div class="col-xs-5">
							<span id="user_password_password_error" class="alert alert-danger hidden">Een wachtwoord dient minimaal 6 karakters te zijn.</span>
						</div>
					</div>
					<br>
					<div class='row'>
						<div class="col-xs-3 col-xs-offset-1">
							Nieuw Wachtwoord:
						</div>
						<div class="col-xs-3">
							<input id='user_new_password_input' name='user_new_password' type='password' autocomplete="off" style='width:100%' placeholder='Nieuw wachtwoord' onfocus="MyProfile.focusNewPasswordInput()">
						</div>
						<div class="col-xs-5">
							<span id="user_new_password_error" class="alert alert-danger hidden">Een wachtwoord dient minimaal 6 karakters te zijn.</span>
						</div>
					</div>
					<div class='row'>
						<div class="col-xs-3 col-xs-offset-1">
							Herhaal Wachtwoord:
						</div>
						<div class="col-xs-3">
							<input id='user_new_password2_input' name='user_new_password2' type='password' autocomplete="off" style='width:100%' placeholder='Herhaal nieuw wachtwoord' onfocus="MyProfile.focusNewPassword2Input()">
						</div>
						<div class="col-xs-5">
							<span id="user_new_password2_error" class="alert alert-danger hidden">De herhaling is ongelijk aan het eerste wachtwoord.</span>
						</div>
					</div>
					<br>
					<div class='row'>
						<div class="col-xs-3 col-xs-offset-2">
							<button type='submit' class="btn btn-default" style="width:100%">Wachtwoord Aanpassen</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@stop
</html>