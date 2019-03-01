<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LarpEventController extends Controller
{
    public function showAllEvents(){
        $coming_events = LarpEvents::all()->where('end_date','>',now())->get();
        $past_events = LarpEvents::all()->where('end_date','<',now())->get();

        return view('larp_event\showAllLarpEvents',
                        ['coming_events' => $coming_events,
                        'past_events' => $past_events
                    ]);
    }
}
