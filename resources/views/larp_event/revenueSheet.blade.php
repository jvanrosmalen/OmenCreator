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

            table {
                cellspacing: 1px;
            }

           td:nth-child(1){
               border: 1px solid black;
               width: 18px;
               height: 18px;
           }

           td:nth-child(2),
           td:nth-child(3),
           td:nth-child(4) {
               width: 25%;
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
                    <td> </td>
                    <td>{{ $participant -> name }}</td>
                    <td>{{ $participant -> char_user -> name }}</td>
                    <td>{{ $participant->moneyAmountToString($participant->getIncome()) }}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>