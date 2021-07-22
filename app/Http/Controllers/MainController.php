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

echo $allNotes;



        return view('home',['allNotes'=>$allNotes]);

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
