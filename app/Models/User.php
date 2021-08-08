<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public $timestamps = false;
    protected $guarded=[];

    public function notes(){
        return $this->hasMany(Note::class);
    }
}
