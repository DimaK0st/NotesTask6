<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static $timestamps = false;
    public function authorizationPost(Request $request)
    {
        $userName = User::where('email', '=', $request->login)->orWhere('userName', '=', $request->login)->first();
        if ($userName !== null) {
            if ($request->password == $userName['password']) {
                session(['id' => $userName['id'],
                    'userName' => $userName['userName'],
                    'access' => 1]
                );
                return "1";
            } else {
                return "2";
            }
        }else {
            return "3";
        }
    }

    public function registerPost(Request $req)
    {
        $userEmail = User::where('email', '=', $req->login)->count();
        $userName = User::where('userName', '=', $req->login)->count();
        if ($userEmail > 0 or $userName > 0) {
            return "2";
        } else {
            $user = new User();
            $user->userName = $req->login;
            $user->email = $req->email;
            $user->password = $req->password;
            $user->save();

            return "1";
        }

    }

    public function show(Request $request, $id)
    {
        $value = $request->session()->get('key');

        //
    }
}
