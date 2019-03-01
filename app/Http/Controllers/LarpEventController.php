<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LarpEvent;

class LarpEventController extends Controller
{
    public function showAllEvents(){
        $current_date = date("Y-m-d");

        echo $current_date;

        $coming_events = LarpEvent::where('end_date','>',$current_date)->get();
        $past_events = LarpEvent::where('end_date','<',$current_date)->get();

        return view('larp_event\showAllLarpEvents',
                        ['coming_events' => $coming_events,
                        'past_events' => $past_events
                    ]);
    }
}
