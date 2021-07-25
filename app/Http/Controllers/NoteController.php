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
        $idTheme=$user->idNote;

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
        $allImage= $this->getAllImageNote($oneNotes['idUser'], $oneNotes['idNotes']);
        var_dump($allImage);
        return view('getNote',["oneNotes"=>$oneNotes, "allImage"=>$allImage]);

    }

    public function getAllImageNote($idUser, $idNotes){
        $pathScan = public_path('../public/storage/'.$idUser.'/'.$idNotes);
        $files = scandir($pathScan);
        $allImage=array();
        for($i=2;$i<count($files);$i++){
            array_push($allImage, asset('storage/'.$idUser.'/'.$idNotes.'/'.$files[$i]));
        }
        return $allImage;
    }


    public function editNote($id)
    {

        $oneNotes = NoteModel::where('idNotes', '=', $id)->first();
        echo "<!DOCTYPE html>";
        $allImage= $this->getAllImageNote($oneNotes['idUser'], $oneNotes['idNotes']);
        return view('editNote', ["oneNotes"=>$oneNotes,"allImage"=>$allImage]);
    }


    public function editPostNote(Request $request)
    {

        $regexp = "/http:\/\/\w+\//";
        $idUser=$_COOKIE['id'];
        $path=$request->tempNoteDelete;
        echo $path;
        $path = explode(",", $path);

        echo "<br>После регулярки";
        foreach ($path as $onePath){
            if($onePath!=""){
            echo "<br>___________________";
                $result = str_replace("http://notestask6", "", $onePath);
                echo $result;
                unlink(public_path($result));
            }
        }
        app('App\Http\Controllers\ImageController')->addNote($request, $idUser."/".$request->idNotes);


        $note = NoteModel::where('idNotes', $request->idNotes)->update(['nameNotes'=>$request->inputNameNote,'textNotes'=>$request->inputTextNote]);


        return "";
//        return redirect('/getNote/'.$request->idNotes);
        }

}
