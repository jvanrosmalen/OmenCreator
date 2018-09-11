<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            li a:before {
                content: "\2610";
                margin-right:5px;
            }
        </style>
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

                </h4>
            </div>
        </div>

        @foreach($errorLogArray as $skillName=>$errorArray)
            <div class="row">
                <div class="col-xs-3">
                </div>
                <div class="col-xs-7">
                    <h5>
                        {{$skillName}}
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                </div>       
                <div class="col-xs-7">
                    <ul>
                        @foreach($errorArray as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </body>   
</html>