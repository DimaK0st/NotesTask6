<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;

class NoteController extends Controller
{

    public function addNote(Request $request)
    {
    }


    public function getNotes()
    {
        return app('App\Http\Controllers\ImageController')->getSavedImages();

    }

    public function getOneNote($id)
    {
    }


    public function editNote($id)
    {
       }


    public function editPostNote(Request $request)
    {

    }


}
