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
        $idUser = session('id');
        $user = new Note();
        $user->idUser = $idUser;
        $user->nameNotes = $request->inputNameNote;
        $user->textNotes = $request->inputTextNote;
        $user->save();
        $idTheme = $user->idNotes;
        return app('App\Http\Controllers\ImageController')->addNote($request, $idUser . "/" . $idTheme);

    }


    public function getNotes()
    {
        return app('App\Http\Controllers\ImageController')->getSavedImages();

    }

    public function getOneNote($id)
    {
        $oneNotes = Note::where('idNotes', '=', $id)->orderBy('idNotes', 'desc')->first();
        $allImage = $this->getAllImageNote($oneNotes['idUser'], $oneNotes['idNotes']);
        return view('getNote', ["oneNotes" => $oneNotes, "allImage" => $allImage]);

    }

    public function getAllImageNote($idUser, $idNotes)
    {
        $pathScan = public_path('../public/storage/' . $idUser . '/' . $idNotes);
        $allImage = array();
        if (is_readable($pathScan)) {
            $files = scandir($pathScan);
            for ($i = 2; $i < count($files); $i++) {
                array_push($allImage, asset('storage/' . $idUser . '/' . $idNotes . '/' . $files[$i]));
            }
        } else array_push($allImage, $allNotes[0]['path'] = "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22208%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20208%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17aab92a0d9%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17aab92a0d9%22%3E%3Crect%20width%3D%22208%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2266.9453125%22%20y%3D%22117.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E");
        return $allImage;
    }


    public function editNote($id)
    {
        $oneNotes = Note::where('idNotes', '=', $id)->first();
        echo "<!DOCTYPE html>";
        $allImage = $this->getAllImageNote($oneNotes['idUser'], $oneNotes['idNotes']);
        return view('editNote', ["oneNotes" => $oneNotes, "allImage" => $allImage]);
    }


    public function editPostNote(Request $request)
    {
        $regexp = "/http:\/\/\w+\//";
        $idUser = session('id');
        $path = $request->tempNoteDelete;
        $path = explode(",", $path);
        foreach ($path as $onePath) {
            if ($onePath != "") {
                $result = str_replace("http://notestask6", "", $onePath);
                if (is_readable(public_path($result))) {
                    unlink(public_path($result));
                }
            }
        }
        app('App\Http\Controllers\ImageController')->addNote($request, $idUser . "/" . $request->idNotes);
        $note = Note::where('idNotes', $request->idNotes)->update(['nameNotes' => $request->inputNameNote, 'textNotes' => $request->inputTextNote]);
        return redirect('/getNote/' . $request->idNotes);
    }

    public function getCsvFile()
    {
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=abc.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );

        $filename = "download.csv";
        $handle = fopen($filename, 'w');
        fputcsv($handle, [

            "idNotes",
            "idUser",
            "nameNotes",
            "textNotes"
        ], '|');

        $Notes = Note::where('idUser', '=', session('id'))->get();
        foreach ($Notes as $row) {
            // Add a new row with data
            fputcsv($handle, [
                $row->idNotes,
                $row->idUser,
                $row->nameNotes,
                $row->textNotes
            ], '|');
        }
        fclose($handle);
        return Response::download(public_path() . '/' . $filename, "download.csv", $headers);
    }


    function kama_parse_csv_file($file_path, $file_encodings = ['cp1251', 'UTF-8'], $col_delimiter = '', $row_delimiter = "")
    {
        if (!file_exists($file_path))
            return false;
        $cont = trim(file_get_contents($file_path));
        $encoded_cont = mb_convert_encoding($cont, 'UTF-8', mb_detect_encoding($cont, $file_encodings));
        unset($cont);
        if (!$row_delimiter) {
            $row_delimiter = "\r\n";
            if (false === strpos($encoded_cont, "\r\n"))
                $row_delimiter = "\n";
        }
        $lines = explode($row_delimiter, trim($encoded_cont));
        $lines = array_filter($lines);
        $lines = array_map('trim', $lines);
        if (!$col_delimiter) {
            $lines10 = array_slice($lines, 0, 30);
            foreach ($lines10 as $line) {
                if (!strpos($line, ',')) $col_delimiter = '|';
                if (!strpos($line, '|')) $col_delimiter = ',';
                if ($col_delimiter) break;
            }
            if (!$col_delimiter) {
                $delim_counts = array('|' => array());
                foreach ($lines10 as $line) {
                    $delim_counts['|'][] = substr_count($line, ';');
                }
                $delim_counts = array_map('array_filter', $delim_counts);
                $delim_counts = array_map('array_count_values', $delim_counts);
                $delim_counts = array_map('max', $delim_counts);
                $col_delimiter = array_search(max($delim_counts), $delim_counts);
            }
        }
        $data = [];
        foreach ($lines as $key => $line) {
            $data[] = str_getcsv($line, $col_delimiter);
            unset($lines[$key]);
        }
        return $data;
    }

    public function importCsvFile(Request $request)
    {
        if ($request->isMethod('post') && $request->file('importCsvFile')) {
            $file = $request->file('importCsvFile');
            $filename = $file->getClientOriginalName(); // image.jpg
            Storage::putFileAs('public/' . session('id') . "/import", $file, $filename);
        }
        $data = $this->kama_parse_csv_file(public_path() . "/storage/" . session('id') . "/import/" . $filename);
        $row = 0;
        foreach ($data as $oneData) {
            if ($row != 0) {

                $note = new Note();
                $note->idUser = session('id');
                $note->nameNotes = $oneData[2];
                $note->textNotes = $oneData[3];
                $note->save();
            } else {
                $row .= 1;
            }
        }
        return redirect("/");
    }


    public function deletePostNote(Response $response)
    {
        Note::where('idNotes', '=', $_POST['deleteNote'])->delete();
        File::deleteDirectory(public_path() . "/storage/" . session('id') . "/" . $_POST['deleteNote']);
        return redirect("/");
    }


}
