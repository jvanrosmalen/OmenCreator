<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-8">
                    <h4>{{$character->name}}, {{$character->title}}<br>(Speler: {{$character->char_user->name}})</h4>
                </div>
                <div class="col-xs-4 pull-right">
                    <h5>Datum: 
                        <?php
                            date_default_timezone_set('Europe/Amsterdam');
                            echo date('d-m-Y');
                        ?>
                    </h5>
                </div>
            </div>
            <hr>
            @foreach($skills as $skill)
                <div class="row">
                    <div class="row">
                        <div class="col-xs-12"><em>{{$skill->name}}</em></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">{{$skill->description_long}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>