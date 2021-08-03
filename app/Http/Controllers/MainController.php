<?php

namespace App\Http\Controllers;

use App\Models\NoteModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function home(Request $request)
    {
        if (!is_null(session('id'))) {
            $allNotes = NoteModel::selectRaw('`idNotes`, `idUser`, `nameNotes` , LEFT (textNotes, 200) as textNotes ')
                ->where('idUser', '=', session('id'))
                ->orderBy('idNotes', 'desc')->get();
        } else {
            $allNotes = NoteModel::where('idUser', '=', "-1")->orderBy('idNotes', 'desc')->get();
        }
var_dump(count($allNotes));
        for ($i = 0; $i < count($allNotes); $i++) {
            $path = session('id') . "/" . (string)$allNotes[$i]['idNotes'];
            $pathScan = public_path('../public/storage/' . $allNotes[$i]['idUser'] . "/" . $allNotes[$i]['idNotes']);
            if (is_readable($pathScan)) {
                $files = scandir($pathScan);
                $files;
                $allNotes[$i]['path'] = asset('storage/' . $path . "/" . $files[2]);
            } else $allNotes[$i]['path'] = "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22208%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20208%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17aab92a0d9%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17aab92a0d9%22%3E%3Crect%20width%3D%22208%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2266.9453125%22%20y%3D%22117.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E";
        }
        if (is_null(session('id'))) {
            return view('home', ['allNotes' => $allNotes, 'firstLogin' => "1"]);
        }
        return view('home', ['allNotes' => $allNotes]);

    }

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

    public function importCsv()
    {
        return view('postCsv');

    }
}
