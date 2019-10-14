<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <style>
            body {
                font-size: 14px;
            }

            .underlined {
                border-bottom: 1px solid black;
            }
        </style>
	</head>
	<body>
        <h3>Inkomsten: {{$event->name}}</h3>
        <table>
            <tr>
                <th></th>
                <th>Karakternaam</th>
                <th>Spelernaam</th>
                <th>Inkomsten</th>
            </tr>
            @foreach($participants as $participant)
                <tr>
                    <td>&#x25fb;</td>
                    <td class="underlined">{{ $participant -> name }}</td>
                    <td class="underlined"></td>
                    <td class="underlined"></td>
                </tr>
            @endforeach
        </table>
    </body>
</html>