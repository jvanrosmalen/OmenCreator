@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Ahl&eacute;nnia zegt:</div>

                <div class="panel-body text-center">
                    Ik ken jouw naam niet, en de woorden die je spreekt kunnen mij niet bekoren.<br>
                    Keer terug naar de rand van het woud. Mijn paden zullen voor jou verborgen blijven.<br>
                    <br>
                    <em>(Je e-mail en/of je wachtwoord worden niet herkend.)</em>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
        	<div class='row'>
        		<div class="col-xs-4 col-xs-offset-4">
        			<a href='login' class='btn btn-default' style='width:100%'>Terug</a>
        		</div>
        	</div>
        </div>
    </div>
    
</div>
@endsection
