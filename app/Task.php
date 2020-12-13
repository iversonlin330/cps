<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    protected $guarded =['id'];

    protected $casts = [
        'content' => 'array'
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
	
	public function unit()
    {
        return $this->hasOne('\App\Unit', 'id', 'unit_id');
    }

    public function maxScore()
    {
        $this->content;
        return 5;
    }
}
