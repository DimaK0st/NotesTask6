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


    public function getNotes(){



        return app('App\Http\Controllers\ImageController')->getSavedImages();

    }

    public function getOneNote($id)
    {

//        return app('App\Http\Controllers\ImageController')->getSavedImages();



        $oneNotes = NoteModel::where('idNotes', '=', $id)->orderBy('idNotes', 'desc')->first();

        echo $oneNotes;

        $pathScan = public_path('../public/storage/'.$oneNotes['idUser'].'/'.$oneNotes['idNotes']);
        $files = scandir($pathScan);
        echo "<br>";
        $allImage=array();
        for($i=2;$i<count($files);$i++){
        array_push($allImage, asset('storage/'.$oneNotes['idUser'].'/'.$oneNotes['idNotes'].'/'.$files[$i]));
        }
        var_dump($allImage);
        return view('getNote',["oneNotes"=>$oneNotes, "allImage"=>$allImage]);

    }


}
