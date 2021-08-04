<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public $timestamps = false;


    public function notes(){
        return $this->hasMany('App/Note','id_User', "id");
    }
}
