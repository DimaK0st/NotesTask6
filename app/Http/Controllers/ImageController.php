<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function addNote(Request $request, $path)
    {
        // загрузка файла
        for ($i = 1; $i < 6; $i++) {
            if ($request->isMethod('post') && $request->file('image_' . $i)) {
                $file = $request->file('image_' . $i);

                $filename = $file->getClientOriginalName(); // image.jpg
                Storage::putFileAs('public/'.$path, $file, $filename);

            }
        }



        return view('home',['path'=> $path."/".$filename]);
    }



    public function getSavedImages($path){

        $pathScan = public_path('../public/storage/'.$path);
        $files = scandir($pathScan);
        echo var_dump($files);

    }

}
