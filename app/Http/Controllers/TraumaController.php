<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Character;
use App\Trauma;

class TraumaController extends Controller
{
    public function manageTrauma($charId){
        $character = Character::find($charId);
        return view('trauma/showCharTrauma', ['character'=>$character]);
    }

    public function doAddTrauma(){
        $charId = $_POST["charId"];
        $character = Character::find($charId);

        $trauma = new Trauma();

        $trauma->amount = 1;
        $trauma->gotten_on_omen = $_POST["gotten_on_omen"];
        $trauma->description = $_POST["trauma_reason"];
        $trauma->healed_on_omen = 0;
        $trauma->healed_by = "";
        $trauma->character_id = $charId;

        $trauma->save();

        return view('trauma/showCharTraumaAddSuccessful', ['character' => $character]);
    }

    public function showHealTrauma($traumaId){
        $trauma = Trauma::find($traumaId);
        $character = Character::find($trauma->character_id);
        return view('trauma/showHealTrauma', ['trauma' => $trauma, 'character' => $character]);
    }

    public function doHealTrauma(){
        $traumaId = $_POST['traumaId'];
        $trauma = Trauma::find($traumaId);
        $character = Character::find($trauma->character_id);

        $trauma->healed_on_omen = $_POST['healed_on_omen'];
        $trauma->healed_by = $_POST['healed_by'];

        $trauma->save();

        return view('trauma/showCharTraumaHealSuccessful', ['trauma'=> $trauma, 'character' => $character]);
    }

    public function showDeleteTrauma($traumaId){
        $trauma = Trauma::find($traumaId);
        $character = Character::find($trauma->character_id);
        return view('trauma/showDeleteTrauma', ['trauma' => $trauma, 'character' => $character]);
    }

    public function doDeleteTrauma(){
        $traumaId = $_POST['traumaId'];
        $traumaDescription = Trauma::find($traumaId)->description;
        $character = Character::find($trauma->character_id);

        $trauma->delete();

        return view('trauma/showCharTraumaDeleteSuccessful', ['traumaDescription'=> $traumaDescription, 'character' => $character]);
    }
}
