<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteModel extends Model
{
    public $table = "notes";
    public $timestamps = false;
    use HasFactory;
}
