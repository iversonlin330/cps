<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    public function tasks()
    {
        return $this->hasMany('\App\Task');
    }
}
