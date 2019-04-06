<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LarpEvent;

class LarpEventController extends Controller
{
    public function showAllEvents(){
        $current_date = date("Y-m-d");

        $coming_events = LarpEvent::where('end_date','>=',$current_date)->orderBy('end_date', 'DESC')->get();
        $past_events = LarpEvent::where('end_date','<',$current_date)->orderBy('end_date', 'DESC')->get();

        return view('larp_event/showAllLarpEvents',
                        ['coming_events' => $coming_events,
                        'past_events' => $past_events
                    ]);
    }

    public function showCreateEvent(){
        return view('larp_event/showNewLarpEvent'); 
    }

    public function createEventSubmit(Request $request){

        if($request->exists('larp_event_id')){
            // This is an update.
            $newEvent = LarpEvent::find($request->input('larp_event_id')); 
        } else {
            // This is a create
            $newEvent = new LarpEvent();
        }

        $newEvent->name = $request->input('larp_event_name');
        $newEvent->description = $request->input('larp_event_description');
        $newEvent->begin_date = date("Y-m-d", strtotime($request->input('larp_event_begin_date')));
        $newEvent->end_date = date("Y-m-d", strtotime($request->input('larp_event_end_date')));

        $newEvent->save();

        return view('larp_event/showCreateLarpEventSuccess',
                        ['eventName' => $newEvent->name,
                        'isUpdate' => $request->exists('larp_event_id')
                        ]);
    }

    public function showEvent($eventId){
        $event = LarpEvent::find($eventId);

        return view('larp_event/showLarpEvent', ['event' => $event]);
    }

    public function editEvent($eventId){
        $event = LarpEvent::find($eventId);

        return view('larp_event/showNewLarpEvent', ['event' => $event]);
    }
}
