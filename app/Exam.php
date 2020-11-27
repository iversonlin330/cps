<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //

    protected $guarded = ['id'];

    protected $casts = [
        'unit_id' => 'array'
    ];

    public function units()
    {
        return Unit::whereIn('id',$this->unit_id)->get();

        return $this->belongsToMany('App\Unit')->orderBy('order', 'desc');
    }

    public function total_score()
    {
        return 30;
    }

    public function avg_score()
    {
        return 22;
    }
}
