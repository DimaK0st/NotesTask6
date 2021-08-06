<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!is_null(session('id'))) {
            $allNotes = Note::selectRaw('`id`, `id_user`, `name` , LEFT (text, 200) as text ')
                ->where('id_user', '=', session('id'))
                ->orderBy('id', 'desc')->get();
        } else {
            $allNotes = Note::where('id_user', '=', "-1")->orderBy('id', 'desc')->get();
        }
        for ($i = 0; $i < count($allNotes); $i++) {
            $path = session('id') . "/" . (string)$allNotes[$i]['id'];
            $pathScan = public_path('../public/storage/' . $allNotes[$i]['id_user'] . "/" . $allNotes[$i]['id']);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addNote');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idUser = session('id');
        $note = new Note();
        $note->id_user = $idUser;
        $note->name = $request->inputNameNote;
        $note->text = $request->inputTextNote;
        $note->save();
        $idTheme = $note->id;

        echo $idTheme;
        return app('App\Http\Controllers\ImageController')->addNote($request, $idUser . "/" . $idTheme);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oneNotes = Note::where('id', '=', $id)->orderBy('id', 'desc')->first();
        $allImage = $this->getAllImageNote($oneNotes['id_user'], $oneNotes['id']);
        return view('getNote', ["oneNotes" => $oneNotes, "allImage" => $allImage]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oneNotes = Note::where('id', '=', $id)->first();
        echo "<!DOCTYPE html>";
        $allImage = $this->getAllImageNote($oneNotes['id_user'], $oneNotes['id']);
        return view('editNote', ["oneNotes" => $oneNotes, "allImage" => $allImage]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $note = Note::where('id', $request->idNotes)->update(['name' => $request->inputNameNote, 'text' => $request->inputTextNote]);
        return redirect()->route('getNote', $request->idNotes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::where('id', '=', $id)->delete();
        File::deleteDirectory(public_path() . "/storage/" . session('id') . "/" . $id);
        return redirect()->route('notes.index');
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

            "id",
            "id_user",
            "name",
            "text"
        ], '|');

        $Notes = Note::where('id_user', '=', session('id'))->get();
        foreach ($Notes as $row) {
            // Add a new row with data
            fputcsv($handle, [
                $row->idNotes,
                $row->id_user,
                $row->name,
                $row->text
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
                $note->id_user = session('id');
                $note->name = $oneData[2];
                $note->text = $oneData[3];
                $note->save();
            } else {
                $row .= 1;
            }
        }
        return redirect()->route('home');
    }


}
