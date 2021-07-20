<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static $timestamps = false;
    public function authorizationPost(Request $request)
    {
        $user= new UserModel();
        $user->userName;


        $user->checkUserData($request->login,$request->password);
        return var_dump($request->all());

    }
    public function registerPost(Request $req){

        $user= new UserModel();
        $user->userName= $req->login;
        $user->email=$req->email;
        $user->password=$req->password;
        $user->save();

        return var_dump($req->all());





    }
}
