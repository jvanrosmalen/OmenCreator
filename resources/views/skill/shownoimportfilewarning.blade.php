@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12'>
                <h3>Geen Correcte File Geselecteerd</h3>
            </div>
        </div>

        <div class="row well warning-text">
			<div class="col-xs-12">
				Je hebt geen file geselecteerd, je hebt geen .xlsx geselecteerd of de layout van de file is niet correct.<br>
                <br>
                De layout die verwacht wordt is de volgende:
                <table style="font-size:2">
                    <thead>
                        <th>Kolom</th>
                        <th>Inhoud</th>
                    </thead>
                    <tr>
                        <td>A</td>
                        <td>x</td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td>toon</td>
                    </tr>
                    <tr>
                        <td>C</td>
                        <td>Vaardigheid</td>
                    </tr>
                    <tr>
                        <td>D</td>
                        <td>Klasse</td>
                    </tr>
                    <tr>
                        <td>E</td>
                        <td>EP</td>
                    </tr>
                    <tr>
                        <td>F</td>
                        <td>Korte Omschrijving</td>
                    </tr>
                    <tr>
                        <td>G</td>
                        <td>Voorvereiste</td>
                    </tr>
                    <tr>
                        <td>H</td>
                        <td>Afkomst</td>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td>Hand-out?</td>
                    </tr>
                    <tr>
                        <td>J</td>
                        <td>RES_ANGST</td>
                    </tr>
                    <tr>
                        <td>K</td>
                        <td>RES-DIEFSTAL</td>
                    </tr>
                    <tr>
                        <td>L</td>
                        <td>RES_GIF</td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>RES_MAGIE</td>
                    </tr>
                    <tr>
                        <td>N</td>
                        <td>RES_ZIEKTE</td>
                    </tr>
                    <tr>
                        <td>O</td>
                        <td>WILSKRACHT</td>
                    </tr>
                    <tr>
                        <td>P</td>
                        <td>STATUS</td>
                    </tr>
                    <tr>
                        <td>Q</td>
                        <td>FOCUS</td>
                    </tr>
                    <tr>
                        <td>R</td>
                        <td>TRAUMA</td>
                    </tr>
                    <tr>
                        <td>S</td>
                        <td>BUFFERPUNTEN</td>
                    </tr>
                    <tr>
                        <td>T</td>
                        <td>LP_LINKERARM</td>
                    </tr>
                    <tr>
                        <td>U</td>
                        <td>LP_TORSO</td>
                    </tr>
                    <tr>
                        <td>V</td>
                        <td>LP_RECHTERARM</td>
                    </tr>
                    <tr>
                        <td>W</td>
                        <td>LP_LINKERBEEN</td>
                    </tr>
                    <tr>
                        <td>X</td>
                        <td>LP_RECHTERBEEN</td>
                    </tr>
                    <tr>
                        <td>Y</td>
                        <td>SPECIAAL</td>
                    </tr>
                    <tr>
                        <td>Z</td>
                        <td>OMSCHRIJVING</td>
                    </tr>
                </table>
			</div>		
		</div>

		<div class="row button-row">
			<div class="col-xs-5"></div>
			<div class="col-xs-2">
				<a href="/import_skills" class="btn btn-default" type="button"	style="width: 120px; font-size: 18px;">
				Terug
				</a>
			</div>
			<div class="col-xs-5"></div>
		</div> 
    </div>
@endsection