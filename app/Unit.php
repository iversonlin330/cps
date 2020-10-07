<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded =['id'];

    public function tasks()
    {
        return $this->hasMany('\App\Task');
    }

    public function average_score()
    {
        return 3;
    }

    public function max_score()
    {
        return 5;
    }
}
