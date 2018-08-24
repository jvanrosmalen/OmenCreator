@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='row'>
            <div class='col-xs-12'>
                <h3>Importeer Vaardigheden</h3>
            </div>
        </div>

        <div class="row well warning-text">
			<div class="col-xs-12">
				Deze actie verwijderd alle huidige karakters en skills uit de database! Als je ook maar een beetje
                 denkt dat je niet echt weet wat je aan het doen bent, raak dan niets aan en ga onmiddelijk naar een
                  andere pagina.
			</div>		
		</div>

        <div class="row">
            <form action="/do_import_skills" method="post" enctype="multipart/form-data">

			<!-- ******************* -->
			<!-- For Laravel CSRF administration -->
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<!-- ******************* -->

            <h3>Hand-out</h3>
                <div class="row">
					<div class='col-xs-2'>
					</div>
                    <div class='col-xs-3'>
                        {!! Form::file('skill_imports') !!}
                    </div>
                </div>
            </form>
        <div>
    </div>
@endsection