<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LarpEvent;
use App\Character;
use App\EpAssignment;
use PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

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

    public function showEvent($eventId){
        $event = LarpEvent::find($eventId);

        return view('larp_event/showLarpEvent', ['event' => $event, 'participants' => $event->participants]);
    }

    public function editEvent($eventId){
        $event = LarpEvent::find($eventId);

        return view('larp_event/showNewLarpEvent', ['event' => $event]);
    }

    public function showCreateEvent(){
        return view('larp_event/showNewLarpEvent'); 
    }

    public function addPlayers($eventId){
        $event = LarpEvent::find($eventId);
        $participant_ids = array();

        $characters = Character::where('is_alive', true)
                                ->where('is_active', true)
                                ->where('is_player_char', true)
                                ->orderBy('name')
                                ->get();

        foreach($event->participants as $participant){
            array_push($participant_ids, $participant->id);
        }

        return view('larp_event/showLarpEventAddPlayers',
                        ['event' => $event,
                        'characters' => $characters,
                        'participant_ids' => $participant_ids,
                        'participant_ids_json' => JSON_encode($participant_ids)
                        ]);
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
        $newEvent->ep_assigned = false;

        $newEvent->save();

        return view('larp_event/showCreateLarpEventSuccess',
                        ['eventName' => $newEvent->name,
                        'isUpdate' => $request->exists('larp_event_id')
                        ]);
    }

    public function doDeleteEvent($eventId){
        $event = LarpEvent::find($eventId);
        $eventName = $event->name;

        if(!$event->participants->isEmpty()){
            $event->participants()->detach(); 
        }

        $event->delete();

        return view('larp_event/showEventDeleted', ['eventName' => $eventName]);
    }

    public function deleteEventWarning($eventId){
        $eventName = LarpEvent::find($eventId)->name;

        return view('larp_event/showDeleteEventWarning',['eventName' => $eventName, 'eventId' => $eventId]);
    }

    public function doUpdateParticipants($eventId){
        $participantIdsArray = JSON_decode($_POST['selected_participants']);
        $event = LarpEvent::find($eventId);

        $event->participants()->sync($participantIdsArray);
        $event->save();

        return view('larp_event/showParticipantsUpdated', ['eventName' => $event->name]);
    }

    public function doAssignEP($eventId){
        $event = LarpEvent::find($eventId);

        if(!$event->ep_assigned){
            foreach($event->participants as $participant){
                $ep_amount = 3;
                $epAssign = new EpAssignment();

                // the Participants do not give is_alive attribute via event
                // so check the character behind it.
                $character = Character::find($participant->id);

                if($character->is_alive){
                    $character->ep_amount = $character->ep_amount + $ep_amount; 
                    $character->nr_events_survived = $character->nr_events_survived + 1;        
                    $character->save();

                    $epAssign->amount = $ep_amount;
                    $epAssign->reason = $event->name;
                } else {
                    $epAssign->amount = 0;
                    $epAssign->reason = "Gestorven op ".$event->name;
                }

                $epAssign->character_id = $character->id;
                $epAssign->save();

                $event->ep_assigned = true;
                $event->save();
            }
        

            return view('larp_event/showParticipantsEpAssigned', ['event' => $event]);
        } else {
            return view('larp_event/showEpAlreadyAssigned', ['event' => $event]);
        }
    }

    public function generateRevenueOverview($eventId){
        $event = LarpEvent::find($eventId);
        $participants = $event->participants;

		$pdf = \PDF::loadView('larp_event.revenueSheet', compact('participants', 'event'));
		$pdf->setPaper('A4', 'portrait');
		return $pdf->download('inkomsten '.$event->name.'.pdf');        
    }

    public function generateEventCombatSheets($eventId){
        $participants = LarpEvent::find($eventId)->participants;
        $combatSheetsPdf = null;
        $pdfMerger = PDFMerger::init();

        foreach($participants as $participant){
            $character = Character::find($participant->id);
            $temp_storage_path = storage_path('events/temp_combatsheets/combatsheet_'.$character->name.'.pdf');

            $pdf = \PDF::loadView('character.charCombatSheet', compact('character'));
            $pdf->setPaper('A4', 'landscape');

            $pdf->save($temp_storage_path);
            $pdfMerger->addPDF($temp_storage_path, 'all');
        }

        $pdfMerger->duplexMerge();
        // delete all files in temp storage folder
        $files = glob(storage_path('events/temp_combatsheets/').'*'); // get all file names
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }

        return $pdfMerger->save("combatsheets ".$event->name, "download");
		// return $combatSheetsPdf->download('combatsheet_'.$character->name.'.pdf');
    }
}
