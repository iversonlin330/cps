<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //

    protected $guarded = ['id'];

    public function units()
    {
        return $this->belongsToMany('App\Unit')->orderBy('order', 'desc');
    }

    public function total_score()
    {

    }

    public function avg_score()
    {

    }
}
