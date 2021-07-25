<?php

namespace App\Http\Controllers;

use App\Models\NoteModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(Request $request)
    {

        $allNotes = NoteModel::where('idUser', '=', $_COOKIE['id'])->orderBy('idNotes', 'desc')->get();

        echo count($allNotes);
        for ($i = 0; $i < count($allNotes); $i++) {

            $path = $_COOKIE['id'] . "/" . (string)$allNotes[$i]['idNotes'];
            $pathScan = public_path('../public/storage/' . $allNotes[$i]['idUser'] . "/" . $allNotes[$i]['idNotes']);
            $pathScan;
            $files = scandir($pathScan);
            $files;
            $allNotes[$i]['path'] = asset('storage/' . $path . "/" . $files[2]);

        }
        return view('home', ['allNotes' => $allNotes]);

    }

    //

    public function addNote()
    {
        return view('addNote');

    }


    public function authorization()
    {
        return view('authorization');

    }

    public function register()
    {
        return view('registration');

    }
    //
}
