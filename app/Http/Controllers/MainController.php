<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function home(Request $request)
    {
        return redirect()->route('notes.index');
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

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('home');

    }
}
