@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Hymir zegt:</div>

                <div class="panel-body text-center">
                    Je zoekt naar kennis die niet voor jou is!<br>
                    Ga heen en keer nimmer terug naar deze plek, of voel mijn woede!
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
        	<div class='row'>
        		<div class="col-xs-4 col-xs-offset-4">
        			<a href='/home' class='btn btn-default' style='width:100%'>Terug</a>
        		</div>
        	</div>
        </div>
    </div>
    
</div>
@endsection
