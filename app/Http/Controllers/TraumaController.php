<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Character;

class TraumaController extends Controller
{
    public function addTrauma($charId){
        $character = Character::find($charId);
        return view('trauma/showAddTrauma', ['character'=>$character]);
    }
}
