<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LarpEvent;

class LarpEventController extends Controller
{
    public function showAllEvents(){
        $current_date = date("Y-m-d");

        $coming_events = LarpEvent::where('end_date','>=',$current_date)->get();
        $past_events = LarpEvent::where('end_date','<',$current_date)->get();

        return view('larp_event/showAllLarpEvents',
                        ['coming_events' => $coming_events,
                        'past_events' => $past_events
                    ]);
    }

    public function showCreateEvent(){
        return view('larp_event/showNewLarpEvent'); 
    }

    public function createEventSubmit(Request $request){
        $newEvent = new LarpEvent();

        $newEvent->name = $request->input('larp_event_name');
        $newEvent->description = $request->input('larp_event_description');

        var_dump($request->inpu('eventBeginDate'));

    }
}
