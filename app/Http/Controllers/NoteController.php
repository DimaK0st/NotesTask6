<?php

namespace App\Http\Controllers;

use App\Models\NoteModel;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function addNote(Request $request){

        $idUser=$_COOKIE['id'];


        $user = new NoteModel();
        $user->idUser = $idUser;
        $user->nameNotes = $request->inputNameNote;
        $user->textNotes = $request->inputTextNote;
        $user->save();
        $idTheme=$user->id;


        return app('App\Http\Controllers\ImageController')->addNote($request, $idUser."/".$idTheme);

    }


}
