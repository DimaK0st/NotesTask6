<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static $timestamps = false;

    public function authorizationPost(Request $request)
    {
        $userName = UserModel::where('email', '=', $request->login)->orWhere('userName', '=', $request->login)->first();
        if ($userName !== null) {
            if ($request->password == $userName['password']) {
                $data = array(
                    'id' => $userName['id'],
                    'userName' => $userName['userName'],
                    'access' => 1
                );
                return json_encode($data);
            } else {
                return "2";
            }


        }
    }

    public function registerPost(Request $req)
    {
        $userEmail = UserModel::where('email', '=', $req->login)->count();
        $userName = UserModel::where('userName', '=', $req->login)->count();
        if ($userEmail > 0 or $userName > 0) {
            return "2";
        } else {
            $user = new UserModel();
            $user->userName = $req->login;
            $user->email = $req->email;
            $user->password = $req->password;
            $user->save();

            return "1";
        }

    }
}
