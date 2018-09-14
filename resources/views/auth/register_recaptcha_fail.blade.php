@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Godi Gunnar Akeson kijkt je vuil aan en zegt:</div>

                <div class="panel-body text-center">
                    Geen heks zeg je? Ik ben niet overtuigd.<br>
                    Je krijgt nog &eacute;&eacute;n kans...<br>
                    (Je ziet in de verte een brandstapel opgericht worden.)<br>
                    <em>(De recaptcha check is niet succesvol.)</em>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
        	<div class='row'>
        		<div class="col-xs-4 col-xs-offset-4">
        			<a href='register' class='btn btn-default' style='width:100%'>Terug</a>
        		</div>
        	</div>
        </div>
    </div>
    
</div>
@endsection