<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    //
    protected $guarded = ["id"];

    public function classrooms()
    {
        return $this->hasMany('\App\Classroom');
    }
}
