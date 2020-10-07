<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $guarded =['id'];

    public function students()
    {
        return $this->hasMany('\App\User', 'classroom_id');
    }

    public function teacher()
    {
        return $this->belongsTo('\App\User', 'id', 'user_id');
    }
}
