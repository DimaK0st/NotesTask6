<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        return view('home');

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
