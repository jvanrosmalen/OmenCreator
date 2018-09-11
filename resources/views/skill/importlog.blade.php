<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>

    <body>
        <div class="row">
            <div class="col-xs-2">
            </div>
            <div class="col-xs-4">
                <h3>Import Log</h3>
            </div>
            <div class="col-xs-4">
                <h4>
                    <?php
                        date_default_timezone_set("Europe/Amsterdam");
                        echo "Datum: ".date("d-m-Y");
                    ?>
                </h4>
            </div>
        </div>

        @foreach($errorLogArray as $skillName => $errors)
            <div class="row">
                <div class="col-xs-1">
                </div>
                <div class='col-xs-10'>
                    <h5>{{$skillName}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2">
                </div>
                <div class='col-xs-10'>
                    <ul class="errorLog">
                    @foreach($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </body>   
</html>