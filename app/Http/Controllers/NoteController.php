<?php

namespace App\Http\Controllers;

use App\Models\Image;
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
            $allNotes = Note::selectRaw('`id`, `user_id`, `name` , LEFT (text, 200) as text')
                ->where('user_id', '=', session('id'))
                ->orderBy('id', 'desc')->get();
        } else {
            $allNotes = Note::where('user_id', '=', "-1")->orderBy('id', 'desc')->get();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idUser = session('id');
        $note = new Note();
        $note->user_id = $idUser;
        $note->name = $request->inputNameNote;
        $note->text = $request->inputTextNote;
        $note->save();
        $idTheme = $note->id;
        $path = $idUser . "/" . $idTheme;
        return $this->imageNote($request, $path, $idTheme);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oneNotes = Note::where('id', '=', $id)->orderBy('id', 'desc')->first();
        return view('getNote', ["oneNotes" => $oneNotes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oneNotes = Note::where('id', '=', $id)->first();
        echo "<!DOCTYPE html>";
        return view('editNote', ["oneNotes" => $oneNotes]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idUser = session('id');
        $path = $request->tempNoteDelete;
        $path = explode(",", $path);
        foreach ($path as $onePath) {
            if ($onePath != "") {
                $result = str_replace("http://notestask6", "", $onePath);
                if (is_readable(public_path($result))) {
                    unlink(public_path($result));
                    $result = str_replace("/storage/", "", $result);
                    Image::where('path', $result)->delete();
                }
            }
        }
        $this->imageNote($request, $idUser . "/" . $request->idNotes, $id);
        Note::where('id', $request->idNotes)->update(['name' => $request->inputNameNote, 'text' => $request->inputTextNote]);
        return redirect()->route('notes.show', $request->idNotes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::where('id', '=', $id)->delete();
        File::deleteDirectory(public_path() . "/storage/" . session('id') . "/" . $id);
        return redirect()->route('notes.index');
    }


    public function imageNote(Request $request, $path, $id)
    {

        for ($i = 1; $i < 6; $i++) {
            if (($request->isMethod('put') || $request->isMethod('post')) && $request->file('image_' . $i)) {
                $file = $request->file('image_' . $i);
                $filename = time() . $i . '_' . $file->getClientOriginalName(); // image.jpg
                Storage::putFileAs('public/' . $path, $file, $filename);

                $note = Note::find($id);
                $image = new Image([
                    'note_id' => $id,
                    'path' => $path . "/" . $filename,
                ]);
                $note->images()->save($image);
            }
        }
        return redirect()->route('home');
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
            "user_id",
            "name",
            "text"
        ], '|');

        $Notes = Note::where('user_id', '=', session('id'))->get();
        foreach ($Notes as $row) {
            // Add a new row with data
            fputcsv($handle, [
                $row->idNotes,
                $row->user_id,
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
                $note->user_id = session('id');
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
